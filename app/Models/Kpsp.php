<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kpsp extends Model
{
    protected $fillable = [
        'anak_id',
        'tanggal_pemeriksaan',
        'berdiri_berpegangan',
        'berjalan_bantuan',
        'mengambil_benda_tangan',
        'mengambil_benda_kecil',
        'mengucap_suku_kata',
        'merespon_saat_dipanggil',
        'melepas_tangan',
        'menirukan_bunyi',
        'menunjuk_benda',
        'minum_cangkir',
        'catatan',
        'rekomendasi',
        'petugas',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'berdiri_berpegangan' => 'boolean',
        'berjalan_bantuan' => 'boolean',
        'mengambil_benda_tangan' => 'boolean',
        'mengambil_benda_kecil' => 'boolean',
        'mengucap_suku_kata' => 'boolean',
        'merespon_saat_dipanggil' => 'boolean',
        'melepas_tangan' => 'boolean',
        'menirukan_bunyi' => 'boolean',
        'menunjuk_benda' => 'boolean',
        'minum_cangkir' => 'boolean',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    public function getTotalSkorAttribute()
    {
        return (int)$this->berdiri_berpegangan +
            (int)$this->berjalan_bantuan +
            (int)$this->mengambil_benda_tangan +
            (int)$this->mengambil_benda_kecil +
            (int)$this->mengucap_suku_kata +
            (int)$this->merespon_saat_dipanggil +
            (int)$this->melepas_tangan +
            (int)$this->menirukan_bunyi +
            (int)$this->menunjuk_benda +
            (int)$this->minum_cangkir;
    }

    public function getUsiaBulanAttribute()
    {
        if (!$this->anak || !$this->anak->tanggal_lahir_anak) {
            return 0;
        }

        $birthDate = $this->anak->tanggal_lahir_anak;
        $examDate = \Carbon\Carbon::parse($this->tanggal_pemeriksaan);

        return $birthDate->diffInMonths($examDate);
    }
}
