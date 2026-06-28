<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenyewaanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'mobil_id' => Mobil::factory(),
            'user_id' => User::factory(),
            'tanggal_sewa' => now(),
            'jam_sewa' => '08:00',
            'tanggal_kembali' => now()->addDays(3),
            'jam_kembali' => '17:00',
            'lama_sewa' => 3,
            'total_harga' => 350000 * 3,
            'denda_per_jam' => 50000,
            'status' => 'aktif',
        ];
    }
}
