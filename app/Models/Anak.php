<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $table = 'anaks';

    protected $fillable = [
        'nik_anak',
        'nama_anak',
        'tempat_lahir_anak',
        'tanggal_lahir_anak',
        'anak_ke',
        'golongan_darah',
        'jenis_kelamin',
        'nama_ibu',
    ];

    protected $casts = [
        'tanggal_lahir_anak' => 'date',
    ];

    /**
     * Get the age of the child in years
     */
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir_anak) {
            return null;
        }

        return $this->tanggal_lahir_anak->age;
    }

    /**
     * Get formatted gender
     */
    public function getJenisKelaminLengkapAttribute()
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Get formatted birth date
     */
    public function getTanggalLahirFormatAttribute()
    {
        if (!$this->tanggal_lahir_anak) {
            return '-';
        }

        return $this->tanggal_lahir_anak->format('d-m-Y');
    }
}
