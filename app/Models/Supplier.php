<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function SebutanSupplier()
    {
        return $this->belongsTo(SebutanSupplier::class, 'sebutan', 'id');
    }
    
}
