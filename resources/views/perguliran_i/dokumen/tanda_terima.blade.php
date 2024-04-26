@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>TANDA TERIMA</b>
                </div>
                <div style="font-size: 16px;">
                    <b>PINJAMAN KELOMPOK {{ $pinkel->jpp->nama_jpp }}</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="70">Nama Kelompok</td>
            <td width="5" align="right">:</td>
            <td>{{ $pinkel->anggota->namadepan }} - {{ $pinkel->id }}</td>
            <td width="70">Alokasi Pinjaman</td>
            <td width="5" align="right">:</td>
            <td>Rp. {{ number_format($pinkel->alokasi) }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td align="right">:</td>
            <td>{{ $pinkel->anggota->alamat }}</td>
            <td>Sistem Angsuran</td>
            <td align="right">:</td>
            <td>{{ $pinkel->sis_pokok->nama_sistem }}</td>
        </tr>
        <tr>
            <td>Tanggal Pencairan</td>
            <td align="right">:</td>
            <td>{{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
            <td>Prosentase Jasa</td>
            <td align="right">:</td>
            <td>{{ $pinkel->pros_jasa }}% / {{ $pinkel->jangka }} bulan</td>
        </tr>
        <tr>
            <td>Nomor SPK</td>
            <td align="right">:</td>
            <td>{{ $pinkel->spk_no }}</td>
            <td>Pinjaman Ke-</td>
            <td align="right">:</td>
            <td>0</td>
        </tr>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px; table-layout: fixed;">
        <tr style="background: rgb(232, 232, 232)">
            <th class="t l b" width="3%" height="15">No</th>
            <th class="t l b" width="18%">Nik</th>
            <th class="t l b" width="22%">Nama Anggota</th>
            <th class="t l b" width="3%">JK</th>
            <th class="t l b" width="26%">Alamat</th>
            <th class="t l b" width="14%">Pengajuan</th>
            <th class="t l b r" width="14%">Ttd</th>
        </tr>

        @php
            $alokasi = 0;
        @endphp
        @php
            $no = $pinkel->iteration;
        @endphp
        <tr>
            <td class="t l b" height="15" align="center">{{ $no }}</td>
            <td class="t l b">{{ $pinkel->anggota->nik }}</td>
            <td class="t l b">{{ $pinkel->anggota->namadepan }}</td>
            <td class="t l b" align="center">{{ $pinkel->anggota->jk }}</td>
            <td class="t l b">{{ $pinkel->anggota->alamat }}</td>
            <td class="t l b" align="right">{{ number_format($pinkel->alokasi) }}</td>
            <td class="t l b r">{{ $no }}.</td>
        </tr>
        @php
            $alokasi += $pinkel->alokasi;
        @endphp

        <tr>
            <td colspan="7" style="padding: 0px !important;">
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px; table-layout: fixed;">
                    <tr style="font-weight: bold;">
                        <td class="t l b" height="15" width="72%" align="center">JUMLAH</td>
                        <td class="t l b" align="right" width="14%">{{ number_format($alokasi) }}</td>
                        <td class="t l b r" width="14%">&nbsp;</td>
                    </tr>
                </table>

                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">
                    <tr>
                        <td width="60%">&nbsp;</td>
                        <td width="60">Diterima Di</td>
                        <td width="2">:</td>
                        <td>{{ substr($pinkel->wt_cair, 6) }}</td>
                    </tr>
                    <tr>
                        <td width="60%">&nbsp;</td>
                        <td width="60">Pada Tanggal</td>
                        <td width="2">:</td>
                        <td>{{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
                    </tr>
                </table>
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">
                    <tr>
                        <td colspan="2" height="10">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" width="50%">Mengetahui,</td>
                        <td align="center" width="50%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center">{{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}</td>
                        <td align="center">Ketua Kelompok</td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2" height="30">&nbsp;</td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td align="center">{{ $dir->namadepan }} {{ $dir->namabelakang }}</td>
                        <td align="center">{{ $pinkel->anggota->ketua }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
