<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSimpanan extends Model
{
    use HasFactory;
    protected $table = 'jenis_simpanan';
    public $timestamps = false;

    protected $guarded = ['id'];

    // ambil data dari simpanan anggota
    public function sa()
    {
        return $this->hasMany(SimpananAnggota::class, 'jenis_simpanan', 'id');
    }
}
