<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poli::create([
            'nama_poli' => 'Poli Umum',
            'kuota' => 50
        ]);

        Poli::create([
            'nama_poli' => 'Poli Gigi',
            'kuota' => 20
        ]);
        
        Poli::create([
            'nama_poli' => 'Poli Mata',
            'kuota' => 15
        ]);
    }
}
