<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'agent';
    public $timestamps = false;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function SebutanAgent()
    {
        return $this->belongsTo(SebutanAgent::class, 'sebutan', 'id');
    }
    public function d()
    {
        return $this->belongsTo(Desa::class, 'desa', 'kd_desa');
    }

    public function kec()
    {
        return $this->belongsTo(Kecamatan::class, 'lokasi','id');
    }
    
}
