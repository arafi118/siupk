@php
    use App\Utils\Tanggal;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    @php
        $data_total = [];
        $data_rek_beban_ops = [];
    @endphp

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td style="border: 1px solid;" align="center" height="30" colspan="5" class="style3 bottom"
                style="font-size: 15px;">
                <div>{{ $kec->nama_lembaga_long }}</div>
                <div>SANDI LKM {{ $kec->sandi_lkm }}</div>
                <div>LAPORAN KINERJA KEUANGAN</div>
                <div>Untuk Periode Yang Berakhir Pada Tanggal {{ Tanggal::tglLatin($tgl_kondisi) }}</div>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>

    <table border="0" width="96%" cellspacing="0" cellpadding="0" style="font-size: 11px; border-color: black;">
        <thead>
            <tr style="background: rgb(232, 232, 232); font-weight: bold; font-size: 12px;">
                <th height="20">No</th>
                <th>Nama Akun</th>
                <th>Kode Akun</th>
                <th>SD. Bulan Lalu</th>
                <th>Bulan Ini</th>
                <th>SD. Bulan Ini</th>
            </tr>
        </thead>
        <tbody>
            @php
                $core_number = 1;
            @endphp
            @foreach ($rekening_ojk as $rek_ojk)
                @php
                    $total_bulan_lalu = 0;
                    $total_bulan_ini = 0;
                    $total_sd_bulan_ini = 0;

                    $saldo_bulan_lalu = 0;
                    $saldo_bulan_ini = 0;
                    $saldo_sd_bulan_ini = 0;
                @endphp

                {{-- NON OPERASIONAL --}}
                @foreach ($rek_ojk->child as $rek_child)
                    @php
                        if (strlen($rek_child->kode) != '0') {
                            continue;
                        }

                        $bulan_lalu = 0;
                        $bulan_ini = 0;
                        $sd_bulan_ini = 0;
                        if (substr($rek_child->rekening, -2) != '00') {
                            foreach ($rek_child->rek as $rek) {
                                $data_saldo = $keuangan->komSaldoLR($rek, $tgl_kondisi);

                                $bulan_lalu += $data_saldo['bulan_lalu'];
                                $bulan_ini += $data_saldo['sd_bulan_ini'] - $data_saldo['bulan_lalu'];
                                $sd_bulan_ini += $data_saldo['sd_bulan_ini'];

                                $data_rek_beban_ops[] = $rek->kode_akun;
                            }
                        } else {
                            foreach ($rek_child->akun3 as $akun3) {
                                foreach ($akun3->rek as $rek) {
                                    $data_saldo = $keuangan->komSaldoLR($rek, $tgl_kondisi);

                                    $bulan_lalu += $data_saldo['bulan_lalu'];
                                    $bulan_ini += $data_saldo['sd_bulan_ini'] - $data_saldo['bulan_lalu'];
                                    $sd_bulan_ini += $data_saldo['sd_bulan_ini'];

                                    $data_rek_beban_ops[] = $rek->kode_akun;
                                }
                            }
                        }

                        $saldo_bulan_lalu += $bulan_lalu;
                        $saldo_bulan_ini += $bulan_ini;
                        $saldo_sd_bulan_ini += $sd_bulan_ini;
                    @endphp
                @endforeach

                @php
                    if ($core_number == 3) {
                        $saldo_bulan_lalu = $data_total[1]['bulan_lalu'] - $data_total[2]['bulan_lalu'];
                        $saldo_bulan_ini = $data_total[1]['bulan_ini'] - $data_total[2]['bulan_ini'];
                        $saldo_sd_bulan_ini = $data_total[1]['sd_bulan_ini'] - $data_total[2]['sd_bulan_ini'];
                    }

                    if ($core_number == 6) {
                        $saldo_bulan_lalu =
                            $data_total[3]['bulan_lalu'] +
                            ($data_total[4]['bulan_lalu'] - $data_total[5]['bulan_lalu']);
                        $saldo_bulan_ini =
                            $data_total[3]['bulan_ini'] + ($data_total[4]['bulan_ini'] - $data_total[5]['bulan_ini']);
                        $saldo_sd_bulan_ini =
                            $data_total[3]['sd_bulan_ini'] +
                            ($data_total[4]['sd_bulan_ini'] - $data_total[5]['sd_bulan_ini']);
                    }

                    if ($core_number == 8) {
                        $saldo_bulan_lalu = $data_total[6]['bulan_lalu'] - $data_total[7]['bulan_lalu'];
                        $saldo_bulan_ini = $data_total[6]['bulan_ini'] - $data_total[7]['bulan_ini'];
                        $saldo_sd_bulan_ini = $data_total[6]['sd_bulan_ini'] - $data_total[7]['sd_bulan_ini'];
                    }

                    $data_total[$core_number] = [
                        'bulan_lalu' => $saldo_bulan_lalu,
                        'bulan_ini' => $saldo_bulan_ini,
                        'sd_bulan_ini' => $saldo_sd_bulan_ini,
                    ];

                    $this_bg = 'rgb(200, 200, 200)';
                    if ($core_number == 4 || $core_number == 7) {
                        $this_bg = 'rgb(230, 230, 230)';
                    }

                    if ($core_number == 5) {
                        $this_bg = 'rgb(255, 255, 255)';
                    }

                    $style = 'style="background: ' . $this_bg . ';"';
                    if (!in_array($core_number, ['4', '5', '7'])) {
                        $style = 'style="font-weight: bold; background: ' . $this_bg . '; text-transform: uppercase;"';
                    }
                @endphp

                <tr {!! $style !!}>
                    <td align="center">{{ $core_number }}</td>
                    <td>{{ $rek_ojk->nama_akun }}</td>
                    @if ($core_number <= 2)
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    @else
                        <td align="center">{{ $rek_ojk->kode }}</td>
                        <td align="right">{{ number_format($saldo_bulan_lalu, 2) }}</td>
                        <td align="right">{{ number_format($saldo_bulan_ini, 2) }}</td>
                        <td align="right">{{ number_format($saldo_sd_bulan_ini, 2) }}</td>
                    @endif
                </tr>

                @php
                    $point_number = 1;
                @endphp

                {{-- OPERASIONAL --}}
                @foreach ($rek_ojk->child as $rek_child)
                    @php
                        if (strlen($rek_child->kode) < 1) {
                            continue;
                        }

                        $bulan_lalu = 0;
                        $bulan_ini = 0;
                        $sd_bulan_ini = 0;

                        foreach ($rek_child->child as $child) {
                            if (substr($child->rekening, -2) != '00') {
                                foreach ($child->rek as $rek) {
                                    $data_saldo = $keuangan->komSaldoLR($rek, $tgl_kondisi);

                                    $bulan_lalu += $data_saldo['bulan_lalu'];
                                    $bulan_ini += $data_saldo['sd_bulan_ini'] - $data_saldo['bulan_lalu'];
                                    $sd_bulan_ini += $data_saldo['sd_bulan_ini'];

                                    $data_rek_beban_ops[] = $rek->kode_akun;
                                }
                            } else {
                                foreach ($child->akun3 as $akun3) {
                                    foreach ($akun3->rek as $rek) {
                                        $data_saldo = $keuangan->komSaldoLR($rek, $tgl_kondisi);

                                        $bulan_lalu += $data_saldo['bulan_lalu'];
                                        $bulan_ini += $data_saldo['sd_bulan_ini'] - $data_saldo['bulan_lalu'];
                                        $sd_bulan_ini += $data_saldo['sd_bulan_ini'];

                                        $data_rek_beban_ops[] = $rek->kode_akun;
                                    }
                                }
                            }
                        }
                    @endphp
                    @php
                        $bg = 'rgb(230, 230, 230)';
                        if ($point_number % 2 == 0) {
                            $bg = 'rgb(255, 255, 255)';
                        }
                    @endphp
                    <tr style="background: {{ $bg }}">
                        <td align="center">{{ $core_number }}.{{ $point_number }}</td>
                        <td>{{ $rek_child->nama_akun }}</td>
                        <td align="center">{{ $rek_child->kode }}</td>
                        <td align="right">{{ number_format($bulan_lalu, 2) }}</td>
                        <td align="right">{{ number_format($bulan_ini, 2) }}</td>
                        <td align="right">{{ number_format($sd_bulan_ini, 2) }}</td>
                    </tr>

                    @php
                        $point_number++;

                        $total_bulan_lalu += $bulan_lalu;
                        $total_bulan_ini += $bulan_ini;
                        $total_sd_bulan_ini += $sd_bulan_ini;
                    @endphp
                @endforeach

                @if ($core_number < 3)
                    <tr style="background: rgb(150, 150, 150); font-weight: bold;">
                        <th height="14" colspan="3">Jumlah {{ $rek_ojk->nama_akun }}</th>
                        <th align="right">{{ number_format($total_bulan_lalu, 2) }}</th>
                        <th align="right">{{ number_format($total_bulan_ini, 2) }}</th>
                        <th align="right">{{ number_format($total_sd_bulan_ini, 2) }}</th>
                    </tr>

                    @php
                        $data_total[$core_number] = [
                            'bulan_lalu' => $total_bulan_lalu,
                            'bulan_ini' => $total_bulan_ini,
                            'sd_bulan_ini' => $total_sd_bulan_ini,
                        ];
                    @endphp
                @endif

                @php
                    $core_number++;
                @endphp
            @endforeach
        </tbody>
    </table>
    <table class="p" border="0" align="center" width="96%" cellspacing="0" cellpadding="0"
        style="font-size: 12px;">
        <tr>
            <td colspan="14">
                <div style="margin-top: 14px;"></div>
                {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
            </td>
        </tr>
    </table>
@endsection
