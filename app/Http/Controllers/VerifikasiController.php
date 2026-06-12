<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Verifikasi;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $verifikasis = Verifikasi::with('customer', 'verifier')->latest()->get();

        return view('verifikasi.index', compact('verifikasis'));
    }

    public function create()
    {
        $customers = Customer::orderBy('nama_customer')->get();

        return view('verifikasi.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tanggal_verifikasi' => 'required|date',
            'status_verifikasi' => 'required|in:menunggu,disetujui,ditolak',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $validated['verified_by'] = auth()->id();

        $verifikasi = Verifikasi::create($validated);

        activity()->performedOn($verifikasi)->log("Verifikasi {$verifikasi->customer->nama_customer} created");

        return redirect('/verifikasi')
            ->with('success', 'Data verifikasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $verifikasi = Verifikasi::with('customer', 'verifier')->findOrFail($id);

        return view('verifikasi.show', compact('verifikasi'));
    }

    public function edit($id)
    {
        $verifikasi = Verifikasi::findOrFail($id);

        return view('verifikasi.edit', compact('verifikasi'));
    }

    public function update(Request $request, $id)
    {
        $verifikasi = Verifikasi::findOrFail($id);

        $validated = $request->validate([
            'tanggal_verifikasi' => 'required|date',
            'status_verifikasi' => 'required|in:menunggu,disetujui,ditolak',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $verifikasi->update($validated);

        activity()->performedOn($verifikasi)->log("Verifikasi {$verifikasi->customer->nama_customer} updated");

        return redirect('/verifikasi')
            ->with('success', 'Data verifikasi berhasil diupdate');
    }

    public function destroy($id)
    {
        $verifikasi = Verifikasi::findOrFail($id);

        $customerName = $verifikasi->customer->nama_customer ?? $verifikasi->id;
        $verifikasi->delete();

        activity()->log("Verifikasi {$customerName} deleted");

        return redirect('/verifikasi')
            ->with('success', 'Data verifikasi berhasil dihapus');
    }
}
