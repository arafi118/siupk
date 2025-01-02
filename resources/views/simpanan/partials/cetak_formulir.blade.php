@php

    $nik            = $anggota->nik ?? '';
    $namadepan      = $anggota->namadepan ?? '';
    $nick           = $anggota->anggotas->nick ?? '';
    $tempat         = $anggota->tempat_lahir ?? ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';
    $jk             = $anggota->jk ?? '';
    $alamat         = $anggota->alamat ?? '';
    $hp             = $anggota->hp ?? '';
    $agama          = $anggota->anggotas->agama ?? '';
    $pernikahan     = $anggota->anggotas->pernikahan ?? '';
    $pendidikan     = $anggota->anggotas->pendidikan ?? '';
    $pekerjaan      = $anggota->usaha ?? '';
    $npwp           = $anggota->anggotas->npwp ?? '';
    $penghasilan    = $anggota->anggotas->penghasilan ?? '';
    $sumber         = $anggota->anggotas->sumber ?? '';
    $jr             = $anggota->jr ?? '';
    $sts_permohonan = $anggota->status_permohonan ?? '';
    $lembaga        = $anggota->lembaga ?? '';
    $jabatan        = $anggota->jabatan ?? '';
    $pengampu       = $anggota->pengampu ?? '';
    $hubungan       = $anggota->hubungan ?? '';
    $ibu            = $anggota->anggotas->ibu ?? '';
    $penerima       = $anggota->penerima ?? '';
    $pencetak       = $anggota->pencetak ?? '';
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Form Buka Rekening</title>
    <style type="text/css">
    <!--
    .style6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px;  }
    .style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
    .style10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
    .all    {border: 1px solid #000000; }
    .top    {border-top: 1px solid #000000; }
    .bottom {border-bottom: 1px solid #000000; }
    .left   {border-left: 1px solid #000000; }
    .right  {border-right: 1px solid #000000; }
    .style27 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
    .align-justify {text-align:justify; }
    .style28 {font-size: 10px}
    -->
    </style>
    <link rel="shortcut icon" href="images/fav.png" type="image/x-icon">
    <link href="css/application.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
</head>

<body onLoad="window.print()">

<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
        <td height="20" colspan="2" width="65%" class="bottom">
        </td>
        <td height="20" colspan="2" class="bottom"><div align="right" class="style9">CIF : </div><br><div align="right" class="style9">No Rekening : </div></td>
        <td height="20" colspan="2" class="bottom" width="15%"><div align="left" class="style9 bottom"></div><br><div align="left" class="style9 bottom">
        </div></td>
    </tr> 
</table>

<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
        <td height="35" colspan="6" class="bottom"><p align="center" class="style6"><b>FORMULIR SIMPANAN NASABAH</b></p></td>
    </tr>
    <tr>
        <td height="0" class="align-justify style9"><div align="right">1.</div></td>
        <td height="0" class="align-justify style9">N I K</td>
        <td height="0" colspan="4" class="style27 bottom">: {{ $nik }}</td>
    </tr>
    <tr>
        <td width="4%" class="align-justify style9"><div align="right">2.</div></td>
        <td width="25%" class="align-justify style9">Nama Lengkap</td>
        <td colspan="4" class="style27 bottom">: {{ $namadepan }}</td>
    </tr>
    <tr>
        <td width="4%" class="align-justify style9"><div align="right">3.</div></td>
        <td width="25%" class="align-justify style9">Nama Alias</td>
        <td colspan="3" width="40%" class="style27 bottom">: {{ $nick }}</td>
        <td class="style27">
            &nbsp; &nbsp; 
            [{{ $jk == 'L' ? '✓' : ' ' }}] Laki Laki <i class="fa fa-square"></i>
            &nbsp; &nbsp; 
            [{{ $jk == 'P' ? '✓' : ' ' }}] Perempuan
        </td>
    </tr>
    <tr>
        <td height="0" class="align-justify style9"><div align="right">4.</div></td>
        <td height="0" class="align-justify style9">Tempat, Tanggal Lahir </td>
    </tr>
    <tr>
        <td height="0" class="align-justify style9"><div align="right">5.</div></td>
        <td height="0" class="align-justify style9">Alamat</td>
        <td height="0" colspan="4" class="style27 bottom">: {{ $alamat }}</td>
    </tr>
    <tr>
        <td height="0" class="align-justify style9"><div align="right">6.</div></td>
        <td height="0" class="align-justify style9">No. Handphone</td>
        <td height="0" colspan="4" class="style27 bottom">: {{ $hp }}</td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">7.</div></td>
        <td class="align-justify style9">Agama</td>
        <td colspan="4" class="style27 bottom">: {{ $agama }}</td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">8.</div></td>
        <td class="align-justify style9">Status Pernikahan</td>
        <td colspan="4" class="style27">: 
            &nbsp; &nbsp; [{{ $pernikahan == 'Lajang' ? '✓' : ' ' }}] Lajang
            &nbsp; &nbsp; [{{ $pernikahan == 'Menikah' ? '✓' : ' ' }}] Menikah
            &nbsp; &nbsp; [{{ $pernikahan == 'Duda/Janda' ? '✓' : ' ' }}] Duda/Janda
        </td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">9.</div></td>
        <td class="align-justify style9">Pendidikan Terakhir</td>
        <td colspan="4" class="style27">: 
            &nbsp; &nbsp; [{{ $pendidikan == '' ? '✓' : ' ' }}] Tidak ada
            &nbsp; &nbsp; [{{ $pendidikan == '1' ? '✓' : ' ' }}] SD
            &nbsp; &nbsp; [{{ $pendidikan == '2' ? '✓' : ' ' }}] SLTP
            &nbsp; &nbsp; [{{ $pendidikan == '3' ? '✓' : ' ' }}] SLTA
            &nbsp; &nbsp; [{{ $pendidikan == '4' ? '✓' : ' ' }}] D3
            &nbsp; &nbsp; [{{ $pendidikan == '5' ? '✓' : ' ' }}] S1
            &nbsp; &nbsp; [{{ $pendidikan == '6' ? '✓' : ' ' }}] S2
            &nbsp; &nbsp; [{{ $pendidikan == '7' ? '✓' : ' ' }}] S3
            &nbsp; &nbsp; [{{ $pendidikan == '99' ? '✓' : ' ' }}] Lainnya
        </td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">10.</div></td>
        <td class="align-justify style9">Pekerjaan</td>
        <td colspan="4" class="style27 bottom">: {{ $pekerjaan }}</td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">11.</div></td>
        <td class="align-justify style9">Alamat Pekerjaan</td>
        <td colspan="4" class="style27 bottom">: {{ $alamat }}</td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">12.</div></td>
        <td class="align-justify style9">NPWP</td>
        <td colspan="4" class="style27 bottom">: {{ $npwp }}</td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">13.</div></td>
        <td class="align-justify style9">Penghasilan per Bulan</td>
        <td colspan="4" class="style27">: 
            &nbsp; &nbsp; [{{ $penghasilan == '1' ? '✓' : ' ' }}] < 5 jt
            &nbsp; &nbsp; [{{ $penghasilan == '2' ? '✓' : ' ' }}] 5 - 15 jt
            &nbsp; &nbsp; [{{ $penghasilan == '3' ? '✓' : ' ' }}] 15 - 25 jt
            &nbsp; &nbsp; [{{ $penghasilan == '4' ? '✓' : ' ' }}] > 25 jt
        </td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">14.</div></td>
        <td class="align-justify style9">Sumber Dana</td>
        <td colspan="4" class="style27">: 
            &nbsp; &nbsp; [{{ $sumber == 'Gaji/Upah' ? '✓' : ' ' }}] Gaji/Upah
            &nbsp; &nbsp; [{{ $sumber == 'Usaha' ? '✓' : ' ' }}] Usaha
            &nbsp; &nbsp; [{{ $sumber == 'Lainnya' ? '✓' : ' ' }}] Lainnya : {{ $sumber == 'Lainnya' ? $sumber_lainnya : '' }}
        </td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">15.</div></td>
        <td class="align-justify style9">Jenis Rekening</td>
        <td colspan="4" class="style27 bottom">: 
            &nbsp; &nbsp; [{{ $jr == 'Simantera' ? '✓' : ' ' }}] Simantera <i class="fa fa-square"></i>
            &nbsp; &nbsp; [{{ $jr == 'Simantera Qurban' ? '✓' : ' ' }}] Simantera Qurban
            &nbsp; &nbsp; [{{ $jr == 'Simantera Hari raya' ? '✓' : ' ' }}] Simantera Hari raya
        </td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">16.</div></td>
        <td class="align-justify style9">Status Permohonan</td>
        <td colspan="4" class="style27">: 
            &nbsp; &nbsp; [{{ $sts_permohonan == 'Pribadi' ? '✓' : ' ' }}] Pribadi
            &nbsp; &nbsp; [{{ $sts_permohonan == 'Kuasa' ? '✓' : ' ' }}] Kuasa
        </td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right"></div></td>
        <td colspan="4" class="style27"><span class="style27 bottom">Isikan Jika Status Permohonan Kuasa</span>
            <table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                    <td width="4%" class="align-justify style9"><div align="right">1.</div></td>
                    <td width="25%" class="align-justify style9">Nama Lembaga</td>
                    <td colspan="4" class="style27 bottom">: {{ $lembaga }}</td>
                </tr>
                <tr>
                    <td width="4%" class="align-justify style9"><div align="right">2.</div></td>
                    <td width="25%" class="align-justify style9">Jabatan</td>
                    <td colspan="4" class="style27 bottom">: {{ $jabatan }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">17.</div></td>
        <td class="align-justify style9">Pengampu</td>
        <td colspan="4" class="style27 bottom">: {{ $pengampu }}</td>
    </tr>
    <tr>
        <td class="align-justify style9"><div align="right">18.</div></td>
        <td class="align-justify style9">Hubungan</td>
        <td colspan="4" class="style27 bottom">: {{ $hubungan }}</td>
    </tr>
<tr>
        <td class="align-justify style9"><div align="right">19.</div></td>
        <td class="align-justify style9">Nama Gadis Ibu Kandung</td>
        <td colspan="4" class="style27 bottom">: {{ $ibu }}</td>
    </tr>
</table>     
<br>
<table width="97%" border="0" class="style9 top" align="center" cellpadding="3" cellspacing="0">
    <br>
    <tr>
        <td width="45%" class="style9 align-justify" colspan="2">
            <p><span class="style27"> PERNYATAAN</span> <br>Bersama ini saya menyatakan bahwa <br>
            1. Semua data isian diatas adalah benar. <br>
            2. Menyetujui serta tunduk pada ketentuan dan syarat umum yang berlaku pada pembukaan rekening di KOPERASI LEMBAGA KEUANGAN MIKRO. <br>
            3. Dana yang saya setorkan dan pergunakan tidak berasal dari / untuk tujuan <i>money laundering</i> atau pencucian uang. 
            <br><br><br></p>
        </td>
    </tr>
    <tr>
        <td height="24" class="style9">
            <p align="center">Petugas Penerima</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p align="center"><b>{{ $penerima }}</b></p>
        </td>
        <td height="24" class="style9">
            <p align="center">Pemohon</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p align="center"><b>{{ $namadepan }}</b></p>
        </td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </td>
    </tr>
    <tr>
        <td class="style10 top align-right" colspan="3">Dicetak Oleh: {{ $pencetak }}; pada: {{ date('Y-m-d H:i:s') }}</td>
    </tr>
</table>
</body>
</html>
