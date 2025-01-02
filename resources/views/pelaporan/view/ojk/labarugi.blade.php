@php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();
@endphp

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
                <br>
                <b>{{ $kec->nama_lembaga_long }}</b>
                <br>
                <b>SANDI LKM {{ $kec->sandi_lkm }}</b>
                <br>
                <b>LAPORAN POSISI KEUANGAN</b>
                <br>
                <b>{{ strtoupper($sub_judul) }}</b>
            </td>
        </tr>
    </table>

    <table border="0" width="96%" cellspacing="0" cellpadding="0" style="font-size: 11px; border-color: black; table-layout: fixed;">
        <thead>
            <tr style="background: rgb(74, 74, 74); color: #fff; font-weight: bold; font-size: 12px;">
                <th height="20" width="5%">No</th>
                <th>Nama Akun</th>
                <th width="20%">Kode Akun</th>
                <th width="15%">s.d. Bulan Lalu</th>
                <th width="15%">Bulan Ini</th>
                <th width="15%">s.d. Bulan Ini</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Filter rekening_ojk based on super_sub
                $filteredRekening = $rekening_ojk->where('super_sub', 4)->sortBy('urutan');
                $jumlah = 0;
                $jumlahlalu = 0;
                $a = 0;
                $a_lalu = 0;
                $b = 0;
                $b_lalu = 0;
                $c = 0;
                $c_lalu = 0;
                $f = 0;
                $f_lalu = 0;
                $g = 0;
                $g_lalu = 0;
            @endphp

            @foreach ($filteredRekening as $rek_ojk)
                @php
                    $bg = $loop->iteration % 2 == 0 ? 'rgb(255, 255, 255)' : 'rgb(230, 230, 230)';
                    if (!is_numeric($rek_ojk->nomor)) {
                        $bg = $loop->iteration % 2 == 0 ? 'rgb(197, 197, 197)' : 'rgb(167, 167, 167)';
                    }
                    $sum_saldo = 0;
                    $sum_saldolalu = 0;
                @endphp

                <tr style="background: {{ $bg }};">
                    <td align='left'>{{ $rek_ojk->nomor }}</td>
                    <td>{{ $rek_ojk->nama_akun }}</td>
                    <td align='center'>{{ $rek_ojk->kode }}</td>

                    @php
                        if ($rek_ojk->rekening === null) {
                            echo "  <td align='right'></td>
                                    <td align='right'></td>
                                    <td align='right'></td>";
                        } elseif ($rek_ojk->rekening == '0') {
                            echo "  <td align='right'>0</td>
                                    <td align='right'>0</td>
                                    <td align='right'>0</td>";
                        } elseif ($rek_ojk->rekening == "#") {
                            echo "  <td align='right'>#</td>
                                    <td align='right'>#</td>
                                    <td align='right'>#</td>";
                        } elseif ($rek_ojk->rekening == "A") {
                            echo "  <td align='right'>". number_format($a_lalu) ."</td>
                                    <td align='right'>". number_format($a-$a_lalu) ."</td>
                                    <td align='right'>". number_format($a) ."</td>";
                        } elseif ($rek_ojk->rekening == "B") {
                            echo "  <td align='right'>". number_format($b_lalu) ."</td>
                                    <td align='right'>". number_format($b-$b_lalu) ."</td>
                                    <td align='right'>". number_format($b) ."</td>";
                        } elseif ($rek_ojk->rekening == "C") {
                            echo "  <td align='right'>". number_format($c_lalu) ."</td>
                                    <td align='right'>". number_format($c-$c_lalu) ."</td>
                                    <td align='right'>". number_format($c) ."</td>";
                        } elseif ($rek_ojk->rekening == "F") {
                            echo "  <td align='right'>". number_format($f_lalu) ."</td>
                                    <td align='right'>". number_format($f-$f_lalu) ."</td>
                                    <td align='right'>". number_format($f) ."</td>";
                        } elseif ($rek_ojk->rekening == "H") {
                            echo "  <td align='right'>". number_format($f_lalu-$g_lalu) ."</td>
                                    <td align='right'>". number_format(($f-$f_lalu)-($g - $g_lalu)) ."</td>
                                    <td align='right'>". number_format(($f)-($g)) ."</td>";
                        } else {
                            $kodeAkunArray = explode('#', $rek_ojk->rekening);

                            foreach ($kodeAkunArray as $kodeAkun) {
                                // Calculate previous month and year
                                $bulanSebelumnya = $bulan - 1;
                                $tahunSebelumnya = $tahun;

                                // Adjust year and month if previous month is 0
                                if ($bulanSebelumnya == 0) {
                                    $bulanSebelumnya = 12;
                                    $tahunSebelumnya = $tahun - 1;
                                }

                                // Get current month's record
                                $rek = \App\Models\Rekening::with([
                                    'kom_saldo' => function ($query) use ($tahun, $bulan) {
                                        $query->where('tahun', $tahun)
                                            ->where(function ($query) use ($bulan) {
                                                $query->where('bulan', '0')->orWhere('bulan', $bulan);
                                            });
                                    },
                                ])->where('kode_akun', $kodeAkun)->first();

                                // Get previous month's record
                                $reklalu = \App\Models\Rekening::with([
                                    'kom_saldo' => function ($query) use ($tahunSebelumnya, $bulanSebelumnya) {
                                        $query->where('tahun', $tahunSebelumnya)
                                            ->where(function ($query) use ($bulanSebelumnya) {
                                                $query->where('bulan', '0')->orWhere('bulan', $bulanSebelumnya);
                                            });
                                    },
                                ])->where('kode_akun', $kodeAkun)->first();

                                $saldo = $keuangan->komSaldo($rek);
                                $saldolalu       = $keuangan->komSaldo($reklalu);
                                $sum_saldo      += $saldo;
                                $sum_saldolalu  += $saldolalu;
                                if (substr($rek_ojk->kode, 0, 1) == '4') {
                                    $a          += $saldo;
                                    $a_lalu     += $saldolalu;
                                    $c          += $saldo;
                                    $c_lalu     += $saldolalu;
                                    $f          += $saldo;
                                    $f_lalu     += $saldolalu;
                                }
                                if (substr($rek_ojk->kode, 0, 1) == '5') {
                                    $b          += $saldo;
                                    $b_lalu     += $saldolalu;
                                    $c          -= $saldo;
                                    $c_lalu     -= $saldolalu;
                                    $f          -= $saldo;
                                    $f_lalu     -= $saldolalu;
                                }
                                if (substr($rek_ojk->kode, 0, 1) == '6') {
                                    $f          += $saldo;
                                    $f_lalu     += $saldolalu;
                                }
                                if (substr($rek_ojk->kode, 0, 1) == '7') {
                                    $f          -= $saldo;
                                    $f_lalu     -= $saldolalu;
                                }
                                if (substr($rek_ojk->kode, 0, 1) == '8') {
                                    $g          -= $saldo;
                                    $g_lalu     -= $saldolalu;
                                }




                            }

                            $jumlah += $sum_saldo;
                            $jumlahlalu += $sum_saldolalu;
                            @endphp
                                <td align='right'>
                                    {{ number_format($sum_saldolalu) }}
                                </td>
                                <td align='right'>
                                    {{ number_format($sum_saldo - $sum_saldolalu) }}
                                </td>
                                <td align='right'>
                                    {{ number_format($sum_saldo) }}
                                </td>
                            @php
                        }
                            @endphp
                </tr>
            @endforeach
            
                <tr>    
                    <td colspan="6" style="padding: 0px !important;">
                        <div style="margin-top: 16px;"></div>
                        {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
                    </td>
                </tr>    
        </tbody>
    </table>
@endsection
