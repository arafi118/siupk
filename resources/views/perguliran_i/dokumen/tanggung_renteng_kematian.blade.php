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
                    <b>SURAT PERNYATAAN KESANGGUPAN TANGGUNG RENTENG KEMATIAN</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="100">Tanggal</td>
            <td width="5" align="center">:</td>
            <td>{{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
        </tr>
        <tr>
            <td colspan="3">Kami yang bertanda tangan di bawah ini :</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>
                <b>{{ $dir->namadepan }} {{ $dir->namabelakang }}</b>
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>
                <b>{{ $dir->nik }}</b>
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>
                <b>{{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}</b>
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
                <b>{{ $dir->alamat }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="justify">
                Dalam hal ini bertindak untuk dan atas nama {{ $kec->nama_lembaga_sort }} selaku pengelola dana iuran
                tanggung renteng kematian bagi pemanfaat {{ $pinkel->jpp->nama_jpp }}, selanjutnya disebut Pihak Pertama,
                dan
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->anggota->ketua }}</b>
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>
                <b>Ketua Kelompok</b>
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
                <b>
                    {{ $pinkel->anggota->alamat_kelompok }} {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }}
                    {{ $pinkel->anggota->d->nama_desa }}
                </b>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p style="text-align: justify;">
                    Dalam hal ini bertindak untuk dan atas nama diri sendiri dan anggota-anggota kelompok peminjam
                    {{ $pinkel->anggota->nama_kelompok }} yang telah memberikan kuasa secara tertulis sebagaimana Surat
                    Kuasa terlampir yang menjadi bagian tidak terpisahkan dari dokumen perjanjian iuran tanggung renteng
                    kematian ini, selanjutnya disebut Pihak Kedua
                </p>
                <p style="text-align: justify;">
                    Pihak Pertama dan Pihak Kedua dalam kedudukan masing-masing seperti telah diterangkan di atas, pada hari
                    ini {{ Tanggal::namaHari($pinkel->tgl_cair) }} tanggal
                    {{ $keuangan->terbilang(Tanggal::hari($pinkel->tgl_cair)) }} bulan
                    {{ Tanggal::namaBulan($pinkel->tgl_cair) }} tahun
                    {{ $keuangan->terbilang(Tanggal::tahun($pinkel->tgl_cair)) }}, bertempat di {{ $tempat }} sadar
                    dan suka rela menyatakan telah membuat perjanjian iuran tanggung renteng kematian bagi anggota kelompok
                    pemanfaat yang meninggal dunia dengan ketentuan-ketentuan yang disepakati.
                </p>
                <p style="text-align: justify;">
                    Pihak Kedua menyatakan secara sadar dan suka rela telah menanda-tangani akad atau perjanjian iuran
                    tanggung renteng kematian ini, setelah terlebih dahulu membaca isi perjanjian ini kepada para Pemberi
                    kuasa dengan sejelas-jelasnya dan tidak seorangpun diantaranya menyatakan keberatan.
                </p>
            </td>
        </tr>
    </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">{{ $kec->nama_kec }}, {{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
        </tr>
        <tr>
            <td align="center" width="50%">Pihak Pertama</td>
            <td align="center" width="50%">Pihak Kedua</td>
        </tr>
        <tr>
            <td align="center">{{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }},</td>
            <td align="center">Ketua Kelompok,</td>
        </tr>
        <tr>
            <td colspan="2" height="50">&nbsp;</td>
        </tr>
        <tr>
            <td align="center">
                <b>{{ $dir->namadepan }} {{ $dir->namabelakang }}</b>
            </td>
            <td align="center">
                <b>{{ $pinkel->anggota->ketua }}</b>
            </td>
        </tr>
    </table>
@endsection
