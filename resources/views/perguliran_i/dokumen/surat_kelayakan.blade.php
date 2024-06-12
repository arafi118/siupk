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
                ______ /UPK/{{ Tanggal::tglRomawi($pinkel->tgl_dana) }} </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td align="center">:</td>
            <td colspan="2">
                {{ Tanggal::tglLatin($pinkel->tgl_dana) }} </td>
        </tr>
        <tr>
            <td>Sifat</td>
            <td align="center">:</td>
            <td colspan="2">
                Penting dan Rahasia
            </td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td align="center">:</td>
            <td colspan="2">
                <b>Kelayakan Pinjaman</b>
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">
                <div>Dengan hormat,</div>
                <div style="text-align: justify;">
                    Dengan ini memberitahukan bahwa keputusan rapat pendanaan Perguliran {{ $kec->nama_lembaga_sort }}
                    Tanggal {{ Tanggal::tglLatin($pinkel->tgl_dana) }}. yang merupakan tindak lanjut hasil verifikasi atas
                    Proposal Permohonan Kredit dari ;
                </div>
                <table>
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
                            {{ $pinkel->anggota->alamat_Anggota }}
                            {{ $pinkel->anggota->d->sebutan_desa->sebutan_kades }} {{ $pinkel->anggota->d->nama_desa }}
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Tanggal Proposal</td>
                        <td>:</td>
                        <td>{{ Tanggal::tglLatin($pinkel->tgl_proposal) }}</td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Jumlah Permohonan</td>
                        <td>:</td>
                        <td>Rp {{ number_format($pinkel->proposal) }}</td>
                    </tr>
                </table>

                <div style="text-align: justify;">
                    Dinyatakan Layak/Tidak Layak didanai sebesar Rp. {{ number_format($pinkel->alokasi) }}
                    ({{ $keuangan->terbilang($pinkel->alokasi) }}) dan dengan
                    jadwal pencairan besok pada tanggal {{ Tanggal::tglLatin($pinkel->tgl_cair) }} bertempat di
                    {{ $tempat }}.
                </div>

                <div style="text-align: justify;">
                    Demikian surat pemberitahuan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan
                    terimakasih.
                </div>
            </td>
        </tr>
    </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
            <td colspan="2" height="24">&nbsp;</td>
        </tr>
        <tr>
            <td width="50%">&nbsp;</td>
            <td width="50%" align="center">
                {{ $kec->nama_kec }}, {{ Tanggal::tglLatin($pinkel->tgl_dana) }}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">{{ $kec->sebutan_level_1 }} UPK</td>
        </tr>
        <tr>
            <td colspan="2" height="40">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">{{ $dir->namadepan }} {{ $dir->namabelakang }}</td>
        </tr>
    </table>
@endsection
