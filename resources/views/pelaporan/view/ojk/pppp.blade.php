<title>LABA RUGI</title>
@php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();
@endphp

@extends('pelaporan.layout.base')

@section('content')
<style type="text/css">
	.style6 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 16px;
	}

	.style9 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 11px;
	}

	.style10 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
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
		font-family: Verdana, Arial, Helvetica, sans-serif
	}

	.style27 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
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
<body onLoad="window.print()">
    <!-- Header Page -->
	<table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
        <tr>
            <td height="20" colspan="3" class="bottom"></td>
            <td height="20"colspan="3"  class="bottom">
                <div align="right" class="style9">
                    Dokumen Laporan<br>
                    Kd.Doc. RL Lembar-1
                </div>
            </td>
        </tr>
    </table>
    
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" height="30" colspan="6" class="style6 bottom">
                <br>
                <br>SANDI LKM {{$lkm->sandi_lkm}}
                <br>LAPORAN KINERJA KEUANGAN
                <br>Untuk Periode Yang Berakhir Pada Tanggal{{$tgl}}</b>
                <br>{{$lkm->nama_lkm_long}}

              
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        </table>

        <table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" class="style9">
        <tr height='25' class='style27'>
            <th width="5%" class="left top right">No</th>
            <th width="25%" class="top right">Nama Akun</th>
            <th width="10%" class="top right">Kode Akun</th>
            <th width="20%" class="top right">SD. Bulan Lalu</th>
            <th width="20%" class="top right">Bulan Ini</th>
            <th width="20%" class="top right">SD. Bulan Ini</th>
        </tr>
        <!-- Contoh data, ganti dengan data dinamis dari PHP -->
        <tr height='25'>
            <td class='left top right align-center'>1</td>
            <td class='top right'>Contoh Akun 1</td>
            <td class='top right'>001</td>
            <td class='top right align-right'>-----</td>
            <td class='top right align-right'>-----</td>
            <td class='top right right align-right'>-----</td>
        </tr>
        <tr height='25'>
            <td class='left top right align-center'>2</td>
            <td class='top right'>Contoh Akun 2</td>
            <td class='top right'>002</td>
            <td class='top right align-right'>-----</td>
            <td class='top right align-right'>-----</td>
            <td class='top right right align-right'>-----</td>
        </tr>
        <!-- Akhir contoh data -->
        <tr height="50" style="border: 1px solid;   ">
            <th class="left top right align-center" colspan="3">Jumlah ----</th>
            <th class="top right align-right">----</th>
            <th class="top right align-right">----</th>
            <th class="top right align-right">----</th>
        </tr>
    </table>

@endsection