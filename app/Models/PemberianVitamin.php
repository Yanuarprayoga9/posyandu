<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemberianVitamin extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemeriksaan_id',
        'jenis_vitamin_id',
        'jumlah',
        'keterangan',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }

    public function jenisVitamin()
    {
        return $this->belongsTo(JenisVitamin::class);
    }
}
