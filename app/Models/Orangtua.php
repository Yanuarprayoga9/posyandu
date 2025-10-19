<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kk',
        'nik_ibu',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'golongan_darah_ibu',
        'nik_ayah',
        'nama_ayah',
        'no_telepon',
        'alamat',
    ];
}
