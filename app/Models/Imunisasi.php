<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'anak_id',
        'jenis_imunisasi_id',
        'tanggal_imunisasi',
        'usia_saat_imunisasi_bulan',
        'jenis_vaksin',
        'keterangan',
        'petugas',
    ];

    protected $casts = [
        'tanggal_imunisasi' => 'date',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    public function jenisImunisasi()
    {
        return $this->belongsTo(JenisImunisasi::class);
    }
}
