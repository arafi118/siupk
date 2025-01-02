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
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>BERITA ACARA PENCAIRAN</b>
                </div>
                <div style="font-size: 16px;">
                    <b>PINJAMAN INDIVIDU {{ $pinkel->jpp->nama_jpp }}</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>


    <p style="text-align: justify;">
        Sesuai Surat Perjanjian Kredit (SPK) nomor : {{ $pinkel->spk_no }}. Pada hari ini
        {{ Tanggal::namaHari($pinkel->tgl_cair) }}
        tanggal
        {{ $keuangan->terbilang(Tanggal::hari($pinkel->tgl_cair)) }} bulan {{ Tanggal::namaBulan($pinkel->tgl_cair) }}
        tahun
        {{ $keuangan->terbilang(Tanggal::tahun($pinkel->tgl_cair)) }}, telah diadakan pencairan dana
        perguliran {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }} {{ $kec->nama_kec }}
        {{ $pinkel->anggota->kd_kelompok }} dengan detail identitas pemanfaat dan detail pinjaman sebagai
        berikut :
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">



        <tr>
            <td align="center">1.</td>
            <td>Nama Pemanfaat</td>
            <td align="center">:</td>
            <td>
                <b> {{ $pinkel->anggota->namadepan }}</b>
            </td>

            <td align="center">9.</td>
            <td>KK / NIK Penjamin</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->kk }} {{ $pinkel->anggota->nik_penjamin }}</b>
            </td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td>NIK</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->nik }}</b>
            </td>

            <td align="center">10.</td>
            <td>Nama Penjamin</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->penjamin }}</b>
            </td>
        </tr>
        <tr>
            <td align="center">3.</td>
            <td>Jenis Kelamin</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->jk }}</b>
            </td>

            <td align="center">11.</td>
            <td>Jenis Pinjaman</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->jpp->nama_jpp }}</b>
            </td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td>Tempat & tgl lahir</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->tempat_lahir }}
                    {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_lahir)->format('d F Y') }}</b>
            </td>

            <td align="center">12.</td>
            <td>Alokasi Pinjaman</td>
            <td align="center">:</td>
            <td>
                <b>Rp. {{ number_format($pinkel->alokasi) }},-</b>
            </td>
        </tr>
        <tr>
            <td align="center">5.</td>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->alamat }} </b>
            </td>

            <td align="center">13.</td>
            <td>Tanggal Pencairan</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->tgl_cair }}</b>
            </td>
        </tr>
        <tr>
            <td align="center">6.</td>
            <td>Desa</td>
            <td align="center">:</td>
            <td>
                <b> {{ $pinkel->anggota->d->nama_desa }} </b>
            </td>

            <td align="center">14.</td>
            <td>Tempo</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->jangka }} bulan</b>
            </td>

        </tr>
        <tr>
            <td align="center">7.</td>
            <td>Contact Person</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->hp }} </b>
            </td>

            <td align="center">15.</td>
            <td>Sistem angsuran pokok & jasa</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->sis_pokok->nama_sistem }} & {{ $pinkel->sis_jasa->nama_sistem }}</b>
            </td>

        </tr>
        <tr>
            <td align="center">8.</td>
            <td>Jenis Usaha</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->usaha }}</b>
            </td>


            <td align="center">16.</td>
            <td>Prosentase Jasa</td>
            <td align="center">:</td>
            <td>
                <b>{{ round($pinkel->pros_jasa / $pinkel->jangka, 2) }}% per bulan</b>
            </td>

        </tr>
    </table>

    <p>
        Demikian, berita acara ini dibuat sekaligus sebagai bukti pencairan dana pinjaman di atas.
    </p>
    </div>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="50%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center" colspan="2">
                {{ $kec->nama_kec }}, {{ Tanggal::tglLatin($pinkel->tgl_cair) }}
            </td>
        </tr>
        <tr>
            <td align="center">
                {{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}
            </td>
            <td colspan="2" align="center">Peminjam</td>
        </tr>
        <tr>
            <td colspan="3" height="40">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" style="font-weight: bold;">
                {{ $dir->namadepan }} {{ $dir->namabelakang }}
            </td>
            <td colspan="2" align="center" style="font-weight: bold;">{{ $pinkel->anggota->namadepan }}</td>
        </tr>
    </table>
@endsection
