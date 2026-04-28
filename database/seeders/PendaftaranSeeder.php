<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pendaftaran::create([
            'pasien_id' => 1,
            'poli_id' => 1,
            'dokter_id' => 1,
            'tanggal_daftar' => now(),
        ]);
        Pendaftaran::create([
            'pasien_id' => 2,
            'poli_id' => 2,
            'dokter_id' => 2,
            'tanggal_daftar' => now(),
        ]);
        Pendaftaran::create([
            'pasien_id' => 3,
            'poli_id' => 3,
            'dokter_id' => 3,
            'tanggal_daftar' => now(),
        ]);
    }
}
