@extends('layouts.base')

@section('content')
    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card position-sticky top-10">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item mb-2">
                        <b>Pengaturan</b>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#lembaga">
                            <i class="material-icons text-lg me-2">business</i>
                            <span class="text-sm">Identitas Lembaga</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#pengelola">
                            <i class="material-icons text-lg me-2">assignment_ind</i>
                            <span class="text-sm">Sebutan Pengelola</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#pinjaman">
                            <i class="material-icons text-lg me-2">equalizer</i>
                            <span class="text-sm">Sistem Pinjaman</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#asuransi">
                            <i class="material-icons text-lg me-2">account_balance_wallet</i>
                            <span class="text-sm">Pengaturan Asuransi</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#redaksi_spk">
                            <i class="material-icons text-lg me-2">description</i>
                            <span class="text-sm">Redaksi Dok. SPK</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#calk">
                            <i class="material-icons text-lg me-2">insert_drive_file</i>
                            <span class="text-sm">Pengaturan CALK</span>
                        </a>
                    </li> --}}
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#logo">
                            <i class="material-icons text-lg me-2">crop_original</i>
                            <span class="text-sm">Logo</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#whatsapp">
                            <i class="material-icons text-lg me-2">priority_high</i>
                            <span class="text-sm">Whatsapp</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9 mt-lg-0 mt-4">
            <div class="card" id="lembaga">
                <div class="card-header">
                    <h5 class="mb-0">Identitas Lembaga</h5>
                </div>
                <div class="card-body pt-0">
                    @include('sop.partials._lembaga')
                </div>
            </div>
            <div class="card mt-4" id="pengelola">
                <div class="card-header">
                    <h5 class="mb-0">Sebutan Pengelola Lembaga</h5>
                </div>
                <div class="card-body pt-0">
                    @include('sop.partials._pengelola')
                </div>
            </div>
            <div class="card mt-4" id="pinjaman">
                <div class="card-header">
                    <h5 class="mb-0">Sistem Pinjaman</h5>
                </div>
                <div class="card-body pt-0">
                    @include('sop.partials._pinjaman')
                </div>
            </div>
            <div class="card mt-4" id="asuransi">
                <div class="card-header">
                    <h5 class="mb-0">Pengaturan Asuransi</h5>
                </div>
                <div class="card-body pt-0">
                    @include('sop.partials._asuransi')
                </div>
            </div>
            <div class="card mt-4" id="redaksi_spk">
                <div class="card-header">
                    <h5 class="mb-0">Redaksi Dokumen SPK</h5>
                </div>
                <div class="card-body pt-0">
                    @include('sop.partials._spk')
                </div>
            </div>
            <div class="card mt-4" id="logo">
                <div class="card-header">
                    <h5 class="mb-0">Upload Logo</h5>
                </div>
                <div class="card-body pt-0">
                    @include('sop.partials._logo')
                </div>
            </div>
            <div class="card mt-4" id="whatsapp">
                <div class="card-header">
                    <h5 class="mb-0">Pengaturan Whatsapp</h5>
                </div>
                <div class="card-body pt-0">
                    @include('sop.partials._whatsapp')
                </div>
            </div>
        </div>

        {{-- Modal Scan Whatsapp --}}
        <div class="modal fade" id="ModalScanWA" tabindex="-1" aria-labelledby="ModalScanWALabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalScanWALabel">
                            Aktivasi Whatsapp Gateway
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="LayoutModalScanWA">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-5 col-lg-6 text-center">
                                            <img class="w-100 border-radius-lg shadow-lg mx-auto"
                                                src="/assets/img/no_image.png" id="QrCode" alt="chair">
                                        </div>
                                        <div class="col-lg-5 mx-auto">
                                            <h3 class="mt-lg-0 mt-4">Scan kode QR</h3>
                                            <ul class="list-group list-group-flush rounded" id="ListConnection">
                                                <li class="list-group-item">
                                                    Membuat Kode QR
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-warning btn-sm" id="WaLogout">Logout</button> --}}
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.5/socket.io.min.js"></script>

    <script>
        let ListContainer = $('#ListConnection')
        const API = '{{ $api }}'
        const form = $('#FormWhatsapp')
        const socket = io(API, {
            transports: ['polling']
        })

        const pesan = $('#Pesan')

        var scan = 0
        var connect = 0

        var socketId = 0;
        socket.on('connected', (res) => {
            console.log('Connected to the server. Socket ID:', res.id);
            socketId = res.id
        });

        $('#HapusWa').hide()
        $('#ScanWA').hide()
        $(document).ready(function() {
            $.get(API + '/api/client/{{ $token }}', function(result) {
                if (result.success && result.data) {
                    $('#HapusWa').show()
                    $('#ScanWA').hide()
                } else {
                    $('#ScanWA').show()
                    $('#HapusWa').hide()
                }

                console.log(result);

            })
        })

        $(document).on('click', '#ScanWA', function(e) {
            e.preventDefault()

            Swal.fire({
                title: 'Aktivasi Whatsapp',
                text: 'Scan Whatsapp aplikasi SIDBM.',
                showCancelButton: true,
                confirmButtonText: 'Lanjutkan',
                cancelButtonText: 'Batal',
                icon: 'error'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: API + '/api/client',
                        data: {
                            nama: $('#nama_bumdesma').val(),
                            token: '{{ $token }}',
                            socketId
                        },
                        success: function(result) {
                            if (result.success) {
                                $('#ModalScanWA').modal('show')
                            } else {
                                Swal.fire('Error', "Whatsapp sudah terdaftar.", 'error')
                            }
                        }
                    })
                }
            })
        })

        $(document).on('click', '#HapusWa', function(e) {
            e.preventDefault()

            Swal.fire({
                title: 'Hapus Whatsapp',
                text: 'Hapus koneksi whatsapp SIDBM.',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                icon: 'error'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: API + '/api/client/{{ $token }}',
                        success: function(result) {
                            if (result.success) {
                                Swal.fire('Whatsapp Dihapus',
                                    "Scan ulang untuk bisa menggunakan layanan pesan pemberitahuan otomatis.",
                                    'success')

                                $('#ScanWA').show()
                                $('#HapusWa').hide()
                            }
                        }
                    })
                }
            })
        })

        var scanQr = 0;
        socket.on('QR', (result) => {
            $('#QrCode').attr('src', result.url)

            if (scanQr <= 0) {
                var List = $('<li class="list-group-item fw-bold">Scan QR</li>')
                ListContainer.append(List)
            }

            scanQr += 1;
        })

        socket.on('ClientConnect', (result) => {
            $('#QrCode').attr('src', result.url)
            var List = $('<li class="list-group-item list-group-item-success fw-bold">Whatsapp Aktif</li>')
            ListContainer.append(List)
        })
    </script>

    <script>
        var tahun = "{{ date('Y') }}"
        var bulan = "{{ date('m') }}"

        $(".money").maskMoney();
        new Choices($('#pembulatan')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })
        new Choices($('#sistem')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })
        new Choices($('#jenis_asuransi')[0], {
            shouldSort: false,
            fuseOptions: {
                threshold: 0.1,
                distance: 1000
            }
        })

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
