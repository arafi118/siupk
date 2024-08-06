<title>Laba Rugi</title>
@extends('pelaporan.layout.base')

@section('content')
    @php
        $saldo1 = 0;
        $saldo_bln_lalu1 = 0;

        $saldo2 = 0;
        $saldo_bln_lalu2 = 0;
    @endphp

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td style="border: 1px solid;" align="center" height="30" colspan="5" class="style3 bottom" style="font-size: 15px;">
                <br>{{$lkm->nama_lkm_long}}
                <br>SANDI LKM {{$lkm->sandi_lkm}}
                <br>Untuk Periode Yang Berakhir Pada Tanggal
                <br>LAPORAN KINERJA KEUANGAN</b>
            </td>
        </tr>
    </table>
    <table border="1" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px; border-color: black;">
        <tr  style="font-weight: bold;">
                <td style="border: 1px solid;" align="center" width="55%" height="16">Nama akun</td>
                <td style="border: 1px solid;" align="center" width="55%" height="16">Kode akun</td>
                <td style="border: 1px solid;" align="center" width="15%">s.d. {{ $header_lalu }}</td>
                <td style="border: 1px solid;" align="center" width="15%">{{ $header_sekarang }}</td>
                <td style="border: 1px solid;" align="center" width="15%">s.d. {{ $header_sekarang }}</td>
            </tr>
            <tr style="font-weight: bold;">
                <td style="border: 1px solid;" colspan="5" height="14">4. Pendapatan</td>
            </tr>

            @foreach ($pendapatan as $p)
                <tr style="font-weight: bold;">
                    <td style="border: 1px solid;" colspan="5" height="14">{{ $p['kode_akun'] }}. {{ $p['nama_akun'] }}</td>
                </tr>

                @php
                    $jum_bulan_lalu = 0;
                    $jum_saldo = 0;
                @endphp

                @foreach ($p['rek'] as $rek)
                    @php
                        $bg = 'rgb(230, 230, 230)';
                        if ($loop->iteration % 2 == 0) {
                            $bg = 'rgb(255, 255, 255)';
                        }
                    @endphp

                    <tr>
                        <td style="border: 1px solid;" align="left">{{ $rek['nama_akun'] }}</td>
                        <td style="border: 1px solid;" align="left">{{ $rek['kode_akun'] }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo_bln_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo'] - $rek['saldo_bln_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo'], 2) }}</td>
                    </tr>

                    @php
                        $saldo_bln_lalu1 += $rek['saldo_bln_lalu'];
                        $saldo1 += $rek['saldo'];

                        $jum_bulan_lalu += $rek['saldo_bln_lalu'];
                        $jum_saldo += $rek['saldo'];
                    @endphp
                @endforeach

                <tr style="border: 1px solid;">
                    <td style="border: 1px solid;" align="left" height="14"><strong>Jumlah{{ $p['nama_akun'] }}</strong></td>
                    <td style="border: 1px solid;" align="left" height="14"><strong>{{ $p['nama_akun'] }}</strong></td>
                    <td style="border: 1px solid;" align="right"><strong>{{ number_format($jum_bulan_lalu, 2) }}</strong></td>
                    <td style="border: 1px solid;" align="right"><strong>{{ number_format($jum_saldo - $jum_bulan_lalu, 2) }}</strong></td>
                    <td style="border: 1px solid;" align="right"><strong>{{ number_format($jum_saldo, 2) }}</strong></td>
                </tr>

            @endforeach
            <tr style="font-weight: bold;">
                <td style="border: 1px solid;" colspan="5" height="14">5. Beban</td>
            </tr>

            @foreach ($beban as $b)
                <tr style="font-weight: bold;">
                    <td style="border: 1px solid;" colspan="5" height="14">{{ $b['kode_akun'] }}. {{ $b['nama_akun'] }}</td>
                </tr>

                @php
                    $jum_bulan_lalu = 0;
                    $jum_saldo = 0;
                @endphp

                @foreach ($b['rek'] as $rek)
                    @php
                        $bg = 'rgb(230, 230, 230)';
                        if ($loop->iteration % 2 == 0) {
                            $bg = 'rgb(255, 255, 255)';
                        }
                    @endphp

                    <tr>
                        <td style="border: 1px solid;" align="left">{{ $rek['nama_akun'] }}</td>
                        <td style="border: 1px solid;" align="left">{{ $rek['kode_akun'] }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo_bln_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo'] - $rek['saldo_bln_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo'], 2) }}</td>
                    </tr>

                    @php
                        $saldo_bln_lalu1 -= $rek['saldo_bln_lalu'];
                        $saldo1 -= $rek['saldo'];

                        $jum_bulan_lalu += $rek['saldo_bln_lalu'];
                        $jum_saldo += $rek['saldo'];
                    @endphp
                @endforeach
                <tr style="font-weight: bold;">
                    <td  align="left" height="14">Jumlah{{ $b['nama_akun'] }}</td>
                    <td  align="left" height="14">{{ $b['kode_akun'] }}</td>
                    <td  align="right">{{ number_format($jum_bulan_lalu, 2) }}</td>
                    <td  align="right">{{ number_format($jum_saldo - $jum_bulan_lalu, 2) }}</td>
                    <td  align="right">{{ number_format($jum_saldo, 2) }}</td>
                </tr>
            @endforeach

            <tr style="font-weight: bold;">
                <td style="border: 1px solid;" style="font-weight: bold;"align="left">A. Laba Rugi OPERASIONAL</td>
                <td style="border: 1px solid;" align="left">4.1 - 5.1 - 5.2</td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo_bln_lalu1, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo1 - $saldo_bln_lalu1, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo1, 2) }}</td>
            </tr>

            @foreach ($pendapatanNOP as $pNOP)
                <tr style="font-weight: bold;">
                    <td style="border: 1px solid;" colspan="5" height="14">{{ $pNOP['kode_akun'] }}. {{ $pNOP['nama_akun'] }}</td>
                </tr>

                @php
                    $jum_bulan_lalu = 0;
                    $jum_saldo = 0;
                @endphp

                @foreach ($pNOP['rek'] as $rek)
                    @php
                        $bg = 'rgb(230, 230, 230)';
                        if ($loop->iteration % 2 == 0) {
                            $bg = 'rgb(255, 255, 255)';
                        }
                    @endphp

                    <tr>
                        <td style="border: 1px solid;" align="left">{{ $rek['nama_akun'] }}</td>
                        <td style="border: 1px solid;" align="left">{{ $rek['kode_akun'] }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo_bln_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo'] - $rek['saldo_bln_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo'], 2) }}</td>
                    </tr>

                    @php
                        $saldo_bln_lalu2 += $rek['saldo_bln_lalu'];
                        $saldo2 += $rek['saldo'];

                        $jum_bulan_lalu += $rek['saldo_bln_lalu'];
                        $jum_saldo += $rek['saldo'];
                    @endphp
                @endforeach

                <tr>
                    <td style="border: 1px solid;" align="left" height="14"><strong>Jumlah {{ $pNOP['nama_akun'] }}</strong></td>
                    <td style="border: 1px solid;" align="left" height="14"><strong>{{ $pNOP['kode_akun'] }}</strong></td>
                    <td style="border: 1px solid;" align="right"><strong>{{ number_format($jum_bulan_lalu, 2) }}</strong></td>
                    <td style="border: 1px solid;" align="right"><strong>{{ number_format($jum_saldo - $jum_bulan_lalu, 2) }}</strong></td>
                    <td style="border: 1px solid;" align="right"><strong>{{ number_format($jum_saldo, 2) }}</strong></td>
                </tr>

            @endforeach

            @foreach ($bebanNOP as $bNOP)
                <tr style="font-weight: bold;">
                    <td style="border: 1px solid;" colspan="5" height="14">{{ $bNOP['nama_akun'] }}.{{ $bNOP['kode_akun'] }}</td>
                </tr>

                @php
                    $jum_bulan_lalu = 0;
                    $jum_saldo = 0;
                @endphp

                @foreach ($bNOP['rek'] as $rek)
                    @php
                        $bg = 'rgb(230, 230, 230)';
                        if ($loop->iteration % 2 == 0) {
                            $bg = 'rgb(255, 255, 255)';
                        }
                    @endphp

                    <tr>
                        <td style="border: 1px solid;" align="left">{{ $rek['nama_akun'] }}</td>
                        <td style="border: 1px solid;" align="left">{{ $rek['nama_akun'] }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo_bln_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo'] - $rek['saldo_bln_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" align="right">{{ number_format($rek['saldo'], 2) }}</td>
                    </tr>

                    @php
                        $saldo_bln_lalu2 -= $rek['saldo_bln_lalu'];
                        $saldo2 -= $rek['saldo'];

                        $jum_bulan_lalu += $rek['saldo_bln_lalu'];
                        $jum_saldo += $rek['saldo'];
                    @endphp
                @endforeach

                <tr>
                    <td style="border: 1px solid;" align="left" height="14"><b>Jumlah {{ $bNOP['nama_akun'] }}</b></td>
                    <td style="border: 1px solid;" align="left" height="14"><b>{{ $bNOP['kode_akun'] }}</b></td>
                    <td style="border: 1px solid;" align="right"><b>{{ number_format($jum_bulan_lalu, 2) }}</b></td>
                    <td style="border: 1px solid;" align="right"><b>{{ number_format($jum_saldo - $jum_bulan_lalu, 2) }}</b></td>
                    <td style="border: 1px solid;" align="right"><b>{{ number_format($jum_saldo, 2) }}</b></td>
                </tr>

            @endforeach

            <tr>
                <td style="border: 1px solid;" align="left" style="font-weight: bold;">B. Laba Rugi OPERASIONAL</td>
                <td style="border: 1px solid;" align="left">(Kode Akun 4.2 - 5.3) </td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo_bln_lalu2, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo2 - $saldo_bln_lalu2, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo2, 2) }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid;" align="left" colspan="2" style="font-weight: bold;">C. Laba Rugi Sebelum Taksiran Pajak (A + B) </td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo_bln_lalu1 + $saldo_bln_lalu2, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo1 - $saldo_bln_lalu1 + ($saldo2 - $saldo_bln_lalu2), 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($saldo1 + $saldo2, 2) }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid;" colspan="5" height="14">5.4 Beban Pajak</td>
        <tr>
            <td style="border: 1px solid;" align="left" style="font-weight: bold;">Taksiran PPh (0.5%)</td>
            <td style="border: 1px solid;" align="left" width="15%">5.4.01.01.</td>
            <td style="border: 1px solid;" align="right" width="15%">{{ number_format($pph['bulan_lalu'], 2) }}</td>
            <td style="border: 1px solid;" align="right" width="15%">{{ number_format($pph['sekarang'] - $pph['bulan_lalu'], 2) }}</td>
            <td style="border: 1px solid;" align="right" width="15%">{{ number_format($pph['sekarang'], 2) }}</td>
        </tr>
        <tr style="font-weight: bold;">
                        <td style="border: 1px solid;" width="55%" align="left" colspan="2">C. Laba Rugi Setelah Taksiran Pajak (A + B)</td>
                        <td style="border: 1px solid;" width="15%" align="right">{{ number_format($saldo_bln_lalu1 + $saldo_bln_lalu2 - $pph['bulan_lalu'], 2) }}</td>
                        <td style="border: 1px solid;" width="15%" align="right">{{ number_format($saldo1 - $saldo_bln_lalu1 + ($saldo2 - $saldo_bln_lalu2) - ($pph['sekarang'] - $pph['bulan_lalu']), 2) }}</td>
                        <td style="border: 1px solid;" width="15%" align="right">{{ number_format($saldo1 + $saldo2 - $pph['sekarang'], 2) }}</td>
                    </tr>
</table>
    <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">


                <div style="margin-top: 16px;"></div>
                {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
            </td>
        </tr>
    </table>
@endsection
