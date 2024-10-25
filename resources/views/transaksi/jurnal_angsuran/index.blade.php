@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
        <div class="tab-content">
            <br>
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Tanggal Transaksi</label><input name=""
                                                id="exampleState" placeholder="with a placeholder" type="date"
                                                class="form-control"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Pokok</label><input name="password" id="exampleState"
                                                placeholder="password placeholder" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Denda</label><input name="text" id="exampleState"
                                                placeholder="with a placeholder" type="text" class="form-control"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Jasa</label><input name="password" id="exampleState"
                                                placeholder="password placeholder" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="exampleState" class="form-label">Total Bayar</label>
                                            <input name="state" id="exampleState" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <style>
                                        .btn--text {
                                            color: white;
                                            font-weight: bold;

                                        }
                                    </style>
                                    <button class="mt-2 btn btn-info btn--text">DETAIL KELOMPOK</button>
                                    <button class="mt-2 btn btn-warning btn--text">ANGSURAN ANGGOTA</button>
                                    <button class="mt-2 btn btn-secondary btn--text">POSTING</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-12 card">
                        <div class="card-body">
                            <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                <li class="nav-item">
                                    <a role="tab" class="nav-link active" id="tab-c1-0" data-bs-toggle="tab"
                                        href="#tab-animated1-0">
                                        <span class="nav-text"><b>Pokok</b></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a role="tab" class="nav-link" id="tab-c1-1" data-bs-toggle="tab"
                                        href="#tab-animated1-1">
                                        <span class="nav-text"><b>Jasa</b></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-animated1-0" role="tabpanel">
                                    <p class="mb-0">Lorem Ipsum has been the industry's standard dummy text ever
                                        since the 1500s, when an unknown printer took a galley of type and scrambled it
                                        to make a type specimen
                                        book.
                                        It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged. </p>
                                </div>
                                <div class="tab-pane" id="tab-animated1-1" role="tabpanel">
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                        1500s, when an
                                        unknown
                                        printer took a galley of type and scrambled it to make a type specimen book. It
                                        has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <style>
                                    .btn-white-text {
                                        color: white;
                                        font-weight: bold;
                                        width: 100%;
                                        /* Set the width to 100% to make buttons equally wide */
                                        max-width: 200px;
                                        /* Optional: set max-width to avoid buttons being too wide */
                                    }
                                </style>
                                <button class="mt-2 btn btn-success btn-white-text">KARTU</button>&nbsp;&nbsp;
                                <button class="mt-2 btn btn-danger btn-white-text">DETAIL</button>&nbsp;&nbsp;
                                <button class="mt-2 btn btn-info btn-white-text">LPP PER BULAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
            $("#exampleState").maskMoney({
            allowNegative: true
        });
        var formatter = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        })

        var pokok, jasa = 0;

        $("#pokok").maskMoney({
            allowNegative: true
        });

        $("#jasa").maskMoney({
            allowNegative: true
        });

        $("#denda").maskMoney({
            allowNegative: true
        });

        $("#total").maskMoney({
            allowNegative: true
        });


        $(".date").flatpickr({
            dateFormat: "d/m/Y"
        })

        var id_pinkel = '{{ Request::get('pinkel') ?: 0 }}'

        if (id_pinkel > 0) {
            var ch_pokok = document.getElementById('chartP').getContext("2d");
            var ch_jasa = document.getElementById('chartJ').getContext("2d");

            $.get('/transaksi/form_angsuran/' + id_pinkel, function(result) {
                angsuran(false, result)

                makeChart('pokok', ch_pokok, result.sisa_pokok, result.sum_pokok)
                makeChart('jasa', ch_jasa, result.sisa_jasa, result.sum_jasa)

                $('#loan-id').html(id_pinkel)

                var id = $('#id').val()
                $.get('/transaksi/angsuran/form_anggota/' + id, function(result) {
                    if (result.success) {
                        $('#LayoutAngsuranAnggota').html(result.view)
                        $('#AngsuranAnggotaLabel').text(result.title)
                    }
                })
            })
        }

        $(document).on('change', '#tgl_transaksi', function(e) {
            var tanggal = $(this).val()
            var id_pinj = $('#id').val()

            $.get('/transaksi/angsuran/target/' + id_pinj, {
                tanggal
            }, function(result) {
                $('#pokok').val(formatter.format(result.saldo_pokok))
                $('#jasa').val(formatter.format(result.saldo_jasa))
            })
        })

        $(document).on('change', '#pokok,#jasa,#denda', function(e) {
            var pokok = $('#pokok').val()
            var jasa = $('#jasa').val()
            var denda = $('#denda').val()

            pokok = parseFloat(pokok.split(',').join('').split('.00').join(''))
            if (!pokok) {
                pokok = 0;
                $('#pokok').val(formatter.format('0'))
            }

            jasa = parseFloat(jasa.split(',').join('').split('.00').join(''))
            if (!jasa) {
                jasa = 0;
                $('#jasa').val(formatter.format('0'))
            }

            denda = parseFloat(denda.split(',').join('').split('.00').join(''))
            if (!denda) {
                $('#denda').val(formatter.format('0'))
                denda = 0;
            }

            var total = pokok + jasa + denda
            $('#total').val(formatter.format(total))
        })

        $(document).on('click', '#SimpanAngsuran', function(e) {
            $('#notif').html('')
            e.preventDefault()

            var sisa_pokok = $('#_pokok').val()
            var pokok = $('#pokok').val()
            pokok = parseFloat(pokok.split(',').join('').split('.00').join(''))

            var next = true
            if (pokok > sisa_pokok) {
                Swal.fire('Error', 'Angsuran pokok tidak boleh melebihi saldo pinjaman saat ini.', 'warning')
                return false

                next = false
            }

            if (next == true) {
                var form = $('#FormAngsuran')
                var form2 = $('#FormAngsuranAnggota')

                var loading = Swal.fire({
                    title: "Mohon Menunggu..",
                    html: "Memproses transaksi angsuran.",
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })

                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize() + '&' + form2.serialize(),
                    success: function(result) {
                        var ch_pokok = document.getElementById('chartP').getContext("2d");
                        var ch_jasa = document.getElementById('chartJ').getContext("2d");

                        loading.close()
                        if (result.success) {
                            $.get('/angsuran/notifikasi/' + result.idtp, function(res) {
                                $('#notif').html(res.view)
                            })

                            Swal.fire('Berhasil!', result.msg, 'success').then(() => {
                                $.get('/transaksi/form_angsuran/' + result
                                    .id_pinkel,
                                    function(result) {
                                        angsuran(true, result)

                                        makeChart('pokok', ch_pokok, result
                                            .sisa_pokok, result
                                            .sum_pokok)
                                        makeChart('jasa', ch_jasa, result
                                            .sisa_jasa,
                                            result.sum_jasa)

                                        var id = $('#id').val()
                                        $.get('/transaksi/angsuran/form_anggota/' +
                                            id,
                                            function(result) {
                                                if (result.success) {
                                                    $('#LayoutAngsuranAnggota')
                                                        .html(result
                                                            .view)
                                                    $('#AngsuranAnggotaLabel')
                                                        .text(result
                                                            .title)
                                                }
                                            })
                                    })
                            })

                            if (result.whatsapp) {
                                sendMsg(result.number, result.nama_kelompok, result
                                    .pesan)
                            }
                        } else {
                            loading.close()
                            Swal.fire('Error', result.msg, 'warning')
                        }
                    },
                    error: function(e) {
                        loading.close()
                        Swal.fire('Error', '', 'warning')
                    }
                })
            }
        })

        $(document).on('click', '#cetakKartuAngsuran', function(e) {
            e.preventDefault()
            var id_pinj = $('#id').val()

            Swal.fire({
                title: "Cetak Kartu Angsuran",
                showDenyButton: true,
                confirmButtonText: "Angsuran Kelompok",
                denyButtonText: "Angsuran Anggota",
                confirmButtonColor: "#3085d6",
                denyButtonColor: "#3085d6",
            }).then((result) => {
                if (result.isConfirmed) {
                    open_window('/perguliran/dokumen/kartu_angsuran/' + id_pinj)
                } else if (result.isDenied) {
                    open_window('/perguliran/dokumen/kartu_angsuran_anggota/' + id_pinj)
                }
            });
        })

        $(document).on('click', '#cetakLPP', function(e) {
            e.preventDefault()
            var id_pinj = $('#id').val()

            open_window('/transaksi/angsuran/lpp/' + id_pinj)
        })

        $(document).on('click', '#btnDetailKelompok', function(e) {
            var id = $('#id').val()

            $.get('/database/kelompok/detail_kelompok/' + id, function(result) {
                $('#DetailKelompok').modal('show')

                $('#DetailKelompokLabel').html(result.label)
                $('#LayoutDetailKelompok').html(result.view)
            })
        })

        $(document).on('click', '#btnDetailAngsuran', function(e) {
            var id = $('#id').val()

            $.get('/transaksi/angsuran/detail_angsuran/' + id, function(result) {
                $('#DetailAngsuran').modal('show')

                $('#DetailAngsuranLabel').html(result.label)
                $('#LayoutDetailAngsuran').html(result.view)

                $('#BuktiAngsuranLabel').html(result.label_cetak)
                $('#LayoutBuktiAngsuran').html(result.cetak)
            })
        })

        $(document).on('click', '#cetakBuktiAngsuran, #tutupBuktiAngsuran', function(e) {
            e.preventDefault()

            $('#BuktiAngsuran').modal('toggle');
        })     

        $(document).on('click', '#BtnCetakBkm', function(e) {
            e.preventDefault()

            $('#FormCetakBuktiAngsuran').attr('action', '/transaksi/angsuran/cetak_bkm');
            $('#FormCetakBuktiAngsuran').submit();
        })

        $(document).on('click', '#btnAngsuranAnggota', function(e) {
            e.preventDefault()
            $('#AngsuranAnggota').modal('show')
        })

        $(document).on('click', '.btn-link', function(e) {
            var action = $(this).attr('data-action')

            open_window(action)
        })

        $(document).on('click', '.btn-struk', function(e) {
            e.preventDefault()

            var idtp = $(this).attr('data-idtp')
            Swal.fire({
                title: "Cetak Kuitansi Angsuran",
                showDenyButton: true,
                confirmButtonText: "Biasa",
                denyButtonText: "Dot Matrix",
                confirmButtonColor: "#3085d6",
                denyButtonColor: "#3085d6",
            }).then((result) => {
                if (result.isConfirmed) {
                    open_window('/transaksi/angsuran/struk/' + idtp)
                } else if (result.isDenied) {
                    open_window('/transaksi/angsuran/struk_matrix/' + idtp)
                }
            });
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
    </script>
@endsection
