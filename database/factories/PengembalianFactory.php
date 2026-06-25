<?php

namespace Database\Factories;

use App\Models\Penyewaan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengembalianFactory extends Factory
{
    public function definition(): array
    {
        return [
            'penyewaan_id' => Penyewaan::factory(),
            'tanggal_pengembalian' => now(),
            'telat_jam' => 0,
            'denda_per_jam' => 0,
            'denda_telat' => 0,
            'denda_kerusakan' => 0,
            'total_denda' => 0,
            'status_pengembalian' => 'tepat_waktu',
            'catatan' => null,
            'foto_kondisi' => null,
            'user_id' => User::factory(),
        ];
    }

    public function telat(int $jam, int $dendaPerJam = 50000): static
    {
        return $this->state(fn(array $attr) => [
            'telat_jam' => $jam,
            'denda_per_jam' => $dendaPerJam,
            'denda_telat' => $jam * $dendaPerJam,
            'total_denda' => $jam * $dendaPerJam + ($attr['denda_kerusakan'] ?? 0),
            'status_pengembalian' => $jam > 0 && ($attr['denda_kerusakan'] ?? 0) > 0 ? 'telat_dan_rusak' : 'telat',
        ]);
    }

    public function rusak(int nominal): static
    {
        return $this->state(fn(array $attr) => [
            'denda_kerusakan' => $nominal,
            'total_denda' => ($attr['denda_telat'] ?? 0) + $nominal,
            'status_pengembalian' => ($attr['telat_jam'] ?? 0) > 0 && $nominal > 0 ? 'telat_dan_rusak' : 'rusak',
        ]);
    }
}
