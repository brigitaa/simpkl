<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru_monitoring extends Model
{
    use HasFactory;
    public $table = "guru_monitoring";
    protected $fillable = [
        'dudi_id',
        'periode_id',
        'guru_id'
    ];
}
