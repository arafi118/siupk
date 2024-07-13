@extends('layouts.base')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-address-card"></i>
                </div>
                <div><b>Data Agent</b>
                    <div class="page-title-subheading">
                         {{ Session::get('nama_lembaga') }} Kecamatan {{ $kec->nama_kec }}
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                <div class="d-inline-block dropdown">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#RegisterAgent"
                    class="btn btn-info btn-sm mb-2"><i class="fa fa-user-plus"></i> &nbsp; &nbsp;Registrer Agent Baru</button>
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
                        <table class="mb-0 table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Nomor ID</th>
                                    <th>Nama</th>
                                    <th>Desa</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
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
@endsection

@section('modal')
<div class="modal fade bd-example-modal-lg" id="EditAgent" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="RegisterAgent" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
    </div>
</div>
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
        ajax: "/database/agent",
        columns: [{
                data: 'nomorid',
                name: 'nomorid'
            },
            {
                data: 'agent',
                name: 'agent'
            },
            {
                data: 'desa',
                nama: 'desa'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'nohp',
                name: 'nohp'
            },
        ]
    });

    $.get('/database/agent/create', function(result) {
            $('#RegisterAgent .modal-dialog').html(result)
        })

        $(document).on('keyup', '#id', function(e) {
            e.preventDefault()

            var id = $(this).val()
            if (id.length == 16) {
                $.get('/database/agent/create?id=' + id, function(result) {
                    $('#RegisterAgent .modal-dialog').html(result)
                })
            }
        })

        $(document).on('click', '#SimpanAgent', function(e) {
            e.preventDefault()
            $('small').html('')

            var form = $('#FormRegisterAgent')
            $.ajax({
                type: 'post',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    Swal.fire('Berhasil', result.msg, 'success').then(() => {
                        Swal.fire({
                            title: 'Tambah Agent Baru?',
                            text: "",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak'
                        }).then((res) => {
                            if (res.isConfirmed) {
                                $.get('/database/agent/create', function(result) {
                                    $('#RegisterAgent  .modal-dialog').html(result)
                                })
                            } else {
                                window.location.href = '/database/agent'
                            }
                        })
                    })
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



    $('.table').on('click', 'tbody tr', function (e) {
        var data = table.row(this).data();

        $.get('/database/agent/' + data.id + "/edit", function (result) {
            $('#EditAgent .modal-dialog').html(result)
            $('#EditAgent').modal('show')
        })

    })

    $(document).on('click', '#SimpanAgent', function (e) {
        e.preventDefault()

        var form = $('#FormEditAgent')
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (result) {
                Swal.fire('Berhasil', result.msg, 'success').then(async (result) => {
                    await $('#EditAgent').modal('toggle')
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

</script>
@endsection
