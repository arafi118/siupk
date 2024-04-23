<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Anggota extends Model
{
    use HasFactory;
    protected $table;
    public $timestamps = false;

    protected $guarded = ['id'];

    public function __construct()
    {
        $this->table = 'anggota_' . Session::get('lokasi');
    }

    public function pinjaman_anggota()
    {
        return $this->hasMany(PinjamanAnggota::class, 'nia');
    }

    public function pinjaman()
    {
        return $this->hasOne(PinjamanAnggota::class, 'nia');
    }

    public function d()
    {
        return $this->belongsTo(Desa::class, 'desa', 'kd_desa');
    }

    public function pemanfaat()
    {
        return $this->hasOne(DataPemanfaat::class, 'nik', 'nik');
    }

    public function u()
    {
        return $this->belongsTo(Usaha::class, 'usaha', 'id');
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'hubungan', 'id');
    }

    public function getRouteKeyName()
    {
        return 'nik';
    }
}
