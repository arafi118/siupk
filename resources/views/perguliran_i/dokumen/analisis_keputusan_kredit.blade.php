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
        <br>
        <br>
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>ANALISA DAN KEPUTUSAN KREDIT</b>
                </div>
                <div style="font-size: 12px;">
                    <b>Pinjaman Perorangan {{ $kec->nama_lembaga_sort }}</b>
                </div>
                <div style="font-size: 13px;">
                    <b>Nomor : 53 /VIII/2018</b>
                </div>
                <div style="font-size: 13px;">
                    <b>KREDIT BARU</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>

    <h3><b> I. DATA POKOK PEMINJAM</b></h3>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td align="center"width="5%">1.</td>
            <td width="45%">Nama</td>
            <td align="center"width="5%">:</td>
            <td>
                <b>{{ $pinkel->anggota->namadepan }}</b>
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">2.</td>
            <td width="45%">Tempat & tgl lahir</td>
            <td align="center"width="5%">:</td>
            <td>
                <b>{{ $pinkel->anggota->tempat_lahir }} {{ $pinkel->anggota->tgl_lahir }}</b>
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">3.</td>
            <td width="45%">Usia</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->jk }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">4.</td>
            <td width="45%">Pekerjaan/dinasti/istansi</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->tempat_lahir }}
                    {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_lahir)->format('d F Y') }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">5.</td>
            <td width="45%">Dinas/instansi</td>
            <td align="center"width="5%">:</td>
            <td>
                <b>d </b>
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">6.</td>
            <td width="45%">Golongan</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b> {{ $pinkel->anggota->d->nama_desa }} </b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">7.</td>
            <td width="45%">NIK</td>
            <td align="center"width="5%">:</td>
            <td>
                <b>{{ $pinkel->anggota->nik }} </b>
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">8.</td>
            <td width="45%">NPWP</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->hp }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">9.</td>
            <td width="45%">No HP</td>
            <td align="center"width="5%">:</td>
            <td>
                <b>{{ $pinkel->anggota->hp }}</b>
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">10.</td>
            <td width="45%">Alamat</td>
            <td align="center"width="5%">:</td>
            <td>
                <b>{{ $pinkel->anggota->alamat }}</b>
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">8.</td>
            <td width="45%">Penjamin(Suami)</td>
            <td align="center"width="5%">:</td>
            <td>
                <b>{{ $pinkel->anggota->penjamin }}</b>
            </td>
        </tr>
    </table>

    <h3><b>II. PERMOHONAN PINJAMAN</b></h3>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td align="center"width="5%">1.</td>
            <td width="45%">Plafond diajukan</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b> {{ $pinkel->anggota->namadepan }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">2.</td>
            <td width="45%">Totak Pendapatan / keluarga</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->nik }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">3.</td>
            <td width="45%">Tunjangan</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->jk }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">4.</td>
            <td width="45%">Take Home Pay</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->tempat_lahir }}
                    {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_lahir)->format('d F Y') }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">5.</td>
            <td width="45%">Angsuran</td>
            <td align="center"width="5%">:</td>
            <td>
                <b></b>
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">6.</td>
            <td width="45%">Sisa / Penghasilan Setelah Angsuran</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b> {{ $pinkel->anggota->d->nama_desa }} </b> --}}
            </td>
        </tr>
    </table>
    <h3><b>III. PERHITUGAN KREDIT/RATE YANG DIGUNAKAN</b></h3>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td align="center"width="5%">1.</td>
            <td width="45%">Suku Bangun Flat Rate</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b> {{ $pinkel->anggota->namadepan }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">2.</td>
            <td width="45%">Jangka Waktu</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->nik }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">3.</td>
            <td width="45%">Maks Pemberian Pinjaman Sesuai Dinas</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->jk }}</b> --}}
            </td>
        </tr>
    </table>
    <h3><b>IV. REKOMENDASI PEMBERIAN KREDIT</b></h3>
    <p>Berdasarkan hasil perhitungan tersebut diatas, kami simpulkan bahwa yang bersangkutan dapat dipertimbangkan
        permohonan kreditnya dengan syarat-syarat berikut :
    </p>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td align="center"width="5%">1.</td>
            <td colspan="2"width="45%">Jenis Kredit</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b> {{ $pinkel->anggota->namadepan }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">2.</td>
            <td colspan="2"width="45%">Jenis Peningkatan</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->nik }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">3.</td>
            <td colspan="2"width="45%">Besar Platfrom Kredit</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->jk }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">4.</td>
            <td colspan="2"width="45%">Suku Bungga</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->tempat_lahir }}
                    {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_lahir)->format('d F Y') }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">5.</td>
            <td colspan="2"width="45%">Jangka Waktu</td>
            <td align="center"width="5%">:</td>
            <td>
                <b></b>
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">6.</td>
            <td colspan="2"width="45%">Angsuran</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b> {{ $pinkel->anggota->d->nama_desa }} </b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">7.</td>
            <td colspan="2"width="45%">Presentase Angsuran</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->hp }} </b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">8.</td>
            <td colspan="2"width="45%">Membayar Biaya-biaya :</td>
            <td align="center"width="5%"></td>
            <td></td>
        </tr>
        <tr>
            <td align="center"width="5%">&nbsp;</td>
            <td width="5%">&nbsp;</td>
            <td width="40%">a. Provisi Kredit</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ is_numeric($pinkel->anggota->usaha) ? $pinkel->anggota->u->nama_usaha : $pinkel->anggota->usaha }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">&nbsp;</td>
            <td width="5%">&nbsp;</td>
            <td width="40%">b. Premi Angsuran</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ is_numeric($pinkel->anggota->usaha) ? $pinkel->anggota->u->nama_usaha : $pinkel->anggota->usaha }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">&nbsp;</td>
            <td width="5%">&nbsp;</td>
            <td width="40%">c. Biaya</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ is_numeric($pinkel->anggota->usaha) ? $pinkel->anggota->u->nama_usaha : $pinkel->anggota->usaha }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">&nbsp;</td>
            <td width="5%">&nbsp;</td>
            <td width="40%">d. Pelunasan kredit Lama</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ is_numeric($pinkel->anggota->usaha) ? $pinkel->anggota->u->nama_usaha : $pinkel->anggota->usaha }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">8.</td>
            <td colspan="2"width="45%">Lain-lainya :</td>
            <td align="center"width="5%"></td>
            <td></td>
        </tr>
        <tr>
            <td align="center"width="5%">&nbsp;</td>
            <td width="5%">&nbsp;</td>
            <td width="40%">a. Nilai Pertangungan Asuransi</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ is_numeric($pinkel->anggota->usaha) ? $pinkel->anggota->u->nama_usaha : $pinkel->anggota->usaha }}</b> --}}
            </td>
        </tr>
        <tr>
            <td align="center"width="5%">&nbsp;</td>
            <td width="5%">&nbsp;</td>
            <td width="40%">b. Rencana Realisasi Hari/Tanggal</td>
            <td align="center"width="5%">:</td>
            <td>
                {{-- <b>{{ is_numeric($pinkel->anggota->usaha) ? $pinkel->anggota->u->nama_usaha : $pinkel->anggota->usaha }}</b> --}}
            </td>
        </tr>
    </table>
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
