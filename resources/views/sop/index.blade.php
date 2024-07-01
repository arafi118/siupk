@extends('layouts.base')

@section('content')
<div class="app-main__inner">
    
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                            <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">&nbsp;&nbsp;
                                <li class="nav-item mb-1 me-1">
                                    <a role="tab" class="btn btn-outline-primary active" id="wellcome" data-bs-toggle="tab" href="#tab-content-0">
                                        <i class="fa-solid fa-home"></i>&nbsp;<span>Wellcome</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-1 me-1">
                                    <a role="tab" class="btn btn-outline-primary" id="lembaga" data-bs-toggle="tab" href="#tab-content-1">
                                        <i class="fa-solid fa-tree-city"></i>&nbsp;<span>Identitas Lembaga</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-1 me-1">
                                    <a role="tab" class="btn btn-outline-primary" id="pengelola" data-bs-toggle="tab" href="#tab-content-2">
                                        <i class="fa-solid fa-person-chalkboard"></i><span>Sebutan Pengelola</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-1 me-1">
                                    <a role="tab" class="btn btn-outline-primary" id="peminjam" data-bs-toggle="tab" href="#tab-content-3">
                                        <i class="fa-solid fa-chart-simple"></i>&nbsp; <span>Sistem Pinjaman</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-1 me-1">
                                    <a role="tab" class="btn btn-outline-primary" id="asuransi" data-bs-toggle="tab" href="#tab-content-4">
                                        <i class="fa-solid fa-money-bill-transfer"></i>&nbsp;<span> Peng. Asuransi</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-1 me-1">
                                    <a role="tab" class="btn btn-outline-primary" data-bs-toggle="tab" href="#tab-content-5">
                                        <i class="fa-solid fa-laptop-file"></i>&nbsp;<span>Redaksi SPK</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-1 me-1">
                                    <a role="tab" class="btn btn-outline-primary" id="logo " data-bs-toggle="tab" href="#tab-content-6">
                                        <i class="fa-solid fa-panorama"></i>&nbsp;<span>Logo</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-1 me-1">
                                    <a role="tab" class="btn btn-outline-primary" id="whatsapp" data-bs-toggle="tab" href="#tab-content-7">
                                        <i class="fa-solid fa-camera-rotate"></i>&nbsp;<span>Whatsapp</span>
                                    </a>
                                </li>&nbsp;
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Wellcome !!</h5>
                            @include('sop.partials._wellcome')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Identitas Lembaga</h5>
                            @include('sop.partials._lembaga')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Sebutan Pengelola Lembaga</h5>
                            <div class="position-relative mb-3">
                                @include('sop.partials._pengelola')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Sistem Peminjam</h5>
                            @include('sop.partials._pinjaman')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Pengaturan Asuransi</h5>
                            @include('sop.partials._asuransi')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane tabs-animation fade" id="tab-content-5" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Redaksi Dokumen SPK</h5>
                            <div class="position-relative mb-3">
                                @include('sop.partials._spk')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane tabs-animation fade" id="tab-content-6" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Upload LOGO</h5>
                            @include('sop.partials._logo')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane tabs-animation fade" id="tab-content-7" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Pengaturan Whatsapp</h5>
                            @include('sop.partials._whatsapp')
                        </div>
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
                text: 'Kami selaku tim pengembang aplikasi LKM tidak bertanggung jawab jika terjadi sesuatu pada nomor anda ke depannya.',
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
