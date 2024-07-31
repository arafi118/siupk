@extends('pelaporan.layout.base')

@section('content')
<style type="text/css">
    .style3 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 13px;
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

    .style33 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }

    .style33 {
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

    .pull-right {
        float: right;
        margin-left: 130px;
    }

</style>

<table width="93%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
    <tr>
        <td height="30" colspan="4" class="bottom">
            <div align="right" class="style9">Dok. Laporan<br>Kd.Doc. NC.OJK-</div>
        </td>
    </tr>
    <tr>
        <td align="center" height="30" colspan="4" class="style3 bottom">
            <br>{{$lkm->nama_lkm_long}}
            <br>SANDI LKM {{$lkm->sandi_lkm}}
            <br>LAPORAN POSISI KEUANGAN
            <br>{{ strtoupper($sub_judul) }}</b>
        </td>
    </tr>
    <tr align="center">
        <th width="3%" class="left bottom top">NO</th>
        <th width="50%" class="left bottom top">NAMA AKUN</th>
        <th width="15%" class="left bottom top">KODE AKUN</th>
        <th width="35%" class="left right bottom top">JUMLAH</th>
    </tr>
    <tr>
        <th class="left top bottom" align="center">A.</th>
        <th class="left top bottom right" colspan="3" align="left"> &nbsp; ASET</th>
    </tr>
    <tr>
        <td class="left bottom" align="left">&nbsp;</td>
        <td class="left bottom" align="left"></td>
        <td class="left bottom" align="center"></td>
        <td class="left bottom right" align="right"></td>
    </tr>
   
    <tr>
        <th class="left top bottom" colspan="2" align="center">Jumlah Aset</th>
        <td class="left bottom" align="right">&nbsp;--</td>
        <th class="left top bottom right" align="right">--</th>
        
    </tr>
    <tr>
        <th class="left top bottom" align="center">B.</th>
        <th class="left top bottom right"colspan="3" align="left"> &nbsp; LIABILITAS</th>
    </tr>
    <tr>
        <th class="left top bottom" colspan="2" align="center">Jumlah Liabilitas</th>
        <td class="left bottom" align="right">&nbsp;--</td>
        <th class="left top bottom right" align="right">--</th>
    </tr>
    <tr>
        <th class="left top bottom" align="center">C.</th>
        <th class="left top bottom right" colspan="3" align="left"> &nbsp; EKUITAS</th>
    </tr>
    <tr>
        <th class="left top bottom" colspan="2" align="center">Jumlah Ekuitas</th>
        <td class="left bottom" align="right">&nbsp;--</td>
        <th class="left top bottom right" align="right">--</th>
    </tr>
    <tr>
        <th class="left top bottom" colspan="2" align="center">Jumlah Liabilitas Dan Ekuitas</th>
        <td class="left bottom" align="right">&nbsp;--</td>
        <th class="left top bottom right" align="right">--</th>
    </tr>
    <tr>
        <th class="left top bottom" align="center">A.</th>
        <th class="top left bottom" align="left"> &nbsp; Rasio Likuiditas</th>
        <th class="top left bottom" align="right">&nbsp;--</th>
        <th class="top left bottom right" align="right">%</th>
    </tr>
    <tr>
        <td class="left bottom" align="left">&nbsp;1.</td>
        <td class="left bottom"  align="left"> &nbsp; Kas dan Setara Kas</td>
        <td class="left bottom" align="right">&nbsp;--</td>
        <td class="left bottom right" align="right">--</td>
    </tr>
    <tr>
        <td class="left bottom" align="left">&nbsp;3.</td>
        <td class="left bottom" align="left"> &nbsp; Liabilitas Lancar</td>
        <td class="left bottom" align="right">&nbsp;</td>
        <td class="left bottom right" align="right">--</td>
    </tr>
    <tr>
        <th class="left top bottom" align="center">B.</th>
        <th class="top left bottom"  align="left"> &nbsp; Rasio Solvabilitas</th>
        <th class="top left bottom" align="right">&nbsp;--</th>
        <th class="top left bottom right" align="right">--%</th>
    </tr>
    <tr>
        <td class="left bottom" align="left">&nbsp;1.</td>
        <td class="left bottom" align="left"> &nbsp; Total Aset</td>
        <td class="left bottom" align="right">&nbsp;</td>
        <td class="left bottom right" align="right">--</td>
    </tr>
    <tr>
        <td class="left bottom" align="left">&nbsp;3.</td>
        <td class="left bottom" align="left"> &nbsp; Total Liabilitas</td>
        <td class="left bottom" align="right">&nbsp;</td>
        <td class="left bottom right" align="right">--</td>
    </tr>
</table>

@endsection
