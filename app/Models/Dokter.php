<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $fillable = [
        'nama_dokter',
    ];

    public function pendaftaran() 
    { 
        return $this->hasMany(Dokter::class);
    }
}
