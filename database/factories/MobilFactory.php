<?php

namespace Database\Factories;

use App\Models\Mobil;
use Illuminate\Database\Eloquent\Factories\Factory;

class MobilFactory extends Factory
{
    protected $model = Mobil::class;

    public function definition(): array
    {
        return [
            'nama_mobil' => fake()->randomElement(['Toyota Avanza', 'Honda Brio', 'Mitsubishi Xpander']),
            'plat_mobil' => fake()->unique()->regexify('[A-Z] \d{4} [A-Z]{3}'),
            'tahun_mobil' => fake()->numberBetween(2020, 2024),
            'tipe_mobil' => fake()->randomElement(['Matic', 'Manual']),
            'kapasitas_mobil' => fake()->numberBetween(2, 7),
            'harga_mobil' => fake()->numberBetween(200000, 1000000),
            'bahan_bakar' => fake()->randomElement(['Bensin', 'Solar', 'Listrik']),
            'status_mobil' => 'tersedia',
        ];
    }
}
