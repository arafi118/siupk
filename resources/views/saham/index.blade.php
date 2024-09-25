@extends('layouts.base')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-object-group"></i>
                </div>
                <div><b>Data Direksi dan Komisaris</b>
                    <div class="page-title-subheading">
                        {{ Session::get('nama_lembaga') }} Kecamatan {{ $kec->nama_kec }} Kd {{ $kec->kd_kec }}
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                <div class="d-inline-block dropdown">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#RegisterSaham"
                        class="btn btn-info btn-sm mb-2"><i class="fa fa-user-plus"></i> &nbsp; &nbsp;Registrer Data
                        Baru</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <div class="table-responsive">
                            <table class="mb-0 table table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nama Pemegang Saham </th>
                                        <th>Rupiah(Rp)</th>
                                        <th>Presentase(%)</th>
                                        <th>Nama Direksi</th>
                                        <th>Jabatan</th>
                                        <th>Nama Komisaris</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade bd-example-modal-lg" id="EditSaham" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="RegisterSaham" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

    </div>
</div>
<form action="" method="post" id="formHapus">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('script')
<script>
    $('.js-example-basic-single').select2({
        theme: 'bootstrap-5'
    });

    var table = $('.table-hover').DataTable({
        language: {
            paginate: {
                previous: "&laquo;",
                next: "&raquo;"
            }
        },
        processing: true,
        serverSide: true,
        ajax: "/database/saham",
        columns: [{
                data: 'nama_saham',
                name: 'nama_saham'
            },
            {
                data: 'rp_saham',
                name: 'rp_saham'
            },
            {
                data: 'pros_saham',
                nama: 'pros_saham'
            },
            {
                data: 'nama_direksi',
                name: 'nama_direksi'
            },
            {
                data: 'jab_direksi',
                name: 'jab_direksi'
            },
            {
                data: 'nama_kom',
                name: 'nama_kom'
            },
            {
                data: 'jab_kom',
                name: 'jab_kom'
            },
        ]
    });

    $.get('/database/saham/create', function (result) {
        $('#RegisterSaham .modal-dialog').html(result)
    })

    $(document).on('keyup', '#id', function (e) {
        e.preventDefault()

        var id = $(this).val()
        if (id.length == 16) {
            $.get('/database/saham/create?id=' + id, function (result) {
                $('#RegisterSaham .modal-dialog').html(result)
            })
        }
    })

    $(document).on('click', '#SimpanSaham', function (e) {
        e.preventDefault()
        $('small').html('')

        var form = $('#FormRegisterSaham')
        $.ajax({
            type: 'post',
            url: form.attr('action'),
            data: form.serialize(),
            success: function (result) {
                Swal.fire('Berhasil', result.msg, 'success').then(() => {
                    Swal.fire({
                        title: 'Tambah Saham Baru?',
                        text: "",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak'
                    }).then((res) => {
                        if (res.isConfirmed) {
                            $.get('/database/saham/create', function (result) {
                                $('#RegisterSaham  .modal-dialog').html(
                                    result)
                            })
                        } else {
                            window.location.href = '/database/saham'
                        }
                    })
                })
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



    $('.table').on('click', 'tbody tr', function (e) {
        var data = table.row(this).data();

        $.get('/database/saham/' + data.id + "/edit", function (result) {
            $('#EditSaham .modal-dialog').html(result)
            $('#EditSaham').modal('show')
        })

        $('#formHapus').attr('action', '/database/saham/' + data.id)
    })

    $(document).on('click', '#SimpanEditSaham', function (e) {
        e.preventDefault()

        var form = $('#FormEditSaham')
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (result) {
                Swal.fire('Berhasil', result.msg, 'success').then(async (result) => {
                    await $('#EditSaham').modal('toggle')
                    table.ajax.reload();
                })
            },
            error: function (result) {
                const respons = result.responseJSON;

                Swal.fire('Error', 'Cek kembali input yang anda masukkan', 'error')
                $.map(respons, function (res, key) {
                    $('#' + key).parent('.input-group').addClass('is-invalid')
                    $('#msg_' + key).html(res)
                })
            }
        })
    })

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault()

        Swal.fire({
            title: 'Peringatan',
            text: 'Setelah menekan tombol Hapus Direksi dan Komisaris dibawah, maka Direksi dan Komisaris ini akan dihapus dari aplikasi secara permanen.',
            showCancelButton: true,
            confirmButtonText: 'Hapus Direksi dan Komisaris',
            cancelButtonText: 'Batal',
            icon: 'warning'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $('#formHapus')
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function (result) {
                            if (result.success) {
                                Swal.fire('Berhasil', result.msg, 'success').then(
                                    () => {
                                        window.location.href = '/database/saham'
                                    })
                            }
                        }
                })
            }
        })
    })

</script>
@endsection
