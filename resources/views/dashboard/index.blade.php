@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
                <div class="row">
                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Orders</div>
                                        <div class="widget-subheading">Last year expenses</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-success">1896</div>
                                    </div>
                                </div>
                                <div class="widget-progress-wrapper">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;"></div>
                                    </div>
                                    <div class="progress-sub-label">
                                        <div class="sub-label-left">YoY Growth</div>
                                        <div class="sub-label-right">100%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Clients</div>
                                        <div class="widget-subheading">Total Clients Profit</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-primary">$12.6k</div>
                                    </div>
                                </div>
                                <div class="widget-progress-wrapper">
                                    <div class="progress-bar-lg progress-bar-animated progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100" style="width: 47%;"></div>
                                    </div>
                                    <div class="progress-sub-label">
                                        <div class="sub-label-left">Retention</div>
                                        <div class="sub-label-right">100%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Products Sold</div>
                                        <div class="widget-subheading">Total revenue streams</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning">$3M</div>
                                    </div>
                                </div>
                                <div class="widget-progress-wrapper">
                                    <div class="progress-bar-xs progress-bar-animated-alt progress">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                    </div>
                                    <div class="progress-sub-label">
                                        <div class="sub-label-left">Sales</div>
                                        <div class="sub-label-right">100%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="divider mt-0" style="margin-bottom: 30px;"></div>
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="mb-3 card">
                        <div class="card-header-tab card-header-tab-animation card-header">
                            <div class="card-header-title">
                                <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                                Sales Report
                            </div>
                            <ul class="nav">
                                <li class="nav-item"><a href="javascript:void(0);"
                                        class="active nav-link">Last</a></li>
                                <li class="nav-item"><a href="javascript:void(0);"
                                        class="nav-link second-tab-toggle">Current</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabs-eg-77">
                                    <div class="card mb-3 widget-chart widget-chart2 text-start w-100">
                                        <div class="widget-chat-wrapper-outer">
                                            <div
                                                class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                                <div class="chart-container">
                                                    <canvas id="chart-vert-bar" style="height: 227px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted text-uppercase font-size-md opacity-5 fw-normal">Top
                                        Authors</h6>
                                    <div class="scroll-area-sm">
                                        <div class="scrollbar-container">
                                            <ul
                                                class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left me-3">
                                                                <img width="42" class="rounded-circle"
                                                                    src="assets/images/avatars/9.jpg" alt="">
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Ella-Rose Henry
                                                                </div>
                                                                <div class="widget-subheading">Web Developer
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="font-size-xlg text-muted">
                                                                    <small class="opacity-5 pe-1">$</small>
                                                                    <span>129</span>
                                                                    <small class="text-danger ps-2">
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left me-3">
                                                                <img width="42" class="rounded-circle"
                                                                    src="assets/images/avatars/5.jpg" alt="">
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Ruben Tillman</div>
                                                                <div class="widget-subheading">UI Designer</div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="font-size-xlg text-muted">
                                                                    <small class="opacity-5 pe-1">$</small>
                                                                    <span>54</span>
                                                                    <small class="text-success ps-2">
                                                                        <i class="fa fa-angle-up"></i>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left me-3">
                                                                <img width="42" class="rounded-circle"
                                                                    src="assets/images/avatars/4.jpg" alt="">
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Vinnie Wagstaff
                                                                </div>
                                                                <div class="widget-subheading">Java Programmer
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="font-size-xlg text-muted">
                                                                    <small class="opacity-5 pe-1">$</small>
                                                                    <span>429</span>
                                                                    <small class="text-warning ps-2">
                                                                        <i class="fa fa-dot-circle"></i>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left me-3">
                                                                <img width="42" class="rounded-circle"
                                                                    src="assets/images/avatars/3.jpg" alt="">
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Ella-Rose Henry
                                                                </div>
                                                                <div class="widget-subheading">Web Developer
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="font-size-xlg text-muted">
                                                                    <small class="opacity-5 pe-1">$</small>
                                                                    <span>129</span>
                                                                    <small class="text-danger ps-2">
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left me-3">
                                                                <img width="42" class="rounded-circle"
                                                                    src="assets/images/avatars/2.jpg" alt="">
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Ruben Tillman</div>
                                                                <div class="widget-subheading">UI Designer</div>
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <div class="font-size-xlg text-muted">
                                                                    <small class="opacity-5 pe-1">$</small>
                                                                    <span>54</span>
                                                                    <small class="text-success ps-2">
                                                                        <i class="fa fa-angle-up"></i>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="mb-3 card">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title">
                                <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                                Bandwidth Reports
                            </div>
                            <div class="btn-actions-pane-right">
                                <div class="nav">
                                    <a href="javascript:void(0);"
                                        class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-alternate">Tab
                                        1</a>
                                    <a href="javascript:void(0);"
                                        class="ms-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt">Tab
                                        2</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tab-eg-55">
                                <div class="widget-chart p-3">
                                    <div style="height: 350px">
                                        <canvas id="line-chart"></canvas>
                                    </div>
                                    <div class="widget-chart-content text-center mt-5">
                                        <div class="widget-description mt-0 text-warning">
                                            <i class="fa fa-arrow-left"></i>
                                            <span class="ps-1">175.5%</span>
                                            <span class="text-muted opacity-8 ps-1">increased server
                                                resources</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
   {{-- Modal Tagihan --}}
   <div class="modal fade" id="tagihanPinjaman" aria-labelledby="tagihanPinjamanLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tagihanPinjamanLabel">Tagihan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="TbTagihan"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-github btn-sm" id="KirimPesan">Kirim Pesan</button>
                <button type="button" class="btn btn-danger btn-sm" id="closeTagihan">Tutup</button>
            </div>
        </div>
    </div>
