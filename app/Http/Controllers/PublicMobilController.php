<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class PublicMobilController extends Controller
{
    public function index(Request $request)
    {
        $query = Mobil::where('is_visible', true);

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

        $sort = $request->input('sort', 'terbaru');
        match ($sort) {
            'termurah' => $query->orderBy('harga_mobil'),
            'termahal' => $query->orderByDesc('harga_mobil'),
            default => $query->latest(),
        };

        $mobilList = $query->paginate(9)->withQueryString();
        $bahanBakarList = Mobil::where('is_visible', true)
            ->select('bahan_bakar')
            ->distinct()
            ->whereNotNull('bahan_bakar')
            ->pluck('bahan_bakar');
        $kapasitasList = Mobil::where('is_visible', true)
            ->select('kapasitas_mobil')
            ->distinct()
            ->whereNotNull('kapasitas_mobil')
            ->orderBy('kapasitas_mobil')
            ->pluck('kapasitas_mobil');

        $statusList = ['tersedia', 'disewa', 'maintenance'];

        return view('public.mobil.index', compact('mobilList', 'bahanBakarList', 'kapasitasList', 'statusList'));
    }

    public function show($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobilLain = Mobil::where('is_visible', true)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('public.mobil.show', compact('mobil', 'mobilLain'));
    }
}
