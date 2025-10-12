<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisVitamin extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_vitamin',
        'nama_vitamin',
        'deskripsi',
    ];

    public function pemberianVitamins()
    {
        return $this->hasMany(PemberianVitamin::class);
    }
}
