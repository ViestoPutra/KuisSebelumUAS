<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 standard kamar
        Kamar::factory(5)->create([
            'tipe' => 'standard',
            'harga_bulanan' => 1200000,
            'fasilitas' => 'Kasur, Meja, Lemari, Kipas Angin',
        ]);

        // Create 5 deluxe kamar
        Kamar::factory(5)->create([
            'tipe' => 'deluxe',
            'harga_bulanan' => 1700000,
            'fasilitas' => 'Kasur, Meja, Lemari, AC, WiFi, TV',
        ]);

        // Create 5 vip kamar
        Kamar::factory(5)->create([
            'tipe' => 'vip',
            'harga_bulanan' => 2500000,
            'fasilitas' => 'Kasur, Meja, Lemari, AC Premium, WiFi Ultra, Smart TV, Kamar Mandi Dalam',
        ]);
    }
}
