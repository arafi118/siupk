<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\JenisProdukPinjaman;
use App\Models\Rekening;
use App\Models\Transaksi;
use App\Utils\Keuangan;
use Illuminate\Http\Request;
use Session;
use URL;

class PBController extends Controller
{
    public function index()
    {
        $kec = Kecamatan::where('id', 1)->first();
        Session::put('lokasi', $kec->id);

        $logo = '/assets/img/icon/favicon.png';
        if ($kec->logo) {
            $logo = '/storage/logo/' . $kec->logo;
        }

        $jenisProdukPinjaman = JenisProdukPinjaman::all();

        return view('pindah_buku.index')->with(compact('logo', 'jenisProdukPinjaman'));
    }

    public function pindahBuku(Request $request)
    {
        $fromKas = $request->input('from_kas');
        $toKas = $request->input('to_kas');
        $fromPinjaman = $request->input('from_pinjaman');
        $toPinjaman = $request->input('to_pinjaman');

        Transaksi::where('rekening_debit', from_kas)->update([
            'rekening_debit' => to_kas
            ]);
        Transaksi::where('rekening_kredit', from_kas)->update([
            'rekening_debit' => to_kas
            ]);
        Transaksi::where('rekening_debit', $fromPinjaman)->update([
            'rekening_debit' => $toPinjaman
            ]);
        Transaksi::where('rekening_kredit', $fromPinjaman)->update([
            'rekening_debit' => $toPinjaman
            ]);
            
        $lev4 = substr($toPinjaman, -2);
        $lev4 = (int) $lev4;
        Rekening::where('kode_akun', $toKas)->delete();
        Rekening::where('kode_akun', $fromPinjaman)->update([
            'rekening_debit' => $toPinjaman,
            'lev4' => $lev4
            ]);
                
        $lev4 = substr($toKas, -2);
        $lev4 = (int) $lev4;
        Rekening::where('kode_akun', $toPinjaman)->delete();
        Rekening::where('kode_akun', $fromPinjaman)->update([
            'rekening_debit' => $toKas,
            'lev4' => $lev4
            ]);

        return redirect()->route('pindah_buku.index')->with('success', 'Sukses memindahkan buku.');
    }
}
