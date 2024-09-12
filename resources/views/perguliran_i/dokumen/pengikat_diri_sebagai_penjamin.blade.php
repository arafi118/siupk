@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
    <style>
        .break {
            page-break-after: always;
        }
    </style>


    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr class="b">
            <td colspan="4" align="center">
                <div style="font-size: 16px;">
                    SURAT PERNYATAAN
                    PENGIKAT DIRI SEBAGAI PENJAMIN*)
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4" height="5"></td>
        </tr>
    </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="4">
                Yang bertanda tangan dibawah ini,
            </td>
        </tr>
        <tr>
            <td width="28%"colspan="2">Nama Penjamin</td>
            <td width="2%" align="center">:</td>
            <td width="70%">{{ $pinkel->anggota->penjamin }}</td>
        </tr>
        <tr>
            <td colspan="2">Nik/No KK.</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->nik_penjamin }} / {{ $pinkel->anggota->kk }}</td>
        </tr>
        <tr>
            <td colspan="2">Alamat</td>
            <td align="center">:</td>
            <td>
                {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }}
                {{ $pinkel->anggota->d->nama_desa }} {{ $pinkel->anggota->alamat }}
            </td>
        </tr>
        <tr>
            <td colspan="2">Hubungan dengan Piutang</td>
            <td align="center">:</td>
            <td>
                @if ($pinkel->anggota->keluarga)
                    {{ $pinkel->anggota->keluarga->kekeluargaan }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Dengan ini Menyatakan bahwa:
            </td>
        </tr>
        <tr>
            <td width="5%" align="center">1.</td>
            <td colspan="3">
                Saya <b>menyetujui dan menjamin</b> sepenuhnya nasabah sebagai berikut :
            </td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td width="28%">Nama</td>
            <td width="2%" align="center">:</td>
            <td width="70%">{{ $pinkel->anggota->namadepan }}</td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td>Tempat & Tgl lahir</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->tempat_lahir }},
                {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_lahir)->format('d F Y') }}
            </td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td>No KTP/SIM.</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->nik }}</td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>
                {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }}
                {{ $pinkel->anggota->d->nama_desa }} {{ $pinkel->anggota->alamat }}
            </td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td>No HP</td>
            <td align="center">:</td>
            <td>
                {{ $pinkel->anggota->hp }}
            </td>
        </tr>

        <tr>
            <td width="5%">&nbsp;</td>
            <td colspan="3" align="justify">
                <p>
                    untuk melakukan pinjaman dana di {{ $kec->nama_lembaga_sort }}, yang akan <b>dicairkan pada tanggal
                        {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_cair)->format('d F Y') }} </b> sesuai kartu rencana
                    angsuran
                    terlampir sebagai bagian yang tidak terpisahkan dari surat perjanjian kredit (SPK).
                </p>
            </td>
        </tr>
        <tr>
            <td width="5%" align="center" style="vertical-align: top;">2.</td>
            <td colspan="3">
                Apabila orang tersebut diatas tidak memenuhi kewajibannya (membayar angsuran dan kewajiban lainnya)
                sesuai ketentuan dalam surat perjanjian kredit (SPK) maka dengan ini saya mengikatkan diri dan mejamin untuk
                membayar seluruh tagihan yang menjadi kewajiban Piutang tersebut diatas sesuai hasil perhitungan saldo
                utang dan tagihan jasa serta kewajiban lainnya di {{ $kec->nama_lembaga_sort }}.
            </td>
        </tr>
    </table>
    <p>Demikian pernyataan penjaminan ini saya buat dengan sebenar-benarnya dan merupakan bagian tidak terpisahkan dari
        Surat Perjanjian Kredit, dalam kondisi sehat lahir dan batin serta tanpa paksan dari pihak manapun serta bersedia
        dituntut dimuka hukum apabila dikemudian hari saya mengkingkari pernyataan ini.


    </p>
    <br>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td align="center" width="50%">&nbsp;</td>
            <td align="center" width="50%">{{ $kec->nama_kec }}, {{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
        </tr>
        <tr>
            <td align="center">{{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}</td>
            <td align="center">Nama Penjamin</td>
        </tr>
        <tr>
            <td align="center" colspan="2" height="30">&nbsp;</td>
        </tr>
        <tr style="font-weight: bold;">
            <td align="center"> {{ $dir->namadepan }} {{ $dir->namabelakang }}</td>
            <td align="center">{{ $pinkel->anggota->penjamin }}</td>
        </tr>
    </table>
@endsection