</div>

<form action="/pelaporan/preview" method="post" id="FormLaporanDashboard" target="_blank">
    @csrf

    <input type="hidden" name="type" id="type" value="pdf">
    <input type="hidden" name="tahun" id="tahun" value="{{ date('Y') }}">
    <input type="hidden" name="bulan" id="bulan" value="{{ date('m') }}">
    <input type="hidden" name="hari" id="hari" value="{{ date('d') }}">
    <input type="hidden" name="laporan" id="laporan" value="">
    <input type="hidden" name="sub_laporan" id="sub_laporan" value="">
</form>

@php
    $p = $saldo[4];
    $b = $saldo[5];
    $surplus = $saldo['surplus'];
@endphp

<textarea name="msgInvoice" id="msgInvoice" class="d-none">{{ Session::get('msg') }}</textarea>
@section('script')
    <script>
        $(".date").flatpickr({
            dateFormat: "d/m/Y"
        })

        $.ajax({
            type: 'post',
            url: '/dashboard/jatuh_tempo',
            data: $('#defaultForm').serialize(),
            success: function(result) {
                if (result.success) {
                    $('#jatuh_tempo').html(result.jatuh_tempo)

                    if (result.jatuh_tempo != '00') {
                        $('#TbHariIni').html(result.hari_ini)
                    }
                }
            }
        })

        $.ajax({
            type: 'post',
            url: '/dashboard/nunggak',
            data: $('#defaultForm').serialize(),
            success: function(result) {
                if (result.success) {
                    $('#nunggak').html(result.nunggak)

                    if (result.nunggak != '00') {
                        $('#TbMenunggak').html(result.table)
                    }
                }
            }
        })

        function tagihan() {
            var tgl_tagihan = $('#tgl_tagihan').val()

            $.ajax({
                url: '/dashboard/tagihan',
                type: 'post',
                data: $('#formTagihan').serialize(),
                success: function(result) {
                    if (result.success) {
                        $('#TbTagihan').html(result.tagihan)
                        $('#tagihanPinjaman').modal('show')
                    }
                }
            })
        }

        $(document).on('click', '#CekTagihan', function(e) {
            e.preventDefault()

            tagihan()
        })

        $(document).on('click', '#closeTagihan', function() {
            $('#tagihanPinjaman').modal('hide')
            $('#jatuhTempo').modal('show')
        })

        $.get('/dashboard/pinjaman?status=P', function(result) {
            if (result.success) {
                $('#tbProposal').html(result.table)
            }
        })

        $.get('/dashboard/pinjaman?status=V', function(result) {
            if (result.success) {
                $('#tbVerifikasi').html(result.table)
            }
        })

        $.get('/dashboard/pinjaman?status=W', function(result) {
            if (result.success) {
                $('#tbWaiting').html(result.table)
            }
        })

        $.get('/dashboard/pinjaman?status=A', function(result) {
            if (result.success) {
                $('#tbKelompok').html(result.table)
            }
        })

        $.get('/dashboard/pemanfaat?status=A', function(result) {
            if (result.success) {
                $('#tbPemanfaat').html(result.table)
            }
        })

        $(document).on('click', '#KirimPesan', function(e) {
            e.preventDefault()

            var form = $('#FormPemberitahuan')
            var values = $('[data-input=checked]:checked').map(function(i) {
                setTimeout(() => {
                    var pesan = this.value
                    var number = pesan.split('||')[0]
                    var kelompok = pesan.split('||')[1]
                    var msg = pesan.split('||')[2]

                    sendMsg(number, kelompok, msg)
                }, i * 1500);
            }).get();
        })

        function sendMsg(number, nama, msg, repeat = 0) {
            $.ajax({
                type: 'post',
                url: '{{ $api }}/send-text',
                timeout: 0,
                headers: {
                    "Content-Type": "application/json"
                },
                xhrFields: {
                    withCredentials: true
                },
                data: JSON.stringify({
                    token: "{{ auth()->user()->ip }}",
                    number: number,
                    text: msg
                }),
                success: function(result) {
                    if (result.status) {
                        MultiToast('success', 'Pesan untuk kelompok ' + nama + ' berhasil dikirim')
                    } else {
                        if (repeat < 1) {
                            setTimeout(function() {
                                sendMsg(number, nama, msg, repeat + 1)
                            }, 1000)
                        } else {
                            MultiToast('error', 'Pesan untuk kelompok ' + nama + ' gagal dikirim')
                        }
                    }
                },
                error: function(result) {
                    if (repeat < 1) {
                        setTimeout(function() {
                            sendMsg(number, nama, msg, repeat + 1)
                        }, 1000)
                    } else {
                        MultiToast('error', 'Pesan untuk kelompok ' + nama + ' gagal dikirim')
                    }
                }
            })
        }

        $(document).on('click', '#btnjatuhTempo', function(e) {
            e.preventDefault()

            $('#jatuhTempo').modal('show')


            let tab = $('#jatuhTempo').find('ul li a.active')
            if (tab.length > 0) {
                if (tab.attr('aria-controls') != 'tagihan') {
                    $('.btn-pelaporan').show()
                    setLaporan('5', tab.attr('aria-controls'))
                } else {
                    $('.btn-pelaporan').hide()
                }
            }
        })

        $(document).on('click', '#btnpinjaman', function(e) {
            e.preventDefault()

            $('#pinjaman').modal('show')
            $('.btn-pelaporan').show()

            let tab = $('#pinjaman').find('ul li a.active')
            if (tab.length > 0) {
                setLaporan('5', tab.attr('aria-controls'))
            }
        })

        $(document).on('click', '#btnAktif', function(e) {
            e.preventDefault()

            $('#aktif').modal('show')
            $('.btn-pelaporan').show()

            let tab = $('#aktif').find('ul li a.active')
            if (tab.length > 0) {
                setLaporan('5', tab.attr('aria-controls'))
            }
        })

        $(document).on('click', '.nav.nav-pills .nav-item', function() {
            var a = $(this).find('a')

            if (a.attr('aria-controls') == 'tagihan') {
                $('.btn-pelaporan').hide()
            } else {
                $('.btn-pelaporan').show()
            }
            setLaporan('5', a.attr('aria-controls'))
        })

        $(document).on('click', '.btn-pelaporan', function(e) {
            $('#FormLaporanDashboard').submit()
        })

        function setLaporan(laporan, subLaporan = null) {
            $('#FormLaporanDashboard #laporan').val(laporan);
            $('#FormLaporanDashboard #sub_laporan').val(subLaporan);
        }
    </script>

    @if (Session::get('invoice'))
        <script>
            function msgInvoice(number, msg, repeat = 0) {
                $.ajax({
                    type: 'post',
                    url: '{{ $api }}/send-text',
                    timeout: 0,
                    headers: {
                        "Content-Type": "application/json"
                    },
                    xhrFields: {
                        withCredentials: true
                    },
                    data: JSON.stringify({
                        token: "33081920220815",
                        number: number,
                        text: msg
                    }),
                    success: function(result) {
                        if (!result.status) {
                            setTimeout(function() {
                                msgInvoice(number, msg, repeat + 1)
                            }, 1000)
                        }
                    },
                    error: function(result) {
                        if (repeat < 1) {
                            setTimeout(function() {
                                msgInvoice(number, msg, repeat + 1)
                            }, 1000)
                        }
                    }
                })
            }

            msgInvoice("{{ Session::get('hp_dir') }}", $('#msgInvoice').val())
            setTimeout(() => {
                msgInvoice('0882006644656', $('#msgInvoice').val())
            }, 1000);
        </script>
    @endif

    <script>
        var formatter = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        })

        var ctx1 = document.getElementById("chart-line").getContext("2d");
        var ctx2 = document.getElementById("chart-pie").getContext("2d");

        // Line chart
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agu",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
                datasets: [{
                        label: "Pendapatan",
                        tension: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "#4CAF50",
                        pointBorderColor: "transparent",
                        borderColor: "#4CAF50",
                        borderWidth: 2,
                        backgroundColor: "transparent",
                        fill: true,
                        data: [
                            "{{ $p['1'] }}",
                            "{{ $p['2'] }}",
                            "{{ $p['3'] }}",
                            "{{ $p['4'] }}",
                            "{{ $p['5'] }}",
                            "{{ $p['6'] }}",
                            "{{ $p['7'] }}",
                            "{{ $p['8'] }}",
                            "{{ $p['9'] }}",
                            "{{ $p['10'] }}",
                            "{{ $p['11'] }}",
                            "{{ $p['12'] }}"
                        ],
                        maxBarThickness: 6
                    },
                    {
                        label: "Beban",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "#fb8c00",
                        pointBorderColor: "transparent",
                        borderColor: "#fb8c00",
                        borderWidth: 2,
                        backgroundColor: "transparent",
                        fill: true,
                        data: [
                            "{{ $b['1'] }}",
                            "{{ $b['2'] }}",
                            "{{ $b['3'] }}",
                            "{{ $b['4'] }}",
                            "{{ $b['5'] }}",
                            "{{ $b['6'] }}",
                            "{{ $b['7'] }}",
                            "{{ $b['8'] }}",
                            "{{ $b['9'] }}",
                            "{{ $b['10'] }}",
                            "{{ $b['11'] }}",
                            "{{ $b['12'] }}"
                        ],
                        maxBarThickness: 6
                    },
                    {
                        label: "Laba",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "#1A73E8",
                        pointBorderColor: "transparent",
                        borderColor: "#1A73E8",
                        borderWidth: 2,
                        backgroundColor: "transparent",
                        fill: true,
                        data: [
                            "{{ $surplus['1'] }}",
                            "{{ $surplus['2'] }}",
                            "{{ $surplus['3'] }}",
                            "{{ $surplus['4'] }}",
                            "{{ $surplus['5'] }}",
                            "{{ $surplus['6'] }}",
                            "{{ $surplus['7'] }}",
                            "{{ $surplus['8'] }}",
                            "{{ $surplus['9'] }}",
                            "{{ $surplus['10'] }}",
                            "{{ $surplus['11'] }}",
                            "{{ $surplus['12'] }}"
                        ],
                        maxBarThickness: 6
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: '#c1c4ce5c'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7',
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            borderDash: [5, 5],
                            color: '#c1c4ce5c'
                        },
                        ticks: {
                            display: true,
                            color: '#9ca2b7',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        // Pie chart
        new Chart(ctx2, {
            type: "pie",
            data: {
                labels: [
                    'SPP Pokok',
                    'SPP Jasa',
                    'UEP Pokok',
                    'UEP Jasa',
                    'PL Pokok',
                    'PL Jasa'
                ],
                datasets: [{
                    label: "Projects",
                    weight: 9,
                    cutout: 0,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 1,
                    backgroundColor: [
                        '#1a73e8',
                        '#4caf50',
                        '#344767',
                        '#7b809a',
                        '#f44335',
                        '#fb8c00',
                    ],
                    data: [
                        "{{ $pokok_spp }}",
                        "{{ $jasa_spp }}",
                        "{{ $pokok_uep }}",
                        "{{ $jasa_uep }}",
                        "{{ $pokok_pl }}",
                        "{{ $jasa_pl }}",
                    ],
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            color: '#c1c4ce5c'
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            color: '#c1c4ce5c'
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });

        var total_angsur =
            "{{ $pokok_spp + $jasa_spp + $pokok_uep + $jasa_uep + $pokok_pl + $jasa_pl }}"

        $('#total_angsur').html(formatter.format(total_angsur))

        let childWindow, loading;
        $(document).on('click', '#simpanSaldo', function(e) {
            var link = $(this).attr('data-href')

            loading = Swal.fire({
                title: "Mohon Menunggu..",
                html: "Menyimpan Saldo Januari sampai Desember Th. {{ date('Y') }}",
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })

            childWindow = window.open(link, '_blank');
        })

        window.addEventListener('message', function(event) {
            if (event.data === 'closed') {
                loading.close()
                window.location.reload()
            }
        })
    </script>
@endsection
