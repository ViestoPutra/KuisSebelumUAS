<?php

namespace Database\Factories;

use App\Models\Penyewa;
use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KontrakSewa>
 */
class KontrakSewaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalMulai = $this->faker->dateTimeBetween('-6 months', 'now');
        $tanggalSelesai = clone $tanggalMulai;
        $tanggalSelesai->modify('+' . $this->faker->numberBetween(1, 12) . ' months');

        $now = new \DateTime();
        $status = $tanggalSelesai > $now ? 'aktif' : 'selesai';

        return [
            'penyewa_id' => Penyewa::inRandomOrder()->first()?->id ?? Penyewa::factory(),
            'kamar_id' => Kamar::inRandomOrder()->first()?->id ?? Kamar::factory(),
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'harga_bulanan' => $this->faker->numberBetween(1000000, 3000000),
            'status' => $status,
        ];
    }
}
