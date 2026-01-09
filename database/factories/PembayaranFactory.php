<?php

namespace Database\Factories;

use App\Models\KontrakSewa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalBayar = $this->faker->dateTimeBetween('-3 months', 'now');

        return [
            'kontrak_sewa_id' => KontrakSewa::inRandomOrder()->first()?->id ?? KontrakSewa::factory(),
            'bulan' => $this->faker->numberBetween(1, 12),
            'tahun' => $this->faker->numberBetween(2025, 2026),
            'jumlah_bayar' => $this->faker->numberBetween(1000000, 3000000),
            'tanggal_bayar' => $tanggalBayar,
            'status' => $this->faker->randomElement(['lunas', 'tertunggak']),
            'keterangan' => $this->faker->optional()->sentence(),
            'bukti_transfer' => null,
        ];
    }
}
