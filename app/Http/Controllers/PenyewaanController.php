<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function index()
    {
        $penyewaans = Penyewaan::with('customer', 'mobil', 'user')->latest()->get();

        return view('penyewaan.index', compact('penyewaans'));
    }

    public function create()
    {
        $customers = Customer::orderBy('nama_customer')->get();
        $mobils = Mobil::where('status_mobil', 'tersedia')->orderBy('nama_mobil')->get();

        return view('penyewaan.create', compact('customers', 'mobils'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'mobil_id' => 'required|exists:mobil,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'lama_sewa' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,menunggu,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        $penyewaan = Penyewaan::create($validated);

        if ($penyewaan->status === 'aktif') {
            Mobil::where('id', $penyewaan->mobil_id)->update(['status_mobil' => 'disewa']);
        }

        activity()->performedOn($penyewaan)->log("Penyewaan #{$penyewaan->id} created");

        return redirect('/penyewaan')
            ->with('success', 'Data penyewaan berhasil ditambahkan');
    }

    public function show($id)
    {
        $penyewaan = Penyewaan::with('customer', 'mobil', 'user')->findOrFail($id);

        return view('penyewaan.show', compact('penyewaan'));
    }

    public function edit($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        return view('penyewaan.edit', compact('penyewaan'));
    }

    public function update(Request $request, $id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        $validated = $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'lama_sewa' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,menunggu,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $oldStatus = $penyewaan->status;
        $penyewaan->update($validated);

        if ($penyewaan->status === 'dibatalkan' && $oldStatus !== 'dibatalkan') {
            Mobil::where('id', $penyewaan->mobil_id)->update(['status_mobil' => 'tersedia']);
        } elseif ($penyewaan->status === 'aktif' && $oldStatus !== 'aktif') {
            Mobil::where('id', $penyewaan->mobil_id)->update(['status_mobil' => 'disewa']);
        } elseif ($penyewaan->status === 'selesai' && $oldStatus !== 'selesai') {
            Mobil::where('id', $penyewaan->mobil_id)->update(['status_mobil' => 'tersedia']);
        }

        activity()->performedOn($penyewaan)->log("Penyewaan #{$penyewaan->id} updated");

        return redirect('/penyewaan')
            ->with('success', 'Data penyewaan berhasil diupdate');
    }

    public function destroy($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        $penyewaanId = $penyewaan->id;
        $penyewaan->delete();

        activity()->log("Penyewaan #{$penyewaanId} deleted");

        return redirect('/penyewaan')
            ->with('success', 'Data penyewaan berhasil dihapus');
    }
}
