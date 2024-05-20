@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
        <div class="tab-content">
            <br>
            <div class="row">

                <div class="col-md-9">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3"><label for="exampleState">Tanggal
                                                Transaksi</label><input name="" id="exampleState"
                                                placeholder="with a placeholder" type="date" class="form-control"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Jenis Transaksi</label><input name="password"
                                                id="exampleState" placeholder="password placeholder" type="password"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Sumber Dana</label><input name="text"
                                                id="exampleState" placeholder="with a placeholder" type="text"
                                                class="form-control"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Disimpan Ke</label><input name="password"
                                                id="exampleState" placeholder="password placeholder" type="password"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Keterangan</label><input name="state" id="exampleState"
                                                type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Nominal Rp.</label><input name="state"
                                                id="exampleState" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <style>
                                        .btn--text {
                                            color: white;
                                            font-weight: bold;

                                        }
                                    </style>
                                    <button class="mt-2 btn btn-focus btn--text">SIMPAN TRANSAKSI</button>
                                </div><br>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-12 card">

                        <div class="card-body">
                            <form class="">
                                <div class="d-flex justify-content-between">
                                    <div class="text-sm">Saldo:</div>
                                    <div class="text-sm fw-bold">
                                        Rp. <span id="saldo">0.00</span>
                                    </div>
                                </div>

                                <hr class="horizontal dark">
                                <div class="text-sm fw-bold text-center">Cetak Buku Bantu</div>
                                <hr class="horizontal dark mb-0">
                                <div class="row">
                                    <div class="position-relative mb-3"><label for="tahun"
                                            class="form-label">Tahunan</label>
                                        <select class="form-control" name="tahun" id="tahun">
                                            @php
                                                $tgl_pakai = $kec->tgl_pakai;
                                                $th_pakai = explode('-', $tgl_pakai)[0];
                                            @endphp
                                            @for ($i = $th_pakai; $i <= date('Y'); $i++)
                                                <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        <small class="text-danger" id="msg_tahun"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Bulanan</label>
                                            <select class="form-control" name="bulan" id="bulan">
                                                <option value="">--</option>
                                                <option {{ date('m') == '01' ? 'selected' : '' }} value="01">01.
                                                    JANUARI</option>
                                                <option {{ date('m') == '02' ? 'selected' : '' }} value="02">02.
                                                    FEBRUARI</option>
                                                <option {{ date('m') == '03' ? 'selected' : '' }} value="03">03.
                                                    MARET</option>
                                                <option {{ date('m') == '04' ? 'selected' : '' }} value="04">04.
                                                    APRIL</option>
                                                <option {{ date('m') == '05' ? 'selected' : '' }} value="05">05. MEI
                                                </option>
                                                <option {{ date('m') == '06' ? 'selected' : '' }} value="06">06.
                                                    JUNI</option>
                                                <option {{ date('m') == '07' ? 'selected' : '' }} value="07">07.
                                                    JULI</option>
                                                <option {{ date('m') == '08' ? 'selected' : '' }} value="08">08.
                                                    AGUSTUS</option>
                                                <option {{ date('m') == '09' ? 'selected' : '' }} value="09">09.
                                                    SEPTEMBER
                                                </option>
                                                <option {{ date('m') == '10' ? 'selected' : '' }} value="10">10.
                                                    OKTOBER</option>
                                                <option {{ date('m') == '11' ? 'selected' : '' }} value="11">11.
                                                    NOVEMBER
                                                </option>
                                                <option {{ date('m') == '12' ? 'selected' : '' }} value="12">12.
                                                    DESEMBER
                                                </option>
                                            </select>
                                            <small class="text-danger" id="msg_bulan"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="position-relative mb-3"><label for="exampleState"
                                                class="form-label">Harian</label>
                                            <select class="form-control" name="tanggal" id="tanggal">
                                                <option value="">--</option>
                                                @for ($j = 1; $j <= 31; $j++)
                                                    @php $no=str_pad($j, 2, "0" , STR_PAD_LEFT) @endphp
                                                    <option value="{{ $no }}">{{ $no }}</option>
                                                @endfor
                                            </select>
                                            <small class="text-danger" id="msg_tanggal"></small>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <style>
                                        .btn--text {
                                            color: rgb(255, 255, 255);
                                            font-weight: bold;

                                        }
                                    </style>
                                    <button class="mt-2 btn btn-success btn--text">DETAIL TRANSAKSI</button>
                                </div>

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
        var formatter = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        })

        var jenis_transaksi = new Choices($('#jenis_transaksi')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })
        var sumber = new Choices($('#sumber_dana')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })
        var simpan = new Choices($('#disimpan_ke')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })
        var selectTahun = new Choices($('select#tahun')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })
        var selectBulan = new Choices($('select#bulan')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })
        new Choices($('select#tanggal')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })

        $(".date").flatpickr({
            dateFormat: "d/m/Y"
        })

        $("#nominal").maskMoney({
            allowNegative: true
        });

        $(document).on('change', '#jenis_transaksi', function(e) {
            e.preventDefault()

            if ($(this).val().length > 0) {
                $.get('/transaksi/ambil_rekening/' + $(this).val(), function(result) {
                    $('#kd_rekening').html(result)
                })
            }
        })

        $(document).on('change', '#tgl_transaksi', function(e) {
            e.preventDefault()

            var tgl_transaksi = $(this).val().split('/')
            var tahun = tgl_transaksi[2];
            var bulan = tgl_transaksi[1];
            var hari = tgl_transaksi[0];

            selectTahun.setChoiceByValue(tahun)
            selectBulan.setChoiceByValue(bulan)
        })

        $(document).on('change', '#sumber_dana', function(e) {
            e.preventDefault()
            var sumber_dana = $(this).val()

            if (sumber_dana == '1.2.02.01') {
                simpan.setChoiceByValue('5.1.07.08')
            }

            if (sumber_dana == '1.2.02.02') {
                simpan.setChoiceByValue('5.1.07.09')
            }

            if (sumber_dana == '1.2.02.03') {
                simpan.setChoiceByValue('5.1.07.10')
            }

            var tgl_transaksi = $('#tgl_transaksi').val().split('/')
            var tahun = tgl_transaksi[2];
            var bulan = tgl_transaksi[1];
            var hari = tgl_transaksi[0];

            $.get('/trasaksi/saldo/' + sumber_dana + '?tahun=' + tahun + '&bulan=' + bulan + '&hari=' + hari,
                function(result) {
                    $('#saldo').html(formatter.format(result.saldo))
                })
        })

        $(document).on('change', '#sumber_dana,#disimpan_ke', function(e) {
            e.preventDefault()

            var tgl_transaksi = $('#tgl_transaksi').val()
            var jenis_transaksi = $('#jenis_transaksi').val()
            var sumber_dana = $('#sumber_dana').val()
            var disimpan_ke = $('#disimpan_ke').val()

            $.get('/transaksi/form_nominal/', {
                jenis_transaksi,
                sumber_dana,
                disimpan_ke,
                tgl_transaksi
            }, function(result) {
                $('#form_nominal').html(result)
            })
        })

        $(document).on('change', '#harga_satuan,#jumlah', function(e) {
            var harga = ($('#harga_satuan').val()) ? $('#harga_satuan').val() : 0
            var jumlah = ($('#jumlah').val()) ? $('#jumlah').val() : 0

            harga = parseInt(harga.split(',').join('').split('.00').join(''))

            var harga_perolehan = harga * jumlah
            $('#harga_perolehan').val(formatter.format(harga_perolehan))
        })

        $(document).on('click', '#SimpanTransaksi', function(e) {
            e.preventDefault()
            $('small').html('')
            $('#notifikasi').html('')

            var form = $('#FormTransaksi')
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        Swal.fire('Berhasil', result.msg, 'success').then(() => {
                            jenis_transaksi.setChoiceByValue('')

                            $('#notifikasi').html(result.view)
                            var sumber_dana = $('#sumber_dana').val()
                            var tgl_transaksi = $('#tgl_transaksi').val().split('/')
                            var tahun = tgl_transaksi[2];
                            var bulan = tgl_transaksi[1];
                            var hari = tgl_transaksi[0];

                            $.get('/trasaksi/saldo/' + sumber_dana + '?tahun=' + tahun +
                                '&bulan=' + bulan + '&hari=' + hari,
                                function(res) {
                                    $('#saldo').html(formatter.format(res.saldo))
                                })
                        })
                    } else {
                        Swal.fire('Error', result.msg, 'error')
                    }
                },
                error: function(result) {
                    const respons = result.responseJSON;

                    Swal.fire('Error', 'Cek kembali input yang anda masukkan', 'error')
                    $.map(respons, function(res, key) {
                        $('#' + key).parent('.input-group.input-group-static').addClass(
                            'is-invalid')
                        $('#msg_' + key).html(res)
                    })
                }
            })
        })

        $(document).on('change', '#nama_barang', function(e) {
            var value = $(this).val().split('#')

            var id = value[0]
            var unit = parseInt(value[1])
            var nilai_buku = parseInt(value[2])

            var harga = nilai_buku / unit

            $('#unit').attr('max', unit)

            $('#unit').val(unit)
            $('#harsat').val(harga)
            $('#nilai_buku').val(formatter.format(nilai_buku))
            $('#harga_jual').val(formatter.format(nilai_buku))
        })

        $(document).on('change', '#unit', function() {
            var max = parseInt($(this).attr('max'))
            var unit = parseInt($(this).val())

            if (unit > max) {
                $(this).val(max)
                unit = max
            }

            if (unit < 1) {
                $(this).val(max)
                unit = max
            }

            var harga = parseInt($('#harsat').val())
            var nilai_buku = unit * harga

            $('#nilai_buku').val(formatter.format(nilai_buku))
            $('#harga_jual').val(formatter.format(nilai_buku))
        })

        $(document).on('change', '#alasan', function() {
            var status = $(this).val()
            console.log(status)

            if (status == "dijual") {
                $('#col_nilai_buku,#col_unit').attr('class', 'col-sm-4')
                $('#col_harga_jual').show()
                $("#col_harga_jual").focus()
            } else {
                $('#col_nilai_buku,#col_unit').attr('class', 'col-sm-6')
                $('#col_harga_jual').hide()
            }
        })

        $(document).on('click', '#BtndetailTransaksi', function(e) {
            var tahun = $('select#tahun').val()
            var bulan = $('select#bulan').val()
            var hari = $('select#tanggal').val()
            var kode_akun = $('#sumber_dana').val()

            if (kode_akun != '') {
                $.ajax({
                    url: '/transaksi/detail_transaksi',
                    type: 'get',
                    data: {
                        tahun,
                        bulan,
                        hari,
                        kode_akun
                    },
                    success: function(result) {
                        $('#detailTransaksi').modal('show')

                        $('#detailTransaksiLabel').html(result.label)
                        $('#LayoutdetailTransaksi').html(result.view)

                        $('#CetakBuktiTransaksiLabel').html(result.label)
                        $('#LayoutCetakBuktiTransaksi').html(result.cetak)
                    }
                })
            }
        })

        $(document).on('click', '#BtnCetakBuktiTransaksi', function(e) {
            e.preventDefault()

            $('#CetakBuktiTransaksi').modal('toggle')
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

        $(document).on('click', '.btn-link', function(e) {
            var action = $(this).attr('data-action')

            open_window(action)
        })

        $(document).on('click', '.btn-reversal', function(e) {
            e.preventDefault()

            var idt = $(this).attr('data-idt')
            $.get('/transaksi/data/' + idt, function(result) {

                $('#rev_idt').val(result.idt)
                $('#rev_idtp').val(result.idtp)
                $('#rev_id_pinj').val(result.id_pinj)
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Setelah menekan tombol Reversal dibawah, maka aplikasi akan membuat transaksi minus (-) senilai Rp. -' +
                        result.jumlah,
                    showCancelButton: true,
                    confirmButtonText: 'Reversal',
                    cancelButtonText: 'Batal',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $('#formReversal')
                        $.ajax({
                            type: form.attr('method'),
                            url: form.attr('action'),
                            data: form.serialize(),
                            success: function(result) {
                                if (result.success) {
                                    Swal.fire('Berhasil!', result.msg, 'success')
                                        .then(() => {
                                            $('#detailTransaksi').modal('hide')
                                        })
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault()

            var idt = $(this).attr('data-idt')
            $.get('/transaksi/data/' + idt, function(result) {

                $('#del_idt').val(result.idt)
                $('#del_idtp').val(result.idtp)
                $('#del_id_pinj').val(result.id_pinj)
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Setelah menekan tombol Hapus Transaksi dibawah, maka transaksi ini akan dihapus dari aplikasi secara permanen.',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus Transaksi',
                    cancelButtonText: 'Batal',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $('#formHapus')
                        $.ajax({
                            type: form.attr('method'),
                            url: form.attr('action'),
                            data: form.serialize(),
                            success: function(result) {
                                if (result.success) {
                                    Swal.fire('Berhasil!', result.msg, 'success')
                                        .then(() => {
                                            $('#detailTransaksi').modal('hide')
                                        })
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).on('click', '#BtnCetak', function(e) {
            e.preventDefault()

            $('#FormCetakDokumenTransaksi').submit()
        })

        function initializeBootstrapTooltip() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),
                tooltipList = tooltipTriggerList.map(function(e) {
                    return new bootstrap.Tooltip(e)
                });
        }
    </script>
@endsection
