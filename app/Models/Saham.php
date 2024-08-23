<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saham extends Model
{
    use HasFactory;
    protected $table = 'saham';

    public function kec()
    {
        return $this->belongsTo(Kecamatan::class, 'lokasi','id');
    }
}
