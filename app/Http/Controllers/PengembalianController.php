<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Pengembalian;
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
            'tanggal_pengembalian' => 'required|date',
            'kondisi_mobil' => 'nullable|string|max:255',
            'denda' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        $penyewaan = Penyewaan::findOrFail($validated['penyewaan_id']);

        if ($penyewaan->pengembalian) {
            return back()->with('error', 'Penyewaan ini sudah memiliki data pengembalian');
        }

        $pengembalian = Pengembalian::create($validated);

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
            'denda' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        $pengembalian->update($validated);

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
