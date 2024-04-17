@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')

<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
        <td height="50" colspan="3" class="bottom">
            <p align="center" class="style6">TANDA TERIMA JAMINAN</p>
        </td>
    </tr>
    
    <tr>
        <td height="25" colspan="3" class="style9">&nbsp;</td>
    </tr>
    <tr>
        <td height="25" class="style10">Tanggal Cair </td>
        <td class="style27">: {{ $pinkel->tgl_cair }}</td>
        <td height="25" class="style9">&nbsp;</td>
    </tr>
    <tr>
        <td height="25" class="style10">NIK</td>
        <td class="style27">: {{ $pinkel->anggota->nik }}</td>
        <td height="25" class="style9">&nbsp;</td>
    </tr>
    <tr>
        <td height="25" class="style10">Diterima dari </td>
        <td class="style27">: {{ $pinkel->anggota->namadepan }}</td>
        <td height="25" class="style9">&nbsp;</td>
    </tr>
    <tr>
        <td height="25" class="style10">Diserahkan Kepada </td>
        <td class="style27">
            : {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }}  {{ $kec->nama_kec }}
        </td>
        <td height="25" class="style9">&nbsp;</td>
    </tr>

    <tr>
        <td height="30" colspan="3" ><p align="center" class="style10"></p></td>
    </tr>

    <tr>
        <td height="30" colspan="3" class="bottom top">
            <p align="center" class="style10"><b>JENIS JAMINAN</b></p>
        </td>
    </tr>

    <tr>
        <td height="30" class="bottom top" colspan="3">
            <p align="center" class="style10">
                <b  class="style11">Jenis jaminan, Nomor, Type/Merek, Alamat</b><br><br>

                @php
                $jenis_jaminan = [
                    '1' => 'Tanah',
                    '2' => 'Tanah dan Bangunan',
                    '3' => 'Sepeda Motor',
                    '4' => 'Mobil',
                    '5' => 'SKP Pegawai',
                    '6' => 'Barang Berharga',
                    '7' => 'Hasil Pertanian',
                    '8' => 'Hewan Ternak',
                    '9' => 'Barang Elektronik', // Perhatikan, Anda memiliki '8' dua kali
                ];
                @endphp

                @if(array_key_exists(substr($pinkel->jaminan, 0, 1), $jenis_jaminan))
                    {{ $jenis_jaminan[substr($pinkel->jaminan, 0, 1)] }}{{ substr($pinkel->jaminan, 1) }}
                @endif
            </p>
        </td>
    </tr>
</table>
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
        <td width="32%" height="36" colspan="1" class="style26">
            <div align="center" class="style9">
                <p>Yang menyerahkan,<br></p>
            </div>
        </td>
        <td class="style26">
            <div align="center" class="style9">
                <p>Yang Menerima,</p>
            </div>
        </td>
    </tr>
    <tr>
        <th height="24" colspan="-1" class="style9">
            <p align="center">&nbsp;</p>
            <p align="center">&nbsp;</p>
            <p>{{$pinkel->anggota->namadepan }}<br>NIK. {{$pinkel->anggota->nik }}</p>
        </th>
        <th width="32%" class="style9">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>
                {{ $dir->namadepan }} {{$dir->namabelakang}}
                
                <br>
                {{ $dir->j->nama_jabatan }}
                {{ $kec->nama_lembaga_sort}}
            </p>
        </th>
    </tr>
</table>
<div style="height:250px;">
</div>
<head>
</head>
@endsection