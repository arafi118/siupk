<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningOjk extends Model
{
    use HasFactory;
    protected $table = 'rekening_ojk';
    public $timestamps = false;

    protected $guarded = ['id'];
}
