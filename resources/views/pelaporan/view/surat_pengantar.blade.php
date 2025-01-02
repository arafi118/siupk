@extends('pelaporan.layout.base')

@section('content')
    <table border="0">
        <tr>
            <td width="5%">Nomor<br>Lampiran<br> Perihal</td>
            <td width="20%">: &nbsp; <br> : 1 Bendel <br> : Laporan Keuangan</td>
            <td width="45%" align="right">{{ $kec->nama_kec }}, {{ $tgl }} <br> &nbsp;<br> &nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" height="15"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="2" align="left" style="padding-left: 8px;">
                <div>Kepada Yth.</div>
                <div><b>Kepala Dinas PMD {{ $nama_kabupaten }}</b></div>
                <div>Di {{ $kab->alamat_kab }}.</div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="15"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="2" style="padding-left: 8px; text-align: justify;">
                <div>Dengan Hormat, </div>
                <div>
                    Bersama ini kami sampaikan Laporan Keuangan {{ $nama_lembaga }} {{ $kec->sebutan_kec }}
                    {{ $kec->nama_kec }} sampai dengan
                    {{ $sub_judul }} sebagai berikut:
                    <ol>
                        <li>Laporan Neraca</li>
                        <li>Laporan Laba Rugi</li>
                        <li>Laporan Arus Kas</li>
                        <li>Laporan Perubahan Modal</li>
                        <li>Catatan atas Laporan Keuangan (CALK)</li>
                    </ol>
                </div>
                <div>
                    Demikian laporan kami sampaikan, atas perhatiannya kami ucapkan terima kasih.
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="15"></td>
        </tr>
        <tr>
            <td width="5%">&nbsp; </td>
            <td width="20%"> &nbsp;</td>
            <td width="50%" align="center">
                <div>{{ $nama_lembaga }}</div>
                <div>{{  $kec->sebutan_level_1 }},</div>
                <br>
                <br>
                <br>
                <br>
                <div>
                    <b>{{ ($dir->namadepan ?? '') . ' ' . ($dir->namabelakang ?? '') }}</b>

                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div>
                    Tembusan :
                    <ol>
                        @if ($kec->sebutan_kec == "Kecamatan")
                            <li>Camat {{ $kec->nama_kec }}</li>
                        @else
                            <li>Penewu {{ $kec->nama_kec }}</li>
                        @endif
                        
                        @if (session('lokasi') != 36)
                            <li>Kades/Lurah</li>
                        @endif
                        <li>Arsip</li>
                    </ol>
                </div>
            </td>
        </tr>
    </table>
@endsection
