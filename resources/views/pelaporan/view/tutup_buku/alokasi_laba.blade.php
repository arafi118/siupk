@php
    use App\Utils\Tanggal;
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();


    $jumlah_laba_ditahan = $surplus;
    $jumlah = 0;
    $total = 0;
    $debit = 0;
    $kredit = 0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td align="center">
                <div style="font-size: 18px;">
                    <b>ALOKASI PEMBAGIAN LABA USAHA</b>
                </div>
                <div style="font-size: 16px;">
                    <b>{{ strtoupper($sub_judul) }}</b>
                </div>
            </td>
        </tr>
    </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr style="background: rgb(232, 232, 232); font-weight: bold; font-size: 12px;">
            <td height="20">
                <b>Laba/Rugi Tahun {{ $tahun - 1 }}</b>
            </td>
            <td align="right">
                <b>Rp. {{ number_format($surplus, 2) }}</b>
            </td>
        </tr>
        <tr style="background: rgb(74, 74, 74); color: #fff;">
            <td colspan="2" height="20">
                <b>Alokasi Laba Usaha</b>
            </td>
        </tr>
        
                    @foreach ($akun1 as $lev1)
                        @php
                            $sum_akun1 = 0;
                        @endphp
                        @foreach ($lev1->akun2 as $lev2)
                            @foreach ($lev2->akun3 as $lev3)
                                @php
                                    $sum_saldo = 0;
                                    $akun_lev4 = [];
                                @endphp

                                @foreach ($lev3->rek as $rek)
                                    @php
                                        $saldo = $keuangan->komSaldo($rek);
                                        if ($rek->kode_akun == '3.2.02.01') {
                                            $saldo = $keuangan->laba_rugi($tgl_kondisi);
                                        }

                                        $sum_saldo += $saldo;

                                        $akun_lev4[] = [
                                            'lev4' => $rek->lev4,
                                            'kode_akun' => $rek->kode_akun,
                                            'nama_akun' => $rek->nama_akun,
                                            'saldo' => $saldo,
                                        ];
                                    @endphp
                                @endforeach

                                @php
                                    if ($lev1->lev1 == '1') {
                                        $debit += $sum_saldo;
                                    } else {
                                        $kredit += $sum_saldo;
                                    }

                                    $sum_akun1 += $sum_saldo;
                                @endphp
                                @php
                                    // Konversi array $akun_lev4 menjadi koleksi Laravel
                                    $grouped_lev4 = collect($akun_lev4)->groupBy(function ($item) {
                                        return $item['lev4'];
                                    });
                                @endphp

                                @foreach ($grouped_lev4 as $key => $group)
                                    @php
                                        $bg = 'rgb(230, 230, 230)';
                                        if ($loop->iteration % 2 == 0) {
                                            $bg = 'rgba(255, 255, 255)';
                                        }

                                        // Menghitung total saldo untuk setiap grup
                                        $total_saldo = $group->sum('saldo');
                                    @endphp
                                    <tr style="background: {{ $bg }};">
                                        <td>{{ $group->first()['nama_akun'] }}</td>
                                        @if ($total_saldo < 0)
                                            <td align="right">({{ number_format($total_saldo * -1, 2) }})</td>
                                        @else
                                            <td align="right">{{ number_format($total_saldo, 2) }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach

                        <tr style="background: rgb(167, 167, 167); font-weight: bold;">
                            <td height="20" align="left">
                                <b>Jumlah {{ $lev1->nama_akun }}</b>
                            </td>
                            <td align="right">{{ number_format($sum_akun1, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" height="2"></td>
                        </tr>
                    @endforeach


        <tr>
            <td colspan="2" style="padding: 0px !important;">
                <div style="margin-top: 16px;"></div>
                {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
            </td>
        </tr>
    </table>
@endsection
