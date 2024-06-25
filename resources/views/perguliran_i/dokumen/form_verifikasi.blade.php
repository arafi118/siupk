@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
    <table width="97%" border="0" align="center" cellpadding="3" cellspacing="0" style="font-size: 11px;">

        <tr>
            <td height="50" colspan="6" class="bottom">
                <p align="center" style="font-size: 14px; font-weight: bold;">PENILAIAN PERMOHONAN PINJAMAN
                    INDIVIDU
                </p>
            </td>
        </tr>


        <tr>
            <td height="25" colspan="6"><b>A. IDENTITAS PEMINJAM (ANGGOTA)</b></td>
        </tr>

        <tr>
            <td width="4%" align="right">1. </td>
            <td width="25%">Nama anggota</td>
            <td colspan="4">: {{ $pinkel->anggota->namadepan }}</td>
        </tr>
        <tr>
            <td width="4%" align="right">2. </td>
            <td>Jenis Kelamin</td>
            <td colspan="4">: {{ $pinkel->anggota->jk }}</td>
        </tr>
        <tr>
            <td width="4%" align="right">3.</td>
            <td height="0">N I K</td>
            <td height="0" colspan="4">: {{ $pinkel->anggota->nik }}</td>
        </tr>
        <tr>
            <td width="4%" align="right">4.</td>
            <td height="0">Tempat, anggal Lahir </td>
            <td height="0" colspan="4">: {{ $pinkel->anggota->tempat_lahir }}
                {{ Tanggal::tglLatin($pinkel->anggota->tgl_lahir) }}

            </td>
        </tr>
        <tr>
            <td width="4%" align="right">5.</td>
            <td height="0">Alamat</td>
            <td height="0" colspan="4"><span>: {{ $pinkel->anggota->alamat }}
                    {{ $pinkel->anggota->d->nama_desa }}</span></td>
        </tr>
        <tr>
            <td width="4%" align="right">6.</td>
            <td height="0">No. Handphone</td>
            <td height="0" colspan="4"><span>: {{ $pinkel->anggota->hp }}</span></td>
        </tr>
        <tr>
            <td width="4%" align="right">7.</td>
            <td>Jenis Usaha</td>
            <td colspan="4">: {{ is_numeric($pinkel->anggota->usaha) ? $pinkel->anggota->u->nama_usaha : $pinkel->anggota->usaha }}</td>
        </tr>
        <tr>
            <td width="4%" align="right">8.</td>
            <td>Jumlah Kredit yang diminta</td>
            <td colspan="4"><span>: Rp. {{ number_format($pinkel->proposal) }}.- </span>
            </td>
        </tr>
        <tr>
            <td width="4%" align="right">9.</td>
            <td>Sistem angsuran</td>
            <td colspan="4">: {{ $pinkel->sis_pokok->nama_sistem }}
                ({{ $pinkel->sis_pokok->deskripsi_sistem }})</td>
        </tr>
        <tr>
            <td width="4%" align="right">10.</td>
            <td>jangka waktu</td>
            <td colspan="4">: {{ $pinkel->jangka }} bulan</td>
        </tr>
    </table>
    <table width="97%" border="0" align="center" cellpadding="3" cellspacing="0" style="font-size: 11px;">
        <tr>
            <td height="25" colspan="6"><strong>B. INFORMASI PENDAPATAN &amp;
                    PENGELUARAN</strong></td>
        </tr>
        <tr>
            <td rowspan="6" align="right" valign="top" class="style9 align-justify">
                <div align="right">1.</div>
            </td>
            <td width="60%" colspan="2" class="style9 align-justify">Pendapatan Keluarga 1 (satu) bulan</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pendapatan dari usaha suami</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pendapatan dari usaha istri</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pendapatan dari hasil kebun, sawah, ladang</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pendapatan lain-lain</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <th colspan="2" class="style9 align-justify">
                <div align="center" class="style28">Jumlah pendapatan </div>
            </th>
            <td colspan="3"><strong>: Rp. </strong></td>
        </tr>
        <tr>
            <td rowspan="10" valign="top" class="style9 align-justify">
                <div align="right">2.</div>
            </td>
            <td colspan="2" class="style9 align-justify">Pengeluaran keluarga</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pembelian alat/barang dagangan</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pengeluaran Kebutuhan Makan/minum</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pengeluaran Sabun-Cuci-mandi</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pengeluaran untuk Sekolah</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pengeluaran untuk sosial</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pengeluaran listrik, air, telphon dll</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Angsuran pinjaman di bank/koperasi/perorangan</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">Pengeluaran lain-lain</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td colspan="2" class="style9 align-justify">
                <div align="center" class="style28"><strong>Jumlah Pengeluaran </strong></div>
            </td>
            <td colspan="3"><strong>: Rp. </strong></td>
        </tr>
        <tr>
            <td colspan="6"><strong>C. IDENTITAS JAMINAN</strong></td>
        </tr>
        <tr>
            <td class="style9 align-justify">
                <div align="right">1.</div>
            </td>
            <td colspan="2" class="style9 align-justify">Tabungan di Bank/Koperasi/BMT atas nama pribadi</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td class="style9 align-justify">
                <div align="right">2.</div>
            </td>
            <td colspan="2" class="style9 align-justify">Nilai harta lain berupa
                ...............................................</td>
            <td colspan="3" class="style9 align-justify">: Rp. </td>
        </tr>
        <tr>
            <td class="style9 align-justify">&nbsp;</td>
            <td colspan="2" class="style9 align-justify">
                <div align="center" class="style28"><strong>Total Nilai Jaminan</strong></div>
            </td>
            <td colspan="3" class="style9 align-justify"><strong>: Rp. </strong></td>
        </tr>
        <tr>
            <td colspan="6"><strong>D. PENILAIAN</strong></td>
        </tr>
        <tr>
            <td class="style9 align-justify">
                <div align="right">1.</div>
            </td>
            <td colspan="2" class="style9 align-justify">Ratio pendapatan keluarga (bersih) per bulan dibagi angsuran
                per bulan</td>
            <td colspan="3" class="style9 align-justify">: ............% (min 200%)</td>
        </tr>
        <tr>
            <td class="style9 align-justify">
                <div align="right">2.</div>
            </td>
            <td colspan="2" class="style9 align-justify">Ratio tabungan di kelompok dibagi kredit yang diajukan</td>
            <td colspan="3" class="style9 align-justify">: ............% (min 20%)</td>
        </tr>
    </table>

    <table width="97%" border="0" align="center" cellpadding="3" cellspacing="0" style="font-size: 11px;">


        <tr>
            <td width="45%" class="style9 align-justify">
                <p><span> E. KESIMPULAN</span><br>
                    Anggota/peminjam ini LAYAK / TIDAK LAYAK untuk diberikan kredit sebesar:<br>
                    <br>
                    <strong><u></u>Rp. {{ $pinkel->alokasi }} </u></strong>
                </p>
                <p>Dengan Catatan :<br><br><br><br>
                    *) coret yang tidak perlu. </p>
            </td>
            <td width="5%" height="20" colspan="-1" class="style9 align-justify">
                <p>&nbsp;</p>
            </td>
            <td width="50%" colspan="2" class="style9">
                <p><br>
                    Diverifikasi Pada : ................................................<br>
                    Oleh : Tim Verifikasi {{ $kec->sebutan_kec }} {{ $kec->nama_kec }} <br>
                </p>

                <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
                    @foreach ($user as $r)
                        <tr>
                            <td width="70" height="20">
                                <div>{{ $r->namadepan }} {{ $r->namabelakang }}</div>
                                <div>
                                    <b>{{ $r->j->nama_jabatan }}</b>
                                </div>
                            </td>
                            <td align="right" style="vertical-align: bottom;">
                                _____________________________________
                            </td>
                        </tr>
                    @endforeach
                </table>

            </td>
        </tr>
    </table>
    </body>
@endsection
