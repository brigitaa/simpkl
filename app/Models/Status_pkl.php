<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_pkl extends Model
{
    use HasFactory;
    public $table = "status_pkl";
    protected $fillable = [
        'nama_status_pkl'
    ];
}
