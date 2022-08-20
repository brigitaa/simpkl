<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    public $table = "pengajuan";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'siswa_id',
        'periode_id',
        'dudi_id',
        'pernyataan_ortu',
        'pernyataan_siswa',
        'status_verif_pokja',
        'status_verif_kaprog'
    ];

    public function getTanggalMulaiAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getTanggalSelesaiAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
