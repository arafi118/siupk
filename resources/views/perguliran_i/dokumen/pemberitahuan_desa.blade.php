@php
    use App\Utils\Tanggal;

    $waktu = '';
    $tempat = '';
    $wt_cair = explode('_', $pinkel->wt_cair);
    if (count($wt_cair) == 1) {
        $waktu = $wt_cair[0];
    }

    if (count($wt_cair) == 2) {
        $waktu = $wt_cair[0];
        $tempat = $wt_cair[1];
    }
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
            <td width="50">Nomor</td>
            <td width="10" align="center">:</td>
            <td colspan="2">
                &nbsp; </td>
        </tr>
        <tr>
            <td>Sifat</td>
            <td align="center">:</td>
            <td colspan="2">
                Penting dan Rahasia< </td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td align="center">:</td>
            <td colspan="2">
                <b>Pemberitahuan Pencairan</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
            <td align="left" width="140">
                <div>Kepada Yth.</div>
                <div style="font-weight: bold;">
                    {{ $pinkel->anggota->d->sebutan_desa->sebutan_kades }} {{ $pinkel->anggota->d->nama_desa }}
                </div>
                <div>
                    {{ $kec->sebutan_kec }} {{ $kec->nama_kec }}
                </div>
                <div>Di</div>
                <div>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Tempat
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3" align="justify">
                <div>Dengan hormat,</div>
                <div>
                    Menindaklanjuti hasil keputusan rapat pendanaan {{ $kec->nama_lembaga_sort }}
                    Tanggal {{ Tanggal::tglLatin($pinkel->tgl_dana) }} dengan ini memberitahukan bahwa akan dilakukan
                    pencairan kredit kepada ;
                </div>
                <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                    <tr>
                        <td width="10">1.</td>
                        <td width="120">Nama Pemanfaat</td>
                        <td width="5">:</td>
                        <td>{{ $pinkel->anggota->namadepan }}</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            {{ ucwords(strtolower($pinkel->anggota->alamat_kelompok)) }}
                            {{ ucwords(strtolower($pinkel->anggota->d->sebutan_desa->sebutan_desa)) }}
                            {{ ucwords(strtolower($pinkel->anggota->d->nama_desa)) }}
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Tanggal Cair</td>
                        <td>:</td>
                        <td>{{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Tempat</td>
                        <td>:</td>
                        <td>{{ $tempat }}</td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td colspan="4">
                <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;"
                    class="padding">
                    <tr>
                        <td width="50">&nbsp;</td>
                        <td style="padding: 0px;" align="justify">
                            <p>
                                Demikian surat pemberitahuan ini kami sampaikan, atas perhatian dan kerjasamanya kami
                                ucapkan
                                terimakasih.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                                <tr>
                                    <td width="33%" height="10">&nbsp;</td>
                                    <td width="33%">&nbsp;</td>
                                    <td width="33%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td align="center">{{ $kec->nama_kec }}, {{ Tanggal::tglLatin($pinkel->tgl_cair) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td align="center">
                                        {{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" height="40">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td align="center">
                                        <u>
                                            <b>{{ $dir->namadepan }} {{ $dir->namabelakang }}</b>
                                        </u>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
