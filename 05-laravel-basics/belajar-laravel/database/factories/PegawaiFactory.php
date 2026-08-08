<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'posisi' => fake()->jobTitle(),
            'shift' => fake()->randomElement(['Pagi', 'Siang', 'Malam']),
            'departemen_id' => fake()->numberBetween(1, 3),
            'foto' => null,
        ];
    }
}
