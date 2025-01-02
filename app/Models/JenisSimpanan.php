<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSimpanan extends Model
{
    use HasFactory;

    protected $table = 'jenis_simpanan';
    public $timestamps = false;

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'jenis_simpanan');
    }
}
