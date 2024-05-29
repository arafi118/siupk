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
use DB;

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

        //update ._.



        return redirect()->route('pindah_buku.index')->with('success', 'Sukses memindahkan buku.');
    }
}
