@php
    use App\Utils\Tanggal;

    $real = 0;
    $real_pokok = 0;
    $real_jasa = 0;
    $sum_pokok = 0;
    $sum_jasa = 0;
    $saldo_pokok = $pinkel->alokasi;
    $saldo_jasa = $pinkel->alokasi / $pinkel->pros_jasa;
    if ($real) {
        $real_pokok = $real->realisasi_pokok ?? null;
        $real_jasa = $real->realisasi_jasa ?? null;
        $sum_pokok = $real->sum_pokok ?? null;
        $sum_jasa = $real->sum_jasa ?? null;
        $saldo_pokok = $real->saldo_pokok ?? null;
        $saldo_jasa = $real->saldo_jasa ?? null;
    }

    $target_pokok = 0;
    $target_jasa = 0;
    if ($ra) {
        $target_pokok = $ra->target_pokok;
        $target_jasa = $ra->target_jasa;
    }

    $tunggakan_pokok = $target_pokok - $sum_pokok;
    if ($tunggakan_pokok < 0) {
        $tunggakan_pokok = 0;
    }
    $tunggakan_jasa = $target_jasa - $sum_jasa;
    if ($tunggakan_jasa < 0) {
        $tunggakan_jasa = 0;
    }
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
            <td width="50">Nomor</td>
            <td width="10" align="center">:</td>
            <td colspan="2">
                ______/LKM/{{ Tanggal::tglRomawi(date('Y-m-d')) }}
            </td>
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
                <b>Surat Persetujuan Kredit (SP2K)</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
            <td align="left" width="140">
                <div>Kepada Yth. </div>
                <div>
                    Bpk/Ibu <b>{{ $pinkel->anggota->namadepan }}</b>
                </div>
                <div>Di</div>
                <div>
                    &nbsp;&nbsp;{{ $pinkel->anggota->d->nama_desa }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            @php
                if ($pinkel->anggota->jk == 'P') {
                    $PL = 'Ibu.';
                } else {
                    $PL = 'Bpk.';
                }
            @endphp

            <td colspan="3">
                <div style="text-align: justify;">
                    Dengan ini diberitahukan bahwa sesuai dengan surat permohonan kredit saudara dan setelah diadakan
                    verifikasi serta penilaian Analisa dan kredit, maka {{ $kec->nama_lembaga_sort }} menyetujui permohonan tersebut dengan
                    ketentuan
                    dan syarat- syarat sebagai berikut:
                </div>
                <div style="text-align: justify;">
                    Fasilitas Kredit
                </div>
                <table>
                    <tr>
                        <td align="center"width="5%">1.</td>
                        <td>Jumlah Plafon Kredit</td>
                        <td align="center"width="5%">:</td>
                        <td>
                            Rp. {{ number_format($pinkel->alokasi) }}
                        </td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">2.</td>
                        <td>Jangka Waktu Kredit</td>
                        <td align="center"width="5%">:</td>
                        <td>
                            {{ number_format($pinkel->jangka) }} bulan
                        </td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">3.</td>
                        <td>Jenis Kredit</td>
                        <td align="center"width="5%">:</td>
                        <td>
                            Rp. {{ number_format($pinkel->jenis_pp) }}
                        </td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">4.</td>
                        <td>Suku Jasa Kredit</td>
                        <td align="center"width="5%">:</td>
                        <td>
                            Rp. {{ number_format($pinkel->pros_jasa) }}
                        </td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">5.</td>
                        <td>Cara Penarikan</td>
                        <td align="center"width="5%">:</td>
                        <td>
                            Sekaligus
                        </td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">6.</td>
                        <td>Cara Pembayaran</td>
                        <td align="center"width="5%">:</td>
                        <td>
                            Pokok dan jasa diangsur sesuai tabel rencana angsuran sebagai bagian yang
                            tidak terpisahkan dari surat perjanjian kredit(SPK)
                        </td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">7.</td>
                        <td>Cara Pengikat Kredit</td>
                        <td align="center"width="5%">:</td>
                        <td>
                            ibawah tanda tangan
                        </td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">8.</td>
                        <td>Syarat Lainnya</td>
                        <td align="center"width="5%">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">&nbsp;</td>
                        <td width="45%" colspan="3">a. Suami/Istri turut menandatangani SPK dan diikat dengan
                            penanggung.
                        </td>
                    </tr>
                    <tr>
                        <td align="center"width="5%">&nbsp;</td>
                        <td width="45%" colspan="3">b. Tidak memberi imbalan dalam bentuk uang, barang, fasilitas
                            lainnya
                            kepada petugas.</td>
                    </tr>
                </table>

                <div style="text-align: justify;">
                    Sebagai tanda persetujuan saudara, harap surat SP2K ini ditanda tangani diatas materai Rp 10.000 dan
                    diserahkan kembali kepada {{ $kec->nama_lembaga_sort }} paling lambat dalam waktu 1 (Satu) hari sebelum
                    tanggal
                    pencairan.
                </div>
            </td>
        </tr>
    </table>
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
                Direktur
            </td>
            <td colspan="2" align="center">Piutang</td>
        </tr>
        <tr>
            <td colspan="3" height="40">&nbsp;</td>
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
