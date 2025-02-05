@php
    use App\Utils\Tanggal;

    $jumlah_laba_ditahan = $surplus;
    $jumlah = 0;
    $total_cr = 0;
    $total_tr = 0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
     
                    <tr>
                        <td>&nbsp;<br>&nbsp;<br></td>
                    </tr>
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
        @foreach ($cr as $cares)
            @php
                $bg = 'rgb(230, 230, 230)';
                if ($loop->iteration % 2 == 0) {
                    $bg = 'rgba(255, 255, 255)';
                }

                // Menghitung total saldo untuk setiap grup
                $total_saldo = $cares->trx_kredit_sum_jumlah* -1;
                $total_cr += $total_saldo;
            @endphp
            <tr style="background: {{ $bg }};">
                <td>{{ $cares->nama_akun }}</td>
                    <td align="right">{{ number_format($total_saldo, 2) }}</td>
            </tr>
        @endforeach
        
            <tr style="background: rgb(167, 167, 167); font-weight: bold;">
                <td height="20" align="left">
                    <b>Jumlah Cadangan Kerugian Piutang</b>
                </td>
                <td align="right">{{ number_format($total_cr, 2) }}</td>
            </tr>
            
        @foreach ($rekening as $trx)
            @php
                $bg = 'rgb(230, 230, 230)';
                if ($loop->iteration % 2 == 0) {
                    $bg = 'rgba(255, 255, 255)';
                }

                // Menghitung total saldo untuk setiap grup
                $total_saldo = $trx->saldo->kredit - $trx->saldo->debit;
                $total_tr += $total_saldo;
            @endphp
            <tr style="background: {{ $bg }};">
                <td>{{ $trx->nama_akun }}</td>
                @if ($total_saldo < 0)
                    <td align="right">({{ number_format($total_saldo * -1, 2) }})</td>
                @else
                    <td align="right">{{ number_format($total_saldo, 2) }}</td>
                @endif
            </tr>
        @endforeach
        
            <tr style="background: rgb(167, 167, 167); font-weight: bold;">
                <td height="20" align="left">
                    <b>Jumlah Cadangan Kerugian Piutang</b>
                </td>
                <td align="right">{{ number_format($total_tr, 2) }}</td>
            </tr>

        <tr>
            <td colspan="2" style="padding: 0px !important;">
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">
                    <tr style="background: rgb(74, 74, 74); color: #fff;">
                        <td align="center" height="20">
                            <b>Total Alokasi Laba Usaha</b>
                        </td>
                        <td align="right">
                            <b>Rp. {{ number_format($jumlah_laba_ditahan - $total_tr -$total_cr, 2) }}</b>
                        </td>
                    </tr>
                </table>

                <div style="margin-top: 16px;"></div>
                {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
            </td>
        </tr>
    </table>
@endsection
