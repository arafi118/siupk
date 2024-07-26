<title>KOLEKTIBILITAS PINJAMAN</title>
@php
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

@foreach ($jenis_pp as $jpp)
    @php
    if ($jpp->pinjaman_individu->isEmpty()) {
        $empty = true;
        continue;
    }
    $jumlah_lunas = 0;
    $k_alokasi = 0;
    $k_saldo = 0;
    $lancar = 0;
    $diragukan = 0;
    $macet = 0;
    $kd_desa = [];
    @endphp

    @if ($jpp->nama_jpp != 'Kendaraan' && !$empty)
        <div class="break"></div>
        @php
        $empty = false;
        @endphp
    @endif

    <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" class="style9">
        <tr>
            <td height="20" colspan="2" class="bottom"></td>
            <td height="20" colspan="2" class="bottom">
                <div align="right" class="style9">Dok. Laporan ----<br>Kd.Doc. CRK-----</div>
            </td>
        </tr> 
        <tr>
            <td height="20" colspan="4" class="style6 bottom align-center"><br>DAFTAR RINCIAN PINJAMAN YANG DIBERIKAN <br> BERDASARKAN KOLEKTIBILITAS<br></td>
        </tr>
        <tr>
            <td colspan="2" class="style9">NAMA LKM</td>
            <td colspan="2" class="style9">:{{$lkm->nama_lkm_long}}</td>
        </tr>
        <tr>
            <td colspan="2" class="style9">SANDI LKM</td>
            <td colspan="2" class="style9">:{{$lkm->sandi_lkm}}</td>
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
            $kidp = $pinj_i['id'];
            $section = $pinj_i->kd_desa;
            $nama_desa = $pinj_i->sebutan_desa . ' ' . $pinj_i->nama_desa;
            $apros_jasa = number_format($pinj_i['pros_jasa'] - $pinj_i['jangka'], 2);
            $ktgl1 = $pinj_i['tgl_cair'];
            $kpenambahan = "+" . $pinj_i['jangka'] . " month";
            $atgl2 = date('Y-m-d', strtotime($kpenambahan, strtotime($ktgl1)));
            $apros_jasa = number_format($pinj_i['pros_jasa'] / $pinj_i['jangka'], 2);
            $saldopinjaman = date($tgl . "-" . $kidp);

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
            $target_pokok = 0;
            $target_jasa = 0;
            $wajib_pokok = 0;
            $wajib_jasa = 0;
            $angsuran_ke = 0;

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

            if (is_numeric($kolek) && is_numeric($saldopinjaman)) {
                if ($kolek <= 3) {
                    $lancar += $saldopinjaman;
                } elseif ($kolek <= 5) {
                    $diragukan += $saldopinjaman;
                } else {
                    $macet += $saldopinjaman;
                }
            }
            
            $totals = $lancar + $diragukan + $macet;

            if ($totals > 0) {
                $npl = ($diragukan + $macet) / $totals * 100;
            } else {
                $npl = 0; 
            }




            $jum_nunggak = $saldopinjaman == 0 ? 0 : date($tgl_kondisi . "-" . $kidp);
            if ($jum_nunggak <= 0) {
                $jum_nunggak = 0;
            }

            $k_alokasi += $pinj_i->alokasi;
            $k_saldo += $pinj_i->saldo;
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
@endsection
