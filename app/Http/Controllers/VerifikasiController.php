<?php

namespace App\Http\Controllers;

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
        return view('verifikasi.create');
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
}
