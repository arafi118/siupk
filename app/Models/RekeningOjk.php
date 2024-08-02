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

    public function rek()
    {
        return $this->hasOne(Rekening::class, 'kode_akun','rekening');
    }
}
