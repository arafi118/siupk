@php
use App\Utils\Tanggal;
$section = 0;
$nomor_jenis_pp_i =0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
@foreach ($jenis_pp_i as $jpp)
@php
if ($jpp->pinjaman_anggota->isEmpty()) {
continue;
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
@if ($jpp->$nomor_jenis_pp_i != 0)
<div class="break"></div>
@endif
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
    <tr>
        <td colspan="3" align="center">
            <div style="font-size: 18px;">
                <b>Cadangan Kerugian Piutang {{ $jpp->nama_jpp }}</b>
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

@foreach ($jpp->pinjaman_anggota as $ping_ang)
@php
$kd_desa[] = $ping_ang->kd_desa;
$desa = $ping_ang->kd_desa;

@endphp
@if (array_count_values($kd_desa)[$ping_ang->kd_desa] <= '1' ) @if ($section !=$desa && count($kd_desa)> 1)
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
    @endif

    @php
    $j_alokasi = 0;
    $j_saldo = 0;
    $j_tunggakan_pokok = 0;
    $j_tunggakan_jasa = 0;
    $j_kolek1 = 0;
    $j_kolek2 = 0;
    $j_kolek3 = 0;
    $section = $ping_ang->kd_desa;
    $nama_desa = $ping_ang->sebutan_desa . ' ' . $ping_ang->nama_desa;
    @endphp
    @endif

    @php
    $sum_pokok = 0;
    $sum_jasa = 0;
    $saldo_pokok = $ping_ang->alokasi;
    $saldo_jasa = $ping_ang->pros_jasa == 0 ? 0 : $ping_ang->alokasi * ($ping_ang->pros_jasa / 100);
    if ($ping_ang->saldo) {
    $sum_pokok = $ping_ang->saldo->sum_pokok;
    $sum_jasa = $ping_ang->saldo->sum_jasa;
    $saldo_pokok = $ping_ang->saldo->saldo_pokok;
    $saldo_jasa = $ping_ang->saldo->saldo_jasa;
    }

    $target_pokok = 0;
    $target_jasa = 0;
    $wajib_pokok = 0;
    $wajib_jasa = 0;
    $angsuran_ke = 0;
    if ($ping_ang->target) {
    $target_pokok = $ping_ang->target->target_pokok;
    $target_jasa = $ping_ang->target->target_jasa;
    $wajib_pokok = $ping_ang->target->wajib_pokok;
    $wajib_jasa = $ping_ang->target->wajib_jasa;
    $angsuran_ke = $ping_ang->target->angsuran_ke;
    }

    $tunggakan_pokok = $target_pokok - $sum_pokok;
    if ($tunggakan_pokok < 0) { $tunggakan_pokok=0; } $tunggakan_jasa=$target_jasa - $sum_jasa; if ($tunggakan_jasa < 0)
        { $tunggakan_jasa=0; } $pross=$saldo_pokok==0 ? 0 : $saldo_pokok / $ping_ang->alokasi;

        if ($ping_ang->tgl_lunas <= $tgl_kondisi && $ping_ang->status == 'L') {
            $tunggakan_pokok = 0;
            $tunggakan_jasa = 0;
            $saldo_pokok = 0;
            $saldo_jasa = 0;
            } elseif ($ping_ang->tgl_lunas <= $tgl_kondisi && $ping_ang->status == 'R') {
                $tunggakan_pokok = 0;
                $tunggakan_jasa = 0;
                $saldo_pokok = 0;
                $saldo_jasa = 0;
                } elseif ($ping_ang->tgl_lunas <= $tgl_kondisi && $ping_ang->status == 'H') {
                    $tunggakan_pokok = 0;
                    $tunggakan_jasa = 0;
                    $saldo_pokok = 0;
                    $saldo_jasa = 0;
                    }

                    $tgl_akhir = new DateTime($tgl_kondisi);
                    $tgl_awal = new DateTime($ping_ang->tgl_cair);
                    $selisih = $tgl_akhir->diff($tgl_awal);

                    // if ($lpp == 'Minggu') {
                    // $selisih_hari = $selisih->days;
                    // $selisih = floor($selisih_hari / 7);
                    // } else {
                    // }
                    $selisih = $selisih->y * 12 + $selisih->m;

                    $_kolek = 0;
                    if ($wajib_pokok != '0') {
                    $_kolek = $tunggakan_pokok / $wajib_pokok;
                    }
                    $kolek = round($_kolek + ($selisih - $angsuran_ke));
                    if ($kolek < 6) { $kolek1=$saldo_pokok; $kolek2=0; $kolek3=0; } elseif ($kolek>= 6 && $kolek <= 12)
                            { $kolek1=0; $kolek2=$saldo_pokok; $kolek3=0; } else { $kolek1=0; $kolek2=0;
                            $kolek3=$saldo_pokok; } $j_alokasi +=$ping_ang->alokasi;
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

                            $t_pros = 0;
                            if ($t_saldo) {
                            $t_pross = $t_saldo / $t_alokasi;
                            }
                            @endphp

                            <table border="1" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
                                <tr>
                                    <th height="20" width="10">No</th>
                                    <th width="200">Tingkat Kolektibilitas</th>
                                    <th width="30">%</th>
                                    <th width="150">Saldo Piutang</th>
                                    <th>Beban Penyisihan Penghapusan Piutang</th>
                                    <th width="150">NPL</th>
                                </tr>
                                <tr>
                                    <td align="center">a</td>
                                    <td align="center">b</td>
                                    <td align="center">c</td>
                                    <td align="center">d</td>
                                    <td align="center">e = c * d</td>
                                    <td align="center">f = (2 + 3) / saldo</td>
                                </tr>
                                <tr>
                                    <td align="center">1</td>
                                    <td>Lancar</td>
                                    <td align="center">0%</td>
                                    <td align="right">{{ number_format($t_kolek1) }}</td>
                                    <td align="right">{{ number_format(($t_kolek1 * 0) / 100) }}</td>
                                    <td align="center" rowspan="4">
                                        {{ round($t_kolek1 + $t_kolek2 + $t_kolek3 > 0 ? (($t_kolek2 + $t_kolek3) / ($t_kolek1 + $t_kolek2 + $t_kolek3)) * 100 : 0, 2) }}%
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">2</td>
                                    <td>Diragukan</td>
                                    <td align="center">50%</td>
                                    <td align="right">{{ number_format($t_kolek2) }}</td>
                                    <td align="right">{{ number_format(($t_kolek2 * 50) / 100) }}</td>
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td>Macet</td>
                                    <td align="center">100%</td>
                                    <td align="right">{{ number_format($t_kolek3) }}</td>
                                    <td align="right">{{ number_format(($t_kolek3 * 100) / 100) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" height="15">Total</th>
                                    <th>{{ number_format($t_kolek1 + $t_kolek2 + $t_kolek3) }}</th>
                                    <th>{{ number_format(($t_kolek1 * 0) / 100 + ($t_kolek2 * 50) / 100 + ($t_kolek3 * 100) / 100) }}
                                    </th>
                                </tr>
                            </table>

                            <div style="margin-top: 16px;"></div>
                            {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi,
                            $kec->ttd->tanda_tangan_pelaporan), true) !!}
                            @endif
                            @php
                            $nomor_jenis_pp_i++;
                            @endphp
                            @endforeach

                            @endsection
