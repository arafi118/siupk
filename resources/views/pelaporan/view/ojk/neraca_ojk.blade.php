@extends('pelaporan.layout.base')

@section('content')
    @php
        $data_total = [];
        $data_rek_beban_ops = [];
    @endphp

<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
    <tr>
        <td align="center" height="30" colspan="4" class="style3 bottom" style="font-size: 15px;">
            <br>{{$kec->nama_lembaga_long}}
            <br>SANDI LKM {{$kec->sandi_lkm}}
            <br>LAPORAN POSISI KEUANGAN
            <br>{{ strtoupper($sub_judul) }}</b>
        </td>
    </tr>
    
</table>


    <table border="1" width="96%" cellspacing="0" cellpadding="0" style="font-size: 11px; border-color: black;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Akun</th>
                <th>Kode Akun</th>
                <th>Jumlah</th>
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
                @endphp

                <tr {!! in_array($core_number, ['4', '5', '7']) ? '' : 'style="font-weight: bold;"' !!}>
                    <td align="center">{{ $core_number }}</td>
                    <td>{{ $rek_ojk->nama_akun }}</td>
                    @if ($core_number <= 2)
                        <td>&nbsp;R</td>
                        <td>&nbsp;T</td>
                    @else
                        <td>&nbsp;T</td>
                        <td align="right">00</td>
                    @endif
                </tr>

                @php
                    $point_number = 1;
                @endphp

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
                    <tr>
                        <td align="center">{{ $core_number }}.{{ $point_number }}</td>
                        <td>{{ $rek_child->nama_akun }}</td>
                        <td align="center">{{ $rek_child->kode }}</td>
                        <td align="right">00</td>
                    </tr>

                    @php
                        $point_number++;

                        $total_bulan_lalu += $bulan_lalu;
                        $total_bulan_ini += $bulan_ini;
                        $total_sd_bulan_ini += $sd_bulan_ini;
                    @endphp
                @endforeach

                @if ($core_number < 3)
                    <tr>
                        <th colspan="3">Jumlah {{ $rek_ojk->nama_akun }}</th>
                        <th align="right">00</th>
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
@endsection
