<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pasien;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pasien::create([
            'nomor_rm' => 'P-1',
            'nama_pasien' => 'Pasien 1',
            'alamat' => 'Alamat 1',
        ]);
        Pasien::create([
            'nomor_rm' => 'P-2',
            'nama_pasien' => 'Pasien 2',
            'alamat' => 'Alamat 2',
        ]);
        Pasien::create([
            'nomor_rm' => 'P-3',
            'nama_pasien' => 'Pasien 3',
            'alamat' => 'Alamat 3',
        ]);
    }
}
