<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'lokasi_kegiatan',
        'sasaran_kegiatan',
        'penanggung_jawab',
        'dokumentasi',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];
}
