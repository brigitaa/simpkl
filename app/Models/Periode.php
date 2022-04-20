<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    public $table = "periode";
    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai'
    ];
}
