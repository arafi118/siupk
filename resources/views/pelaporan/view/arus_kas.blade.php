@php
    $array_saldo = [];
    $j_saldo = 0;

    $index = 1;
    $total_bulan_ini = 0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>ARUS KAS</b>
                </div>
                <div style="font-size: 16px;">
                    <b>{{ strtoupper($sub_judul) }}</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>

    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr style="background: rgb(200, 200, 200)">
            <th colspan="2">Nama Akun</th>
            <th>Jumlah</th>
        </tr>

        @foreach ($arus_kas as $ak)
            @php
                $dot = substr($ak->nama_akun, 1, 1);
                if ($dot == '.') {
                    $bg = '150, 150, 150';
                } else {
                    $bg = '128, 128, 128';
                }

                $romawi = 0;
                if (!($dot == '.' && $ak->id != '2') && $ak->id != '9') {
                    $romawi = $index;
                }

                $sub_total = 0;
            @endphp

            @if (!($dot == '.' && $ak->id != '2') && $ak->id != '9')
                @if ($ak->id > 2)
                    @php
                        $section = explode(' ', $section);
                        $section = ucwords(strtolower(end($section)));

                        $title = 'Kas Bersih yang diperoleh dari aktivitas ' . $section;
                        if ($section == 'Operasi') {
                            $title .= ' (A-B-C)';
                        } else {
                            $title .= ' (A-B)';
                        }

                        $total_bulan_ini += $total;
                    @endphp
                    <tr style="background: rgb(128, 128, 128)">
                        <td>&nbsp;</td>
                        <td>{{ $title }}</td>
                        <td align="right">{{ number_format($total, 2) }}</td>
                    </tr>
                @endif

                @php
                    $total = 0;
                @endphp
            @endif

            <tr>
                <td colspan="3" height="3"></td>
            </tr>
            <tr style="background: rgb({{ $bg }})">
                <td width="5%" align="center">{{ $keuangan->romawi($romawi) }}</td>
                <td width="80%">{{ $ak->nama_akun }}</td>
                <td width="15%" align="right">
                    @if ($ak->id == 1)
                        {{ number_format($saldo_bulan_lalu, 2) }}
                    @endif
                </td>
            </tr>

            @php
                $number = 0;
            @endphp
            @foreach ($ak->child as $child)
                @php
                    $akun3 = $child->rek_debit;
                    if ($child->rek_kredit) {
                        $akun3 = $child->rek_kredit;
                    }
                @endphp

                @if ($akun3)
                    @php
                        $number++;
                        if ($number % 2 == 0) {
                            $bg = '240, 240, 240';
                        } else {
                            $bg = '200, 200, 200';
                        }

                        $jumlah = 0;
                    @endphp
                    @foreach ($akun3->rek as $rek)
                        @php
                            $transaksi = $rek->trx_kredit;
                            if ($child->rek_debit) {
                                $transaksi = $rek->trx_debit;
                            }

                            foreach ($transaksi as $trx) {
                                $jumlah += $trx->jumlah;
                            }

                        @endphp
                    @endforeach

                    <tr style="background: rgb({{ $bg }})">
                        <td>&nbsp;</td>
                        <td>{{ $akun3->nama_akun }}</td>
                        <td align="right">{{ number_format($jumlah, 2) }}</td>
                    </tr>

                    @php
                        $sub_total += $jumlah;
                        if ($child->rek_debit) {
                            $total -= $jumlah;
                        } else {
                            $total += $jumlah;
                        }
                    @endphp
                @endif
            @endforeach

            @if ($dot == '.')
                <tr style="background: rgb(150, 150, 150); font-weight: bold;">
                    <td>&nbsp;</td>
                    <td>Jumlah {{ substr(ucwords(strtolower($ak->nama_akun)), 3) }}</td>
                    <td align="right">{{ number_format($sub_total, 2) }}</td>
                </tr>
            @endif
            @php
                if (!($dot == '.' && $ak->id != '2') && $ak->id != '9') {
                    $index++;

                    $section = $ak->nama_akun;
                } else {
                    continue;
                }
            @endphp
        @endforeach

        @php
            $section = explode(' ', $section);
            $section = ucwords(strtolower(end($section)));

            $title = 'Kas Bersih yang diperoleh dari aktivitas ' . $section;
            if ($section == 'Operasi') {
                $title .= ' (A-B-C)';
            } else {
                $title .= ' (A-B)';
            }

            $total_bulan_ini += $total;
        @endphp
        <tr style="background: rgb(128, 128, 128)">
            <td>&nbsp;</td>
            <td>{{ $title }}</td>
            <td align="right">{{ number_format($total, 2) }}</td>
        </tr>

        <tr>
            <td colspan="3" style="padding: 0px !important;">
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">
                    <tr style="background: rgb(128, 128, 128)">
                        <td width="5%" align="center">&nbsp;</td>
                        <td width="80%">Kenaikan (Penurunan) Kas</td>
                        <td width="15%" align="right">{{ number_format($total_bulan_ini, 2) }}</td>
                    </tr>
                    <tr style="background: rgb(128, 128, 128)">
                        <td align="center">&nbsp;</td>
                        <td>SALDO AKHIR KAS SETARA KAS</td>
                        <td align="right">{{ number_format($total_bulan_ini + $saldo_bulan_lalu, 2) }}</td>
                    </tr>
                </table>

                <div style="margin-top: 16px;"></div>
                {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
            </td>
        </tr>
    </table>
@endsection
