<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        $query = Mobil::with('manager')->withCount('penyewaan');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_mobil', 'like', "%{$search}%")
                    ->orWhere('tipe_mobil', 'like', "%{$search}%")
                    ->orWhere('plat_mobil', 'like', "%{$search}%");
            });
        }

        if ($bahan_bakar = $request->input('bahan_bakar')) {
            $query->where('bahan_bakar', $bahan_bakar);
        }

        if ($kapasitas = $request->input('kapasitas')) {
            $query->where('kapasitas_mobil', (int) $kapasitas);
        }

        if ($status = $request->input('status')) {
            $query->where('status_mobil', $status);
        }

        $query->orderBy('is_visible', 'desc');

        $sort = $request->input('sort', 'terbaru');
        match ($sort) {
            'termurah' => $query->orderBy('harga_mobil'),
            'termahal' => $query->orderByDesc('harga_mobil'),
            default => $query->latest(),
        };

        $mobils = $query->paginate(15)->withQueryString();

        $bahanBakarList = Mobil::query()
            ->select('bahan_bakar')
            ->distinct()
            ->whereNotNull('bahan_bakar')
            ->pluck('bahan_bakar');
        $kapasitasList = Mobil::query()
            ->select('kapasitas_mobil')
            ->distinct()
            ->whereNotNull('kapasitas_mobil')
            ->orderBy('kapasitas_mobil')
            ->pluck('kapasitas_mobil');
        $statusList = ['tersedia', 'disewa', 'maintenance'];

        return view('mobil.index', compact('mobils', 'bahanBakarList', 'kapasitasList', 'statusList'));
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

        $validated['managed_by'] = auth()->id();

        if ($request->hasFile('foto_mobil')) {
            $validated['foto_mobil'] = $request->file('foto_mobil')->store('foto_mobil', 'public');
        }

        $mobil = Mobil::create($validated);

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
            'plat_mobil' => 'required|string|max:20|unique:mobil,plat_mobil,'.$mobil->id,
            'tahun_mobil' => 'required|integer|min:2000|max:2030',
            'tipe_mobil' => 'nullable|string|max:50',
            'kapasitas_mobil' => 'required|integer|min:1|max:20',
            'bahan_bakar' => 'nullable|string|max:20',
            'harga_mobil' => 'required|numeric|min:0',
            'status_mobil' => 'required|in:tersedia,disewa,maintenance',
            'foto_mobil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_mobil')) {
            if ($mobil->foto_mobil) {
                Storage::disk('public')->delete($mobil->foto_mobil);
            }
            $validated['foto_mobil'] = $request->file('foto_mobil')->store('foto_mobil', 'public');
        }

        $mobil->update($validated);

        activity()->performedOn($mobil)->log("Mobil {$mobil->nama_mobil} updated");

        return redirect('/mobil')
            ->with('success', 'Data mobil berhasil diupdate');
    }

    public function toggleVisibility($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->update(['is_visible' => !$mobil->is_visible]);

        $status = $mobil->is_visible ? 'ditampilkan' : 'disembunyikan';
        activity()->performedOn($mobil)->log("Mobil {$mobil->nama_mobil} {$status}");

        return redirect('/mobil')
            ->with('success', "Mobil {$mobil->nama_mobil} berhasil {$status}");
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $mobil = Mobil::findOrFail($id);

        if ($mobil->penyewaan()->exists()) {
            return back()->with('error', 'Mobil tidak dapat dihapus karena memiliki riwayat penyewaan. Gunakan fitur sembunyikan saja.');
        }

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
