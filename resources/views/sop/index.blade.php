@extends('layouts.base')

@section('content')
    <style>
        /* CSS untuk membuat tautan responsif */
        .nav-item {
            display: flex;
            justify-content: left;
        }


        /* Media query untuk mengatur lebar tautan pada layar kecil */
        @media (max-width: 576px) {
            .btn {
                width: 100%;
            }

            .sticky-navbar {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                top: 0;
                z-index: 1000;
                /* Ensure it stays above other content */
                background-color: white;
                /* Optional: to match the card's background */
            }

        }
    </style>
    <div class="app-main__inner">
        <div class="tab-content">
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-12 card position-sticky top-10">
                        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">&nbsp;&nbsp;&nbsp;
                            <li class="nav-item">
                                <a href="#lembaga" class="btn btn-outline-primary" active>
                                    <i class="fa-solid fa-tree-city"></i>
                                    <span>Identitas Lembaga</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#pengelola" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-person-chalkboard"></i>
                                    <span>Sebutan Pengelola</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#pinjaman" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-chart-simple"></i>
                                    <span>Sistem Pinjaman</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#asuransi" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-money-bill-transfer"></i>
                                    <span>Pengaturan Asuransi</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#redaksi_spk" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-laptop-file"></i>
                                    <span>Redaksi Dk.SPK</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#logo" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-panorama"></i>
                                    <span>Logo</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#whatsapp" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-camera-rotate"></i>
                                    <span>Whatsapp</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card" id="lembaga">
                        <div class="card-body">
                            <h5 class="card-title">Identitas Lembaga</h5>
                        </div>
                        <div class="card-body pt-0">
                            @include('sop.partials._lembaga')
                        </div>
                    </div>
                    <div class="main-card mb-3 card" id="pengelola">
                        <div class="card-body">
                            <h5 class="card-title">Sebutan Pengelola Lembaga</h5>
                        </div>
                        <div class="card-body pt-0">
                            @include('sop.partials._pengelola')
                        </div>
                    </div>
                    <div class="main-card mb-3 card" id="pinjaman">
                        <div class="card-body">
                            <h5 class="card-title">Sistem Pinjaman</h5>
                        </div>
                        <div class="card-body pt-0">
                            @include('sop.partials._pinjaman')
                        </div>
                    </div>
                    <div class="main-card mb-3 card" id="asuransi">
                        <div class="card-body">
                            <h5 class="card-title">Pengaturan Asuransi</h5>
                        </div>
                        <div class="card-body pt-0">
                            @include('sop.partials._asuransi')
                        </div>
                    </div>
                    <div class="main-card mb-3 card" id="redaksi_spk">
                        <div class="card-body">
                            <h5 class="card-title">Redaksi Dokumen SPK</h5>
                        </div>
                        <div class="card-body pt-0">
                            @include('sop.partials._spk')
                        </div>
                    </div>
                    <div class="main-card mb-3 card" id="logo">
                        <div class="card-body">
                            <h5 class="card-title">Upload Logo</h5>
                        </div>
                        <div class="card-body pt-0">
                            @include('sop.partials._logo')
                        </div>
                    </div>
                    <div class="main-card mb-3 card" id="whatsapp">
                        <div class="card-body">
                            <h5 class="card-title">Controls Types</h5>
                        </div>
                        <div class="card-body pt-0">
                            @include('sop.partials._whatsapp')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form action="/pengaturan/whatsapp/{{ $token }}" method="post" id="FormWhatsapp">
        @csrf
    </form>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.2/socket.io.min.js"></script>

    <script>
        const form = $('#FormWhatsapp')
        const socket = io("{{ $api }}")
        const token = "{{ $token }}"
        const pesan = $('#Pesan')
        var scan = 0
        var connect = 0

        $(document).on('click', '#ScanWA', function(e) {
            e.preventDefault()

            Swal.fire({
                title: 'Peringatan',
                text: 'Kami selaku tim pengembang aplikasi SIDBM tidak bertanggung jawab jika terjadi sesuatu pada nomor anda ke depannya.',
                showCancelButton: true,
                confirmButtonText: 'Lanjutkan',
                cancelButtonText: 'Batal',
                icon: 'error'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#ModalScanWA').modal('show')
                    if (connect < 1) {
                        socket.emit('register', {
                            token
                        })
                    } else {
                        waActive()
                    }
                }
            })
        })

        socket.on('qrCode', (res) => {
            if (res.token == token) {
                $('#QrCode').attr('src', res.url)

                if (scan < 1) {
                    pesan.append('<li>' + res.msg + '</li>')
                }
                scan += 1
            }
        })

        socket.on('aktif', (res) => {
            if (res.token == token) {
                if (connect < 1) {
                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(result) {
                            pesan.append('<li>' + res.msg + '</li>')
                            waActive()
                        }
                    })
                }
                connect += 1
            }
        })

        $(document).on('click', '#WaLogout', function(e) {
            e.preventDefault()

            $.ajax({
                type: 'post',
                url: '{{ $api }}/logout',
                data: {
                    token: token
                },
                success: function(result) {
                    if (result.status) {
                        Swal.fire({
                            title: 'Selamat',
                            text: 'Anda telah logout dari SI DBM Whatsapp Gateway.',
                            showCancelButton: false,
                            icon: 'success'
                        }).then(() => {
                            scan = 0
                            connect = 0
                        })
                    }
                }
            })
        })

        function waActive() {
            Swal.fire({
                title: 'Selamat',
                text: 'SI DBM Whatsapp Gateway berhasil diaktifkan.',
                showCancelButton: false,
                icon: 'success'
            })
        }
    </script>

    <script>
        var tahun = "{{ date('Y') }}"
        var bulan = "{{ date('m') }}"

        $(".money").maskMoney();
        $(document).ready(function() {
        $('#spk').summernote();
        });
        
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        $(document).on('click', '.btn-simpan', async function(e) {
            e.preventDefault()

            if ($(this).attr('id') == 'SimpanSPK') {
                await $('#spk').val(quill.container.firstChild.innerHTML)
            }

            var form = $($(this).attr('data-target'))
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        Toastr('success', result.msg)

                        if (result.nama_lembaga) {
                            $('#nama_lembaga_sort').html(result.nama_lembaga)
                        }
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

        $(document).on('click', '#EditLogo', function(e) {
            e.preventDefault()

            $('#logo_kec').trigger('click')
        })

        $(document).on('change', '#logo_kec', function(e) {
            e.preventDefault()

            var logo = $(this).get(0).files[0]
            if (logo) {
                var form = $('#FormLogo')
                var formData = new FormData(document.querySelector('#FormLogo'));
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        if (result.success) {
                            var reader = new FileReader();

                            reader.onload = function() {
                                $("#previewLogo").attr("src", reader.result);
                                $(".colored-shadow").css('background-image',
                                    "url(" + reader.result + ")")
                            }

                            reader.readAsDataURL(logo);
                            Toastr('success', result.msg)
                        } else {
                            Toastr('error', result.msg)
                        }
                    }
                })
            }
        })
    </script>
@endsection
