<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('penyewaan.customer', 'penyewaan.mobil')->latest()->get();

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

        $penyewaan = Penyewaan::findOrFail($validated['penyewaan_id']);

        if ($penyewaan->pengembalian) {
            return back()->with('error', 'Penyewaan ini sudah memiliki data pengembalian');
        }

        $tanggalPengembalian = now();
        $deadline = Carbon::parse($penyewaan->tanggal_kembali->format('Y-m-d').' '.($penyewaan->jam_kembali ?? '17:00'));
        $telatJam = 0;
        if ($tanggalPengembalian->greaterThan($deadline)) {
            $totalJam = $deadline->diffInMinutes($tanggalPengembalian) / 60;
            $hariTelat = intdiv((int) $totalJam, 24);
            $sisaJam = (int) ceil($totalJam % 24);
            $telatJam = ($hariTelat * 8) + min($sisaJam, 8);
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

        $pengembalian = Pengembalian::create($data);

        $penyewaan->update(['status' => 'selesai']);
        $penyewaan->mobil()->update(['status_mobil' => 'tersedia']);

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
        $telatJam = 0;
        if ($tglKembali->greaterThan($deadline)) {
            $totalJam = $deadline->diffInMinutes($tglKembali) / 60;
            $hariTelat = intdiv((int) $totalJam, 24);
            $sisaJam = (int) ceil($totalJam % 24);
            $telatJam = ($hariTelat * 8) + min($sisaJam, 8);
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
        ];

        $pengembalian->update($data);

        activity()->performedOn($pengembalian)->log("Pengembalian #{$pengembalian->penyewaan_id} diperbarui");

        return redirect('/pengembalian')
            ->with('success', 'Data pengembalian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        $penyewaanId = $pengembalian->penyewaan_id;
        $pengembalian->delete();

        activity()->log("Pengembalian #{$penyewaanId} deleted");

        return redirect('/pengembalian')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }
}
