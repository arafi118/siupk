<title>PENYISIHAN CADANGAN</title>
@php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();
@endphp

@extends('pelaporan.layout.base')

@section('content')
<style type="text/css">

.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 16px;font-weight: bold;  
  -webkit-print-color-adjust: exact; }
.style9 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; 
  -webkit-print-color-adjust: exact; }
.style10 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; 
  -webkit-print-color-adjust: exact; }
.top	{border-top: 1px solid #000000; }
.bottom	{border-bottom: 1px solid #000000; }
.left	{border-left: 1px solid #000000; }
.right	{border-right: 1px solid #000000; }
.all	{border: 1px solid #000000; }
.style26 {font-family: Arial, Helvetica, sans-serif}
.style27 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.align-justify {text-align:justify; }
.align-center {text-align:center; }
.align-right {text-align:right; }
</style>
<table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
    <tr>
        <td height="20" colspan="3" class="bottom"></td>
        <td height="20" colspan="3" class="bottom">
            <div align="right" class="style9">Dok. Laporan ---<br>Kd.Doc. CRK----</div>
        </td>
    </tr>
    <tr>
        <td height="10%" colspan="6" class="style6 bottom" align="center"><br>CADANGAN PENYISIHAN PENGHAPUSAN KREDIT <br><br></td>
    </tr>
    <tr>
        <td colspan="2" class="style9">NAMA LKM</td>
        <td colspan="4" class="style9">: --</td>
    </tr>
    <tr>
        <td colspan="2" class="style9">SANDI LKM</td>
        <td colspan="4" class="style9">: ---</td>
    </tr>
    <tr>
        <td colspan="2" class="style9 bottom">PERIODE LAPORAN</td>
        <td colspan="4" class="style9 bottom">: ----</td>
    </tr>
    <tr align="center" height="100%">
        <th width="2%" class="left bottom top">NO</th>
        <th width="20%" class="left bottom top">TINGKAT KOLEKTIBILITAS</th>
        <th width="5%" class="left bottom top">%</th>
        <th width="30%" class="left bottom top">SALDO PINJAMAN</th>
        <th width="20%" class="left bottom top">BEBAN PENYISIHAN PENGHAPUSAN PINJAMAN</th>
        <th width="20%" class="left right bottom top">NPL</th>
    </tr>
    <tr align="center" style="background:rgba(0,0,0, 0.4);">
        <td class="left bottom">a</td>
        <td class="left bottom">b</td>
        <td class="left bottom">c</td>
        <td class="left bottom">d</td>
        <td class="left bottom">e = c * d</td>
        <td class="left bottom right">f=(2+3)/Saldo</td>
    </tr>
    <tr>
        <td class="left bottom" align="center">1</td>
        <td class="left bottom">Lancar</td>
        <td class="left bottom" align="center">0 %</td>
        <td class="left bottom" align="right">----</td>
        <td class="left bottom" align="right">----</td>
        <th class="left bottom right" align="center" rowspan="4">----%</th>
    </tr>
    <tr>
        <td class="left bottom" align="center">2</td>
        <td class="left bottom">Diragukan</td>
        <td class="left bottom" align="center">50 %</td>
        <td class="left bottom" align="right">----</td>
        <td class="left bottom" align="right">----</td>
    </tr>
    <tr>
        <td class="left bottom" align="center">3</td>
        <td class="left bottom">Macet</td>
        <td class="left bottom" align="center">100%</td>
        <td class="left bottom" align="right">----</td>
        <td class="left bottom" align="right">----</td>
    </tr>
    <tr align="center" height="15%">
        <th colspan="3" class="left bottom">T O T A L</th>
        <th class="left bottom" align="right">----</th>
        <th class="left bottom" align="right">----</th>
    </tr>
</table>
@endsection
