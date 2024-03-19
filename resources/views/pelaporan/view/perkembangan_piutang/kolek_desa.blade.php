@php
    use App\Utils\Tanggal;
    $section = 0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    @foreach ($jenis_pp as $jpp)
        @php
            if ($jpp->pinjaman_kelompok->isEmpty()) {
                break;
            }
        @endphp

        @php
            $kd_desa = [];
            $nomor = 1;
            $t_alokasi = 0;
            $t_saldo = 0;
            $t_tunggakan_pokok = 0;
            $t_tunggakan_jasa = 0;
            $t_kolek1 = 0;
            $t_kolek2 = 0;
            $t_kolek3 = 0;
        @endphp
        @if ($jpp->nama_jpp != 'SPP')
            <div class="break"></div>
        @endif
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td colspan="3" align="center">
                    <div style="font-size: 18px;">
                        <b>DAFTAR KOLEKTIBILITAS REKAP DESA {{ strtoupper($jpp->nama_jpp) }}</b>
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
                <th class="t l b" rowspan="2" width="24%">Nama Desa</th>
                <th class="t l b" rowspan="2" width="10%">Alokasi</th>
                <th class="t l b" rowspan="2" width="10%">Saldo</th>
                <th class="t l b" rowspan="2" width="4%">%</th>
                <th class="t l b" colspan="2" width="20%">Tunggakan</th>
                <th class="t l b" width="10%">Lancar</th>
                <th class="t l b" width="10%">Diragukan</th>
                <th class="t l b r" width="10%">Macet</th>
            </tr>
            <tr>
                <th class="t l b" width="10%">Pokok</th>
                <th class="t l b" width="10%">Jasa</th>
                <th class="t l b">(Menunggak 1-3)</th>
                <th class="t l b">(Menunggak 4-5)</th>
                <th class="t l b r">(Menunggak 6+)</th>
            </tr>

            @foreach ($jpp->pinjaman_kelompok as $pinkel)
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
                        @endphp
                        <tr>
                            <td class="t l b" align="left">{{ $nomor++ }}. {{ $nama_desa }}</td>
                            <td class="t l b" align="right">{{ number_format($j_alokasi) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_saldo) }}</td>
                            <td class="t l b" align="center">{{ number_format(floor($j_pross * 100)) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_tunggakan_pokok) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_tunggakan_jasa) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_kolek1) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_kolek2) }}</td>
                            <td class="t l b r" align="right">{{ number_format($j_kolek3) }}</td>
                        </tr>
                    @endif

                    @php
                        $j_alokasi = 0;
                        $j_saldo = 0;
                        $j_tunggakan_pokok = 0;
                        $j_tunggakan_jasa = 0;
                        $j_kolek1 = 0;
                        $j_kolek2 = 0;
                        $j_kolek3 = 0;
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
                    $kolek = round($_kolek + ($selisih - $angsuran_ke));
                    if ($kolek <= 3) {
                        $kolek1 = $saldo_pokok;
                        $kolek2 = 0;
                        $kolek3 = 0;
                    } elseif ($kolek <= 5) {
                        $kolek1 = 0;
                        $kolek2 = $saldo_pokok;
                        $kolek3 = 0;
                    } else {
                        $kolek1 = 0;
                        $kolek2 = 0;
                        $kolek3 = $saldo_pokok;
                    }

                    $j_alokasi += $pinkel->alokasi;
                    $j_saldo += $saldo_pokok;
                    $j_tunggakan_pokok += $tunggakan_pokok;
                    $j_tunggakan_jasa += $tunggakan_jasa;
                    $j_kolek1 += $kolek1;
                    $j_kolek2 += $kolek2;
                    $j_kolek3 += $kolek3;
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
                @endphp
                <tr>
                    <td class="t l b" align="left">{{ $nomor++ }}. {{ $nama_desa }}</td>
                    <td class="t l b" align="right">{{ number_format($j_alokasi) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_saldo) }}</td>
                    <td class="t l b" align="center">{{ number_format(floor($j_pross * 100)) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_tunggakan_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_tunggakan_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_kolek1) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_kolek2) }}</td>
                    <td class="t l b r" align="right">{{ number_format($j_kolek3) }}</td>
                </tr>

                @php
                    $t_pros = 0;
                    if ($t_saldo) {
                        $t_pross = $t_saldo / $t_alokasi;
                    }
                @endphp
                <tr>
                    <td colspan="9" style="padding: 0px !important;">
                        <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                            style="font-size: 11px; table-layout: fixed;">
                            <tr style="font-weight: bold;">
                                <td class="t l b" width="24%" align="center" height="20">J U M L A H</td>
                                <td class="t l b" width="10%" align="right">{{ number_format($t_alokasi) }}</td>
                                <td class="t l b" width="10%" align="right">{{ number_format($t_saldo) }}</td>
                                <td class="t l b" width="4%" align="center">
                                    {{ number_format(floor($t_pross * 100)) }}</td>
                                <td class="t l b" width="10%" align="right">{{ number_format($t_tunggakan_pokok) }}
                                </td>
                                <td class="t l b" width="10%" align="right">{{ number_format($t_tunggakan_jasa) }}
                                </td>
                                <td class="t l b" width="10%" align="right">{{ number_format($t_kolek1) }}</td>
                                <td class="t l b" width="10%" align="right">{{ number_format($t_kolek2) }}</td>
                                <td class="t l b r" width="10%" align="right">{{ number_format($t_kolek3) }}</td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td class="t l b" align="center" rowspan="2" height="20">Resiko Pinjaman</td>
                                <td class="t l b" colspan="5" align="center">(Lancar + Diragukan + Macet)</td>
                                <td class="t l b" align="center">Lancar * 0%</td>
                                <td class="t l b" align="center">Diragukan * 50%</td>
                                <td class="t l b r" align="center">Macet * 100%</td>
                            </tr>
                            <tr>
                                <td class="t l b" align="center" colspan="5">
                                    {{ number_format(($t_kolek1 * 0) / 100 + ($t_kolek2 * 50) / 100 + ($t_kolek3 * 100) / 100) }}
                                </td>
                                <td class="t l b" align="center">{{ number_format(($t_kolek1 * 0) / 100) }}</td>
                                <td class="t l b" align="center">{{ number_format(($t_kolek2 * 50) / 100) }}</td>
                                <td class="t l b r" align="center">{{ number_format(($t_kolek3 * 100) / 100) }}</td>
                            </tr>

                            <tr>
                                <td colspan="9">
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
