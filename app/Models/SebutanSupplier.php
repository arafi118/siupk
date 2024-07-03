<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SebutanSupplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    public function Supplier()
    {
        return $this->hasMany(Supplier::class, 'sebutan', 'id');
    }
}
