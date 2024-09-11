


@php
    use App\Utils\Tanggal;
    $section = 0;
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

<table width="96%" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td height="20" colspan="10" class="bottom"></td>
		<td height="20" colspan="8" class="bottom">
			<div align="right" class="style9"></div>
		</td>
	</tr> 
    <tr>
        <td height="20" colspan="14" class="style6 bottom align-center"><br>LAPORAN PERKEMBANGAN KREDIT </td>
    </tr>
			<tr align="center" height="30px" class="style9">
              <th width="" rowspan="" class="left">No</th>
              <th width="" rowspan="" class="left">Kreditur - Loan ID</a></th>
              <th width="" rowspan="" class="left">Merk - Nama</a></th>
			  <th width="" rowspan="" class="left">Tgl Cair</a></th>
              <th width="" rowspan="" class="left">Tenor</a></th>
              <th width="" rowspan="" class="left">Harga Barang</a></th>
              <th width="" rowspan="" class="left">Uang Muka</a></th>
              <th width="" rowspan="" class="left">Plafon Kredit</a></th>
              <th colspan="" class="left ">Target Angsuran</a></th>
              <th colspan="" class="left ">Realisasi  </a></th>
              <th colspan="" class="left ">Realisasi s.d. </a></th>
              <th width="" rowspan="" class="left ">Sisa Angsuran </th>
              <th width="" rowspan="" class="left ">%</th>
              <th colspan="" class="left  right">Tunggakan Angsuran</th>
            </tr>
		<tr>
			<td class="style27 left top right" colspan="14"></td>
		</tr>
		<tr align="right" height="14px" class="style9">
              <td class="left top" align="center"></td>
			  <td class="left top" align="left"></td>
			  <td class="left top" align="left"></td>
			  
              <td class="left top" align="center"></td>
			  <td class="left top" align="center"></td>
			  <td class="left top"></td>
			  <td class="left top"></td>
			  <td class="left top"></td>
              <td class="left top"></td>
			  <td class="left top"></td>
              <td class="left top"></td>
              <td class="left top"></td>
              <td class="left top "></td>
	
			  <td class="left top right align-center" colspan="2"></td>
			  <td class="left top right align-center" colspan="2">Rescedulling </td>
			  <td class="left top right"></td>
		<tr align="right" height="30px" class="style27">
              <td class="left top" align="center" colspan="5">Total</td>
			  <td class="left top"></td>
			  <td class="left top"></td>
			  <td class="left top"></td>
              <td class="left top"></td>
			  <td class="left top"></td>
              <td class="left top"></td>
              <td class="left top"></td>
              <td class="left top">%</td>
			  <td class="left top right"></td>
		</tr>
		<td class="style10 top" colspan="14">&nbsp;</td>
</table>
@endsection