@php
    use App\Utils\Tanggal;
    $jumlah_angsuran = 0;

    if (Request::get('status') == 'P') {
        $alokasi = $pinkel->proposal;
        $tanggal = 'Tanggal Proposal';
        $tgl = $pinkel->tgl_proposal;
    }

    if (Request::get('status') == 'V') {
        $alokasi = $pinkel->verifikasi;
        $tanggal = 'Tanggal Verifikasi';
        $tgl = $pinkel->tgl_verifikasi;
    }

    if (Request::get('status') == 'W') {
        $alokasi = $pinkel->alokasi;
        $tanggal = 'Tanggal Cair';
        $tgl = $pinkel->tgl_cair;
    }

    if (Request::get('status') == 'A') {
        $alokasi = $pinkel->alokasi;
        $tanggal = 'Tanggal Cair';
        $tgl = $pinkel->tgl_cair;
    }

    $saldo_pokok = $alokasi;
    $alokasi_pinjaman = $alokasi;
    $saldo_jasa = $keuangan->pembulatan(($saldo_pokok * $pinkel->pros_jasa) / 100);

    $sum_pokok = 0;
    $sum_jasa = 0;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr class="b">
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>RENCANA ANGSURAN PINJAMAN INDIVIDU {{ $pinkel->jpp->nama_jpp }} </b>
                </div>
                <div style="font-size: 16px;">
                    <b>&nbsp;
                    </b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>
    <table border="0" width="100%" align="center"cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="90">Nama calon pemanfaat</td>
            <td width="5" align="center">:</td>
            <td>
                <b>{{ $pinkel->anggota->namadepan }} </b>
            </td>
            <td width="90">Jangka waktu</td>
            <td width="5" align="center">:</td>
            <td>
                <b>{{ $pinkel->jangka }} Bulan</b>
            </td>
        </tr>
        <tr>
            <td>No register</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->id }}</b>
            </td>
            <td>Sistem Angsuran</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->sis_pokok->nama_sistem }} {{ round($pinkel->jangka / $pinkel->sis_pokok->sistem) }} Kali</b>
            </td>
        </tr>
        <tr>
            <td>{{ $tanggal }}</td>
            <td align="center">:</td>
            <td>
                <b>{{ Tanggal::tglLatin($tgl) }}</b>
            </td>
            <td>Jenis Jasa</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->jasa->nama_jj }}</b>
            </td>
        </tr>
        <tr>
            <td>Alokasi Pinjaman</td>
            <td align="center">:</td>
            <td>
                <b>Rp. {{ number_format($alokasi_pinjaman) }}</b>
            </td>
            <td>Prosentase Jasa</td>
            <td align="center">:</td>
            <td>
                <b>{{ round($pinkel->pros_jasa / $pinkel->jangka, 2) }}% per bulan</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
    </table>

    <table border="0" width="100%" align="center"cellspacing="0" cellpadding="0"
        style="font-size: 11px; table-layout: fixed;">
        <tr style="background: rgb(232, 232, 232)">
            <th class="l t b" height="20" width="5%" align="center">Ke</th>
            <th class="l t b" width="13%" align="center">Tanggal</th>
            <th class="l t b" width="13%" align="center">Pokok</th>
            <th class="l t b" width="13%" align="center">Jasa</th>
            <th class="l t b" width="15%" align="center">Jumlah</th>
            <th class="l t b" width="15%" align="center">Total Target</th>
            <th class="l t b" width="13%" align="center">Saldo Pokok</th>
            <th class="l t b r" width="13%" align="center">Saldo Jasa</th>
        </tr>
        @foreach ($rencana as $ra)
            @php
                $wajib_angsur = $ra->wajib_pokok + $ra->wajib_jasa;
                $jumlah_angsuran += $wajib_angsur;
                $saldo_pokok -= $ra->wajib_pokok;
                $saldo_jasa -= $ra->wajib_jasa;

                if ($pinkel->jenis_jasa == '2') {
                    $saldo_jasa = ($saldo_pokok * $pinkel->pros_jasa) / 100;
                }

                $sa_pokok = $pinkel->sistem_angsuran;
                $sa_jasa = $pinkel->sa_jasa;

                $jangka = $pinkel->jangka;
                if ($sa_pokok == 11 || $sa_jasa == 11) {
                    $jangka += 24;
                }

                $sum_pokok += $ra->wajib_pokok;
                $sum_jasa += $ra->wajib_jasa;
            @endphp
            <tr>
                <td class="l" align="center">{{ $ra->angsuran_ke }}</td>
                <td class="l" align="center">{{ Tanggal::tglIndo($ra->jatuh_tempo) }}</td>
                <td class="l" align="right">{{ number_format($ra->wajib_pokok) }}</td>
                <td class="l" align="right">{{ number_format($ra->wajib_jasa) }}</td>
                <td class="l" align="right">{{ number_format($wajib_angsur) }}</td>
                <td class="l" align="right">{{ number_format($jumlah_angsuran) }}</td>
                <td class="l" align="right">{{ number_format($saldo_pokok) }}</td>
                <td class="l r" align="right">{{ number_format($saldo_jasa) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="8" style="padding: 0px !important;">
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px; table-layout: fixed;">
                    <tr style="font-weight: bold;">
                        <td class="l t b" width="18%" height="15" align="center" colspan="2">Jumlah</td>
                        <td class="l t b" width="13%" align="right">{{ number_format($sum_pokok) }}</td>
                        <td class="l t b" width="13%" align="right">
                            {{ number_format($sum_jasa) }}
                        </td>
                        <td class="l t b" width="15%" align="right">{{ number_format($jumlah_angsuran) }}</td>
                        <td class="l t b" width="15%" align="right">{{ number_format($jumlah_angsuran) }}</td>
                        <td class="l t b" width="13%" align="right">{{ number_format($saldo_pokok) }}</td>
                        <td class="l t b r" width="13%" align="right">{{ number_format($saldo_jasa) }}</td>
                    </tr>
                </table><br>

                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">

                    <tr>
                        <td align="center" colspan="4">&nbsp;</td>
                        <td align="center" colspan="4">
                            {{ $kec->nama_kec }}, {{ Tanggal::tglLatin($tgl) }}
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="4">
                            {{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }} <br><br><br><br>
                        </td>
                        <td align="center" colspan="4">
                            Pemanfaat <br><br><br><br>
                        </td>

                    </tr>
                    <tr>
                        <td align="center" colspan="4">
                            <b> {{ $dir->namadepan }} {{ $dir->namabelakang }}</b>
                        </td>
                        <td align="center" colspan="4">
                            <b> {{ $pinkel->anggota->namadepan }}</b>
                        </td>

                    </tr>

                </table>
            </td>
        </tr>
    </table>
@endsection
