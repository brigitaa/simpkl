<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    public $table = "kelas";
    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'kompetensi_keahlian_id'
    ];

    // public function siswa() {
	// 	return $this->belongsTo('Siswa', 'siswa_id');
	// }
}
