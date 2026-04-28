<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'pasien_id',
        'poli_id',
        'dokter_id',
        'tanggal_daftar',
    ];

    public function pasien() {
        return $this->belongsTo(Pasien::class);
    }

    public function poli() {
        return $this->belongsTo(Poli::class);
    }

    public function dokter() {
        return $this->belongsTo(Dokter::class);
    }
}
