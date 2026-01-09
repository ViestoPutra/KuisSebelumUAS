<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    private static $kamarCounter = 2001;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipe = $this->faker->randomElement(['standard', 'deluxe', 'vip']);
        
        $harga = match($tipe) {
            'standard' => $this->faker->numberBetween(1000000, 1500000),
            'deluxe' => $this->faker->numberBetween(1500000, 2000000),
            'vip' => $this->faker->numberBetween(2000000, 3000000),
        };

        $fasilitas = match($tipe) {
            'standard' => 'Kasur, Meja, Lemari, Kipas Angin',
            'deluxe' => 'Kasur, Meja, Lemari, AC, WiFi, TV',
            'vip' => 'Kasur, Meja, Lemari, AC Premium, WiFi Ultra, Smart TV, Kamar Mandi Dalam',
        };

        $nomor = self::$kamarCounter++;

        return [
            'nomor_kamar' => (string) $nomor,
            'tipe' => $tipe,
            'harga_bulanan' => $harga,
            'fasilitas' => $fasilitas,
            'status' => $this->faker->randomElement(['tersedia', 'terisi']),
        ];
    }
}
