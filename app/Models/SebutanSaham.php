<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SebutanSaham extends Model
{
    use HasFactory;

    protected $table = 'saham';

    public function Saham()
    {
        return $this->hasMany(Saham::class, 'sebutan', 'id');
    }
}
