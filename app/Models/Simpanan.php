<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Simpanan extends Model
{
    use HasFactory;
    protected $table;
    public $timestamps = false;

    protected $guarded = ['id'];

    public function __construct()
    {
        $this->table = 'simpanan_anggota_' . Session::get('lokasi');
    }

    public function js()
    {
        return $this->belongsTo(JenisSimpanan::class, 'jenis_simpanan');
    }
    public function realSimpananTerbesar()
    {
        return $this->hasOne(RealSimpanan::class, 'cif', 'id')->latestOfMany();
    }

    public function jasa()
    {
        return $this->belongsTo(JenisJasa::class, 'jenis_jasa');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'nia', 'id');
    }

    public function sts()
    {
        return $this->belongsTo(StatusPinjaman::class, 'status', 'kd_status');
    }

    public function real_s()
    {
        return $this->hasMany(RealSimpanan::class, 'cif', 'id')->orderBy('tgl_transaksi', 'ASC')->orderBy('id', 'ASC');
    }

    public function trx()
    {
        return $this->hasMany(Transaksi::class, 'id_simp', 'id')->orderBy('tgl_transaksi', 'ASC')->orderBy('idtp', 'ASC');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pinj_i()
    {
        return $this->hasOne(PinjamanAnggota::class, 'nia', 'nia')->orderBy('tgl_cair', 'DESC');
    }

    public function getTableStructure()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
