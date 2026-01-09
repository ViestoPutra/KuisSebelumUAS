<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan semua seeders dalam urutan yang benar
        $this->call([
            KamarSeeder::class,
            PenyewaSeeder::class,
            KontrakSewaSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
