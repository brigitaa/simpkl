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
        'kode_thn_ajaran'
    ];
}
