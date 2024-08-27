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
            <td style="border: 1px solid;" align="center" height="30" colspan="5" class="style3 bottom"
                style="font-size: 15px;">
                <br>{{ $kec->nama_lembaga_long }}
                <br>SANDI LKM {{ $kec->sandi_lkm }}
                <br>Untuk Periode Yang Berakhir Pada Tanggal
                <br>LAPORAN KINERJA KEUANGAN</b>
            </td>
        </tr>
    </table>
  <br>

    <table border="1" width="96%" cellspacing="0" cellpadding="0" style="font-size: 11px; border-color: black;">
        <tr style="font-weight: bold;">
            <td style="border: 1px solid;" align="center" width="50%" height="16">Nama Akun</td>
            <td style="border: 1px solid;" align="center" width="15%" height="16">Kode Akun</td>
            <td style="border: 1px solid;" align="center" width="20%">s.d.{{ $header_lalu }}</td>
            <td style="border: 1px solid;" align="center" width="20%">{{ $header_sekarang }}</td>
            <td style="border: 1px solid;" align="center" width="20%">s.d. {{ $header_sekarang }}</td>
        </tr>
        <tr style="background: rgb(255, 255, 255); font-weight: bold; text-transform: uppercase;">
            <td style="border: 1px solid;" colspan="5" height="14">4. Pendapatan</td>
        </tr>

        @foreach ($pendapatan as $p)
            <tr style="font-weight: bold;">
                <td style="border: 1px solid;" height="14">{{ $p['nama_akun'] }}</td>
                <td style="border: 1px solid;"align="center">{{ $p['kode_akun'] }}</td>
                <td style="border: 1px solid;">&nbsp;</td>
                <td style="border: 1px solid;">&nbsp;</td>
                <td style="border: 1px solid;">&nbsp;</td>
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
                    <td style="border: 1px solid;" align="center">{{ $rek['kode_akun'] }}</td>
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

            <tr style="background: rgb(255, 255, 255); font-weight: bold;">
                <td colspan="2"border: 1px solid;" align="center" height="14">Jumlah {{ $p['nama_akun'] }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_bulan_lalu, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_saldo - $jum_bulan_lalu, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_saldo, 2) }}</td>
            </tr>
        @endforeach

        <tr style="background: rgb(255, 255, 255); font-weight: bold; text-transform: uppercase;">
            <td style="border: 1px solid;" colspan="5" height="14">5. Beban</td>
        </tr>

        @foreach ($beban as $b)
            <tr style="background: rgb(255, 255, 255); font-weight: bold;">
                <td style="border: 1px solid;" height="14">{{ $b['nama_akun'] }}</td>
                <td style="border: 1px solid;" height="14" align="center">{{ $b['kode_akun'] }}</td>
                <td style="border: 1px solid;">&nbsp;</td>
                <td style="border: 1px solid;">&nbsp;</td>
                <td style="border: 1px solid;">&nbsp;</td>
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
                    <td style="border: 1px solid;" align="center">{{ $rek['kode_akun'] }}</td>
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
            <tr style="background: rgb(255, 255, 255); font-weight: bold;">
                <td colspan="2" style="border: 1px solid;" align="center" height="14">Jumlah{{ $b['nama_akun'] }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_bulan_lalu, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_saldo - $jum_bulan_lalu, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_saldo, 2) }}</td>
            </tr>
        @endforeach

        <tr style="background: rgb(255, 255, 255); font-weight: bold;">
            <td style="border: 1px solid;" align="left">A. Laba Rugi OPERASIONAL</td>
            <td style="border: 1px solid;" align="center"></td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo_bln_lalu1, 2) }}</td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo1 - $saldo_bln_lalu1, 2) }}</td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo1, 2) }}</td>
        </tr>
        @foreach ($pendapatanNOP as $pNOP)
            <tr style="background: rgb(255, 255, 255); font-weight: bold;">
                <td style="border: 1px solid;" height="14">{{ $pNOP['nama_akun'] }}</td>
                <td style="border: 1px solid;" height="14" align="center">{{ $pNOP['kode_akun'] }}</td>
                <td style="border: 1px solid;">&nbsp;</td>
                <td style="border: 1px solid;">&nbsp;</td>
                <td style="border: 1px solid;">&nbsp;</td>
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
                    <td style="border: 1px solid;" align="center">{{ $rek['kode_akun'] }}</td>
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

            <tr style="background: rgb(255, 255, 255); font-weight: bold;">
                <td colspan="2" style="border: 1px solid;" align="center" height="14">Jumlah {{ $pNOP['nama_akun'] }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_bulan_lalu, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_saldo - $jum_bulan_lalu, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_saldo, 2) }}</td>
            </tr>
        @endforeach

        @foreach ($bebanNOP as $bNOP)
            <tr style="background: rgb(255, 255, 255); font-weight: bold;">
                <td style="border: 1px solid;"  height="14">{{ $bNOP['nama_akun'] }}</td>
                <td style="border: 1px solid;" height="14" align="center">{{ $bNOP['kode_akun'] }}</td>
                <td style="border: 1px solid;">&nbsp;</td>
                <td style="border: 1px solid;">&nbsp;</td>
                <td style="border: 1px solid;">&nbsp;</td>
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
                    <td style="border: 1px solid;" align="center">{{ $rek['kode_akun'] }}</td>
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

            <tr style="background: rgb(255, 255, 255); font-weight: bold;">
                <td colspan="2" style="border: 1px solid;" align="center" height="14">Jumlah {{ $bNOP['nama_akun'] }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_bulan_lalu, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_saldo - $jum_bulan_lalu, 2) }}</td>
                <td style="border: 1px solid;" align="right">{{ number_format($jum_saldo, 2) }}</td>
            </tr>
        @endforeach

        <tr style="background: rgb(255, 255, 255); font-weight: bold;">
            <td style="border: 1px solid;" align="left">B. Laba Rugi OPERASIONAL</td>
            <td style="border: 1px solid;" align="center"></td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo_bln_lalu2, 2) }}</td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo2 - $saldo_bln_lalu2, 2) }}</td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo2, 2) }}</td>
        </tr>
        <tr style="background: rgb(255, 255, 255); font-weight: bold;">
            <td style="border: 1px solid;" align="left">C. Laba Rugi Sebelum Taksiran Pajak (A + B) </td>
            <td style="border: 1px solid;" align="left"></td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo_bln_lalu1 + $saldo_bln_lalu2, 2) }}</td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo1 - $saldo_bln_lalu1 + ($saldo2 - $saldo_bln_lalu2), 2) }}</td>
            <td style="border: 1px solid;" align="right">{{ number_format($saldo1 + $saldo2, 2) }}</td>
        </tr>
        <tr style="background: rgb(255, 255, 255); font-weight: bold;">
            <td style="border: 1px solid;" colspan="5" height="14">5.4 Beban Pajak</td>
        </tr>
        <tr style="background: rgb(255, 255, 255); font-weight: bold;">
            <td style="border: 1px solid;" align="left">Taksiran PPh (0.5%) </td>
            <td style="border: 1px solid;" align="center">5.4.01.01</td>
            <td style="border: 1px solid;" align="right">{{ number_format($pph['bulan_lalu'], 2) }}</td>
            <td style="border: 1px solid;" align="right">{{ number_format($pph['sekarang'] - $pph['bulan_lalu'], 2) }}</td>
            <td style="border: 1px solid;" align="right">{{ number_format($pph['sekarang'], 2) }}</td>
        </tr>
        <tr style="background: rgb(255, 255, 255); font-weight: bold;">
            <td  style="border: 1px solid;"width="70%" align="left">C. Laba Rugi Setelah Taksiran Pajak (A + B) </td>
                        <td style="border: 1px solid;"width="30%" align="left"> </td>
                        <td style="border: 1px solid;"width="15%" align="right">
                            {{ number_format($saldo_bln_lalu1 + $saldo_bln_lalu2 - $pph['bulan_lalu'], 2) }}</td>
                        <td style="border: 1px solid;"width="15%" align="right">
                            {{ number_format($saldo1 - $saldo_bln_lalu1 + ($saldo2 - $saldo_bln_lalu2) - ($pph['sekarang'] - $pph['bulan_lalu']), 2) }}
                        </td>
                        <td style="border: 1px solid;"width="15%" align="right">{{ number_format($saldo1 + $saldo2 - $pph['sekarang'], 2) }}
                        </td>            
        </tr>
    </table>
    <table class="p" border="0" width="96%" cellspacing="0" cellpadding="0"
    style="font-size: 11px;">
    <tr>
        <td width="15%" align="right">
            {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
        </td>
    </tr>
</table>
@endsection
