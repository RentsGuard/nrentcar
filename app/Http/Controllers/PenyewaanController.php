<?php

namespace App\Http\Controllers;

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
        return view('penyewaan.create');
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
}
