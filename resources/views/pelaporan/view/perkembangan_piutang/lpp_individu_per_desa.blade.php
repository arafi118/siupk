@php
    use App\Utils\Tanggal;
    $section = 0;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    <style>
        html {
            margin-left: 40px;
            margin-right: 40px;
        }
    </style>

    @foreach ($jenis_pp as $jpp)
        @php
            // Skip jika tidak ada pinjaman individu
            if ($jpp->pinjaman_individu->isEmpty()) {
                continue;
            }

            // Inisialisasi variabel total
            $t_alokasi = 0;
            $t_target_pokok = 0;
            $t_target_jasa = 0;
            $t_real_bl_pokok = 0;
            $t_real_bl_jasa = 0;
            $t_real_pokok = 0;
            $t_real_jasa = 0;
            $t_real_bi_pokok = 0;
            $t_real_bi_jasa = 0;
            $t_saldo_pokok = 0;
            $t_saldo_jasa = 0;
            $t_tunggakan_pokok = 0;
            $t_tunggakan_jasa = 0;
        @endphp

        {{-- Page break untuk jenis pinjaman selain SPP --}}
        @if ($jpp->nama_jpp != 'SPP')
            <div class="break"></div>
        @endif

        {{-- Header Tabel --}}
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td colspan="3" align="center">
                    <div style="font-size: 18px;">
                        <b>DAFTAR PERKEMBANGAN PINJAMAN INDIVIDU {{ strtoupper($jpp->nama_jpp) }} PER DESA</b>
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

        {{-- Tabel Data Utama --}}
        <table border="1" width="100%" cellspacing="0" cellpadding="0" style="font-size: 8px; table-layout: fixed;">
            {{-- Header Row 1 --}}
            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                <th class="t l b" rowspan="2" width="2%">No</th>
                <th class="t l b" rowspan="2" width="15%">Nama Desa</th>
                <th class="t l b" rowspan="2" width="6%">Alokasi</th>
                <th class="t l b" colspan="2" width="12%">Target</th>
                <th class="t l b" colspan="2" width="12%">Real s.d. Bulan Lalu</th>
                <th class="t l b" colspan="2" width="12%">Real Bulan Ini</th>
                <th class="t l b" colspan="2" width="12%">Real s.d. Bulan Ini</th>
                <th class="t l b" rowspan="2" width="6%">Saldo</th>
                <th class="t l b" rowspan="2" width="3%">%</th>
                <th class="t l b r" colspan="2" width="12%">Tunggakan</th>
            </tr>

            {{-- Header Row 2 --}}
            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th>
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th>
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th>
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b" width="6%">Jasa</th>
                <th class="t l b" width="6%">Pokok</th>
                <th class="t l b r" width="6%">Jasa</th>
            </tr>

            @php
                $desa_data = [];
                $nomor_desa = 1;
                
                // Agregasi data per desa
                foreach ($jpp->pinjaman_individu as $pinj_i) {
                    $kd = $pinj_i->kd_desa;
                    
                    if (!isset($desa_data[$kd])) {
                        $desa_data[$kd] = [
                            'nama_desa' => $pinj_i->sebutan_desa . ' ' . $pinj_i->nama_desa,
                            'alokasi' => 0,
                            'target_pokok' => 0,
                            'target_jasa' => 0,
                            'real_bl_pokok' => 0,
                            'real_bl_jasa' => 0,
                            'real_pokok' => 0,
                            'real_jasa' => 0,
                            'real_bi_pokok' => 0,
                            'real_bi_jasa' => 0,
                            'saldo_pokok' => 0,
                            'saldo_jasa' => 0,
                            'tunggakan_pokok' => 0,
                            'tunggakan_jasa' => 0,
                        ];
                    }
                    
                    // Hitung saldo per pinjaman (sama seperti lpp_individu asli)
                    $saldo_pokok = $pinj_i->alokasi;
                    $saldo_jasa = $pinj_i->pros_jasa == 0 ? 0 : $pinj_i->alokasi * ($pinj_i->pros_jasa / 100);
                    $sum_pokok = 0;
                    $sum_jasa = 0;
                    
                    if ($pinj_i->saldo) {
                        $sum_pokok = $pinj_i->saldo->sum_pokok;
                        $sum_jasa = $pinj_i->saldo->sum_jasa;
                        $saldo_pokok = $pinj_i->saldo->saldo_pokok;
                        $saldo_jasa = $pinj_i->saldo->saldo_jasa;
                    }
                    
                    if ($saldo_jasa < 0) {
                        $saldo_jasa = 0;
                    }
                    
                    if ($pinj_i->tgl_lunas <= $tgl_kondisi && $pinj_i->status == 'L') {
                        $saldo_jasa = 0;
                    }
                    
                    // Target
                    $target_pokok = 0;
                    $target_jasa = 0;
                    if ($pinj_i->target) {
                        $target_pokok = $pinj_i->target->target_pokok;
                        $target_jasa = $pinj_i->target->target_jasa;
                    }
                    
                    // Tunggakan
                    $tunggakan_pokok = $target_pokok - $sum_pokok;
                    if ($tunggakan_pokok < 0) {
                        $tunggakan_pokok = 0;
                    }
                    $tunggakan_jasa = $target_jasa - $sum_jasa;
                    if ($tunggakan_jasa < 0) {
                        $tunggakan_jasa = 0;
                    }
                    
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
                    
                    // Real bulan ini dari withSum yang sudah ada
                    $real_pokok_bulan_ini = $pinj_i->real_i_sum_realisasi_pokok ?? 0;
                    $real_jasa_bulan_ini = $pinj_i->real_i_sum_realisasi_jasa ?? 0;
                    
                    // Real bulan lalu = sum s.d. sekarang - real bulan ini
                    $real_bl_pokok = $sum_pokok - $real_pokok_bulan_ini;
                    $real_bl_jasa = $sum_jasa - $real_jasa_bulan_ini;
                    
                    // Akumulasi ke desa
                    $desa_data[$kd]['alokasi'] += $pinj_i->alokasi;
                    $desa_data[$kd]['target_pokok'] += $target_pokok;
                    $desa_data[$kd]['target_jasa'] += $target_jasa;
                    $desa_data[$kd]['real_bl_pokok'] += $real_bl_pokok;
                    $desa_data[$kd]['real_bl_jasa'] += $real_bl_jasa;
                    $desa_data[$kd]['real_pokok'] += $real_pokok_bulan_ini;
                    $desa_data[$kd]['real_jasa'] += $real_jasa_bulan_ini;
                    $desa_data[$kd]['saldo_pokok'] += $saldo_pokok;
                    $desa_data[$kd]['saldo_jasa'] += $saldo_jasa;
                    $desa_data[$kd]['tunggakan_pokok'] += $tunggakan_pokok;
                    $desa_data[$kd]['tunggakan_jasa'] += $tunggakan_jasa;
                }
                
                // Akumulasi ke total
                foreach ($desa_data as $kd => &$data) {
                    // Hitung real_bi dari akumulasi
                    $data['real_bi_pokok'] = $data['real_bl_pokok'] + $data['real_pokok'];
                    $data['real_bi_jasa'] = $data['real_bl_jasa'] + $data['real_jasa'];
                    
                    // Akumulasi ke total
                    $t_alokasi += $data['alokasi'];
                    $t_target_pokok += $data['target_pokok'];
                    $t_target_jasa += $data['target_jasa'];
                    $t_real_bl_pokok += $data['real_bl_pokok'];
                    $t_real_bl_jasa += $data['real_bl_jasa'];
                    $t_real_pokok += $data['real_pokok'];
                    $t_real_jasa += $data['real_jasa'];
                    $t_real_bi_pokok += $data['real_bi_pokok'];
                    $t_real_bi_jasa += $data['real_bi_jasa'];
                    $t_saldo_pokok += $data['saldo_pokok'];
                    $t_saldo_jasa += $data['saldo_jasa'];
                    $t_tunggakan_pokok += $data['tunggakan_pokok'];
                    $t_tunggakan_jasa += $data['tunggakan_jasa'];
                }
            @endphp

            {{-- Tampilkan Data Per Desa --}}
            @foreach ($desa_data as $kd => $data)
                @php
                    // Hitung persentase
                    $pross = 1;
                    if ($data['target_pokok'] != 0) {
                        $pross = $data['real_bi_pokok'] / $data['target_pokok'];
                    }
                @endphp
                
                <tr>
                    <td class="t l b" align="center" height="15">{{ $nomor_desa++ }}</td>
                    <td class="t l b" align="left">{{ $data['nama_desa'] }}</td>
                    <td class="t l b" align="right">{{ number_format($data['alokasi']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['target_pokok']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['target_jasa']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['real_bl_pokok']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['real_bl_jasa']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['real_pokok']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['real_jasa']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['real_bi_pokok']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['real_bi_jasa']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['saldo_pokok']) }}</td>
                    <td class="t l b" align="center">{{ number_format(floor($pross * 100)) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['tunggakan_pokok']) }}</td>
                    <td class="t l b r" align="right">{{ number_format($data['tunggakan_jasa']) }}</td>
                </tr>
            @endforeach

            @php
                // Hitung persentase total
                $t_pross = 1;
                if ($t_target_pokok != 0) {
                    $t_pross = $t_real_bi_pokok / $t_target_pokok;
                }

                // Inisialisasi variabel untuk data lunas
                $tl_alokasi = 0;
                $tl_target_pokok = 0;
                $tl_target_jasa = 0;
                $tl_real_bl_pokok = 0;
                $tl_real_bl_jasa = 0;
                $tl_real_bi_pokok = 0;
                $tl_real_bi_jasa = 0;
                $tl_saldo_pokok = 0;
                $tl_saldo_jasa = 0;
                $tl_tunggakan_pokok = 0;
                $tl_tunggakan_jasa = 0;

                // Proses data pinjaman lunas
                if (isset($lunas)) {
                    foreach ($lunas as $ln) {
                        $target_pokok = 0;
                        $target_jasa = 0;
                        $sum_pokok = 0;
                        $sum_jasa = 0;

                        $tl_alokasi += $ln->alokasi;

                        if ($ln->target) {
                            $tl_target_pokok += $ln->target->target_pokok;
                            $tl_target_jasa += $ln->target->target_jasa;
                            $target_pokok = $ln->target->target_pokok;
                            $target_jasa = $ln->target->target_jasa;
                        }

                        if ($ln->saldo) {
                            $tl_real_bl_pokok += $ln->saldo->sum_pokok;
                            $tl_real_bl_jasa += $ln->saldo->sum_jasa;
                            $tl_real_bi_pokok += $ln->saldo->sum_pokok;
                            $tl_real_bi_jasa += $ln->saldo->sum_jasa;
                            $tl_saldo_pokok += $ln->saldo->saldo_pokok;
                            $tl_saldo_jasa += $ln->saldo->saldo_jasa;
                            $sum_pokok = $ln->saldo->sum_pokok;
                            $sum_jasa = $ln->saldo->sum_jasa;
                        }

                        $tunggakan_pokok = $target_pokok - $sum_pokok;
                        if ($tunggakan_pokok < 0) {
                            $tunggakan_pokok = 0;
                        }

                        $tunggakan_jasa = $target_jasa - $sum_jasa;
                        if ($tunggakan_jasa < 0) {
                            $tunggakan_jasa = 0;
                        }

                        $tl_tunggakan_pokok += $tunggakan_pokok;
                        $tl_tunggakan_jasa += $tunggakan_jasa;
                    }
                }

                // Hitung persentase lunas
                $tl_pross = 1;
                if ($tl_target_pokok != 0) {
                    $tl_pross = $tl_real_bi_pokok / $tl_target_pokok;
                }

                // Validasi saldo negatif
                if ($tl_saldo_pokok < 0) {
                    $tl_saldo_pokok = 0;
                }

                if ($tl_saldo_jasa < 0) {
                    $tl_saldo_jasa = 0;
                }
            @endphp

            {{-- Row Data Lunas --}}
            <tr style="font-weight: bold;">
                <td class="t l b" colspan="2" align="left" height="15">Lunas s.d. Tahun Lalu</td>
                <td class="t l b" align="right">{{ number_format($tl_alokasi) }}</td>
                <td class="t l b" align="right">{{ number_format($tl_target_pokok) }}</td>
                <td class="t l b" align="right">{{ number_format($tl_target_jasa) }}</td>
                <td class="t l b" align="right">{{ number_format($tl_real_bl_pokok) }}</td>
                <td class="t l b" align="right">{{ number_format($tl_real_bl_jasa) }}</td>
                <td class="t l b" align="right">{{ number_format(0) }}</td>
                <td class="t l b" align="right">{{ number_format(0) }}</td>
                <td class="t l b" align="right">{{ number_format($tl_real_bi_pokok) }}</td>
                <td class="t l b" align="right">{{ number_format($tl_real_bi_jasa) }}</td>
                <td class="t l b" align="right">{{ number_format($tl_saldo_pokok) }}</td>
                <td class="t l b" align="center">{{ number_format($tl_pross) }}</td>
                <td class="t l b" align="right">0</td>
                <td class="t l b r" align="right">0</td>
            </tr>

            {{-- Row Grand Total --}}
            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                <td class="t l b" colspan="2" align="center" height="15">J U M L A H</td>
                <td class="t l b" align="right">{{ number_format($t_alokasi + $tl_alokasi) }}</td>
                <td class="t l b" align="right">{{ number_format($t_target_pokok + $tl_target_pokok) }}</td>
                <td class="t l b" align="right">{{ number_format($t_target_jasa + $tl_target_jasa) }}</td>
                <td class="t l b" align="right">{{ number_format($t_real_bl_pokok + $tl_real_bl_pokok) }}</td>
                <td class="t l b" align="right">{{ number_format($t_real_bl_jasa + $tl_real_bl_jasa) }}</td>
                <td class="t l b" align="right">{{ number_format($t_real_pokok) }}</td>
                <td class="t l b" align="right">{{ number_format($t_real_jasa) }}</td>
                <td class="t l b" align="right">{{ number_format($t_real_bi_pokok + $tl_real_bi_pokok) }}</td>
                <td class="t l b" align="right">{{ number_format($t_real_bi_jasa + $tl_real_bi_jasa) }}</td>
                <td class="t l b" align="right">{{ number_format($t_saldo_pokok + $tl_saldo_pokok) }}</td>
                <td class="t l b" align="center">{{ number_format(floor($t_pross * 100)) }}</td>
                <td class="t l b" align="right">{{ number_format($t_tunggakan_pokok) }}</td>
                <td class="t l b r" align="right">{{ number_format($t_tunggakan_jasa) }}</td>
            </tr>

            {{-- Row Tanda Tangan --}}
            <tr>
                <td colspan="15" style="padding: 0px !important;">
                    <div style="margin-top: 16px;"></div>
                    {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
                </td>
            </tr>
        </table>
    @endforeach
@endsection
