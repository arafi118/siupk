<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;
use Session;

class RealSimpanan extends Model
{
    use HasFactory, Compoships;
    protected $table;
    public $timestamps = false;

    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function __construct()
    {
        $this->table = 'real_simpanan_' . Session::get('lokasi');
    }

    public function simpanan()
    {
        return $this->belongsTo(Simpanan::class, 'cif', 'id');
    }
}
