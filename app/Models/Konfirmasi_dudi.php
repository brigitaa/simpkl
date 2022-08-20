<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfirmasi_dudi extends Model
{
    use HasFactory;
    public $table = "konfirmasi_dudi";
    protected $fillable = [
        'pengajuan_id',
        'balasan_dudi',
        'status'
    ];
}
