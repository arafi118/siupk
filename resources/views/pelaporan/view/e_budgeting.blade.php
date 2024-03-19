@php
    use App\Utils\Tanggal;
    $r_pendapatan1 = 0;
    $r_pendapatan2 = 0;
    $r_pendapatan3 = 0;

    $pendapatan1 = 0;
    $pendapatan2 = 0;
    $pendapatan3 = 0;

    $r_beban1 = 0;
    $r_beban2 = 0;
    $r_beban3 = 0;

    $beban1 = 0;
    $beban2 = 0;
    $beban3 = 0;

    $komulatif_pendapatan = 0;
    $komulatif_beban = 0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    <style>
        html {
            margin-left: 40px;
            margin-right: 40px;
        }
    </style>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 10px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>LAPORAN PENGGUNAAN DANA (E-BUDGETING)</b>
                </div>
                <div style="font-size: 16px;">
                    <b style="text-transform: uppercase;">Triwulan
                        {{ $keuangan->romawi(str_pad($triwulan, '2', '0', STR_PAD_LEFT)) }} Tahun
                        Anggaran {{ $tahun }}</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr style="background: rgb(232, 232, 232); font-weight: bold; font-size: 12px;">
            <th rowspan="2" class="t l b" width="32%">Rekening</th>
            <th rowspan="2" class="t l b" width="10%">Komulatif Bulan Lalu</th>
            @foreach ($bulan_tampil as $bt)
                <th colspan="2" class="t l b" width="16%" height="16">
                    {{ Tanggal::namaBulan(date('Y') . '-' . $bt . '-01') }}
                </th>
            @endforeach
            <th rowspan="2" class="t l b r" width="10%">Total</th>
        </tr>
        <tr style="background: rgb(232, 232, 232); font-weight: bold; font-size: 12px;">
            <th class="t l b" width="8%" height="16">Rencana</th>
            <th class="t l b" width="8%">Realisasi</th>
            <th class="t l b" width="8%">Rencana</th>
            <th class="t l b" width="8%">Realisasi</th>
            <th class="t l b" width="8%">Rencana</th>
            <th class="t l b" width="8%">Realisasi</th>
        </tr>

        @foreach ($akun1 as $lev1)
            @php
                $kom_saldo_lalu = 0;

                $bulan1 = 0;
                $bulan2 = 0;
                $bulan3 = 0;

                $rencana1 = 0;
                $rencana2 = 0;
                $rencana3 = 0;
            @endphp
            <tr style="background: rgb(200, 200, 200); font-weight: bold;">
                <td colspan="9" class="t l b r">
                    <b>{{ $lev1->kode_akun }}. {{ $lev1->nama_akun }}</b>
                </td>
            </tr>
            @foreach ($lev1->akun2 as $lev2)
                <tr style="background: rgb(150, 150, 150); font-weight: bold;">
                    <td colspan="9" class="t l b r">
                        <b>{{ $lev2->kode_akun }}. {{ $lev2->nama_akun }}</b>
                    </td>
                </tr>
                @foreach ($lev2->akun3 as $lev3)
                    @foreach ($lev3->rek as $rek)
                        @php
                            $bg = 'rgb(230, 230, 230)';
                            if ($loop->iteration % 2 == 0) {
                                $bg = 'rgba(255, 255, 255)';
                            }

                            $nomor = 0;
                            $t_saldo = 0;
                            $t_rencana = 0;
                            $saldo_bula_lalu = 0;
                            $bulan_lalu = 0;
                            $saldo_kom = 0;

                            $urutan = 1;
                        @endphp
                        <tr style="background: {{ $bg }};">
                            <td class="t l b">{{ $rek->kode_akun }}. {{ $rek->nama_akun }}</td>
                            @if ($triwulan == 1)
                                <td class="t l b" align="right">
                                    {{ number_format($saldo_kom, 2) }}
                                </td>
                            @endif

                            @foreach ($rek->kom_saldo as $saldo)
                                @php
                                    if ($bulan_lalu != 0) {
                                        $saldo_bula_lalu = $saldo_lalu;
                                    }

                                    $bulan_lalu = $saldo->bulan;
                                    $_saldo = floatval($saldo->kredit) - floatval($saldo->debit);
                                    if ($rek->lev1 == 5) {
                                        $_saldo = floatval($saldo->debit) - floatval($saldo->kredit);
                                    }

                                    $rencana = 0;
                                    if ($saldo->eb) {
                                        $rencana = $saldo->eb->jumlah;
                                    }

                                    $t_rencana += $rencana;
                                    $saldo_lalu = $_saldo;
                                @endphp

                                @if ($triwulan > 1 && $saldo->bulan == $bulan_akhir)
                                    @php
                                        $saldo_kom = floatval($saldo->kredit) - floatval($saldo->debit);
                                        if ($rek->lev1 == 5) {
                                            $saldo_kom = floatval($saldo->debit) - floatval($saldo->kredit);
                                        }

                                        $kom_saldo_lalu += $saldo_kom;
                                    @endphp
                                    <td class="t l b" align="right">
                                        {{ number_format($saldo_kom, 2) }}
                                    </td>
                                @endif

                                @if (in_array($saldo->bulan, $bulan_tampil) && $urutan <= 3)
                                    @php
                                        $_saldo -= $saldo_bula_lalu;

                                        $nomor++;
                                        if ($nomor == 1) {
                                            $bulan1 += $_saldo;
                                            $rencana1 += $rencana;
                                        } elseif ($nomor == 2) {
                                            $bulan2 += $_saldo;
                                            $rencana2 += $rencana;
                                        } elseif ($nomor == 3) {
                                            $bulan3 += $_saldo;
                                            $rencana3 += $rencana;
                                        }

                                        $t_saldo += $_saldo;

                                        $urutan++;
                                    @endphp
                                    <td class="t l b" align="right">
                                        {{ number_format($rencana, 2) }}
                                    </td>
                                    <td class="t l b" align="right">
                                        {{ number_format($_saldo, 2) }}
                                    </td>
                                @endif
                            @endforeach
                            <td class="t l b r" align="right">{{ number_format($t_saldo + $saldo_kom, 2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach

            @php
                if ($lev1->lev1 == 4) {
                    $r_pendapatan1 += $rencana1;
                    $r_pendapatan2 += $rencana2;
                    $r_pendapatan3 += $rencana3;

                    $pendapatan1 += $bulan1;
                    $pendapatan2 += $bulan2;
                    $pendapatan3 += $bulan3;
                    $komulatif_pendapatan += $kom_saldo_lalu;
                } else {
                    $r_beban1 += $rencana1;
                    $r_beban2 += $rencana2;
                    $r_beban3 += $rencana3;

                    $beban1 += $bulan1;
                    $beban2 += $bulan2;
                    $beban3 += $bulan3;
                    $komulatif_beban += $kom_saldo_lalu;
                }
            @endphp

            <tr style="background: rgb(150, 150, 150); font-weight: bold;">
                <td align="center" class="t l b" height="14">Total Realisasi {{ $lev1->nama_akun }}</td>
                <td align="right" class="t l b">{{ number_format($kom_saldo_lalu, 2) }}</td>
                <td align="right" class="t l b">{{ number_format($rencana1, 2) }}</td>
                <td align="right" class="t l b">{{ number_format($bulan1, 2) }}</td>
                <td align="right" class="t l b">{{ number_format($rencana2, 2) }}</td>
                <td align="right" class="t l b">{{ number_format($bulan2, 2) }}</td>
                <td align="right" class="t l b">{{ number_format($rencana3, 2) }}</td>
                <td align="right" class="t l b">{{ number_format($bulan3, 2) }}</td>
                <td align="right" class="t l b r">
                    {{ number_format($kom_saldo_lalu + $bulan1 + $bulan2 + $bulan3, 2) }}
                </td>
            </tr>
        @endforeach

        @php
            $r_pendapatan = $r_pendapatan1 + $r_pendapatan2 + $r_pendapatan3;
            $r_beban = $r_beban1 + $r_beban2 + $r_beban3;

            $pendapatan = $pendapatan1 + $pendapatan2 + $pendapatan3;
            $beban = $beban1 + $beban2 + $beban3;
        @endphp

        <tr>
            <td colspan="9" style="padding: 0px !important;">
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 9px;">
                    <tr style="background: rgb(232, 232, 232); font-weight: bold; font-size: 10px;">
                        <th width="32%" class="t l b" height="28">Surplus</th>
                        <th width="10%" class="t l b" align="right">
                            {{ number_format($komulatif_pendapatan - $komulatif_beban, 2) }}
                        </th>
                        <th width="8%" class="t l b" align="right">
                            {{ number_format($r_pendapatan1 - $r_beban1, 2) }}
                        </th>
                        <th width="8%" class="t l b" align="right">{{ number_format($pendapatan1 - $beban1, 2) }}
                        </th>
                        <th width="8%" class="t l b" align="right">
                            {{ number_format($r_pendapatan2 - $r_beban2, 2) }}
                        </th>
                        <th width="8%" class="t l b" align="right">{{ number_format($pendapatan2 - $beban2, 2) }}
                        </th>
                        <th width="8%" class="t l b" align="right">
                            {{ number_format($r_pendapatan3 - $r_beban3, 2) }}
                        </th>
                        <th width="8%" class="t l b" align="right">{{ number_format($pendapatan3 - $beban3, 2) }}
                        </th>
                        <th width="10%" class="t l b r" align="right">
                            {{ number_format($komulatif_pendapatan - $komulatif_beban + ($pendapatan - $beban), 2) }}
                        </th>
                    </tr>
                </table>

                <div style="margin-top: 16px;"></div>
                {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
            </td>
        </tr>
    </table>
@endsection
