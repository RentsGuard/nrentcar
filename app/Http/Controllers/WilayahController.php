<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    private $baseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    public function provinces()
    {
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/provinces.json");
        return response()->json($response->json());
    }

    public function regencies($provinceId)
    {
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/regencies/{$provinceId}.json");
        return response()->json($response->json());
    }

    public function districts($regencyId)
    {
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/districts/{$regencyId}.json");
        return response()->json($response->json());
    }

    public function villages($districtId)
    {
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/villages/{$districtId}.json");
        return response()->json($response->json());
    }
}
