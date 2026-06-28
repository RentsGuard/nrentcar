<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    private $baseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    public function provinces()
    {
        try {
            $response = Http::withoutVerifying()->timeout(10)->get("{$this->baseUrl}/provinces.json");
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data provinsi'], 500);
        }
    }

    public function regencies($provinceId)
    {
        try {
            $response = Http::withoutVerifying()->timeout(10)->get("{$this->baseUrl}/regencies/{$provinceId}.json");
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data kabupaten/kota'], 500);
        }
    }

    public function districts($regencyId)
    {
        try {
            $response = Http::withoutVerifying()->timeout(10)->get("{$this->baseUrl}/districts/{$regencyId}.json");
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data kecamatan'], 500);
        }
    }

    public function villages($districtId)
    {
        try {
            $response = Http::withoutVerifying()->timeout(10)->get("{$this->baseUrl}/villages/{$districtId}.json");
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data kelurahan'], 500);
        }
    }
}
