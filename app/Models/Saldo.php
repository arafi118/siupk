<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;
use Awobaz\Compoships\Database\Eloquent\Relations\BelongsTo;
use Session;

class Saldo extends Model
{
    use HasFactory, Compoships;
    protected $table;
    public $timestamps = false;

    public function __construct()
    {
        $this->table = 'saldo_' . Session::get('lokasi');
    }

    protected $fillable = ['id', 'kode_akun', 'lokasi', 'tahun', 'bulan', 'debit', 'kredit'];

    public function eb()
    {
        return $this->belongsTo(Ebudgeting::class, ['kode_akun', 'tahun', 'bulan'], ['kode_akun', 'tahun', 'bulan']);
    }

    public function saldo()
    {
        return $this->belongsTo(Saldo::class, 'kode_akun', 'kode_akun');
    }

    public function rek()
    {
        return $this->belongsTo(Rekening::class, 'kode_akun', 'kode_akun');
    }
}
