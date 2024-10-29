@extends('pelaporan.layout.base')

@section('content')
    @php
        $data_total = [];
        $data_total_saldo = [];
        $data_rek_beban_ops = [];
    @endphp

<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
    <tr>
        <td align="center" height="30" colspan="4" class="style3 bottom" style="font-size: 15px;">
            <br><b>{{$kec->nama_lembaga_long}}</b>
            <br><b>SANDI LKM {{$kec->sandi_lkm}}</b>
            <br><b>LAPORAN POSISI KEUANGAN</b>
            <br><b>{{ strtoupper($sub_judul) }}</b>
        </td>
    </tr>
    
</table>
    <table border="0" width="96%" cellspacing="0" cellpadding="0" style="font-size: 11px; border-color: black;">
        <thead>
            <tr style="background: rgb(232, 232, 232); font-weight: bold; font-size: 12px;">
                <th height="20">No</th>
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

                @if (in_array($core_number, ['1', '6', '10']))
                    @php
                        $header = 'Aset';
                        if ($core_number == '6') {
                            $header = 'Liabilitas';
                        }
                        
                        if ($core_number == '10') {
                            $header = 'Ekuitas';
                        }

                        $data_total = [];
                        $this_bg = 'rgb(200, 200, 200)';
                    if ($core_number == 1 || $core_number == 10) {
                        $this_bg = 'rgb(230, 230, 230)';
                    }

                    if ($core_number == 6) {
                        $this_bg = 'rgb(255, 255, 255)';
                    }

                    $style = 'style="background: ' . $this_bg . ';"';
                    if (!in_array($core_number, ['1', '6', '10'])) {
                        $style = 'style="font-weight: bold; background: ' . $this_bg . '; text-transform: uppercase;"';
                    }
                    @endphp
                <tr style="background: rgb(170, 170, 170); font-weight: bold;">
                    <td></td>
                        <td><strong>{{ $header }}</strong></td> 
                        <td></td>
                        <td></td>
                    </tr>
                @endif

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
                            }
                        } else {
                            foreach ($rek_child->akun3 as $akun3) {
                                $sum_saldo = 0;
                                foreach ($akun3->rek as $rek) {
                                    $data_saldo = $keuangan->komSaldoLR($rek, $tgl_kondisi);

                                    $bulan_lalu += $data_saldo['bulan_lalu'];
                                    $bulan_ini += $data_saldo['sd_bulan_ini'] - $data_saldo['bulan_lalu'];
                                    $sd_bulan_ini += $data_saldo['sd_bulan_ini'];
                                }
                            }
                        }

                        $saldo_bulan_lalu += $bulan_lalu;
                        $saldo_bulan_ini += $bulan_ini;
                        $saldo_sd_bulan_ini += $sd_bulan_ini;
                    @endphp
                @endforeach

                @php
      
                    $data_total[$core_number] = [
                        'bulan_lalu' => $saldo_bulan_lalu,
                        'bulan_ini' => $saldo_bulan_ini,
                        'sd_bulan_ini' => $saldo_sd_bulan_ini,
                    ];
                    
                @endphp
                @endphp

                <tr style="background: rgb(209, 208, 208); font-weight: bold;">
                    <td height="4"align="center">{{ $core_number }}</td>
                    <td>{{ $rek_ojk->nama_akun }}</td>
                    <td align="center">{{ $rek_ojk->kode }}</td>
                    <td align="right">
                        @if($saldo_sd_bulan_ini < 0)
                            ({{ number_format(abs($saldo_sd_bulan_ini * -1))}})
                        @else
                            {{ number_format($saldo_sd_bulan_ini) }}
                        @endif
                    </td>
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
                                    if ($rek_child->kode == '342') {
                                        $data_saldo['bulan_lalu'] = 0;
                                        $data_saldo['sd_bulan_ini'] = $keuangan->laba_rugi($tgl_kondisi);
                                    }

                                    $bulan_lalu += $data_saldo['bulan_lalu'];
                                    $bulan_ini += $data_saldo['sd_bulan_ini'] - $data_saldo['bulan_lalu'];
                                    $sd_bulan_ini += $data_saldo['sd_bulan_ini'];
                                }
                            } else {
                                foreach ($child->akun3 as $akun3) {
                                    foreach ($akun3->rek as $rek) {
                                        $data_saldo = $keuangan->komSaldoLR($rek, $tgl_kondisi);

                                        $bulan_lalu += $data_saldo['bulan_lalu'];
                                        $bulan_ini += $data_saldo['sd_bulan_ini'] - $data_saldo['bulan_lalu'];
                                        $sd_bulan_ini += $data_saldo['sd_bulan_ini'];
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
                        <td align="right">
                            @if($sd_bulan_ini < 0)
                                ({{ number_format(abs($sd_bulan_ini * -1), 2) }})
                            @else
                                {{ number_format($sd_bulan_ini, 2) }}
                            @endif
                        </td>
                                            </tr>

                    @php
                        $point_number++;

                        $total_bulan_lalu += $bulan_lalu;
                        $total_bulan_ini += $bulan_ini;
                        $total_sd_bulan_ini += $sd_bulan_ini;

                        $data_total[$core_number]['bulan_lalu'] += $bulan_lalu;
                        $data_total[$core_number]['bulan_ini'] += $bulan_ini;
                        $data_total[$core_number]['sd_bulan_ini'] += $sd_bulan_ini;
                    @endphp
                @endforeach

                @if (in_array($core_number, ['5', '9', '13']))
                    @php
                        $data_total[$core_number] = [
                            'bulan_lalu' => $total_bulan_lalu,
                            'bulan_ini' => $total_bulan_ini,
                            'sd_bulan_ini' => $total_sd_bulan_ini,
                        ];

                        $total_saldo = 0;
                        foreach ($data_total as $dt) {
                            $total_saldo += $dt['sd_bulan_ini'];
                        }

                        $data_total_saldo[$header] = $data_total;
                    @endphp

                    <tr style="background: rgb(141, 139, 139); font-weight: bold;">
                        <th colspan="3">Jumlah {{ $header }}</th>
                        <th align="right">
                            @if($total_saldo < 0)
                                ({{ number_format(abs($total_saldo * -1), 2) }})
                            @else
                                {{ number_format($total_saldo, 2) }}
                            @endif
                        </th>                 
                    </tr>
                @endif
                
                @php
                    $core_number++;
                @endphp
            @endforeach
            @php
                // TOTAL
                // aset
                // liabilitas
                // ekuitas
                $aset = $data_total_saldo['Aset'];
                $liabilitas = $data_total_saldo['Liabilitas'];
                $ekuitas = $data_total_saldo['Ekuitas'];

                $saldo_aset = 0;
                $saldo_a = 0;
                $saldo_ekuitas = 0;

                foreach ($aset as $a) {
                    $saldo_aset += $a['sd_bulan_ini'];
                }
                
                foreach ($liabilitas as $l) {
                    $saldo_a += $l['sd_bulan_ini'];
                }

                foreach ($ekuitas as $a) {
                    $saldo_ekuitas += $a['sd_bulan_ini'];
                }
            @endphp
            @php
                $k = $aset[1]['sd_bulan_ini'] + $aset[2]['sd_bulan_ini']; // Menjumlahkan kas
                $l = $liabilitas[6]['sd_bulan_ini'] + $liabilitas[7]['sd_bulan_ini'] + $liabilitas[8]['sd_bulan_ini'] + $liabilitas[9]['sd_bulan_ini']; // Menjumlahkan Liabilitas
                $persentase = 0; // Menghitung persentase
                if ($l > 0) {
                    $persentase = ($k / $l) * 100;
                }
            @endphp
                <tr style="background: rgb(150, 150, 150); font-weight: bold;">
                    <th colspan="3">Jumlah Liabilitas Dan Ekuitas </th>
                <th class="top left bottom" align="right">{{ number_format($saldo_a + $saldo_ekuitas, 2) }}</th>
            </tr>
            <tr style="background: rgb(193, 193, 193); font-weight: bold;">
                <th class="left top bottom " align="center"></th>
                <th class="top left bottom" align="left"> &nbsp; Rasio Likuiditas</th>
                <th class="top left bottom" align="right">&nbsp;</th>
                <th class="top left bottom right" align="right">{{ number_format($persentase, 2) }}%</th>
            </tr>
            @php
                $s = $saldo_aset; // saldo aset
                $sl = $saldo_a; 
                $press = 0; // Menghitung persentase
                if ($sl > 0){
                    $press = ($s / $sl) * 100;
                }
            @endphp
@php
$bg = 'rgb(230, 230, 230)';
if ($point_number % 2 == 0) {
    $bg = 'rgb(255, 255, 255)';
}
@endphp
            <tr style="background: {{ $bg }}">
                <td class="left bottom" align="center">&nbsp; 1.</td>
                <td class="left bottom" align="left"> &nbsp; Kas dan Setara Kas</td>
                <td class="left bottom" align="right">&nbsp;</td>
                <td class="left bottom right" align="right">{{ number_format($aset[1]['sd_bulan_ini'] + $aset[2]['sd_bulan_ini'], 2) }}</td>
            </tr>
            <tr>
                <td class="left bottom" align="center">&nbsp; 2.</td>
                <td class="left bottom" align="left"> &nbsp; Liabilitas Lancar</td>
                <td class="left bottom" align="right">&nbsp;</td>
                <td class="left bottom right" align="right">{{ number_format($liabilitas[6]['sd_bulan_ini'] + $liabilitas[7]['sd_bulan_ini'] + $liabilitas[8]['sd_bulan_ini'] + $liabilitas[9]['sd_bulan_ini'], 2) }}</td>
            </tr>
            <tr style="background: rgb(193, 193, 193); font-weight: bold;">
                <th class="left top bottom" align="center"></td>
                <th class="top left bottom" align="left"> &nbsp; Rasio Solvabilitas</td>
                <th class="top left bottom" align="right">&nbsp;</td>
                <th class="top left bottom right" align="right">{{ number_format($press, 2) }}%</td>
            </tr>
            @php

            $bg = 'rgb(230, 230, 230)';
            if ($point_number % 2 == 0) {
                $bg = 'rgb(255, 255, 255)';
            }
            @endphp
                <tr style="background: {{ $bg }}">   
                <td class="left bottom" align="center">&nbsp; 1.</td>
                <td class="left bottom" align="left"> &nbsp; Total Aset</td>
                <td class="left bottom" align="right">&nbsp;</td>
                <td class="left bottom right" align="right">{{ number_format($saldo_aset, 2) }}</td>
            </tr>
            <tr style="background: rgb(185, 184, 184); font-weight: bold;">
                <td class="left bottom" align="center">&nbsp; 2.</td>
                <td class="left bottom" align="left"> &nbsp; Total Liabilitas</td>
         <td class="left bottom" align="right">&nbsp;</td>
            <td class="left bottom right" align="right">{{ number_format($saldo_a, 2)}}</td>
        
        </tr>

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
