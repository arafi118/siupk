<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Anggotas extends Model
{
    use HasFactory;
    protected $table;
    public $timestamps = false;

    protected $guarded = ['id'];
    
    public function __construct()
    {
        $this->table = 'anggota_s_' . Session::get('lokasi');
    }
}
