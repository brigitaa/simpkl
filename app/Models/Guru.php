<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    public $table = "guru";
    protected $fillable = [
        'nip',
        'nama_guru',
        'no_telp_guru',
        'alamat'
    ];
}
