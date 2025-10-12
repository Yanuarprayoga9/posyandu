<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisImunisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_imunisasi',
        'nama_imunisasi',
        'deskripsi',
        'usia_target_bulan',
    ];

    public function imunisasis()
    {
        return $this->hasMany(Imunisasi::class);
    }
}
