@php
    use App\Utils\Tanggal;
    $section = 0;
    $nomor_jenis_pp = 0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
<style type="text/css">
    .style6 {font-family: Arial, Helvetica, sans-serif; font-size: 16px;font-weight: bold;  }
    .style9 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
    .style10 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
    .top    {border-top: 1px solid #000000; }
    .bottom {border-bottom: 1px solid #000000; }
    .left   {border-left: 1px solid #000000; }
    .right  {border-right: 1px solid #000000; }
    .all    {border: 1px solid #000000; }
    .style26 {font-family: Arial, Helvetica, sans-serif}
    .style27 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
    .align-justify {text-align:justify; }
    .align-center {text-align:center; }
    .align-right {text-align:right; }
</style>
    @foreach ($jenis_pp as $jpp)
        @php
            if ($jpp->pinjaman_anggota->isEmpty()) {
                continue;
            }
        @endphp

        @php
            $kd_desa = [];
            $nomor = 1;
            $t_alokasi = 0;
            $t_saldo = 0;
            $t_tunggakan_pokok = 0;
            $t_tunggakan_jasa = 0;
            $t_kolek1 = 0;
            $t_kolek2 = 0;
            $t_kolek3 = 0;
        @endphp
        @if ($nomor_jenis_pp != 0)
            <div class="break"></div>
        @endif
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td colspan="3" align="center">
                    <div style="font-size: 18px;">
                        <b>
                            DAFTAR RINCIAN PINJAMAN YANG DIBERIKAN <br> BERDASARKAN KOLEKTIBILITAS
                             {{ strtoupper($jpp->nama_jpp) }}
                        </b>
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

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px; table-layout: fixed;">
         
            @foreach ($jpp->pinjaman_anggota as $pinkel)
                @php
                    $kd_desa[] = $pinkel->kd_desa;
                    $desa = $pinkel->kd_desa;

                @endphp
                @if (array_count_values($kd_desa)[$pinkel->kd_desa] <= '1')
                    @if ($section != $desa && count($kd_desa) > 1)
                        @php
                            $j_pross = $j_saldo / $j_alokasi;
                            $t_alokasi += $j_alokasi;
                            $t_saldo += $j_saldo;
                            $t_tunggakan_pokok += $j_tunggakan_pokok;
                            $t_tunggakan_jasa += $j_tunggakan_jasa;
                            $t_kolek1 += $j_kolek1;
                            $t_kolek2 += $j_kolek2;
                            $t_kolek3 += $j_kolek3;
                        @endphp
                    @endif

                    @php
                        $j_alokasi = 0;
                        $j_saldo = 0;
                        $j_tunggakan_pokok = 0;
                        $j_tunggakan_jasa = 0;
                        $j_kolek1 = 0;
                        $j_kolek2 = 0;
                        $j_kolek3 = 0;
                        $section = $pinkel->kd_desa;
                        $nama_desa = $pinkel->sebutan_desa . ' ' . $pinkel->nama_desa;
                    @endphp
                @endif

                @php
                    $sum_pokok = 0;
                    $sum_jasa = 0;
                    $saldo_pokok = $pinkel->alokasi;
                    $saldo_jasa = $pinkel->pros_jasa == 0 ? 0 : $pinkel->alokasi * ($pinkel->pros_jasa / 100);
                    if ($pinkel->saldo) {
                        $sum_pokok = $pinkel->saldo->sum_pokok;
                        $sum_jasa = $pinkel->saldo->sum_jasa;
                        $saldo_pokok = $pinkel->saldo->saldo_pokok;
                        $saldo_jasa = $pinkel->saldo->saldo_jasa;
                    }

                    if ($saldo_jasa < 0) {
                        $saldo_jasa = 0;
                    }

                    if ($pinkel->tgl_lunas <= $tgl_kondisi && $pinkel->status == 'L') {
                        $saldo_jasa = 0;
                    }

                    $target_pokok = 0;
                    $target_jasa = 0;
                    $wajib_pokok = 0;
                    $wajib_jasa = 0;
                    $angsuran_ke = 0;
                    if ($pinkel->target) {
                        $target_pokok = $pinkel->target->target_pokok;
                        $target_jasa = $pinkel->target->target_jasa;
                        $wajib_pokok = $pinkel->target->wajib_pokok;
                        $wajib_jasa = $pinkel->target->wajib_jasa;
                        $angsuran_ke = $pinkel->target->angsuran_ke;
                    }

                    $tunggakan_pokok = $target_pokok - $sum_pokok;
                    if ($tunggakan_pokok < 0) {
                        $tunggakan_pokok = 0;
                    }
                    $tunggakan_jasa = $target_jasa - $sum_jasa;
                    if ($tunggakan_jasa < 0) {
                        $tunggakan_jasa = 0;
                    }

                    $pross = $saldo_pokok == 0 ? 0 : $saldo_pokok / $pinkel->alokasi;

                    if ($pinkel->tgl_lunas <= $tgl_kondisi && $pinkel->status == 'L') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    } elseif ($pinkel->tgl_lunas <= $tgl_kondisi && $pinkel->status == 'R') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    } elseif ($pinkel->tgl_lunas <= $tgl_kondisi && $pinkel->status == 'H') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    }

                    $tgl_akhir = new DateTime($tgl_kondisi);
                    $tgl_awal = new DateTime($pinkel->tgl_cair);
                    $selisih = $tgl_akhir->diff($tgl_awal);

                    // if ($lpp == 'Minggu') {
                    //     $selisih_hari = $selisih->days;
                    //     $selisih = floor($selisih_hari / 7);
                    // } else {
                        
                    // }
                    $selisih = $selisih->y * 12 + $selisih->m;

                    $_kolek = 0;
                    if ($wajib_pokok != '0') {
                        $_kolek = $tunggakan_pokok / $wajib_pokok;
                    }
                    $kolek = round($_kolek + ($selisih - $angsuran_ke));
                    if ($kolek <= 3) {
                        $kolek1 = $saldo_pokok;
                        $kolek2 = 0;
                        $kolek3 = 0;
                    } elseif ($kolek <= 5) {
                        $kolek1 = 0;
                        $kolek2 = $saldo_pokok;
                        $kolek3 = 0;
                    } else {
                        $kolek1 = 0;
                        $kolek2 = 0;
                        $kolek3 = $saldo_pokok;
                    }

                    $j_alokasi += $pinkel->alokasi;
                    $j_saldo += $saldo_pokok;
                    $j_tunggakan_pokok += $tunggakan_pokok;
                    $j_tunggakan_jasa += $tunggakan_jasa;
                    $j_kolek1 += $kolek1;
                    $j_kolek2 += $kolek2;
                    $j_kolek3 += $kolek3;
                @endphp
            @endforeach

            @if (count($kd_desa) > 0)
                @php
                    $j_pross = $j_saldo / $j_alokasi;
                    $t_alokasi += $j_alokasi;
                    $t_saldo += $j_saldo;
                    $t_tunggakan_pokok += $j_tunggakan_pokok;
                    $t_tunggakan_jasa += $j_tunggakan_jasa;
                    $t_kolek1 += $j_kolek1;
                    $t_kolek2 += $j_kolek2;
                    $t_kolek3 += $j_kolek3;
                    $totals = $t_kolek1 + $t_kolek2 + $t_kolek3;
                @endphp

                @php

                    $t_pros = 0;
                    if ($t_saldo) {
                        $t_pross = $t_saldo / $t_alokasi;
                    }
                @endphp
                <tr>
                    <td colspan="3" style="padding: 0px !important;">
                        <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
                            <tr>
                                <td width="20%" class="style9">NAMA LKM</td>
                                <td class="style9">:{{$kec->nama_lembaga_long}}</td>
                            </tr>
                            <tr>
                                <td width="20%" class="style9">SANDI LKM</td>
                                <td class="style9">:{{$kec->sandi_lkm}}</td>
                            </tr>
                            <tr>
                                <td width="20%" class="style9 ">PERIODE LAPORAN</td>
                                <td class="style9 ">:{{$tgl}}</td>
                            </tr> <br>
                        </table>
                        <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
                            <tr align="center" height="100%">
                                <th width="3%" class="left bottom top">NO</th>
                                <th width="40%" class="left bottom top">TINGKAT KOLEKTIBILITAS</th>
                                <th width="40%" class="left right bottom top">JUMLAH</th>
                            </tr>
                            <tr align="center" height="100%" style="background:rgba(0,0,0, 0.4);">
                                <td width="3%"  class="left bottom">I</td>
                                <td class="left bottom">II</td>
                                <td class="left bottom right">III</td>
                            </tr>

                            <tr>
                                <td width="3%"  class="left bottom" align="center">1</td>
                                <td class="left bottom"> &nbsp; Lancar</td>
                                <td class="left bottom right" align="right">{{ number_format($t_kolek1) }}</td>
                            </tr>
                            <tr>
                                <td width="3%"  class="left bottom" align="center">2</td>
                                <td class="left bottom"> &nbsp; Diragukan</td>
                                <td class="left bottom right" align="right">{{ number_format($t_kolek2) }}</td>
                            </tr>
                            <tr>
                                <td width="3%"  class="left bottom" align="center">3</td>
                                <td class="left bottom"> &nbsp; Macet</td>
                                <td class="left bottom right" align="right">{{ number_format($t_kolek3) }}</td>
                            </tr>

                            <tr align="center">
                                <th colspan="2" class="left bottom">TOTAL PINJAMAN YANG DIBERIKAN KEPADA MASYARAKAT</th>
                                <th class="left bottom right" align="right">{{ number_format($totals) }}</th>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <div style="margin-top: 16px;"></div>
                                    {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endif
        </table>
        @php
            $nomor_jenis_pp++;
        @endphp
    @endforeach
@endsection


{{-- @php
use App\Utils\Keuangan;
$keuangan = new Keuangan();
$section = 0;
$empty = false;
@endphp

@extends('pelaporan.layout.base')

@section('content')

<style type="text/css">
    .style6 {font-family: Arial, Helvetica, sans-serif; font-size: 16px;font-weight: bold;  }
    .style9 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
    .style10 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
    .top    {border-top: 1px solid #000000; }
    .bottom {border-bottom: 1px solid #000000; }
    .left   {border-left: 1px solid #000000; }
    .right  {border-right: 1px solid #000000; }
    .all    {border: 1px solid #000000; }
    .style26 {font-family: Arial, Helvetica, sans-serif}
    .style27 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
    .align-justify {text-align:justify; }
    .align-center {text-align:center; }
    .align-right {text-align:right; }
</style>
@php
    $nomor =0;    
@endphp

@foreach ($jenis_pp as $jpp)
    @php
        $jumlah_lunas = 0;
        $k_alokasi = 0;
        $k_saldo = 0;
        $j_saldo = 0;
        $lancar = 0;
        $diragukan = 0;
        $macet = 0;

        $kd_desa = [];
        if ($jpp->pinjaman_individu->isEmpty()) {
            $empty = true;
            continue;
        }
        $nomor++;

    @endphp

    @if ($nomor > 1)
        <div class="break"></div>
        
            @php
            $empty = false;
            @endphp
    @endif

    <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
        <tr>
            <td height="20" colspan="2" class="bottom"></td>
            <td height="20" colspan="2" class="bottom">
            </td>
        </tr> 
        <tr>
            <td height="20" colspan="4" class="style6 bottom align-center"><br>
                DAFTAR RINCIAN PINJAMAN YANG DIBERIKAN <br> BERDASARKAN KOLEKTIBILITAS<br></td>
        </tr>
        <tr>
            <td colspan="2" class="style9">NAMA LKM</td>
            <td colspan="2" class="style9">:{{$kec->nama_lembaga_long}}</td>
        </tr>
        <tr>
            <td colspan="2" class="style9">SANDI LKM</td>
            <td colspan="2" class="style9">:{{$kec->sandi_lkm}}</td>
        </tr>
        <tr>
            <td colspan="2" class="style9 bottom">PERIODE LAPORAN</td>
            <td colspan="2" class="style9 bottom">:{{$tgl}}</td>
        </tr>
        <tr align="center" height="100%">
            <th width="3%" class="left bottom top">NO</th>
            <th colspan="2" class="left bottom top">TINGKAT KOLEKTIBILITAS</th>
            <th width="50%" class="left right bottom top">JUMLAH</th>
        </tr>
        <tr align="center" height="100%" style="background:rgba(0,0,0, 0.4);">
            <td class="left bottom">I</td>
            <td colspan="2" class="left bottom">II</td>
            <td class="left bottom right">III</td>
        </tr>
        

        @foreach ($jpp->pinjaman_individu as $pinj_i)
        @php 
            $saldo_pokok = isset($pinj_i->saldo->saldo_pokok) ? floatval($pinj_i->saldo->saldo_pokok) : 0;
			$k_alokasi += floatval($pinj_i->alokasi);
			$k_saldo += $saldo_pokok; 

		@endphp
            @php
            $nomor = 1;
            $kd_desa[] = $pinj_i->kd_desa;
            $desa = $pinj_i->kd_desa;
            @endphp

            @if (array_count_values($kd_desa)[$pinj_i->kd_desa] <= '1') 
                @if ($section != $desa && count($kd_desa) > 1)
                    <!-- Additional logic if needed -->
                @endif
            @endif

            @php
              $saldo_pokok = $pinj_i->alokasi;
                $saldo_jasa = $pinj_i->pros_jasa == 0 ? 0 : $pinj_i->alokasi * ($pinj_i->pros_jasa / 100);
                if ($pinj_i->saldo) {
                    $sum_pokok = $pinj_i->saldo->sum_pokok;
                    $sum_jasa = $pinj_i->saldo->sum_jasa;
                    $saldo_pokok = $pinj_i->saldo->saldo_pokok;
                    $saldo_jasa = $pinj_i->saldo->saldo_jasa;
                }
                $kidp = $pinj_i['id'];
                $section = $pinj_i->kd_desa;
                $nama_desa = $pinj_i->sebutan_desa . ' ' . $pinj_i->nama_desa;
                $apros_jasa = number_format($pinj_i['pros_jasa'] - $pinj_i['jangka'], 2);
                $ktgl1 = $pinj_i['tgl_cair'];
                $kpenambahan = "+" . $pinj_i['jangka'] . " month";
                $atgl2 = date('Y-m-d', strtotime($kpenambahan, strtotime($ktgl1)));
                $apros_jasa = number_format($pinj_i['pros_jasa'] / $pinj_i['jangka'], 2);
                $j_saldo += $saldo_pokok;
        
                $jumlah_lunas += 1;
                $sum_pokok = 0;
                $sum_jasa = 0;
                $saldo_pokok = $pinj_i->alokasi;
                $saldo = $pinj_i->alokasi;

                if ($pinj_i->saldo) {
                    $saldo = $pinj_i->alokasi - $pinj_i->saldo->sum_pokok;
                    $sum_pokok = $pinj_i->saldo->sum_pokok;
                    $sum_jasa = $pinj_i->saldo->sum_jasa;
                }

                $saldo_jasa = $pinj_i->pros_jasa == 0 ? 0 : $pinj_i->alokasi * ($pinj_i->pros_jasa / 100);
            
                $wajib_pokok = 0;
                if ($pinj_i->target) {
                    $target_pokok = $pinj_i->target->target_pokok;
                    $target_jasa = $pinj_i->target->target_jasa;
                    $wajib_pokok = $pinj_i->target->wajib_pokok;
                    $wajib_jasa = $pinj_i->target->wajib_jasa;
                    $angsuran_ke = $pinj_i->target->angsuran_ke;
                }

                $tunggakan_pokok = $target_pokok - $sum_pokok;
                if ($tunggakan_pokok < 0) { 
                    $tunggakan_pokok = 0; 
                }

                $tunggakan_jasa = $target_jasa - $sum_jasa; 
                if ($tunggakan_jasa < 0) {
                    $tunggakan_jasa = 0;
                }

                $pross = $saldo_pokok == 0 ? 0 : $saldo_pokok / $pinj_i->alokasi;
                if ($pinj_i->tgl_lunas <= $tgl_kondisi && ($pinj_i->status == 'L' || $pinj_i->status == 'R' || $pinj_i->status == 'H')) {
                    $tunggakan_pokok = 0;
                    $tunggakan_jasa = 0;
                    $saldo_pokok = 0;
                    $saldo_jasa = 0;
                }

                $tgl_cair = explode('-', $pinj_i->tgl_cair);
                $th_cair = $tgl_cair[0];
                $bl_cair = $tgl_cair[1];
                $tg_cair = $tgl_cair[2];

                $selisih_tahun = ($tahun - $th_cair) * 12;
                $selisih_bulan = $bulan - $bl_cair;
                $selisih = $selisih_bulan + $selisih_tahun;

                $_kolek = 0;
                if ($wajib_pokok != '0') {
                    $_kolek = $tunggakan_pokok / $wajib_pokok;
                }

                $kolek = ceil($_kolek + ($selisih - $angsuran_ke));
                if ($kolek && $j_saldo) {
                    if ($kolek <= 3) {
                        $lancar += $j_saldo;
                    } elseif ($kolek <= 5) {
                        $diragukan += $j_saldo;
                    } else {
                        $macet += $j_saldo;
                    }
                }
                
                $totals = $lancar + $diragukan + $macet;
                if ($totals > 0) {
                    $npl = ($diragukan + $macet) / $totals * 100;
                } else {
                    $npl = 0; 
                }
            @endphp
        @endforeach

        <tr>
            <td class="left bottom" align="center">1</td>
            <td colspan="2" class="left bottom">Lancar</td>
            <td class="left bottom right" align="right">{{ number_format($lancar) }}</td>
        </tr>
        <tr>
            <td class="left bottom" align="center">2</td>
            <td colspan="2" class="left bottom">Diragukan</td>
            <td class="left bottom right" align="right">{{ number_format($diragukan) }}</td>
        </tr>
        <tr>
            <td class="left bottom" align="center">3</td>
            <td colspan="2" class="left bottom">Macet</td>
            <td class="left bottom right" align="right">{{ number_format($macet) }}</td>
        </tr>
        <tr align="center">
            <th colspan="3" class="left bottom">TOTAL PINJAMAN YANG DIBERIKAN KEPADA MASYARAKAT</th>
            <th class="left bottom right" align="right">{{ number_format($totals) }}</th>
        </tr>
        <tr align="center" height="100%">
            <th width="3%" class="top"></th>
            <th width="20%" class="top"></th>
            <th width="15%" class="top"></th>
            <th width="10%" class="top"></th>
        </tr>
    </table>
@endforeach
@endsection --}}
