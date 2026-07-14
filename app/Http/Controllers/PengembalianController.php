<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengembalian::with('penyewaan.customer', 'penyewaan.mobil');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('penyewaan.customer', function ($q2) use ($search) {
                    $q2->where('nama_customer', 'like', "%{$search}%");
                })->orWhereHas('penyewaan.mobil', function ($q2) use ($search) {
                    $q2->where('nama_mobil', 'like', "%{$search}%");
                });
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status_pengembalian', $status);
        }

        $pengembalians = $query->latest()->paginate(15);

        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        $penyewaans = Penyewaan::where('status', 'aktif')->with('customer', 'mobil')->orderBy('created_at', 'desc')->limit(500)->get();

        return view('pengembalian.create', compact('penyewaans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penyewaan_id' => 'required|exists:penyewaan,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_mobil' => 'nullable|string|max:255',
            'denda_kerusakan' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $penyewaan = Penyewaan::where('id', $validated['penyewaan_id'])
            ->where('status', 'aktif')
            ->firstOrFail();

        if ($penyewaan->pengembalian) {
            return back()->with('error', 'Penyewaan ini sudah memiliki data pengembalian');
        }

        $tanggalPengembalian = Carbon::parse($validated['tanggal_pengembalian']);
        $tglMulai = Carbon::parse($penyewaan->tanggal_sewa->format('Y-m-d').' '.($penyewaan->jam_sewa ?? '08:00'));

        if ($tanggalPengembalian->lessThanOrEqualTo($tglMulai)) {
            return back()->withErrors(['tanggal_pengembalian' => 'Tanggal pengembalian harus setelah tanggal sewa.'])->withInput();
        }

        $denda = $this->calculateDenda($penyewaan, $tanggalPengembalian, $validated['denda_kerusakan'] ?? null, $validated['kondisi_mobil'] ?? null);

        $data = [
            'penyewaan_id' => $validated['penyewaan_id'],
            'tanggal_pengembalian' => $tanggalPengembalian,
            'kondisi_mobil' => $validated['kondisi_mobil'] ?? null,
            'telat_jam' => $denda['telat_jam'],
            'denda_per_jam' => $denda['denda_per_jam'],
            'denda_telat' => $denda['denda_telat'],
            'denda_kerusakan' => $denda['denda_kerusakan'],
            'total_denda' => $denda['total_denda'],
            'status_pengembalian' => $denda['status_pengembalian'],
            'catatan' => $validated['catatan'] ?? null,
            'user_id' => auth()->id(),
        ];

        $pengembalian = DB::transaction(function () use ($data, $penyewaan) {
            $pengembalian = Pengembalian::create($data);
            $penyewaan->update(['status' => 'selesai']);
            $penyewaan->mobil()->update(['status_mobil' => 'tersedia']);
            return $pengembalian;
        });

        activity()->performedOn($pengembalian)->log("Pengembalian #{$penyewaan->id} dicatat");

        return redirect('/pengembalian')
            ->with('success', 'Data pengembalian berhasil dicatat');
    }

    public function show($id)
    {
        $pengembalian = Pengembalian::with('penyewaan.customer', 'penyewaan.mobil', 'penyewaan.user')->findOrFail($id);

        return view('pengembalian.show', compact('pengembalian'));
    }

    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        return view('pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        $validated = $request->validate([
            'tanggal_pengembalian' => 'required|date',
            'kondisi_mobil' => 'nullable|string|max:255',
            'denda_kerusakan' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $penyewaan = $pengembalian->penyewaan;

        $tglKembali = Carbon::parse($validated['tanggal_pengembalian']);
        $tglMulai = Carbon::parse($penyewaan->tanggal_sewa->format('Y-m-d').' '.($penyewaan->jam_sewa ?? '08:00'));

        if ($tglKembali->lessThanOrEqualTo($tglMulai)) {
            return back()->withErrors(['tanggal_pengembalian' => 'Tanggal pengembalian harus setelah tanggal sewa.'])->withInput();
        }

        $dendaKerusakan = $validated['denda_kerusakan'] ?? 0;
        $denda = $this->calculateDenda($penyewaan, $tglKembali, $dendaKerusakan, $validated['kondisi_mobil']);

        $existingDendaPerHari = (int) ($penyewaan->denda_per_jam ?? $denda['denda_per_jam']);
        $dendaTelatRecalc = $denda['telat_jam'] * $existingDendaPerHari;
        $totalDendaRecalc = $dendaTelatRecalc + $dendaKerusakan;

        $data = [
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'kondisi_mobil' => $validated['kondisi_mobil'] ?? null,
            'telat_jam' => $denda['telat_jam'],
            'denda_per_jam' => $existingDendaPerHari,
            'denda_telat' => $dendaTelatRecalc,
            'denda_kerusakan' => $dendaKerusakan,
            'total_denda' => $pengembalian->status_denda === 'lunas' ? $pengembalian->total_denda : $totalDendaRecalc,
            'status_pengembalian' => $denda['status_pengembalian'],
            'catatan' => $validated['catatan'] ?? null,
        ];

        if ($pengembalian->status_denda !== 'lunas') {
            $data['status_denda'] = 'belum_dibayar';
            $data['denda_lunas_at'] = null;
            $data['denda_lunas_by'] = null;
        }

        $pengembalian->update($data);

        activity()->performedOn($pengembalian)->log("Pengembalian #{$pengembalian->penyewaan_id} diperbarui");

        return redirect('/pengembalian')
            ->with('success', 'Data pengembalian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::with('penyewaan.mobil')->findOrFail($id);

        DB::transaction(function () use ($pengembalian) {
            $penyewaan = $pengembalian->penyewaan;

            if ($penyewaan) {
                $penyewaan->update(['status' => 'aktif']);
                if ($penyewaan->mobil) {
                    $penyewaan->mobil()->update(['status_mobil' => 'disewa']);
                }
            }

            $pengembalian->delete();
        });

        activity()->log("Pengembalian #{$pengembalian->penyewaan_id} deleted");

        return redirect('/pengembalian')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }

    public function tandaiLunas($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        if ($pengembalian->status_denda === 'lunas') {
            return back()->with('error', 'Denda sudah lunas');
        }

        $pengembalian->update([
            'status_denda' => 'lunas',
            'denda_lunas_at' => now(),
            'denda_lunas_by' => auth()->id(),
        ]);

        activity()->performedOn($pengembalian)->log("Pengembalian #{$pengembalian->penyewaan_id} denda ditandai lunas");

        return redirect('/pengembalian/' . $pengembalian->id)
            ->with('success', 'Denda ditandai lunas');
    }

    public function batalkanLunas($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        if ($pengembalian->status_denda !== 'lunas') {
            return back()->with('error', 'Denda belum lunas');
        }

        $pengembalian->update([
            'status_denda' => 'belum_dibayar',
            'denda_lunas_at' => null,
            'denda_lunas_by' => null,
        ]);

        activity()->performedOn($pengembalian)->log("Pengembalian #{$pengembalian->penyewaan_id} status denda dibatalkan");

        return redirect('/pengembalian/' . $pengembalian->id)
            ->with('success', 'Status denda dikembalikan ke belum dibayar');
    }

    private function calculateDenda($penyewaan, $tanggalPengembalian, $dendaKerusakan = null, $kondisiMobil = null)
    {
        $expectedDate = $penyewaan->tanggal_kembali;
        $expectedJam = $penyewaan->jam_kembali ?? '17:00';
        $deadline = Carbon::parse($expectedDate->format('Y-m-d').' '.$expectedJam);

        $returnDt = $tanggalPengembalian->copy();

        $isLate = $returnDt->gt($deadline);
        $isEarly = $returnDt->format('Y-m-d') < $expectedDate->format('Y-m-d');

        $telatJam = 0;
        $dendaTelat = 0;
        $dendaPerHari = (int) ($penyewaan->denda_per_jam ?? 200000);

        if ($isLate) {
            $diffMin = $deadline->diffInMinutes($returnDt, false);
            $telatJam = (int) ceil($diffMin / (60 * 24));
            $dendaTelat = $telatJam * $dendaPerHari;
        }

        $dendaKerusakan = $dendaKerusakan ?? 0;
        $totalDenda = $dendaTelat + $dendaKerusakan;

        $kondisi = $kondisiMobil ? strtolower(trim($kondisiMobil)) : null;
        if ($kondisi === 'rusak' && $isLate) {
            $status = 'telat_dan_rusak';
        } elseif ($kondisi === 'rusak') {
            $status = 'rusak';
        } elseif ($isLate) {
            $status = 'telat';
        } elseif ($isEarly) {
            $status = 'awal';
        } else {
            $status = 'tepat_waktu';
        }

        return [
            'telat_jam' => $telatJam,
            'denda_per_jam' => $dendaPerHari,
            'denda_telat' => $dendaTelat,
            'denda_kerusakan' => $dendaKerusakan,
            'total_denda' => $totalDenda,
            'status_pengembalian' => $status,
        ];
    }
}
