<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class RekeningOjk extends Model
{
    use HasFactory;
    protected $table;
    public $timestamps = false;

    public function __construct()
    {
        $this->table = 'rekening_ojk_' . Session::get('lokasi');
    }

    protected $guarded = ['id'];

    public function sub()
    {
        return $this->hasMany(RekeningOjk::class, 'sub','id');
    }
    
    public function akun3()
    {
        return $this->belongsTo(AkunLevel3::class, 'kode_akun','rekening');
    }
}
