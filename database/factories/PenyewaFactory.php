<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penyewa>
 */
class PenyewaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaBefore = ['Budi', 'Siti', 'Ahmad', 'Dewi', 'Rudi', 'Indra', 'Putri', 'Wayan', 'Eka', 'Rina', 'Hendra', 'Dina', 'Bambang', 'Lestari', 'Yusuf', 'Nadia', 'Suryanto', 'Anita', 'Rahmat', 'Sonia'];
        $namaAfter = ['Setiawan', 'Rahman', 'Santoso', 'Wijaya', 'Kusuma', 'Pratama', 'Nugraha', 'Siswanto', 'Sutrisno', 'Handoko', 'Suharto', 'Hartono', 'Widodo', 'Gunawan', 'Hermawan', 'Adi', 'Saputra', 'Riyanto', 'Susanto', 'Fahmi'];
        
        $nama = $this->faker->randomElement($namaBefore) . ' ' . $this->faker->randomElement($namaAfter);

        return [
            'nama_lengkap' => $nama,
            'nomor_telepon' => $this->faker->numerify('08##########'),
            'nomor_ktp' => $this->faker->unique()->numerify('####################'),
            'alamat_asal' => $this->faker->address(),
            'pekerjaan' => $this->faker->randomElement(['Mahasiswa', 'Karyawan', 'Wiraswasta', 'Guru', 'Perawat']),
        ];
    }
}
