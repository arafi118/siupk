@php
    use App\Utils\Tanggal;
    $section = 0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    <style>
        html {
            margin-left: 40px;
            margin-right: 40px;
        }
    </style>
    @foreach ($jenis_pp as $jpp)
        @php
            if ($jpp->pinjaman_individu->isEmpty()) {
                continue;
            }
        @endphp
        @php
            $kd_desa = [];
            $t_alokasi = 0;
            $t_saldo = 0;
            $t_tunggakan_pokok = 0;
            $t_tunggakan_jasa = 0;
            $t_kolek1 = 0;
            $t_kolek2 = 0;
            $t_kolek3 = 0;
            $t_kolek4 = 0;
            $t_kolek5 = 0;

        @endphp
        @if ($jpp->nama_jpp != 'SPP')
            <div class="break"></div>
        @endif
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td colspan="3" align="center">
                    <div style="font-size: 20px;">
                        <b>DAFTAR KOLEKTIBILITAS INDIVIDU {{ strtoupper($jpp->nama_jpp) }}</b>
                    </div>
                    <div style="font-size: 16px;">
                        <b>{{ strtoupper($sub_judul) }}</b>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" height="5"></td>
            </tr>

        </table>

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px; table-layout: fixed;">
            <tr>
                <th class="t l b" width="2%">No</th>
                <th class="t l b" width="23%">Nama - Loan ID</th>
                <th class="t l b" width="10%">Saldo</th>
                <th class="t l b" width="10%">Tunggakan</th>
                <th class="t l b">KOLEK I</th>
                <th class="t l b">KOLEK II</th>
                <th class="t l b ">KOLEK III</th>
                <th class="t l b">KOLEK IV</th>
                <th class="t l b r">KOLEK V</th>
            </tr>

            @foreach ($jpp->pinjaman_individu as $pinkel)
                @php
                    $kd_desa[] = $pinkel->kd_desa;
                    $desa = $pinkel->kd_desa;

                @endphp
                @if (array_count_values($kd_desa)[$pinkel->kd_desa] <= '1')
                    @if ($section != $desa && count($kd_desa) > 1)
                        @php
                            $j_pross = $j_saldo / $j_alokasi;
                            $t_alokasi += $j_alokasi;
                            $t_saldo += $j_saldo;
                            $t_tunggakan_pokok += $j_tunggakan_pokok;
                            $t_tunggakan_jasa += $j_tunggakan_jasa;
                            $t_kolek1 += $j_kolek1;
                            $t_kolek2 += $j_kolek2;
                            $t_kolek3 += $j_kolek3;
                            $t_kolek4 += $j_kolek4;
                            $t_kolek5 += $j_kolek5;
                        @endphp
                        <tr style="font-weight: bold;">
                            <td class="t l b" align="left" colspan="2">Jumlah {{ $nama_desa }}</td>
                            <td class="t l b" align="right">{{ number_format($j_saldo) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_tunggakan_pokok) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_kolek1) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_kolek2) }}</td>
                            <td class="t l b " align="right">{{ number_format($j_kolek3) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_kolek4) }}</td>
                            <td class="t l b r" align="right">{{ number_format($j_kolek5) }}</td>
                        </tr>
                    @endif

                    <tr style="font-weight: bold;">
                        <td class="t l b r" colspan="9" align="left">{{ $pinkel->kode_desa }}.
                            {{ $pinkel->nama_desa }}</td>
                    </tr>
                    @php
                        $nomor = 1;
                        $j_alokasi = 0;
                        $j_saldo = 0;
                        $j_tunggakan_pokok = 0;
                        $j_tunggakan_jasa = 0;
                        $j_kolek1 = 0;
                        $j_kolek2 = 0;
                        $j_kolek3 = 0;
                        $j_kolek4 = 0;
                        $j_kolek5 = 0;
                        $section = $pinkel->kd_desa;
                        $nama_desa = $pinkel->sebutan_desa . ' ' . $pinkel->nama_desa;
                    @endphp
                @endif

                @php
                    $sum_pokok = 0;
                    $sum_jasa = 0;
                    $saldo_pokok = $pinkel->alokasi;
                    $saldo_jasa = $pinkel->pros_jasa == 0 ? 0 : $pinkel->alokasi * ($pinkel->pros_jasa / 100);
                    if ($pinkel->saldo) {
                        $sum_pokok = $pinkel->saldo->sum_pokok;
                        $sum_jasa = $pinkel->saldo->sum_jasa;
                        $saldo_pokok = $pinkel->saldo->saldo_pokok;
                        $saldo_jasa = $pinkel->saldo->saldo_jasa;
                    }

                    if ($saldo_jasa < 0) {
                        $saldo_jasa = 0;
                    }

                    if ($pinkel->tgl_lunas <= $tgl_kondisi && $pinkel->status == 'L') {
                        $saldo_jasa = 0;
                    }

                    $target_pokok = 0;
                    $target_jasa = 0;
                    $wajib_pokok = 0;
                    $wajib_jasa = 0;
                    $angsuran_ke = 0;
                    if ($pinkel->target) {
                        $target_pokok = $pinkel->target->target_pokok;
                        $target_jasa = $pinkel->target->target_jasa;
                        $wajib_pokok = $pinkel->target->wajib_pokok;
                        $wajib_jasa = $pinkel->target->wajib_jasa;
                        $angsuran_ke = $pinkel->target->angsuran_ke;
                    }

                    $tunggakan_pokok = $target_pokok - $sum_pokok;
                    if ($tunggakan_pokok < 0) {
                        $tunggakan_pokok = 0;
                    }
                    $tunggakan_jasa = $target_jasa - $sum_jasa;
                    if ($tunggakan_jasa < 0) {
                        $tunggakan_jasa = 0;
                    }

                    $pross = $saldo_pokok == 0 ? 0 : $saldo_pokok / $pinkel->alokasi;

                    if ($pinkel->tgl_lunas <= $tgl_kondisi && $pinkel->status == 'L') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    } elseif ($pinkel->tgl_lunas <= $tgl_kondisi && $pinkel->status == 'R') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    } elseif ($pinkel->tgl_lunas <= $tgl_kondisi && $pinkel->status == 'H') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    }

                    $tgl_cair = explode('-', $pinkel->tgl_cair);
                    $th_cair = $tgl_cair[0];
                    $bl_cair = $tgl_cair[1];
                    $tg_cair = $tgl_cair[2];

                    $selisih_tahun = ($tahun - $th_cair) * 12;
                    $selisih_bulan = $bulan - $bl_cair;

                    $selisih = $selisih_bulan + $selisih_tahun;

                    $_kolek = 0;

                    if ($wajib_pokok != '0') {
                        $_kolek = $tunggakan_pokok / $wajib_pokok;
                    }
                    $kolek = ceil($_kolek + ($selisih - $angsuran_ke));

                    if ($kolek <= 0) {
                        $kolek1 = $saldo_pokok;
                        $kolek2 = 0;
                        $kolek3 = 0;
                        $kolek4 = 0;
                        $kolek5 = 0;
                    } elseif ($kolek > 0 && $kolek <= 2) {
                        $kolek1 = 0;
                        $kolek2 = $saldo_pokok;
                        $kolek3 = 0;
                        $kolek4 = 0;
                        $kolek5 = 0;
                    } elseif ($kolek > 2 && $kolek <= 4) {
                        $kolek1 = 0;
                        $kolek2 = 0;
                        $kolek3 = $saldo_pokok;
                        $kolek4 = 0;
                        $kolek5 = 0;
                    } elseif ($kolek > 4 && $kolek <= 6) {
                        $kolek1 = 0;
                        $kolek2 = 0;
                        $kolek3 = 0;
                        $kolek4 = $saldo_pokok;
                        $kolek5 = 0;
                    } elseif ($kolek > 6) {
                        $kolek1 = 0;
                        $kolek2 = 0;
                        $kolek3 = 0;
                        $kolek4 = 0;
                        $kolek5 = $saldo_pokok;
                    }

                @endphp

                <tr>
                    <td class="t l b" align="center">{{ $nomor++ }}</td>
                    <td class="t l b" align="left">{{ $pinkel->namadepan }} - {{ $pinkel->id }}</td>
                    <td class="t l b" align="right">{{ number_format($saldo_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($tunggakan_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($kolek1) }}</td>
                    <td class="t l b" align="right">{{ number_format($kolek2) }}</td>
                    <td class="t l b " align="right">{{ number_format($kolek3) }}</td>
                    <td class="t l b" align="right">{{ number_format($kolek4) }}</td>
                    <td class="t l b r" align="right"> {{ number_format($kolek5) }}</td>
                </tr>

                @php
                    $j_alokasi += $pinkel->alokasi;
                    $j_saldo += $saldo_pokok;
                    $j_tunggakan_pokok += $tunggakan_pokok;
                    $j_tunggakan_jasa += $tunggakan_jasa;
                    $j_kolek1 += $kolek1;
                    $j_kolek2 += $kolek2;
                    $j_kolek3 += $kolek3;
                    $j_kolek4 += $kolek4;
                    $j_kolek5 += $kolek5;
                @endphp
            @endforeach

            @if (count($kd_desa) > 0)
                @php
                    $j_pross = $j_saldo / $j_alokasi;
                    $t_alokasi += $j_alokasi;
                    $t_saldo += $j_saldo;
                    $t_tunggakan_pokok += $j_tunggakan_pokok;
                    $t_tunggakan_jasa += $j_tunggakan_jasa;
                    $t_kolek1 += $j_kolek1;
                    $t_kolek2 += $j_kolek2;
                    $t_kolek3 += $j_kolek3;
                    $t_kolek4 += $j_kolek4;
                    $t_kolek5 += $j_kolek5;
                @endphp
                <tr style="font-weight: bold;">
                    <td class="t l b" align="left" colspan="2">Jumlah {{ $nama_desa }}</td>
                    <td class="t l b" align="right">{{ number_format($j_saldo) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_tunggakan_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_kolek1) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_kolek2) }}</td>
                    <td class="t l b r" align="right">{{ number_format($j_kolek3) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_kolek4) }}</td>
                    <td class="t l b r" align="right">{{ number_format($j_kolek5) }}</td>
                </tr>

                @php
                    $t_pros = 0;
                    if ($t_saldo) {
                        $t_pross = $t_saldo / $t_alokasi;
                    }
                @endphp

                <tr>
                    <td colspan="9" style="padding: 0px !important;">
                        <table border="0" width="100%" cellspacing="0" cellpadding="0"
                            style="font-size: 11px; table-layout: fixed;">
                            <tr style="font-weight: bold;">
                                <td width="25%" class="t l b" align="center" height="20">J U M L A H</td>
                                <td width="10%" class="t l b" align="right">{{ number_format($t_saldo) }}</td>
                                <td width="10%" class="t l b r" align="right">
                                    {{ number_format($t_tunggakan_pokok) }}
                                </td>
                                <td class="t l b" align="right">{{ number_format($t_kolek1) }}</td>
                                <td class="t l b" align="right">{{ number_format($t_kolek2) }}</td>
                                <td class="t l b" align="right">{{ number_format($t_kolek3) }}</td>
                                <td class="t l b" align="right">{{ number_format($t_kolek4) }}</td>
                                <td class="t l b r" align="right">{{ number_format($t_kolek5) }}</td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td class="t l b" align="center" rowspan="2" height="20">Resiko Pinjaman</td>
                                <td class="t l b" colspan="2" align="center">(Kolek I + Kolek II + Kolek III + Kolek
                                    IV + Kolek V)</td>
                                <td class="t l b" align="center">Kolek I * 1%</td>
                                <td class="t l b" align="center">Kolek II * 10%</td>
                                <td class="t l b" align="center">Kolek III * 25%</td>
                                <td class="t l b" align="center">Kolek IV * 50%</td>
                                <td class="t l b r" align="center">Kolek V * 100%</td>
                            </tr>
                            <tr>
                                <td class="t l b" align="center" colspan="2">
                                    {{ number_format(($t_kolek1 * 1) / 100 + ($t_kolek2 * 10) / 100 + ($t_kolek3 * 25) / 100 + ($t_kolek4 * 50) / 100 + ($t_kolek3 * 100) / 100) }}
                                </td>
                                <td class="t l b" align="center">{{ number_format(($t_kolek1 * 1) / 100) }}</td>
                                <td class="t l b" align="center">{{ number_format(($t_kolek2 * 10) / 100) }}</td>
                                <td class="t l b" align="center">{{ number_format(($t_kolek3 * 25) / 100) }}</td>
                                <td class="t l b" align="center">{{ number_format(($t_kolek4 * 50) / 100) }}</td>
                                <td class="t l b r" align="center">{{ number_format(($t_kolek5 * 100) / 100) }}</td>
                            </tr>

                            <tr>
                                <td colspan="8">
                                    <div style="margin-top: 16px;"></div>
                                    {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endif
        </table>
    @endforeach
@endsection
