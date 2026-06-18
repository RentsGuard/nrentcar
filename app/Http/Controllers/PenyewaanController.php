<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Penyewaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'jam_sewa' => 'nullable|date_format:H:i',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'jam_kembali' => 'nullable|date_format:H:i',
            'total_harga' => 'required|numeric|min:0',
            'denda_per_jam' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        $validated['jam_sewa'] = $validated['jam_sewa'] ?? '08:00';
        $validated['jam_kembali'] = $validated['jam_kembali'] ?? '17:00';

        $mobil = Mobil::where('id', $validated['mobil_id'])
            ->where('status_mobil', 'tersedia')
            ->firstOrFail();

        $mulai = Carbon::parse($validated['tanggal_sewa'] . ' ' . $validated['jam_sewa']);
        $selesai = Carbon::parse($validated['tanggal_kembali'] . ' ' . $validated['jam_kembali']);
        $validated['lama_sewa'] = max(1, (int) ceil($mulai->diffInMinutes($selesai) / (60 * 24)));

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'aktif';

        $penyewaan = DB::transaction(function () use ($validated, $mobil) {
            $penyewaan = Penyewaan::create($validated);
            $mobil->update(['status_mobil' => 'disewa']);
            return $penyewaan;
        });

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
            'jam_sewa' => 'nullable|date_format:H:i',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'jam_kembali' => 'nullable|date_format:H:i',
            'total_harga' => 'required|numeric|min:0',
            'denda_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $validated['jam_sewa'] = $validated['jam_sewa'] ?? '08:00';
        $validated['jam_kembali'] = $validated['jam_kembali'] ?? '17:00';

        $mulai = Carbon::parse($validated['tanggal_sewa'] . ' ' . $validated['jam_sewa']);
        $selesai = Carbon::parse($validated['tanggal_kembali'] . ' ' . $validated['jam_kembali']);
        $validated['lama_sewa'] = max(1, (int) ceil($mulai->diffInMinutes($selesai) / (60 * 24)));

        $oldStatus = $penyewaan->status;

        DB::transaction(function () use ($penyewaan, $validated, $oldStatus) {
            $penyewaan->update($validated);

            $mobil = Mobil::withTrashed()->find($penyewaan->mobil_id);
            if (!$mobil) return;

            if ($validated['status'] === 'aktif' && $oldStatus !== 'aktif') {
                $mobil->update(['status_mobil' => 'disewa']);
            } elseif (in_array($validated['status'], ['selesai', 'dibatalkan']) && $oldStatus === 'aktif') {
                $mobil->update(['status_mobil' => 'tersedia']);
            }
        });

        activity()->performedOn($penyewaan)->log("Penyewaan #{$penyewaan->id} updated");

        return redirect('/penyewaan')
            ->with('success', 'Data penyewaan berhasil diupdate');
    }

    public function destroy($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        DB::transaction(function () use ($penyewaan) {
            $penyewaan->delete();
            Mobil::where('id', $penyewaan->mobil_id)
                ->where('status_mobil', 'disewa')
                ->update(['status_mobil' => 'tersedia']);
        });

        activity()->log("Penyewaan #{$penyewaan->id} deleted");

        return redirect('/penyewaan')
            ->with('success', 'Data penyewaan berhasil dihapus');
    }
}
