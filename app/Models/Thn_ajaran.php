<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thn_ajaran extends Model
{
    use HasFactory;
    public $table = "thn_ajaran";
    protected $fillable = [
        'kode_thn_ajaran',
        'nama_thn_ajaran'
    ];
}
