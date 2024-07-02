@php
use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')

<table width="80%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td height="50" colspan="3" class="bottom">
                <p align="center" class="style6" style="font-size: 20px; font-weight: bold;">BUKTI PENGAMBILAN JAMINAN
                </p>

            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td height="10" colspan="3" class="style9"></td>
        </tr>
        <tr>
            <td height="10" colspan="3" class="style9">Yang bertanda tangan dibawah ini,</td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td height="10" class="style9">Nama</td>
            <td class="style27">: {{$pinkel->anggota->namadepan}}</td>
            <td height="10" class="style9">&nbsp;</td>
        </tr>
        <tr>
            <td height="10" class="style9">NIK</td>
            <td class="style27">: {{$pinkel->anggota->nik}}</td>
            <td height="10" class="style9">&nbsp;</td>
        </tr>
        <tr>
            <td width="20%" height="10" class="style9">Alamat</td>
            <td width="42%" class="style27">: {{ $pinkel->anggota->d->nama_desa }}</td>
            <td height="10" class="style9">&nbsp;</td>
        </tr>
        <tr>
            <td height="10" class="style9">Nomor HP</td>
            <td class="style27">: {{ $pinkel->anggota->hp }}</td>
            <td height="10" class="style9">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td height="20" colspan="3" class="style9">Menyatakan telah menerima kembali / melakukan
                pengambilan barang jaminan berupa 
                    @php
                        $jaminan = json_decode($pinkel->jaminan, true);
                    @endphp

                    @if (is_array($jaminan) || is_object($jaminan))
                    
        </td>
      </tr>
                            @foreach ($jaminan as $key => $value)
                                
	  <tr>
        <td height="10" class="style9">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
        <td class="style27">: {{ ucwords($value)}}</td>
        <td height="10" class="style9">&nbsp;</td>
                                </tr>
                            @endforeach                 
	  <tr>
        <td height="20" colspan="3" class="style9">
                    @else
                         <STRONG> {{$pinkel->jaminan}} </STRONG>
                    @endif
                    sehubungan telah terselesaikannya
                kewajiban pokok dan jasa pinjaman di {{$kec->nama_lembaga_sort}} dengan loan id {{$pinkel->id}}.
            </td>
        </tr>

        <tr>
            <td height="10" colspan="2" class="style9">&nbsp;</td>
            <td height="10" class="style9">
                <div align="right"><span class="style9"><br></span></div>
            </td>
        </tr>
        <tr>
            <td height="20" colspan="2" class="style9"></td>
            <td height="20" class="style9">
                <div><span class="style9"><br>{{$pinkel->anggota->d->nama_desa}},
                        {{ Tanggal::tglLatin($pinkel->tgl_proposal) }}</span></div>
            </td>
        </tr>
    </table>
    <table width="90%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
            <td width="50%" height="36" colspan="1" class="style26">
                <div align="center" class="style9">
                    <p>Yang menyerahkan<br><br><br><br>
                    {{ $dir->namadepan }} {{ $dir->namabelakang }}
 </p>
                </div>
            </td>
            <td class="style26">
                <div align="center" class="style9">
                    <p>Yang menerima <br><br><br><br>
                        {{$pinkel->anggota->namadepan}}</p>
                </div>
            </td>
        </tr>

    </table>
@endsection
