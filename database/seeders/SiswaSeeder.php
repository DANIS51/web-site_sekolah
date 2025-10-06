<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nisn' => '1234567890',
            'nama_siswa' => 'Ahmad Fauzi',
            'jenis_kelamin' => 'Laki-laki',
            'tahun_masuk' => 2020,
            'alamat' => 'Jl. Sudirman No. 1, Jakarta',
        ]);

        Siswa::create([
            'nisn' => '1234567891',
            'nama_siswa' => 'Siti Aminah',
            'jenis_kelamin' => 'Perempuan',
            'tahun_masuk' => 2021,
            'alamat' => 'Jl. Thamrin No. 2, Jakarta',
        ]);

        Siswa::create([
            'nisn' => '1234567892',
            'nama_siswa' => 'Budi Santoso',
            'jenis_kelamin' => 'Laki-laki',
            'tahun_masuk' => 2019,
            'alamat' => 'Jl. Gatot Subroto No. 3, Jakarta',
        ]);
    }
}
