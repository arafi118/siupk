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
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr class="b">
            <td colspan="3" align="center">
                <div style="font-size: 16px;">
                    SURAT PERNYATAAN AHLI WARIS
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="3">
                Yang bertanda tangan dibawah ini,
            </td>
        </tr>
        <tr>
            <td width="28%">Nama Penjamin</td>
            <td width="2%" align="center">:</td>
            <td width="70%">{{ $pinkel->anggota->penjamin }}</td>
        </tr>
        <tr>
            <td>Nik/No KK.</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->nik_penjamin }}/{{ $pinkel->anggota->kk }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>
                {{ $pinkel->anggota->alamat }}
                {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }} {{ $pinkel->anggota->d->nama_desa }}
            </td>
        </tr>
        <tr>
            <td>Hubungan dengan Piutang</td>
            <td align="center">:</td>
            <td>
                @if ($pinkel->anggota->keluarga)
                    {{ $pinkel->anggota->keluarga->kekeluargaan }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="3" align="justify">
                <p>
                    Adalah benar-benar ahli waris dari <b>{{ $pinkel->anggota->namadepan }}</b> Dengan ini menyatakan
                    bersedia menanggung beban kredit {{ $pinkel->jpp->nama_jpp }} sampai lunas. Apabila terjadi
                    hal-hal yang tidak diinginkan yang menyebabkan peminjaman tidak bisa melunasi kewajibannya seperti :
                    Meninggal Dunia, Melarikan Diri, Berpindah domisili di luar desa, gangguan kejiwaan, sakit parah,
                    dll.
                </p>
                <p>
                    Demikian Surat Pernyataan Ahli Waris ini saya buat tanpa ada paksaan dari pihak manapun.
                </p>
            </td>
        </tr>
    </table>

    <table border="0" width="90%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td align="center" width="50%">&nbsp;</td>
            <td align="center" width="50%">{{ $kec->nama_kec }}, {{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
        </tr>
        <tr>
            <td align="right" >Mengetahui,</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="center">Kepala {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }} {{ $pinkel->anggota->d->nama_desa }}</td>
            <td align="center">Penjamin</td>
        </tr>
        <tr>
            <td align="center" colspan="2" height="30">&nbsp;</td>
        </tr>
        <tr style="font-weight: bold;">
            <td align="center">
                <u>
                    <b>Pembina Tingkat  I {{ $pinkel->anggota->d->pangkat }}</b>
                </u>
                @if ($pinkel->anggota->d->nip)
                    <div><small>NIP. {{ $pinkel->anggota->d->nip }}</small></div>
                @endif
            </td>
            <td align="center">{{ $pinkel->anggota->penjamin }}</td>
        </tr>
    </table>
@endsection
