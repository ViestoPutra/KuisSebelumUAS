<?php

namespace Database\Seeders;

use App\Models\KontrakSewa;
use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KontrakSewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 8 kontrak sewa
        for ($i = 0; $i < 8; $i++) {
            $kamar = Kamar::inRandomOrder()->first();
            
            KontrakSewa::factory()->create([
                'kamar_id' => $kamar->id,
            ]);

            // Update kamar status to terisi
            $kamar->update(['status' => 'terisi']);
        }

        // Set remaining kamar as tersedia
        Kamar::where('status', '!=', 'terisi')->update(['status' => 'tersedia']);
    }
}
