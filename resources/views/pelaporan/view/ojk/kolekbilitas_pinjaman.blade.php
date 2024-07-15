<title>KOLEKTIBILITAS PINJAMAN</title>
@php
use App\Utils\Keuangan;
$keuangan = new Keuangan();
@endphp

@extends('pelaporan.layout.base')

@section('content')

<style type="text/css">

.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 16px;font-weight: bold;  }
.style9 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.style10 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
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
				<td height="20" colspan="2" class="bottom">
                </td>
                <td height="20" colspan="2" class="bottom">
                <div align="right" class="style9">Dok. Laporan ----<br>
					Kd.Doc. CRK-----</div>
				</td>
			</tr> 
            <tr>
        <td height="20" colspan="4" class="style6 bottom align-center"><br>DAFTAR RINCIAN PINJAMAN YANG DIBERIKAN <br> BERDASARKAN KOLEKTIBILITAS<br></td>
    </tr>
    <tr>
            <td colspan="2"  class="style9">NAMA LKM</td>
            <td colspan="2"   class="style9">: ----</td>
	    </tr>
	     <tr>
            <td colspan="2"  class="style9">SANDI LKM</td>
            <td colspan="2"  class="style9">: ----</td>
	     </tr>
	     <tr>
            <td colspan="2"  class="style9 bottom">PERIODE LAPORAN</td>
            <td colspan="2"  class="style9 bottom">: ----</td>
	        </tr>
			
			<tr align="center" height="100%">
              <th width="3%" class="left bottom top">NO</th>
              <th colspan="2" class="left bottom top">TINGKAT KOLEKTIBILITAS</th>
              <th width="50%%" class="left right bottom top">JUMLAH</th>
			</tr>
			<tr align="center" height="100%" style="background:rgba(0,0,0, 0.4);">
              <td class="left bottom">I</td>
              <td colspan="2" class="left bottom">II</td>
              <td class="left bottom right">III</td>
            </tr>
			<tr>
              <td class="left bottom"align="center">1</td>
              <td colspan="2" class="left bottom">Lancar</td>
              <td class="left bottom right" align="right">----</td>
            </tr>
			<tr>
			<td class="left bottom" align="center">2</td>
              <td colspan="2" class="left bottom">Diragukan</td>
              <td class="left bottom right" align="right">----</td>
			</tr>
			<tr>
			<td class="left bottom" align="center">3</td>
              <td colspan="2" class="left bottom">Macet</td>
              <td class="left bottom right" align="right">----</td>
			</tr>
			
			<tr align="center">
              <th colspan="3" class="left  bottom">TOTAL PINJAMAN YANG DIBERIKAN KEPADA MASYARAKAT</th>
			  <th class="left bottom right" align="right">----</th>
		  </tr>
			
			<tr align="center" height="100%">
              <th width="3%" class="top"></th>
              <th  width="20%" class="top"></th>
              <th width="15%" class="top"></th>
              <th width="10%" class="top"></th>
              
		  </tr>
	</table>
@endsection