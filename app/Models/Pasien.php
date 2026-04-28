<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'nomor_rm',
        'nama_pasien',
        'alamat',
    ];

    public function pendaftaran() 
    { 
        return $this->hasMany(Pendaftaran::class);
    }
}
