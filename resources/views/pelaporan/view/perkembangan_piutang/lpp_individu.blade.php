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
            $t_target_pokok = 0;
            $t_target_jasa = 0;
            $t_real_bl_pokok = 0;
            $t_real_bl_jasa = 0;
            $t_real_pokok = 0;
            $t_real_jasa = 0;
            $t_real_bi_pokok = 0;
            $t_real_bi_jasa = 0;
            $t_saldo_pokok = 0;
            $t_saldo_jasa = 0;
            $t_tunggakan_pokok = 0;
            $t_tunggakan_jasa = 0;
        @endphp
        @if ($jpp->nama_jpp != 'SPP')
            <div class="break"></div>
        @endif
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td colspan="3" align="center">
                    <div style="font-size: 18px;">
                        <b>DAFTAR PERKEMBANGAN PINJAMAN INDIVIDU {{ strtoupper($jpp->nama_jpp) }}</b>
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
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 8px; table-layout: fixed;">
            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                <th class="t l b" rowspan="2" width="2%">No</th>
                <th class="t l b" rowspan="2">Kelompok - Loan ID</th>
                <th class="t l b" rowspan="2" width="4%">
                    <div>Tgl Cair</div>
                    <div>
                        <small>(dd/mm/yy)</small>
                    </div>
                </th>
                <th class="t l b" rowspan="2" width="3%">Tem<br>po</th>
                <th class="t l b" rowspan="2" width="6%">Alokasi</th>
                <th class="t l b" rowspan="2" width="3%">%</th>
                <th class="t l b" colspan="2">Target</th>
                <th class="t l b" colspan="2">Real s.d. Bulan Lalu</th>
                <th class="t l b" colspan="2">Real Bulan Ini</th>
                <th class="t l b" colspan="2">Real s.d. Bulan Ini</th>
                <th class="t l b"  rowspan="2" width="6%">Saldo</th>
                <th class="t l b" rowspan="2" width="2%">%</th>
                <th class="t l b r" colspan="2">Tunggakan</th>
            </tr>
            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th>
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th>
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th>
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th>
                <!-- <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th> -->
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b r" width="6%">Jasa</th>
            </tr>

            @foreach ($jpp->pinjaman_individu as $pinj_i)
                @php
                    $kd_desa[] = $pinj_i->kd_desa;
                    $desa = $pinj_i->kd_desa;

                @endphp
                @if (array_count_values($kd_desa)[$pinj_i->kd_desa] <= '1')
                    @if ($section != $desa && count($kd_desa) > 1)
                        @php
                            $t_alokasi += $j_alokasi;
                            $t_target_pokok += $j_target_pokok;
                            $t_target_jasa += $j_target_jasa;
                            $t_real_bl_pokok += $j_real_bl_pokok;
                            $t_real_bl_jasa += $j_real_bl_jasa;
                            $t_real_pokok += $j_real_pokok;
                            $t_real_jasa += $j_real_jasa;
                            $t_real_bi_pokok += $j_real_bi_pokok;
                            $t_real_bi_jasa += $j_real_bi_jasa;
                            $t_saldo_pokok += $j_saldo_pokok;
                            $t_saldo_jasa += $j_saldo_jasa;
                            $t_tunggakan_pokok += $j_tunggakan_pokok;
                            $t_tunggakan_jasa += $j_tunggakan_jasa;

                            $j_pross = 1;
                            if ($j_target_pokok != 0) {
                                $j_pross = $j_real_bi_pokok / $j_target_pokok;
                            }
                        @endphp
                        <tr style="font-weight: bold;">
                            <td class="t l b" colspan="4" align="left" height="15">
                                Jumlah {{ $nama_desa }}
                            </td>
                            <td class="t l b" align="right">{{ number_format($j_alokasi) }}</td>
                            <td class="t l b" align="right">&nbsp;</td>
                            <td class="t l b" align="right">{{ number_format($j_target_pokok) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_target_jasa) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_real_bl_pokok) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_real_bl_jasa) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_real_pokok) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_real_jasa) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_real_bi_pokok) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_real_bi_jasa) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_saldo_pokok) }}</td>
                            <!-- <td class="t l b" align="right">{{ number_format($j_saldo_jasa) }}</td> -->
                            <td class="t l b" align="center">{{ number_format(floor($j_pross * 100)) }}</td>
                            <td class="t l b" align="right">{{ number_format($j_tunggakan_pokok) }}</td>
                            <td class="t l b r" align="right">{{ number_format($j_tunggakan_jasa) }}</td>
                        </tr>
                    @endif

                    <tr style="font-weight: bold;">
                        <td class="t l b r" colspan="18" align="left">{{ $pinj_i->kode_desa }}.
                            {{ $pinj_i->nama_desa }}</td>
                    </tr>

                    @php
                        $nomor = 1;
                        $j_alokasi = 0;
                        $j_target_pokok = 0;
                        $j_target_jasa = 0;
                        $j_real_bl_pokok = 0;
                        $j_real_bl_jasa = 0;
                        $j_real_pokok = 0;
                        $j_real_jasa = 0;
                        $j_real_bi_pokok = 0;
                        $j_real_bi_jasa = 0;
                        $j_saldo_pokok = 0;
                        $j_saldo_jasa = 0;
                        $j_tunggakan_pokok = 0;
                        $j_tunggakan_jasa = 0;
                        $section = $pinj_i->kd_desa;
                        $nama_desa = $pinj_i->sebutan_desa . ' ' . $pinj_i->nama_desa;
                    @endphp
                @endif

                @php
                    $real_pokok = 0;
                    $real_jasa = 0;
                    $sum_pokok = 0;
                    $sum_jasa = 0;
                    $saldo_pokok = $pinj_i->alokasi;
                    $saldo_jasa = $pinj_i->pros_jasa == 0 ? 0 : $pinj_i->alokasi * ($pinj_i->pros_jasa / 100);
                    if ($pinj_i->saldo) {
                        $real_pokok = $pinj_i->saldo->realisasi_pokok;
                        $real_jasa = $pinj_i->saldo->realisasi_jasa;
                        $sum_pokok = $pinj_i->saldo->sum_pokok;
                        $sum_jasa = $pinj_i->saldo->sum_jasa;
                        $saldo_pokok = $pinj_i->saldo->saldo_pokok;
                        $saldo_jasa = $pinj_i->saldo->saldo_jasa;
                    }

                    if ($saldo_jasa < 0) {
                        $saldo_jasa = 0;
                    }

                    if ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'L') {
                        $saldo_jasa = 0;
                    }

                    $target_pokok = 0;
                    $target_jasa = 0;
                    if ($pinj_i->target) {
                        $target_pokok = $pinj_i->target->target_pokok;
                        $target_jasa = $pinj_i->target->target_jasa;
                    }

                    $tunggakan_pokok = $target_pokok - $sum_pokok;
                    if ($tunggakan_pokok < 0) {
                        $tunggakan_pokok = 0;
                    }
                    $tunggakan_jasa = $target_jasa - $sum_jasa;
                    if ($tunggakan_jasa < 0) {
                        $tunggakan_jasa = 0;
                    }

                    $pross = 1;
                    if ($target_pokok != 0) {
                        $pross = $sum_pokok / $target_pokok;
                    }

                    if ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'L') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    } elseif ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'R') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    } elseif ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'H') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    }

                    $pros_jasa = $pinj_i->pros_jasa == 0 ? 0 : $pinj_i->pros_jasa / $pinj_i->jangka;
                    $angke = $pinj_i->target->angsuran_ke ?? 0;
                @endphp

                <tr>
                    <td class="t l b" align="center">{{ $nomor++ }}</td>
                    <td class="t l b" align="left">{{ $pinj_i->namadepan }} [{{ $pinj_i->ketua }}] -
                        {{ $pinj_i->id }}</td>
                    <td class="t l b" align="center">{{ Tanggal::tglIndo($pinj_i->tgl_cair, 'DD/MM/YY') }}</td>
                    <td class="t l b" align="center">
                        <small>{{ $pinj_i->jangka }}/{{ $pinj_i->angsuran_pokok->sistem }}*{{number_format( $angke/$pinj_i->angsuran_pokok->sistem,0)  }}</small>
                    </td>
                    </td>
                    <td class="t l b" align="right">{{ number_format($pinj_i->alokasi) }}</td>
                            <td class="t l b" align="right">
                                {{ rtrim(rtrim(number_format($pros_jasa, 2, '.', ''), '0'), '.') }}%
                            </td>
                    <td class="t l b" align="right">{{ number_format($target_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($target_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($sum_pokok - $pinj_i->real_i_sum_realisasi_pokok) }}
                    </td>
                    <td class="t l b" align="right">{{ number_format($sum_jasa - $pinj_i->real_i_sum_realisasi_jasa) }}
                    </td>
                    <td class="t l b" align="right">{{ number_format($pinj_i->real_i_sum_realisasi_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($pinj_i->real_i_sum_realisasi_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($sum_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($sum_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($saldo_pokok) }}</td>
                    <!-- <td class="t l b" align="right">{{ number_format($saldo_jasa) }}</td> -->
                    <td class="t l b" align="center">{{ number_format(floor($pross * 100)) }}</td>

                    @if ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'L')
                        <td class="t l b r" colspan="2" align="center">
                            V-LUNAS {{ Tanggal::tglIndo($pinj_i->tgl_lunas) }}
                        </td>
                    @elseif ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'R')
                        <td class="t l b r" colspan="2" align="center">
                            Rescedulling {{ Tanggal::tglIndo($pinj_i->tgl_lunas) }}
                        </td>
                    @elseif ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'H')
                        <td class="t l b r" colspan="2" align="center">
                            Penghapusan {{ Tanggal::tglIndo($pinj_i->tgl_lunas) }}
                        </td>
                    @else
                        <td class="t l b" align="right">{{ number_format($tunggakan_pokok) }}</td>
                        <td class="t l b r" align="right">{{ number_format($tunggakan_jasa) }}</td>
                    @endif
                </tr>

                @php
                    $j_alokasi += $pinj_i->alokasi;
                    $j_target_pokok += $target_pokok;
                    $j_target_jasa += $target_jasa;
                    $j_real_bl_pokok += $sum_pokok - $pinj_i->real_i_sum_realisasi_pokok;
                    $j_real_bl_jasa += $sum_jasa - $pinj_i->real_i_sum_realisasi_jasa;
                    $j_real_pokok += $pinj_i->real_i_sum_realisasi_pokok;
                    $j_real_jasa += $pinj_i->real_i_sum_realisasi_jasa;
                    $j_real_bi_pokok += $sum_pokok;
                    $j_real_bi_jasa += $sum_jasa;
                    $j_saldo_pokok += $saldo_pokok;
                    $j_saldo_jasa += $saldo_jasa;
                    $j_tunggakan_pokok += $tunggakan_pokok;
                    $j_tunggakan_jasa += $tunggakan_jasa;
                @endphp
            @endforeach
            @php
                $t_alokasi += $j_alokasi;
                $t_target_pokok += $j_target_pokok;
                $t_target_jasa += $j_target_jasa;
                $t_real_bl_pokok += $j_real_bl_pokok;
                $t_real_bl_jasa += $j_real_bl_jasa;
                $t_real_pokok += $j_real_pokok;
                $t_real_jasa += $j_real_jasa;
                $t_real_bi_pokok += $j_real_bi_pokok;
                $t_real_bi_jasa += $j_real_bi_jasa;
                $t_saldo_pokok += $j_saldo_pokok;
                $t_saldo_jasa += $j_saldo_jasa;
                $t_tunggakan_pokok += $j_tunggakan_pokok;
                $t_tunggakan_jasa += $j_tunggakan_jasa;

                $j_pross = 1;
                if ($j_target_pokok != 0) {
                    $j_pross = $j_real_bi_pokok / $j_target_pokok;
                }
            @endphp
            @if (count($kd_desa) > 0)
                <tr style="font-weight: bold;">
                    <td class="t l b" colspan="4" align="left" height="15">
                        Jumlah {{ $nama_desa }}
                    </td>
                    <td class="t l b" align="right">{{ number_format($j_alokasi) }}</td>
                            <td class="t l b" align="right">&nbsp;</td>
                    <td class="t l b" align="right">{{ number_format($j_target_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_target_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_real_bl_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_real_bl_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_real_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_real_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_real_bi_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_real_bi_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_saldo_pokok) }}</td>
                    <!-- <td class="t l b" align="right">{{ number_format($j_saldo_jasa) }}</td> -->
                    <td class="t l b" align="center">{{ number_format(floor($j_pross * 100)) }}</td>
                    <td class="t l b" align="right">{{ number_format($j_tunggakan_pokok) }}</td>
                    <td class="t l b r" align="right">{{ number_format($j_tunggakan_jasa) }}</td>
                </tr>

                @php
                    $t_pross = 1;
                    if ($t_target_pokok != 0) {
                        $t_pross = $t_real_bi_pokok / $t_target_pokok;
                    }

                    $tl_alokasi = 0;
                    $tl_target_pokok = 0;
                    $tl_target_jasa = 0;
                    $tl_real_bl_pokok = 0;
                    $tl_real_bl_jasa = 0;
                    $tl_real_bi_pokok = 0;
                    $tl_real_bi_jasa = 0;
                    $tl_saldo_pokok = 0;
                    $tl_saldo_jasa = 0;
                    $tl_tunggakan_pokok = 0;
                    $tl_tunggakan_jasa = 0;

                    foreach ($lunas as $ln) {
                        $target_pokok = 0;
                        $target_jasa = 0;
                        $sum_pokok = 0;
                        $sum_jasa = 0;

                        $tl_alokasi += $ln->alokasi;
                        if ($ln->target) {
                            $tl_target_pokok += $ln->target->target_pokok;
                            $tl_target_jasa += $ln->target->target_jasa;

                            $target_pokok = $ln->target->target_pokok;
                            $target_jasa = $ln->target->target_jasa;
                        }

                        if ($ln->saldo) {
                            $tl_real_bl_pokok += $ln->saldo->sum_pokok;
                            $tl_real_bl_jasa += $ln->saldo->sum_jasa;

                            $tl_real_bi_pokok += $ln->saldo->sum_pokok;
                            $tl_real_bi_jasa += $ln->saldo->sum_jasa;

                            $tl_saldo_pokok += $ln->saldo->saldo_pokok;
                            $tl_saldo_jasa += $ln->saldo->saldo_jasa;

                            $sum_pokok = $ln->saldo->sum_pokok;
                            $sum_jasa = $ln->saldo->sum_jasa;
                        }

                        $tunggakan_pokok = $target_pokok - $sum_pokok;
                        if ($tunggakan_pokok < 0) {
                            $tunggakan_pokok = 0;
                        }
                        $tunggakan_jasa = $target_jasa - $sum_jasa;
                        if ($tunggakan_jasa < 0) {
                            $tunggakan_jasa = 0;
                        }

                        $tl_tunggakan_pokok += $tunggakan_pokok;
                        $tl_tunggakan_jasa += $tunggakan_jasa;
                    }

                    $tl_pross = 1;
                    if ($tl_target_pokok != 0) {
                        $tl_pross = $tl_real_bi_pokok / $tl_target_pokok;
                    }

                    if ($tl_saldo_pokok < 0) {
                        $tl_saldo_pokok = 0;
                    }

                    if ($tl_saldo_jasa < 0) {
                        $tl_saldo_jasa = 0;
                    }
                @endphp

                <tr style="font-weight: bold;">
                    <td class="t l b" align="left" colspan="4" height="15">
                        Lunas s.d. Tahun Lalu
                    </td>
                    <td class="t l b" align="right">{{ number_format($tl_alokasi) }}</td>
                            <td class="t l b" align="right">&nbsp;</td>
                    <td class="t l b" align="right">{{ number_format($tl_target_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($tl_target_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($tl_real_bl_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($tl_real_bl_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format(0) }}</td>
                    <td class="t l b" align="right">{{ number_format(0) }}</td>
                    <td class="t l b" align="right">{{ number_format($tl_real_bi_pokok) }}</td>
                    <td class="t l b" align="right">{{ number_format($tl_real_bi_jasa) }}</td>
                    <td class="t l b" align="right">{{ number_format($tl_saldo_pokok) }}</td>
                    <!-- <td class="t l b" align="right">{{ number_format($tl_saldo_jasa) }}</td> -->
                    <td class="t l b" align="center">{{ number_format($tl_pross) }}</td>
                    <td class="t l b" align="right">0</td>
                    <td class="t l b r" align="right">0</td>
                </tr>

                <tr>
                    <td colspan="18" style="padding: 0px !important;">
                        <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                            style="font-size: 8px; table-layout: fixed;">
                            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                                <td class="t l b" align="center" height="15">
                                    J U M L A H
                                </td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_alokasi+$tl_alokasi) }}</td>
                            <td class="t l b" align="right" width="3%">&nbsp;</td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_target_pokok+$tl_target_pokok) }}
                                </td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_target_jasa+$tl_target_jasa) }}
                                </td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_real_bl_pokok+$tl_real_bl_pokok) }}
                                </td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_real_bl_jasa+$tl_real_bl_jasa) }}
                                </td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_real_pokok) }}</td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_real_jasa) }}</td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_real_bi_pokok+$tl_real_bi_pokok) }}
                                </td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_real_bi_jasa+$tl_real_bi_jasa) }}
                                </td>
                                <td class="t l b"  width="6%" align="right">{{ number_format($t_saldo_pokok+$tl_saldo_pokok) }}
                                </td>
                                <!-- <td class="t l b" width="6%" align="right">{{ number_format($t_saldo_jasa) }}</td> -->
                                <td class="t l b" width="2%" align="center">
                                    {{ number_format(floor($t_pross * 100)) }}</td>
                                <td class="t l b" width="6%" align="right">{{ number_format($t_tunggakan_pokok) }}
                                </td>
                                <td class="t l b r" width="6%" align="right">{{ number_format($t_tunggakan_jasa) }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="15">
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
