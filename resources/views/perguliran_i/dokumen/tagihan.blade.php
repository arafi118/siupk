@php
    use App\Utils\Tanggal;

    $real_pokok = 0;
    $real_jasa = 0;
    $sum_pokok = 0;
    $sum_jasa = 0;
    $saldo_pokok = $pinkel->alokasi;
    $saldo_jasa = $pinkel->alokasi / $pinkel->pros_jasa;
    if ($real) {
        $real_pokok = $real->realisasi_pokok ?: null;
        $real_jasa = $real->realisasi_jasa ?: null;
        $sum_pokok = $real->sum_pokok ?: null;
        $sum_jasa = $real->sum_jasa ?: null;
        $saldo_pokok = $real->saldo_pokok ?: null;
        $saldo_jasa = $real->saldo_jasa ?: null;
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
                __________/{{ Tanggal::tglRomawi(date('Y-m-d')) }}
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
                <b>Surat Tagihan</b>
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
                <div>Dengan hormat,</div>
                <div style="text-align: justify;">
                    Mendasar kepada Surat Perjanjian Kredit ({{ $pinkel->jpp->nama_jpp }})
                    antara {{ $PL }} {{ $pinkel->anggota->namadepan }}
                    {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }} {{ $pinkel->anggota->d->nama_desa }}
                    dengan
                    {{ $kec->nama_lembaga_sort }} Tanggal {{ Tanggal::tglLatin($pinkel->tgl_cair) }} dengan rincian pinjaman
                    sebagai berikut ;
                </div>
                <table>
                    <tr>
                        <td width="10">1.</td>
                        <td width="140">Alokasi Pinjaman</td>
                        <td width="5">:</td>
                        <td>
                            <b>Rp. {{ number_format($pinkel->alokasi) }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Tanggal Pencairan</td>
                        <td>:</td>
                        <td>
                            <b>{{ Tanggal::tglLatin($pinkel->tgl_cair) }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Prosentase Jasa</td>
                        <td>:</td>
                        <td>
                            <b>{{ $pinkel->pros_jasa / $pinkel->jangka }}% per Bulan</b>
                        </td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Masa Angsuran</td>
                        <td>:</td>
                        <td>
                            <b>{{ $pinkel->jangka }} Bulan</b>
                        </td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Sistem Angsuran</td>
                        <td>:</td>
                        <td>
                            <b>{{ $pinkel->sis_pokok->nama_sistem }}</b>
                        </td>
                    </tr>
                </table>

                <div style="text-align: justify;">
                    dan mendasar pada catatan pembukuan kami {{ $PL }} {{ $pinkel->anggota->namadepan }}
                    {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }} {{ $pinkel->anggota->d->nama_desa }} sampai
                    dengan
                    diterbitkannya Surat Tagihan ini masih tercatat memiliki tunggakan sebagai berikut ;
                </div>

                <table>
                    <tr>
                        <td width="10">1.</td>
                        <td width="140">Tunggakan Pokok</td>
                        <td width="5">:</td>
                        <td>
                            <b>Rp. {{ number_format($tunggakan_pokok) }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Tunggakan Jasa</td>
                        <td>:</td>
                        <td>
                            <b>Rp. {{ number_format($tunggakan_jasa) }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td><b>Total Tunggakan (Pokok+jasa)</b></td>
                        <td>:</td>
                        <td>
                            <b>Rp. {{ number_format($tunggakan_pokok + $tunggakan_jasa) }}</b>
                        </td>
                    </tr>
                </table>

                <p style="text-align: justify;">
                    Demikian surat ini kami sampaikan, apabila terjadi perbedaan hasil perhitungan angsuran/ tunggakan
                    mohon untuk melakukan klarifikasi dengan {{ $kec->nama_lembaga_sort }}. Pembayaran dimohon untuk dapat dilakukan paling lambat tanggal .................... . Terima kasih atas perhatian dan kerjasamanya.
                </p>
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
                {{ $kec->nama_kec }}, {{ Tanggal::tglLatin(date('Y-m-d')) }}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">{{ $kec->sebutan_level_1 }}</td>
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
