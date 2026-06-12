<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class PublicMobilController extends Controller
{
    public function index(Request $request)
    {
        $query = Mobil::where('status_mobil', 'tersedia');

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
            $query->where('kapasitas_mobil', '>=', (int) $kapasitas);
        }

        $sort = $request->input('sort', 'terbaru');
        match ($sort) {
            'termurah' => $query->orderBy('harga_mobil'),
            'termahal' => $query->orderByDesc('harga_mobil'),
            default => $query->latest(),
        };

        $mobilList = $query->paginate(9)->withQueryString();
        $bahanBakarList = Mobil::where('status_mobil', 'tersedia')
            ->select('bahan_bakar')
            ->distinct()
            ->pluck('bahan_bakar');

        return view('public.mobil.index', compact('mobilList', 'bahanBakarList'));
    }

    public function show($id)
    {
        $mobil = Mobil::where('status_mobil', 'tersedia')->findOrFail($id);
        $mobilLain = Mobil::where('status_mobil', 'tersedia')
            ->where('id_mobil', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('public.mobil.show', compact('mobil', 'mobilLain'));
    }
}
