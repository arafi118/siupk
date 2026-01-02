@php
    use App\Utils\Tanggal;
    $section = 0;
    
    // Ambil data kolek dari database
    $kolekData = $kec->kolek ? json_decode($kec->kolek, true) : [];
    
    // Filter hanya kolek yang aktif (ada nama)
    $activeKolek = array_filter($kolekData, function($k) {
        return !empty($k['nama']);
    });
    
    // Fungsi untuk menentukan tingkat kolek
    function getTingkatKolek($kolek_bulan, $kolekData) {
        if (empty($kolekData)) {
            return 0;
        }
        
        // Loop dari tingkat kolek terendah ke tertinggi
        for ($i = 0; $i < count($kolekData); $i++) {
            $kolek = $kolekData[$i];
            
            // Skip jika kolek tidak aktif
            if (empty($kolek['nama'])) {
                continue;
            }
            
            $durasi = floatval($kolek['durasi']);
            $satuan = $kolek['satuan'];
            
            // Konversi durasi ke bulan jika satuan hari
            if ($satuan == 'hari') {
                $durasi = $durasi / 30;
            }
            
            // Jika kolek_bulan kurang dari durasi, maka masuk ke tingkat ini
            if ($kolek_bulan < $durasi) {
                return $i;
            }
        }
        
        // Jika melebihi semua durasi, masuk ke tingkat kolek tertinggi
        for ($i = count($kolekData) - 1; $i >= 0; $i--) {
            if (!empty($kolekData[$i]['nama'])) {
                return $i;
            }
        }
        
        return 0;
    }
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
            $t_saldo = 0;
            $t_tunggakan_pokok = 0;
            $t_tunggakan_jasa = 0;
            $t_kolek = array_fill(0, count($kolekData), 0);
        @endphp

        {{-- Page break untuk jenis pinjaman selain SPP --}}
        @if ($jpp->nama_jpp != 'SPP')
            <div class="break"></div>
        @endif

        {{-- Header Tabel --}}
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td colspan="3" align="center">
                    <div style="font-size: 20px;">
                        <b>DAFTAR KOLEKTIBILITAS INDIVIDU {{ strtoupper($jpp->nama_jpp) }} PER DESA</b>
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
            {{-- Header Tabel --}}
            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                <th class="t l b" width="2%">No</th>
                <th class="t l b" width="23%">Nama Desa</th>
                <th class="t l b" width="10%">Saldo</th>
                <th class="t l b" width="10%">Tunggakan</th>
                @foreach ($activeKolek as $index => $kolek)
                    <th class="t l b {{ $loop->last ? 'r' : '' }}">{{ strtoupper($kolek['nama']) }}</th>
                @endforeach
            </tr>

            @php
                $desa_data = [];
                $nomor_desa = 1;
                
                // Agregasi data per desa
                foreach ($jpp->pinjaman_individu as $pinkel) {
                    $kd = $pinkel->kd_desa;
                    
                    if (!isset($desa_data[$kd])) {
                        $desa_data[$kd] = [
                            'nama_desa' => $pinkel->sebutan_desa . ' ' . $pinkel->nama_desa,
                            'alokasi' => 0,
                            'saldo' => 0,
                            'tunggakan_pokok' => 0,
                            'tunggakan_jasa' => 0,
                            'kolek' => array_fill(0, count($kolekData), 0),
                        ];
                    }
                    
                    // Hitung data per pinjaman
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

                    if ($pinkel->tgl_lunas <= $tgl_kondisi && in_array($pinkel->status, ['L', 'R', 'H'])) {
                        $tunggakan_pokok = 0;
                        $tunggakan_jasa = 0;
                        $saldo_pokok = 0;
                        $saldo_jasa = 0;
                    }

                    // Hitung kolek bulan
                    $tgl_cair = explode('-', $pinkel->tgl_cair);
                    $th_cair = $tgl_cair[0];
                    $bl_cair = $tgl_cair[1];

                    $selisih_tahun = ($tahun - $th_cair) * 12;
                    $selisih_bulan = $bulan - $bl_cair;
                    $selisih = $selisih_bulan + $selisih_tahun;

                    $_kolek = 0;
                    if ($wajib_pokok != '0') {
                        $_kolek = $tunggakan_pokok / $wajib_pokok;
                    }
                    
                    $kolek_bulan = ceil($_kolek + ($selisih - $angsuran_ke));

                    // Tentukan tingkat kolek
                    $tingkat_kolek = getTingkatKolek($kolek_bulan, $kolekData);
                    
                    // Akumulasi data ke desa
                    $desa_data[$kd]['alokasi'] += $pinkel->alokasi;
                    $desa_data[$kd]['saldo'] += $saldo_pokok;
                    $desa_data[$kd]['tunggakan_pokok'] += $tunggakan_pokok;
                    $desa_data[$kd]['tunggakan_jasa'] += $tunggakan_jasa;
                    $desa_data[$kd]['kolek'][$tingkat_kolek] += $saldo_pokok;
                }
                
                // Akumulasi ke total
                foreach ($desa_data as $kd => &$data) {
                    $t_alokasi += $data['alokasi'];
                    $t_saldo += $data['saldo'];
                    $t_tunggakan_pokok += $data['tunggakan_pokok'];
                    $t_tunggakan_jasa += $data['tunggakan_jasa'];
                    
                    foreach ($data['kolek'] as $idx => $val) {
                        $t_kolek[$idx] += $val;
                    }
                }
            @endphp

            {{-- Tampilkan Data Per Desa --}}
            @foreach ($desa_data as $kd => $data)
                <tr>
                    <td class="t l b" align="center" height="15">{{ $nomor_desa++ }}</td>
                    <td class="t l b" align="left">{{ $data['nama_desa'] }}</td>
                    <td class="t l b" align="right">{{ number_format($data['saldo']) }}</td>
                    <td class="t l b" align="right">{{ number_format($data['tunggakan_pokok']) }}</td>
                    @foreach ($activeKolek as $idx => $kolek)
                        <td class="t l b {{ $loop->last ? 'r' : '' }}" align="right">
                            {{ number_format($data['kolek'][$idx] ?? 0) }}
                        </td>
                    @endforeach
                </tr>
            @endforeach

            @php
                // Hitung total resiko pinjaman
                $total_resiko = 0;
                foreach ($activeKolek as $idx => $kolek) {
                    $prosentase = floatval($kolek['prosentase']);
                    $total_resiko += ($t_kolek[$idx] * $prosentase) / 100;
                }
            @endphp

            {{-- Row Grand Total --}}
            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                <td class="t l b" colspan="2" align="center" height="15">J U M L A H</td>
                <td class="t l b" align="right">{{ number_format($t_saldo) }}</td>
                <td class="t l b" align="right">{{ number_format($t_tunggakan_pokok) }}</td>
                @foreach ($activeKolek as $idx => $kolek)
                    <td class="t l b {{ $loop->last ? 'r' : '' }}" align="right">
                        {{ number_format($t_kolek[$idx] ?? 0) }}
                    </td>
                @endforeach
            </tr>

            {{-- Row Resiko Pinjaman Header --}}
            <tr style="font-weight: bold;">
                <td class="t l b" rowspan="2" colspan="2" align="center" height="15">Resiko Pinjaman</td>
                <td class="t l b" colspan="2" align="center">
                    ({{ implode(' + ', array_map(function($k) { return $k['nama']; }, $activeKolek)) }})
                </td>
                @foreach ($activeKolek as $idx => $kolek)
                    <td class="t l b {{ $loop->last ? 'r' : '' }}" align="center">
                        {{ $kolek['nama'] }} * {{ $kolek['prosentase'] }}%
                    </td>
                @endforeach
            </tr>

            {{-- Row Resiko Pinjaman Nilai --}}
            <tr style="font-weight: bold;">
                <td class="t l b" colspan="2" align="center">
                    {{ number_format($total_resiko) }}
                </td>
                @foreach ($activeKolek as $idx => $kolek)
                    @php
                        $prosentase = floatval($kolek['prosentase']);
                        $nilai_resiko = ($t_kolek[$idx] * $prosentase) / 100;
                    @endphp
                    <td class="t l b {{ $loop->last ? 'r' : '' }}" align="center">
                        {{ number_format($nilai_resiko) }}
                    </td>
                @endforeach
            </tr>

            {{-- Row Tanda Tangan --}}
            <tr>
                <td colspan="{{ 4 + count($activeKolek) }}" style="padding: 0px !important;">
                    <div style="margin-top: 16px;"></div>
                    {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
                </td>
            </tr>
        </table>
    @endforeach
@endsection
