<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprog extends Model
{
    use HasFactory;
    public $table = "kaprog";
    protected $fillable = [
        'nip',
        'nama_kaprog',
        'users_id',
        'kode_keahlian'
    ];
}
