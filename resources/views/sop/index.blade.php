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
        }
    </style>
    <div class="app-main__inner">
        <div class="tab-content">
            <br>
            @include('sop.menu_sop')

            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Controls Types</h5>
                            <form class="">
                                <div class="position-relative mb-3"><label for="exampleEmail"
                                        class="form-label">Email</label><input name="email" id="exampleEmail"
                                        placeholder="with a placeholder" type="email" class="form-control"></div>
                                <div class="position-relative mb-3"><label for="examplePassword"
                                        class="form-label">Password</label><input name="password" id="examplePassword"
                                        placeholder="password placeholder" type="password" class="form-control"></div>
                                <div class="position-relative mb-3">
                                    <label for="exampleSelect" class="form-label">Select</label>
                                    <select name="select" id="exampleSelect" class="form-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="exampleSelectMulti" class="form-label">Select Multiple</label>
                                    <select multiple="" name="selectMulti" id="exampleSelectMulti" class="form-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="exampleText" class="form-label">Text Area</label>
                                    <textarea name="text" id="exampleText" class="form-control"></textarea>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="exampleFile" class="form-label">File</label>
                                    <input name="file" id="exampleFile" type="file" class="form-control">
                                    <small class="form-text text-muted">
                                        This is some placeholder block-level help text for the above input.
                                        It's a bit lighter and easily wraps to a new line.
                                    </small>
                                </div>
                                <button class="mt-1 btn btn-primary">Submit</button>
                            </form>
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
