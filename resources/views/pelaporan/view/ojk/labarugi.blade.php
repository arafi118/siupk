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
                $filteredRekening = $rekening_ojk->where('super_sub', 4);
                $jumlah = 0;
                $jumlahlalu = 0;
                $c = 0;
                $c_lalu = 0;
                $f = 0;
                $g = 0;
                $h = 0;
            @endphp

            @foreach ($filteredRekening as $rek_ojk)
                @php
                    $bg = $loop->iteration % 2 == 0 ? 'rgb(255, 255, 255)' : 'rgb(230, 230, 230)';
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
                        } elseif ($rek_ojk->rekening == "C") {
                            echo "  <td align='right'>". number_format($c) ."</td>
                                    <td align='right'>". number_format($c-$c_lalu) ."</td>
                                    <td align='right'>". number_format($c_lalu) ."</td>";
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
                                    $c          += $saldo;
                                    $c_lalu     += $saldolalu;
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
                                    {{ number_format($sum_saldolalu) }}
                                </td>
                            @php
                        }
                            @endphp
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
