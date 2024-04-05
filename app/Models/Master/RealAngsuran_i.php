<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealAngsuran extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'real_angsuran_i';
    protected $connection = 'master';
    protected $guarded = ['id'];
}
