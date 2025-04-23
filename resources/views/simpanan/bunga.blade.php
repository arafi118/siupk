@php
    use Carbon\Carbon;
    $now = Carbon::now()->subMonth(); // Ambil bulan lalu
    $selectedMonth = $now->format('m');
    $selectedYear = $now->format('Y');
    $years = range(date('Y') - 5, date('Y') + 1); // Range tahun, bisa diubah
    $bulanList = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
@endphp

@extends('layouts.base')

@section('content')

<div class="app-main__inner">   
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="POST">
                            @csrf
                            <div class="row">
                                <!-- CIF -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="my-2">
                                            <label class="form-label" for="bulan_bunga" >Bulan</label>
                                            <select class="form-control" name="bulan_bunga" id="bulan_bunga">
                                                @foreach($bulanList as $value => $label)
                                                    <option value="{{ $value }}" {{ $value == $selectedMonth ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="msg_hitung_bunga"></small>
                                        </div>
                                        
                                        <div class="my-2">
                                            <label for="tahun_bunga" class="form-label">Tahun</label>
                                            <select class="form-control" name="tahun_bunga" id="tahun_bunga">
                                                @for($tahun = 2023; $tahun <= date('Y') + 2; $tahun++)
                                                    <option value="{{ $tahun }}" {{ $tahun == $selectedYear ? 'selected' : '' }}>{{ $tahun }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="input-group input-group-static my-3">
                                            <label for="cif">CIF (Customer Information File)</label>
                                            <input autocomplete="off" type="text" name="cif" id="cif" class="form-control" >
                                            <small class="text-danger" id="msg_cif"></small>
                                        </div>
                                    </div>
                                </div>
                                    @php
                                        $bulan = ltrim($selectedMonth, '0');
                                        $tahun = ltrim($selectedYear, '0');
                                        $tahun_now = ltrim($selectedYear, '0');
                                        $tgl_bunga = $kec->tgl_bunga;
                                                    
                                        $bulan_lalu = $bulan - 1;
                                        if ($bulan_lalu == 0) {
                                            $bulan_lalu = 12;
                                            $tahun--;
                                        }
                                        // Hitung jumlah hari dalam bulan lalu dan bulan ini
                                        $last_day_bulan_lalu = cal_days_in_month(CAL_GREGORIAN, $bulan_lalu, $tahun);
                                        $last_day_bulan_ini  = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun_now);

                                        // Tentukan hari bunga untuk bulan lalu dan bulan ini
                                        if ($tgl_bunga < 0) {
                                            // Hitung dari akhir bulan
                                            $day_bunga_lalu = $last_day_bulan_lalu + $tgl_bunga + 1;
                                            $day_bunga_ini  = $last_day_bulan_ini + $tgl_bunga + 1;
                                        } else {
                                            // Gunakan langsung
                                            $day_bunga_lalu = $day_bunga_ini = $tgl_bunga;
                                        }

                                        // Amankan jika hasil melebihi batas tanggal
                                        $day_bunga_lalu = max(1, min($day_bunga_lalu, $last_day_bulan_lalu));
                                        $day_bunga_ini  = max(1, min($day_bunga_ini, $last_day_bulan_ini));

                                        // Susun tanggal
                                        $tgl_awal   = sprintf("%04d-%02d-%02d", $tahun, $bulan_lalu, $day_bunga_lalu);
                                        $tgl_trans  = sprintf("%04d-%02d-%02d", $tahun_now, $bulan, $day_bunga_ini);
                                        $tgl_akhir  = date("Y-m-d", strtotime($tgl_trans . " -1 day"));

                                        // Hitung jumlah hari (inklusif)
                                        $datetime_awal  = new DateTime($tgl_awal);
                                        $datetime_akhir = new DateTime($tgl_akhir);
                                        $selisih = $datetime_awal->diff($datetime_akhir);
                                        $jumlah_hari = $selisih->days + 1; // +1 agar inklusif
                                    @endphp
                                <div class="col-md-8">
                                    <div class="alert alert-alert d-flex align-items-center" role="alert" style="background-color: #e7f3fe; color: #31708f; border: 1px solid #bce8f1;">
                                        <div id="info-bunga">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button id="simpanBunga"  type="button" class="btn btn-primary mt-3">Proses Kalkulasi</button>
                        </form>
                    </div> 
                </div> 
            </div>
        </div>
    </div> 
</div> 

@endsection

@section('script')
    <script>
        
        new Choices($('#bulan_bunga')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })

        new Choices($('#tahun_bunga')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })

        $(document).ready(function() {
            var currentMonth = $('#bulan_bunga').val();
            var currentYear = $('#tahun_bunga').val();

            tableTransaksi(currentMonth, currentYear);

            function tableTransaksi(bulan, tahun) {
                $.get('/bunga_simpanan/info', {
                    bulan: bulan,
                    tahun: tahun
                }, function(result) {
                    $('#info-bunga').html(result);
                }).fail(function(xhr, status, error) {
                    console.error("Error loading :", error);
                    $('#info-bunga').html('<p>Error loading. Please try again.</p>');
                });
            }

            $('#bulan_bunga, #tahun_bunga').change(function() {
                var bulan = $('#bulan_bunga').val();
                var tahun = $('#tahun_bunga').val();
                tableTransaksi(bulan, tahun);
            });

        });

        let childWindow, loading;
        $(document).on('click', '#simpanBunga', function(e) {
            e.preventDefault();

            var bulan = $('select#bulan_bunga').val();
            var tahun = $('select#tahun_bunga').val();
            var cif = $('#cif').val().trim(); // ambil input dari #cif

            loading = Swal.fire({
                title: "Mohon Menunggu..",
                html: "Proses Hitung bunga",
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Susun URL dengan parameter yang sudah diencode
            var url = '/simpan_bunga?bulan=' + encodeURIComponent(bulan) +
                        '&tahun=' + encodeURIComponent(tahun) +
                        '&start=0' +
                        '&id=' + encodeURIComponent(cif);

            childWindow = window.open(url, '_blank');
        });

        window.addEventListener('message', function(event) {
            if (event.data === 'closed') {
                loading.close()
                window.location.reload()
            }
        })
    </script>
@endsection
