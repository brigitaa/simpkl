<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepalasekolah extends Model
{
    use HasFactory;
    public $table = "kepalasekolah";
    protected $fillable = [
        'nip',
        'nama_kepsek',
        'jabatan',
        'pangkat_gol'
    ];
}
