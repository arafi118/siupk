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

                    $jumlah_aset =0;
                    $kas_setara_kas =0;
                    $jumlah_liabilitas =0;
                    $jumlah_liabilitas_ekuitas =0;
                    $liabilitas_lancar =0;
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
                <th width="50%">Nama Akun</th>
                <th width="20%">Kode Akun</th>
                <th width="20%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
                @php
                    // Filter $rekening_ojk berdasarkan super_sub
                    $filteredRekening = $rekening_ojk->where('super_sub', 4);
                    $jumlah = 0;
                @endphp

                @foreach ($filteredRekening as $rek_ojk)
                    @php
                        $bg = $loop->iteration % 2 == 0 ? 'rgb(255, 255, 255)' : 'rgb(230, 230, 230)';
                    @endphp

                    <tr style="background: {{ $bg }};">
                        <td align='left'>{{ $rek_ojk->nomor }}</td>
                        <td>{{ $rek_ojk->nama_akun }}</td>
                        <td align='center'>{{ $rek_ojk->kode }}</td>
                        <td align='right'>
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

                                    foreach ($kodeAkunArray as $kodeAkun) {
                                        $rek = \App\Models\Rekening::with([
                                            'kom_saldo' => function ($query) use ($tahun, $bulan) {
                                                $query->where('tahun', $tahun)
                                                    ->where(function ($query) use ($bulan) {
                                                        $query->where('bulan', '0')->orWhere('bulan', $bulan);
                                                    });
                                            },
                                        ])->where('kode_akun', $kodeAkun)->first();

                                        $saldo = $keuangan->komSaldo($rek);
                                        $sum_saldo += $saldo;
                                    }

                                    echo number_format($sum_saldo);
                                    $jumlah+=$sum_saldo;
                                    //Jumlah A
                                    if($no=="A"){
                                        $jumlah_aset+=$sum_saldo;
                                    }
                                    //Jumlah Liabilitas
                                    if($no=="B"){
                                        $jumlah_liabilitas+=$sum_saldo;
                                    }
                                    
                                    //Jumlah Liabilitas + Ekuitas
                                    if($no!="A"){
                                        $jumlah_liabilitas_ekuitas+=$sum_saldo;
                                    }
                                    
                                    //Kas dan Setara Kas
                                    if($rek_ojk->kode == "110" OR $rek_ojk->kode == "121" OR $rek_ojk->kode == "122" OR $rek_ojk->kode == "123"){
                                        $kas_setara_kas+=$sum_saldo;
                                    }

                                    //Liabilitas Lancar
                                    if($rek_ojk->kode == "210" OR $rek_ojk->kode == "221" OR $rek_ojk->kode == "222"){
                                        $liabilitas_lancar+=$sum_saldo;
                                    }


                                }
                            @endphp
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection
