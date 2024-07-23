<title>PINJAMAN DITERIMA</title>
@php
use App\Utils\Keuangan;
$keuangan = new Keuangan();
@endphp

@extends('pelaporan.layout.base')

@section('content')
<style type="text/css">
    .style6 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        font-weight: bold;
    }

    .style9 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    .style10 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
    }

    .top {
        border-top: 1px solid #000000;
    }

    .bottom {
        border-bottom: 1px solid #000000;
    }

    .left {
        border-left: 1px solid #000000;
    }

    .right {
        border-right: 1px solid #000000;
    }

    .all {
        border: 1px solid #000000;
    }

    .style26 {
        font-family: Arial, Helvetica, sans-serif
    }

    .style27 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
    }

    .align-justify {
        text-align: justify;
    }

    .align-center {
        text-align: center;
    }

    .align-right {
        text-align: right;
    }
</style>

<table width="96%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
        <td height="20" colspan="4" class="bottom">
        </td>
        <td height="20" colspan="4" class="bottom">
            <div align="right" class="style9">Dokumen Laporan ---<br>
                Kd.Doc. H3 Lembar-1 </div>
        </td>
    </tr>
    <tr>
        <td height="20" colspan="8" class="style6 bottom align-center"><br>DAFTAR RINCIAN PINJAMAN YANG DITERIMA
            <br><br></td>
    </tr>
    <tr>
        <td colspan="2" width="30%" class="style9">NAMA LKM</td>
        <td colspan="6" width="60%" class="style9">:{{$lkm->nama_lkm_long}}</td>
    </tr>
    <tr>
        <td colspan="2" width="30%" class="style9">SANDI LKM</td>
        <td colspan="6" width="60%" class="style9">:{{$lkm->sandi_lkm}}</td>
    </tr>
    <tr>
        <td colspan="2" width="30%" class="style9 bottom">PERIODE LAPORAN</td>
        <td colspan="6" width="60%" class="style9 bottom">:{{$tgl}}</td>
    </tr>
    <tr align="center" height="30px" class="style9 ">
        <th width="2%" rowspan="2" class="left bottom">No</th>
        <th width="15%" rowspan="2" colspan="2" class="left bottom">Nama Pemberi Pinjaman - Loan ID</a></th>
        <th colspan="2" class="left bottom">Jangka Waktu</a></th>
        <th colspan="2" class="left bottom">Suku Bunga</a></th>
        <th width="8%" rowspan="2" class="left bottom right">Jumlah </a></th>
    </tr>
    <tr align="center" height="30px" class="style9">
        <th width="5%" class="left bottom">Mulai </th>
        <th width="5%" class="left bottom">Jatuh Tempo</th>
        <th width="5%" class="left bottom">%</th>
        <th width="5%" class="left bottom">Keterangan</th>
    </tr>
    <tr>
        <td class="style27 left top right" colspan="8">---</td>
    </tr>
    <tr align="right" height="15px" class="style9">
        <td class="left top" align="center"> </td>
        <td colspan="2" class="left top" align="left"> </td>
        <td class="left top" align="center"> </td>
        <td class="left top"> </td>
        <td class="left top" align="center"> </td>
        <td class="left top"> </td>
        <td class="left top  right"> </td>
    <tr>
        <td class="style10 top" colspan="8"><b>Keterangan</b> : Data yang ditampilkan diatas merupakan Tabungan pada
            tahun berjalan ----, untuk menampilkan data Individu aktif tahun lalu dapat memilih mode tahun lalu ---.
        </td>
    </tr>
</table>
@endsection