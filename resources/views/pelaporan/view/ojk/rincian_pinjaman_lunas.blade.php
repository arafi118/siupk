<title>PINJAMAN LUNAS</title>
@php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();
@endphp

@extends('pelaporan.layout.base')

@section('content')
<style type="text/css">
 
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 16px;font-weight: bold;  -webkit-print-color-adjust: exact;}
.style9 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; -webkit-print-color-adjust: exact;}
.style10 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; -webkit-print-color-adjust: exact;}
.top	{border-top: 1px solid #000000; }
.bottom	{border-bottom: 1px solid #000000; }
.left	{border-left: 1px solid #000000; }
.right	{border-right: 1px solid #000000; }
.all	{border: 1px solid #000000; }
.style26 {font-family: Arial, Helvetica, sans-serif}
.style27 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.align-justify {text-align:justify; }
.align-center {text-align:center; }
.align-left {text-align:left; }
.align-right {text-align:right; }
</style>
<table width="96%" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td height="20" colspan="10" class="bottom">
		</td>
		<td height="20" colspan="2" class="bottom">
			<div align="right" class="style9">Dokumen Laporan ----<br>
			Kd.Doc. L2 Lembar-1 </div>
		</td>
	</tr> 
    <tr>
        <td height="20" colspan="12" class="style6 bottom align-center"><br>DAFTAR RINCIAN PINJAMAN YANG DIBERIKAN (Lunas) <br><br></td>
    </tr>
    <tr>
            <td colspan="2" width="30%" class="style9">NAMA LKM</td>
            <td colspan="10"  width="60%" class="style9">: ----</td>
	    </tr>
	     <tr>
            <td colspan="2" width="30%" class="style9">SANDI LKM</td>
            <td colspan="10"  width="60%" class="style9">: ----</td>
	    </tr>
	     <tr>
            <td colspan="2" width="30%" class="style9 bottom">PERIODE LAPORAN</td>
            <td colspan="10" width="60%" class="style9 bottom">: ----</td>
	    </tr>
    
			<tr align="center" height="30px" class="style9">
              <th width="2%" rowspan="2" class="left bottom">No</th>
              <th width="20%" rowspan="2" class="left bottom">Peminjam - Loan ID</a></th>
              <th width="10%" rowspan="2" class="left bottom">Jenis Penggunaan</a></th>
			  <th width="7%" rowspan="2" class="left bottom">Periode Pembayaran</a></th>
			  <th colspan="2" class="left bottom">Jangka Waktu</a></th>
			  <th colspan="2" class="left bottom">Suku Bunga</a></th>
              <th width="3%" rowspan="2" class="left bottom">Plafon</a></th>
              <th width="7%" rowspan="2" class="left bottom">Baki Debet</a></th>
			  <th width="3%" rowspan="2" class="left bottom">Jumlah Tunggakan (X)</a></th>
			  <th width="3%" rowspan="2" class="left right bottom">Kolektibilitas</a></th>
            </tr>
            <tr align="center"  height="30px" class="style9">
			  <th width="5%" class="left bottom">Mulai </th>
              <th width="5%" class="left bottom">Jatuh Tempo</th>
			  <th width="5%" class="left bottom">%</th>
              <th width="5%" class="left bottom">Keterangan</th>
			  
            </tr>
            <tr>
        <th colspan="12" class="style27 top left right align-left">KELOMPOK</td>
    </tr>
			<tr align="right" height="15px" class="style9">
              <td class="left top" align="center">----</td>
			  <td class="left top" align="left">----</td>
			  <td class="left top" align="left">	Pinjaman Modal Kerja</td>
			  <td class="left top" align="center">----</td>
              <td class="left top" align="center">	----</td>
              <td class="left top" align="center">----</td>
			  <td class="left top">					---- %</td>
              <td class="left top" align="center">	----</td>
			  <td class="left top">					----</td>
              <td class="left top">					----</td>
			  <td class="left top">					----</td>
			  <td class="left top right" align="left">			
			  
			  
			  </td> 
		
		<tr class="style9">
		    <th colspan="8" class="left top bottom" align="center">TOTAL ----</th>
		    <th class="left top bottom" align="right">----</th>
		    <th class="left top bottom" align="right">----</th>
		    <th colspan="2" class="left right top bottom" align="right"></th>
		</tr>
    <tr>
        <th colspan="12" class="style9 bottom">&nbsp;</td>
    </tr>
    
			<tr align="center" height="30px" class="style9 ">
              <th width="2%" rowspan="2" class="left bottom">No</th>
              <th width="20%" rowspan="2" class="left bottom">Peminjam - Loan ID</a></th>
              <th width="10%" rowspan="2" class="left bottom">Jenis Penggunaan</a></th>
			  <th width="7%" rowspan="2" class="left bottom">Periode Pembayaran</a></th>
			  <th colspan="2" class="left bottom">Jangka Waktu</a></th>
			  <th colspan="2" class="left bottom">Suku Bunga</a></th>
              <th width="3%" rowspan="2" class="left bottom">Plafon</a></th>
              <th width="7%" rowspan="2" class="left bottom">Baki Debet</a></th>
			  <th width="3%" rowspan="2" class="left bottom">Jumlah Tunggakan (X)</a></th>
			  <th width="3%" rowspan="2" class="left right bottom">Kolektibilitas</a></th>
            </tr>
            <tr align="center"  height="30px" class="style9">
			  <th width="5%" class="left bottom">Mulai </th>
              <th width="5%" class="left bottom">Jatuh Tempo</th>
			  <th width="5%" class="left bottom">%</th>
              <th width="5%" class="left bottom">Keterangan</th>
			  
            </tr>
            <tr>
            <th colspan="12" class="style27 top left right align-left">INDIVIDU</td>
            </tr>
	
		<tr>
			<td class="style27 left top right" colspan="12">----</td>
		</tr>
	
		?>
			<tr align="right" height="15px" class="style9">
              <td class="left top" align="center">	----</td>
			  <td class="left top" align="left">----</td>
			  <td class="left top" align="left">	Pinjaman Modal Kerja</td>
			  <td class="left top" align="center">	----</td>
              <td class="left top" align="center">	----</td>
              <td class="left top" align="center">----</td>
			  <td class="left top">					----%</td>
              <td class="left top" align="center">	----</td>
			  <td class="left top">				----</td>
              <td class="left top">					----</td>
			  <td class="left top">				----</td>
			  <td class="left top right" align="left">			
			 
			  </td> 


		<tr class="style9">
		    <th colspan="8" class="left top" align="center">TOTAL ----</th>
		    <th class="left top" align="right">----</th>
		    <th class="left top" align="right">----</th>
		    <th colspan="2" class="left right top" align="right"></th>
		</tr>
		
		
	
		<tr class="style9">
		    <th colspan="12" class="top" align="center">&nbsp;</th>
		</tr>
		<tr class="style9">
		    <th colspan="8" class="left top" align="center" style="background:rgba(0,0,0, 0.3);">TOTAL KESELURUHAN ----</th>
		    <th class="left top" align="right">----</th>
		    <th class="left top" align="right">----</th>
		    <th colspan="2" class="left right top" align="right"></th>
		</tr>

		
		<tr>
		<td class="style10 top" colspan="12"><b>Keterangan</b> : Data yang ditampilkan diatas merupakan Individu aktif pada tahun berjalan ----, untuk menampilkan data Individu aktif tahun lalu dapat memilih mode tahun lalu----,</td>
		</tr>
</table>
@endsection