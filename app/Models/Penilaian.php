<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    public $table = "penilaian";
    protected $fillable = [
        'penempatan_id',
        'sertifikat',
        'nilai',
        'status_verif_nilai'
    ];
}
