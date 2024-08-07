
<title>NERACA</title>
@extends('pelaporan.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
    <tr>
        <td align="center" height="30" colspan="4" class="style3 bottom" style="font-size: 15px;">
            <br>{{$kec->nama_lembaga_long}}
            <br>SANDI LKM {{$kec->sandi_lkm}}
            <br>LAPORAN POSISI KEUANGAN
            <br>{{ strtoupper($sub_judul) }}</b>
        </td>
    </tr>
    
</table>

<table border="1" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px; border: 1px solid;">
        <tr>
            <td style="border: 1px solid;" width="70%" align="center"><b>Nama Akun</td>
            <td style="border: 1px solid;" width="10%" align="center"><b>Kode</td>
            <td style="border: 1px solid;" align="center" width="20%"><b>Jumlah</td>
        </tr>
       
        @foreach ($akun1 as $lev1)
            @php
                $sum_akun1 = 0;
            @endphp
            <tr>
                <td style="border: 1px solid;" height="20" colspan="3" align="left">
                    <b>{{ $lev1->kode_akun }}. {{ $lev1->nama_akun }}</b>
                </td>
            </tr>
            @foreach ($lev1->akun2 as $lev2)
                <!-- <tr>
                    <td style="border: 1px solid;" colspan="2">{{ $lev2->nama_akun }}</td>
                    <td style="border: 1px solid;">{{ $lev2->kode_akun }}.</td>
                </tr> -->

                @foreach ($lev2->akun3 as $lev3)
                    @php
                        $sum_saldo = 0;
                    @endphp

                    @foreach ($lev3->rek as $rek)
                        @php
                            $saldo = $keuangan->komSaldo($rek);
                            if ($rek->kode_akun == '3.2.02.01') {
                                $saldo = $keuangan->laba_rugi($tgl_kondisi);
                            }

                            $sum_saldo += $saldo;
                        @endphp
                    @endforeach
                    @php
                        $bg = 'rgb(230, 230, 230)';
                        if ($loop->iteration % 2 == 0) {
                            $bg = 'rgba(255, 255, 255)';
                        }

                        if ($lev1->lev1 == '1') {
                            $debit += $sum_saldo;
                        } else {
                            $kredit += $sum_saldo;
                        }

                        $sum_akun1 += $sum_saldo;
                    @endphp
                    <tr>
                        <td style="border: 1px solid;">{{ $lev3->nama_akun }}</td>
                        <td style="border: 1px solid;">{{ $lev3->kode_akun }}.</td>

                        @if ($sum_saldo < 0)
                            <td style="border: 1px solid;" align="right">({{ number_format($sum_saldo * -1, 2) }})</td>
                        @else
                            <td style="border: 1px solid;" align="right">{{ number_format($sum_saldo, 2) }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td style="border: 1px solid;" height="15" colspan="2" align="left">
                    <b>Jumlah {{ $lev1->nama_akun }}</b>
                </td>
                <td style="border: 1px solid;" align="right">{{ number_format($sum_akun1, 2) }}</td>
            </tr>
           
        @endforeach

        <tr>
            <td style="border: 1px solid;" colspan="3" style="padding: 0px !important;">
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">
                    <tr>
                        <td style="border: 1px solid;" height="15" width="80%" align="left">
                            <b>Jumlah Liabilitas + Ekuitas </b>
                        </td>
                        <td style="border: 1px solid;" align="right" width="20%">{{ number_format($kredit, 2) }}</td>
                    </tr>
                </table>
                </table>
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"


                <div style="margin-top: 16px;"></div>
                {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
            </td>
        </tr>
    </table>
@endsection
