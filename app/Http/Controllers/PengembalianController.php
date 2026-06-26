<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $query = Pengembalian::with('penyewaan.customer', 'penyewaan.mobil');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('penyewaan.customer', function ($q2) use ($search) {
                    $q2->where('nama_customer', 'like', "%{$search}%");
                })->orWhereHas('penyewaan.mobil', function ($q2) use ($search) {
                    $q2->where('nama_mobil', 'like', "%{$search}%");
                });
            });
        }

        if ($status = request('status')) {
            $query->where('status_pengembalian', $status);
        }

        $pengembalians = $query->latest()->get();

        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        $penyewaans = Penyewaan::where('status', 'aktif')->with('customer', 'mobil')->orderBy('created_at', 'desc')->get();

        return view('pengembalian.create', compact('penyewaans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penyewaan_id' => 'required|exists:penyewaan,id',
            'kondisi_mobil' => 'nullable|string|max:255',
            'denda_kerusakan' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        $penyewaan = Penyewaan::where('id', $validated['penyewaan_id'])
            ->where('status', 'aktif')
            ->firstOrFail();

        if ($penyewaan->pengembalian) {
            return back()->with('error', 'Penyewaan ini sudah memiliki data pengembalian');
        }

        $tanggalPengembalian = now();
        $deadline = Carbon::parse($penyewaan->tanggal_kembali->format('Y-m-d').' '.($penyewaan->jam_kembali ?? '17:00'));
        $telatJam = 0;
        if ($tanggalPengembalian->greaterThan($deadline)) {
            $telatJam = (int) ceil($deadline->diffInMinutes($tanggalPengembalian) / 60);
        }
        $dendaPerJam = $penyewaan->denda_per_jam ?? 0;
        $dendaTelat = $telatJam * $dendaPerJam;
        $dendaKerusakan = (float) ($validated['denda_kerusakan'] ?? 0);
        $totalDenda = $dendaTelat + $dendaKerusakan;

        $adaTelat = $telatJam > 0;
        $adaRusak = $dendaKerusakan > 0;
        if ($adaTelat && $adaRusak) {
            $statusPengembalian = 'telat_dan_rusak';
        } elseif ($adaTelat) {
            $statusPengembalian = 'telat';
        } elseif ($adaRusak) {
            $statusPengembalian = 'rusak';
        } else {
            $statusPengembalian = 'tepat_waktu';
        }

        $data = [
            'penyewaan_id' => $validated['penyewaan_id'],
            'tanggal_pengembalian' => $tanggalPengembalian,
            'kondisi_mobil' => $validated['kondisi_mobil'] ?? null,
            'telat_jam' => $telatJam,
            'denda_per_jam' => $dendaPerJam,
            'denda_telat' => $dendaTelat,
            'denda_kerusakan' => $dendaKerusakan,
            'total_denda' => $totalDenda,
            'status_pengembalian' => $statusPengembalian,
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
            'catatan' => 'nullable|string',
        ]);

        $penyewaan = $pengembalian->penyewaan;

        $tglKembali = Carbon::parse($validated['tanggal_pengembalian']);
        $deadline = Carbon::parse($penyewaan->tanggal_kembali->format('Y-m-d').' '.($penyewaan->jam_kembali ?? '17:00'));
        $tglMulai = Carbon::parse($penyewaan->tanggal_sewa->format('Y-m-d').' '.($penyewaan->jam_sewa ?? '08:00'));

        if ($tglKembali->lessThanOrEqualTo($tglMulai)) {
            return back()->withErrors(['tanggal_pengembalian' => 'Tanggal pengembalian harus setelah tanggal sewa.'])->withInput();
        }

        $telatJam = 0;
        if ($tglKembali->greaterThan($deadline)) {
            $telatJam = (int) ceil($deadline->diffInMinutes($tglKembali) / 60);
        }
        $dendaPerJam = $penyewaan->denda_per_jam ?? 0;
        $dendaTelat = $telatJam * $dendaPerJam;
        $dendaKerusakan = (float) ($validated['denda_kerusakan'] ?? 0);
        $totalDenda = $dendaTelat + $dendaKerusakan;

        $adaTelat = $telatJam > 0;
        $adaRusak = $dendaKerusakan > 0;
        if ($adaTelat && $adaRusak) {
            $statusPengembalian = 'telat_dan_rusak';
        } elseif ($adaTelat) {
            $statusPengembalian = 'telat';
        } elseif ($adaRusak) {
            $statusPengembalian = 'rusak';
        } else {
            $statusPengembalian = 'tepat_waktu';
        }

        $data = [
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'kondisi_mobil' => $validated['kondisi_mobil'] ?? null,
            'telat_jam' => $telatJam,
            'denda_per_jam' => $dendaPerJam,
            'denda_telat' => $dendaTelat,
            'denda_kerusakan' => $dendaKerusakan,
            'total_denda' => $totalDenda,
            'status_pengembalian' => $statusPengembalian,
            'catatan' => $validated['catatan'] ?? null,
            'status_denda' => 'belum_dibayar',
            'denda_lunas_at' => null,
            'denda_lunas_by' => null,
        ];

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
}
