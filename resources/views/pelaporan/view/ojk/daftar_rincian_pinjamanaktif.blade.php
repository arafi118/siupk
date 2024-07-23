    <title>PINJAMAN AKTIF</title>
    @php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();
    $section = 0;
    $empty = false;
    @endphp

    @extends('pelaporan.layout.base')

    @section('content')

    <style type="text/css">
        .style6 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: bold;
            -webkit-print-color-adjust: exact;
        }

        .style9 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            -webkit-print-color-adjust: exact;
        }

        .style10 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            -webkit-print-color-adjust: exact;
        }

        .top {
            border-top: 1px solid #000000;
        }

        .bottom {
            border-bottom: 1px solid #000000;
        }

        .left {
            border-left: 1px solid #000000;
        }

        .right {
            border-right: 1px solid #000000;
        }

        .all {
            border: 1px solid #000000;
        }

        .style26 {
            font-family: Arial, Helvetica, sans-serif
        }

        .style27 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            font-weight: bold;
        }

        .align-justify {
            text-align: justify;
        }

        .align-center {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

    </style>

    @foreach ($jenis_pp as $jpp)
        @php
            if ($jpp->pinjaman_individu->isEmpty()) {
                $empty = true;
                continue;
            }
            
            $jumlah_aktif = 0;
            $j_alokasi = 0;
            $j_saldo = 0;

            $kd_desa = [];
        @endphp

        @if ($jpp->nama_jpp != 'Kendaraan' && !$empty)
            <div class="break"></div>
            @php
                $empty = false;
            @endphp
        @endif

        <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0">
            <tr>
                <td height="20" colspan="10" class="bottom"></td>
                <td height="20" colspan="2" class="bottom">
                    <div align="right" class="style9">Dokumen Laporan <br>
                        Kd.Doc. I2 Lembar-1</div>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="12" class="style6 bottom align-center"><br>DAFTAR RINCIAN PINJAMAN YANG DIBERIKAN
                    (Aktif) <br><br></td>
            </tr>
            <tr>
                <td colspan="3" width="30%" class="style9">NAMA LKM</td>
                <td colspan="9" width="70%" class="style9">: {{$lkm->nama_lkm_long}}</td>
            </tr>
            <tr>
                <td colspan="3" width="30%" class="style9">SANDI LKM</td>
                <td colspan="9" width="70%" class="style9">:{{$lkm->sandi_lkm}}</td>
            </tr>
            <tr>
                <td colspan="3" width="30%" class="style9 bottom">PERIODE LAPORAN</td>
                <td colspan="9" width="70%" class="style9 bottom">: {{ $tgl }}</td>
            </tr>

            <tr align="center" height="30px" class="style9">
                <th width="2%" rowspan="2" class="left bottom">No</th>
                <th width="20%" rowspan="2" class="left bottom">Peminjam - Loan ID</th>
                <th width="10%" rowspan="2" class="left bottom">Jenis Penggunaan</th>
                <th width="7%" rowspan="2" class="left bottom">Periode Pembayaran</th>
                <th colspan="2" class="left bottom">Jangka Waktu</th>
                <th colspan="2" class="left bottom">Suku Bunga</th>
                <th width="3%" rowspan="2" class="left bottom">Plafon</th>
                <th width="7%" rowspan="2" class="left bottom">Baki Debet</th>
                <th width="3%" rowspan="2" class="left bottom">Jumlah Tunggakan (X)</th>
                <th width="3%" rowspan="2" class="left right bottom">Kolektibilitas</th>
            </tr>
            <tr align="center" height="30px" class="style9">
                <th width="5%" class="left bottom">Mulai</th>
                <th width="5%" class="left bottom">Jatuh Tempo</th>
                <th width="5%" class="left bottom">%</th>
                <th width="5%" class="left bottom">Keterangan</th>
            </tr>
            <tr>
                <th colspan="12" class="style27 top left right align-left">NASABAH PENERIMA INDIVIDU</th>
            </tr>

            @php
            $sumalokasi = 0;
            $alokasi = 0;
            @endphp
            @foreach ($jpp->pinjaman_individu as $pinj_i)
                @php
                    $kd_desa[] = $pinj_i->kd_desa;
                    $desa = $pinj_i->kd_desa;
                @endphp
                @if (array_count_values($kd_desa)[$pinj_i->kd_desa] <= '1' ) 
                    @if ($section !=$desa && count($kd_desa)> 1)

            
                    @endif
                @endif

                <tr>
                    <td class="t l b" align="center">{{ $pinj_i->kode_desa }}</td>
                    <td class="style27 left top right" colspan="11">{{$pinj_i->nama_desa}}</td>
                </tr>

                @php
                    $kidp =$pinj_i['id'];

                    $nomor = 1;
                    $section = $pinj_i->kd_desa;
                    $nama_desa = $pinj_i->sebutan_desa . ' ' . $pinj_i->nama_desa;
                    $kpros_jasa =number_format($pinj_i['pros_jasa'] - $pinj_i['jangka'],2);

                    $ktgl1 = $pinj_i['tgl_cair'];
                    $kpenambahan ="+".$pinj_i['jangka']." month";
                    $ktgl2 = date('Y-m-d', strtotime($kpenambahan, strtotime($ktgl1)));
                    $kpros_jasa =number_format($pinj_i['pros_jasa']/$pinj_i['jangka'],2);
                    $saldopinjaman =date($tgl."-".$kidp);

                
                @endphp

                @php
                    $jumlah_aktif += 1;

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
                    if ($pinj_i->saldo) {
                        $sum_pokok = $pinj_i->saldo->sum_pokok;
                    }

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
                        $tunggakan_pokok=0; 
                    } 
                    
                    $tunggakan_jasa=$target_jasa - $sum_jasa;
                    if ($tunggakan_jasa < 0) { 
                        $tunggakan_jasa=0; 
                    } 
                    $pross=$saldo_pokok==0 ? 0 : $saldo_pokok / $pinj_i->alokasi;
                    if ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'L') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    } elseif ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'R') {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    } elseif ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'H') {
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

                    if($kolek<=3){
                        $keterangan="Lancar" ; 
                    } elseif($kolek<=5){ 
                        $keterangan="Diragukan" ; 
                    }else{
                        $keterangan="Macet" ; 
                    } 
                    
                @endphp 
                @if($saldopinjaman == 0)
                    @php
                        $jum_nunggak = 0;
                    @endphp
                @else
                    @php
                        $jum_nunggak = date($tgl_kondisi . "-" . $kidp);
                    @endphp

                @if($jum_nunggak <= 0)
                        @php
                            $jum_nunggak = 0;
                        @endphp
                @endif
                @endif
                @php
                $j_alokasi += $pinj_i->alokasi;
                $j_saldo += $pinj_i->saldo;

                @endphp



                <tr align="right" height="15px" class="style9">
                    <td class="left top" align="center">{{ $nomor++ }}</td>
                    <td class="left top" align="left">{{ $pinj_i->namadepan }}{{$pinj_i->id}}</td>
                    <td class="left top" align="left">Pinjaman Modal Kerja</td>
                    <td class="left top" align="center">{{$pinj_i->angsuran_pokok->nama_sistem}}</td>
                    <td class="left top" align="center">{{ Tanggal::tglIndo($pinj_i->tgl_cair) }}</td>
                    <td class="left top" align="center">{{ Tanggal::tglIndo($ktgl2)}}</td>
                    <td class="left top">{{$kpros_jasa}}%</td>
                    <td class="left top" align="center">per bulan</td>
                    <td class="left top">{{number_format($pinj_i->alokasi)}}</td>
                    @if ($pinj_i->saldo)
                        <td class="left top">{{number_format($pinj_i->saldo->saldo_pokok)}}</td>
                    @else
                        <td class="left top">0</td>
                    @endif
                    <td class="left top">{{$kolek}}</td>
                    <td class="left top right" align="left">{{$keterangan}}</td>
                </tr>
            
            @endforeach

            @if (count($kd_desa) > 0)

        
                <tr class="style9">
                    <th colspan="8" class="left top" align="center"style="background:rgba(0,0,0, 0.3);">TOTAL ({{$jumlah_aktif}} Anggota)</th>
                    <th class="left top" align="right">{{number_format($j_alokasi)}}</th>
                    <th class="left top" align="right">{{number_format($j_saldo)}}</th>
                    <th colspan="2" class="left right top" align="right"></th>
                    </tr>
                <tr class="style9">
                    <th colspan="12" class="top" align="center">&nbsp;</th>
                </tr>
                <tr>
                    <td class="style10 top" colspan="12"><b>Keterangan</b> : Data yang ditampilkan diatas
                        merupakan Individu aktif
                        pada tahun berjalan----, untuk menampilkan data Individu aktif tahun lalu dapat
                        memilih mode tahun lalu
                        ----.</td>
                </tr>
            @endif
        </table>
    @endforeach

    @endsection
