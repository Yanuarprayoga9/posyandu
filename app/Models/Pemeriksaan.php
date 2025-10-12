<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'anak_id',
        'tanggal_pemeriksaan',
        'usia_bulan',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lingkar_lengan_atas',
        'suhu_tubuh',
        'vitamin_obat',
        'tindakan',
        'status_gizi',
        'petugas',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'lingkar_kepala' => 'decimal:2',
        'lingkar_lengan_atas' => 'decimal:2',
        'suhu_tubuh' => 'decimal:1',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    public function pemberianVitamins()
    {
        return $this->hasMany(PemberianVitamin::class);
    }
}
