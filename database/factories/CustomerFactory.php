<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'nama_customer' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => fake()->unique()->numerify('08##########'),
            'nik' => fake()->unique()->numerify(str_repeat('#', 16)),
            'alamat_customer' => fake()->address(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date('Y-m-d', '2000-01-01'),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
        ];
    }
}
