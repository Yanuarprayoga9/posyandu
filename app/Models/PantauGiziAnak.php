<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PantauGiziAnak extends Model
{
    protected $fillable = [
        'anak_id',
        'tanggal_pemeriksaan',
        'umur_bulan',
        'petugas',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lingkar_lengan_atas',
        'bb_u',
        'tb_u',
        'bb_tb',
        'imt_u',
        'kategori_gizi',
        'frekuensi_makan',
        'frekuensi_camilan',
        'makanan_pokok',
        'protein_hewani',
        'konsumsi_sayur_buah',
        'asupan_asi',
        'catatan',
        'rekomendasi',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'protein_hewani' => 'array',
        'konsumsi_sayur_buah' => 'boolean',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}

