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
                    // Filter $rekening_ojk berdasarkan super_sub
                    $filteredRekening = $rekening_ojk->where('super_sub', 4);
                    $jumlah = 0;
                    $jumlahlalu = 0;
                @endphp

                @foreach ($filteredRekening as $rek_ojk)
                    @php
                        $bg = $loop->iteration % 2 == 0 ? 'rgb(255, 255, 255)' : 'rgb(230, 230, 230)';
                    @endphp

                    <tr style="background: {{ $bg }};">
                        <td align='left'>{{ $rek_ojk->nomor }}</td>
                        <td>{{ $rek_ojk->nama_akun }}</td>
                        <td align='center'>{{ $rek_ojk->kode }}</td>
                            @php
                                if ($rek_ojk->rekening == NULL) {
                                    echo " ";
                                }elseif ($rek_ojk->rekening == 0) {
                                    echo number_format(0);
                                }elseif ($rek_ojk->rekening == "#") {
                                    echo "#";
                                }else{
                                    $kodeAkunArray = explode('#', $rek_ojk->rekening);
                                    $sum_saldo = 0;
                                    $sum_saldolalu = 0;

                                    foreach ($kodeAkunArray as $kodeAkun) {
                                        
// Hitung bulan sebelumnya
$bulanSebelumnya = $bulan - 1;
$tahunSebelumnya = $tahun;

// Jika bulan sebelumnya adalah 0, maka sesuaikan tahun dan bulan
if ($bulanSebelumnya == 0) {
    $bulanSebelumnya = 12;
    $tahunSebelumnya = $tahun - 1;
}

$rek = \App\Models\Rekening::with([
    'kom_saldo' => function ($query) use ($tahun, $bulan) {
        $query->where('tahun', $tahun)
            ->where(function ($query) use ($bulan) {
                $query->where('bulan', '0')->orWhere('bulan', $bulan);
            });
    },
])->where('kode_akun', $kodeAkun)->first();

$reklalu = \App\Models\Rekening::with([
    'kom_saldo' => function ($query) use ($tahunSebelumnya, $bulanSebelumnya) {
        $query->where('tahun', $tahunSebelumnya)
            ->where(function ($query) use ($bulanSebelumnya) {
                $query->where('bulan', '0')->orWhere('bulan', $bulanSebelumnya);
            });
    },
])->where('kode_akun', $kodeAkun)->first();

                                        $saldo = $keuangan->komSaldo($rek);
                                        $saldolalu = $keuangan->komSaldo($reklalu);
                                        $sum_saldo += $saldo;
                                        $sum_saldolalu += $saldolalu;
                                    }

                                    $jumlah+=$sum_saldo;
                                    $jumlahlalu+=$sum_saldolalu;
                                }

                            @endphp
                        <td align='right'>
                            {{number_format($jumlahlalu);}}
                        </td>
                        <td align='right'>
                            {{number_format($jumlah-$jumlahlalu);}}
                        </td>
                        <td align='right'>
                            {{number_format($jumlah);}}
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection
