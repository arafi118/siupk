<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SebutanAgent extends Model
{
    use HasFactory;

    protected $table = 'agent';

    public function Agent()
    {
        return $this->hasMany(Agent::class, 'sebutan', 'id');
    }
}
