@extends('layouts.base')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> --}}
<style>
    .btn-white-custom {
        display: flex;
        align-items: center;
        background-color: rgb(253, 12, 12);
        color: black;
        border-color: #ffffff;
        /* Menjaga warna border asli */
    }

    .btn-white-custom:hover,
    .btn-white-custom:focus,
    .btn-white-custom.active {
        background-color: #202b3c;
        /* Warna asli saat aktif atau hover */
        color: rgb(255, 250, 250);
    }

    .left-align {
        display: flex;
        align-items: center;
    }

    .left-align span {
        font-size: 14px;
        /* Adjust the text size as needed */
    }

</style>

<div class="app-main__inner">

    <div class="tab-content">
        <div class="tab-pane  fade show active" id="" role="tabpanel">
            <div class="row">
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                            <h5 class="card-title">&nbsp;&nbsp;&nbsp;Pengaturan !</h5>
                            <div class="mb-3">&nbsp;
                                <a role="tab" class="btn btn-white  active" style="width: 280px;" id="wellcome"
                                    data-bs-toggle="tab" href="#tab-content-0">
                                    <div class="left-align">
                                        <i class="fa-solid fa-home"></i>&nbsp;&nbsp;<span>Wellcome</span>
                                    </div>
                                </a>
                            </div>
                            <div class="mb-3">&nbsp;
                                <a role="tab" class="btn btn-white " style="width: 280px;" id="lembaga"
                                    data-bs-toggle="tab" href="#tab-content-1">
                                    <div class="left-align">
                                        <i class="fa-solid fa-tree-city"></i>&nbsp;&nbsp;<span>Identitas Lembaga</span>
                                    </div>
                                </a>
                            </div>
                            <div class="mb-3">&nbsp;
                                <a role="tab" class="btn btn-white " style="width: 280px;" id="pengelola"
                                    data-bs-toggle="tab" href="#tab-content-2">
                                    <div class="left-align">
                                        <i class="fa-solid fa-person-chalkboard"></i>&nbsp;&nbsp;<span>Sebutan
                                            Pengelola</span>
                                    </div>
                                </a>
                            </div>
                            <div class="mb-3">&nbsp;
                                <a role="tab" class="btn btn-white " style="width: 280px;" id="peminjam"
                                    data-bs-toggle="tab" href="#tab-content-3">
                                    <div class="left-align">
                                        <i class="fa-solid fa-chart-simple"></i>&nbsp;&nbsp;<span>Sistem Pinjaman</span>
                                    </div>
                                </a>
                            </div>
                            <div class="mb-3">&nbsp;
                                <a role="tab" class="btn btn-white " style="width: 280px;" id="asuransi"
                                    data-bs-toggle="tab" href="#tab-content-4">
                                    <div class="left-align">
                                        <i class="fa-solid fa-money-bill-transfer"></i>&nbsp;&nbsp;<span> Pengaturan
                                            Asuransi</span>
                                    </div>
                                </a>
                            </div>
                            <div class="mb-3">&nbsp;
                                <a role="tab" class="btn btn-white" style="width: 280px;" data-bs-toggle="tab"
                                    href="#tab-content-5">
                                    <div class="left-align">
                                        <i class="fa-solid fa-laptop-file"></i>&nbsp;&nbsp;<span>Redaksi SPK</span>
                                    </div>
                                </a>
                            </div>
                            <div class="mb-3">&nbsp;
                                <a role="tab" class="btn btn-white" style="width: 280px;" data-bs-toggle="tab"
                                    href="#tab-content-6">
                                    <div class="left-align">
                                        <i class="fa-solid fa-panorama"></i>&nbsp;&nbsp;<span>Logo</span>
                                    </div>
                                </a>
                            </div>
                            {{-- <div class="mb-3">&nbsp;
                                <a role="tab" class="btn btn-white" style="width: 280px;" data-bs-toggle="tab"
                                    href="#tab-content-7">
                                    <div class="left-align">
                                        <i class="fa-solid fa-camera-rotate"></i>&nbsp;&nbsp;<span>Whatsapp</span>
                                    </div>
                                </a>
                            </div> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Wellcome !!</h5>
                                        @include('sop.partials._wellcome')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                            <div class="row">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Identitas Lembaga</h5>
                                        @include('sop.partials._lembaga')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                            <div class="row">
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
                        <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                            <div class="row">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sistem Peminjam</h5>
                                        @include('sop.partials._pinjaman')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
                            <div class="row">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pengaturan Asuransi</h5>
                                        @include('sop.partials._asuransi')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-5" role="tabpanel">
                            <div class="row">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Redaksi Dokumen SPK</h5>
                                        @include('sop.partials._spk')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-6" role="tabpanel">
                            <div class="row">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Upload LOGO</h5>
                                        @include('sop.partials._logo')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-7" role="tabpanel">
                            <div class="row">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pengaturan Whatsapp</h5>
                                        @include('sop.partials._whatsapp')
                                    </div>
                                </div>
                            </div>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.2/socket.io.min.js"></script> --}}

<script>
    const form = $('#FormWhatsapp')
    // const socket = io("{{ $api }}")
    const token = "{{ $token }}"
    const pesan = $('#Pesan')
    var scan = 0
    var connect = 0

    $(document).on('click', '#ScanWA', function (e) {
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

    // socket.on('qrCode', (res) => {
    //     if (res.token == token) {
    //         $('#QrCode').attr('src', res.url)

    //         if (scan < 1) {
    //             pesan.append('<li>' + res.msg + '</li>')
    //         }
    //         scan += 1
    //     }
    // })

    // socket.on('aktif', (res) => {
    //     if (res.token == token) {
    //         if (connect < 1) {
    //             $.ajax({
    //                 type: form.attr('method'),
    //                 url: form.attr('action'),
    //                 data: form.serialize(),
    //                 success: function(result) {
    //                     pesan.append('<li>' + res.msg + '</li>')
    //                     waActive()
    //                 }
    //             })
    //         }
    //         connect += 1
    //     }
    // })

    $(document).on('click', '#WaLogout', function (e) {
        e.preventDefault()

        $.ajax({
            type: 'post',
            url: '{{ $api }}/logout',
            data: {
                token: token
            },
            success: function (result) {
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
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    $(document).on('click', '.btn-simpan', async function (e) {
        e.preventDefault()

        if ($(this).attr('id') == 'SimpanSPK') {
            await $('#spk').val(quill.container.firstChild.innerHTML)
        }

        var form = $($(this).attr('data-target'))
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function (result) {
                if (result.success) {
                    Toastr('success', result.msg)

                    if (result.nama_lembaga) {
                        $('#nama_lembaga_sort').html(result.nama_lembaga)
                    }
                }
            },
            error: function (result) {
                const respons = result.responseJSON;

                Swal.fire('Error', 'Cek kembali input yang anda masukkan', 'error')
                $.map(respons, function (res, key) {
                    $('#' + key).parent('.input-group.input-group-static').addClass(
                        'is-invalid')
                    $('#msg_' + key).html(res)
                })
            }
        })
    })

    $(document).on('click', '#EditLogo', function (e) {
        e.preventDefault()

        $('#logo_kec').trigger('click')
    })

    $(document).on('change', '#logo_kec', function (e) {
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
                success: function (result) {
                    if (result.success) {
                        var reader = new FileReader();

                        reader.onload = function () {
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
