<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;
    public $table = "penempatan";
    protected $fillable = [
        'konfirmasi_dudi_id',
        'guru_monitoring_id',
        'status_pkl_id'
    ];
}
