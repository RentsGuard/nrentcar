<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::with('manager')->latest()->get();
        return view('mobil.index', compact('mobils'));
    }

    public function create()
    {
        return view('mobil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'plat_mobil' => 'required|string|max:20|unique:mobil,plat_mobil',
            'tahun_mobil' => 'required|integer|min:2000|max:2030',
            'tipe_mobil' => 'nullable|string|max:50',
            'kapasitas_mobil' => 'required|integer|min:1|max:20',
            'bahan_bakar' => 'nullable|string|max:20',
            'harga_mobil' => 'required|numeric|min:0',
            'status_mobil' => 'required|in:tersedia,disewa,maintenance',
            'foto_mobil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama_mobil' => $validated['nama_mobil'],
            'plat_mobil' => $validated['plat_mobil'],
            'tahun_mobil' => $validated['tahun_mobil'],
            'tipe_mobil' => $validated['tipe_mobil'],
            'kapasitas_mobil' => $validated['kapasitas_mobil'],
            'bahan_bakar' => $validated['bahan_bakar'],
            'harga_mobil' => $validated['harga_mobil'],
            'status_mobil' => $validated['status_mobil'],
            'managed_by' => auth()->id(),
        ];

        if ($request->hasFile('foto_mobil')) {
            $data['foto_mobil'] = $request->file('foto_mobil')->store('foto_mobil', 'public');
        }

        $mobil = Mobil::create($data);

        activity()->performedOn($mobil)->log("Mobil {$mobil->nama_mobil} created");

        return redirect('/mobil')
            ->with('success', 'Mobil berhasil ditambahkan');
    }

    public function show($id)
    {
        $mobil = Mobil::with('manager', 'penyewaan')->findOrFail($id);
        return view('mobil.show', compact('mobil'));
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('mobil.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'plat_mobil' => 'required|string|max:20|unique:mobil,plat_mobil,' . $mobil->id,
            'tahun_mobil' => 'required|integer|min:2000|max:2030',
            'tipe_mobil' => 'nullable|string|max:50',
            'kapasitas_mobil' => 'required|integer|min:1|max:20',
            'bahan_bakar' => 'nullable|string|max:20',
            'harga_mobil' => 'required|numeric|min:0',
            'status_mobil' => 'required|in:tersedia,disewa,maintenance',
            'foto_mobil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama_mobil' => $validated['nama_mobil'],
            'plat_mobil' => $validated['plat_mobil'],
            'tahun_mobil' => $validated['tahun_mobil'],
            'tipe_mobil' => $validated['tipe_mobil'],
            'kapasitas_mobil' => $validated['kapasitas_mobil'],
            'bahan_bakar' => $validated['bahan_bakar'],
            'harga_mobil' => $validated['harga_mobil'],
            'status_mobil' => $validated['status_mobil'],
        ];

        if ($request->hasFile('foto_mobil')) {
            if ($mobil->foto_mobil) {
                Storage::disk('public')->delete($mobil->foto_mobil);
            }
            $data['foto_mobil'] = $request->file('foto_mobil')->store('foto_mobil', 'public');
        }

        $mobil->update($data);

        activity()->performedOn($mobil)->log("Mobil {$mobil->nama_mobil} updated");

        return redirect('/mobil')
            ->with('success', 'Data mobil berhasil diupdate');
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        if ($mobil->foto_mobil) {
            Storage::disk('public')->delete($mobil->foto_mobil);
        }

        $name = $mobil->nama_mobil;
        $mobil->delete();

        activity()->log("Mobil {$name} deleted");

        return redirect('/mobil')
            ->with('success', 'Data mobil berhasil dihapus');
    }
}
