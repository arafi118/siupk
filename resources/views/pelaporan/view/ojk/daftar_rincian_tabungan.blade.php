<title>RINCIAN TABUNGAN</title>
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
.align-right {text-align:right; }

</style>
<table width="96%" border="0" align="center" cellpadding="3" cellspacing="0">

		<tr>
		<td height="20" colspan="3" class="bottom">
		
		</td>
		<td height="20" colspan="3" class="bottom">
			<div align="right" class="style9">Dokumen Laporan----<br>
			Kd.Doc. 2T Tab Lembar-1 </div>
		</td>
	</tr> 
    <tr>
        <td height="20" colspan="6" class="style6 bottom align-center"><br>DAFTAR RINCIAN TABUNGAN <br><br></td>
    </tr>
    <tr>
            <td colspan="2" width="30%" class="style9">NAMA LKM</td>
            <td colspan="4"  width="60%" class="style9">: ----</td>
	    </tr>
	     <tr>
            <td colspan="2" width="30%" class="style9">SANDI LKM</td>
            <td colspan="4"  width="60%" class="style9">: ----</td>
	     </tr>
	     <tr>
            <td colspan="2" width="30%" class="style9 bottom">PERIODE LAPORAN</td>
            <td colspan="4" width="60%" class="style9 bottom">: ----</td>
	        </tr>
			<tr align="center" height="30px" class="style9 ">
              <th width="2%" rowspan="2" class="left bottom">No</th>
              <th width="15%" rowspan="2" colspan="2" class="left bottom">Nama Penyimpan - CIF</a></th>
			  <th colspan="2" class="left bottom">Suku Bunga</a></th>
			  <th width="8%" rowspan="2" class="left bottom right">Jumlah </a></th>
			  
            </tr>
            
            <tr align="center"  height="30px" class="style9">
			  <th width="5%" class="left bottom">%</th>
              <th width="10%" class="left bottom">Keterangan</th>
			  
            </tr>
	   
        
	
		<tr class="style9">
		    <th colspan="5" class="left bottom top" align="center">JUMLAH SALDO</th>
		    <th class="left right bottom top" align="right">< </th>
		</tr>
	 
	 
		<tr class="style9">
		    <th colspan="5" class="bottom" align="center">&nbsp;</th>
		    <th class="bottom" align="right">&nbsp;</th>
		</tr>
		<tr class="style9">
		    <th colspan="5" class="left bottom top" align="center" style="background:rgba(0,0,0, 0.3);">JUMLAH SALDO KESELURUHAN </th>
		    <th class="left right bottom top" align="right" style="background:rgba(192,192,192,0.3);" > </th>
		</tr>




		
		<tr>
		<td class="style10 top" colspan="6"><b>Keterangan</b> : Data yang ditampilkan diatas merupakan Tabungan pada tahun berjalan  , untuk menampilkan data Individu aktif tahun lalu dapat memilih mode tahun lalu  .</td>
		</tr> 
        </table>

</body>

</html>


@endsection