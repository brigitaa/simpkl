<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    public $table = "siswa";
    protected $fillable = [
        'nis',
        'nisn',
        'nama_siswa',
        'jeniskelamin',
        'alamat',
        'no_telp',
        'users_id',
        'kode_kelas',
        'kode_thn_ajaran',
        'nama_ortu',
        'pekerjaan_ortu',
        'alamat_ortu',
        'rt_ortu',
        'norumah_ortu',
        'kelurahan_ortu',
        'hp_ortu'
    ];
    
    public function pengajuan() {
        return $this->hasMany(Pengajuan::class, 'siswa_id', 'id');
    }
}
