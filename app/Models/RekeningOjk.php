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

    public function child()
    {
        return $this->hasMany(RekeningOjk::class, 'parent_id', 'id');
    }

    public function rek()
    {
        return $this->hasMany(Rekening::class, 'kode_akun', 'rekening');
    }

    public function akun3()
    {
        return $this->hasMany(AkunLevel3::class, 'kode_akun', 'rekening');
    }
}
