<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpananAngota extends Model
{
    use HasFactory;
    protected $table = 'simpanan_anggota';
    public $timestamps = false;

    protected $guarded = ['id'];
}
