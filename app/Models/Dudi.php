<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    use HasFactory;
    public $table = "dudi";
    protected $fillable = [
        'nama_dudi',
        'alamat_dudi'
    ];
}
