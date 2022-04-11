<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi_keahlian extends Model
{
    use HasFactory;
    public $table = "kompetensi_keahlian";
    protected $fillable = [
        'kode_keahlian',
        'nama_keahlian',
        'kaprog_id'
    ];
}
