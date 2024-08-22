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
                    SURAT PERNYATAAN/PERSETUJUAN
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4" height="5"></td>
        </tr>
    </table>
    <br>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="4">
                Saya yang bertanda tangan di bawah ini :
            </td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td width="28%">Nama</td>
            <td width="2%" align="center">:</td>
            <td width="70%">{{ $pinkel->anggota->penjamin }}</td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>
                {{ $pinkel->anggota->alamat }}
                {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }} {{ $pinkel->anggota->d->nama_desa }}
            </td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td>No KTP</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->nik }}</td>
            {{-- <td>
                @if ($pinkel->anggota->keluarga)
                    {{ $pinkel->anggota->keluarga->kekeluargaan }}
                @endif
            </td> --}}
        </tr>
        <tr>
            <td colspan="4">
                Adalah Suami dari :
            </td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td width="28%">Nama Penjamin</td>
            <td width="2%" align="center">:</td>
            <td width="70%">{{ $pinkel->anggota->namadepan }}</td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>
                {{ $pinkel->anggota->alamat }}
                {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }} {{ $pinkel->anggota->d->nama_desa }}
            </td>
        </tr>
        <tr>
            <td width="5%">&nbsp;</td>
            <td>No KTP.</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->nik_penjamin }}</td>
        </tr>
        <tr>
            <td colspan="4" align="justify">
                <p>
                    Menerangkan dengan sebenarnya, bahwa saya mengetahui dan menyetujui permohonan kredit sebesar Rp.
                    {{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah) yang akan
                    diajukan kepada {{ $kec->nama_lembaga_sort }} Sebagai salah satu syarat
                    pengajuan permohonan kredit.
                </p>
                <p>
                    Sebagai bentuk tanggung jawab saya sebagai Suami, maka saya akan turut bertanggung jawab dalam
                    melaksanakan kewajiban pengembalian dana tersebut.
                </p>
                <p>
                    Demikan surat pernyataan/persetujuan ini saya buat dengan sebenarnya tanpa ada unsur paksaan dari
                    pihak manapun dan untuk dapat digunakan sebagaimana mestinya.
                </p>
            </td>
        </tr>
    </table>
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
