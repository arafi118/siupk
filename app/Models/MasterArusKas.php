<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterArusKas extends Model
{
    use HasFactory;
    protected $table = 'master_arus_kas';

    public function child()
    {
        return $this->hasMany(MasterArusKas::class, 'parent_id', 'id')->orderBy('id', 'ASC');
    }

    public function rek_debit()
    {
        return $this->belongsTo(AkunLevel3::class, 'debit', 'kode_akun')->orderBy('kode_akun', 'ASC');
    }

    public function rek_kredit()
    {
        return $this->belongsTo(AkunLevel3::class, 'kredit', 'kode_akun')->orderBy('kode_akun', 'ASC');
    }
}
