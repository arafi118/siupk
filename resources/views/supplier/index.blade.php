@extends('layouts.base')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-shopping-cart">
                    </i>
                </div>
                <div><b>Data Supplier</b>
                    <div class="page-title-subheading">
                         {{ Session::get('nama_lembaga') }} Kecamatan 
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                <div class="d-inline-block dropdown">
                    <button type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                        <span class="btn-icon-wrapper pe-2 opacity-7">
                            <i class="fa fa-calendar-plus"></i>
                        </span>Register Supplier
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenProposal"
                    class="btn btn-info btn-sm mb-2">Cetak Dokumen Proposal</button>
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
                        <table class="mb-0 table table-borderless table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Nomor ID</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Brand</th>
                                    <th>No HP</th>
                                    <th>Ins</th>
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
<div class="modal fade bd-example-modal-lg" id="EditSupplier" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    </div>
</div>
@endsection

@section('script')
<script>
    var table = $('.table-borderless').DataTable({
        language: {
            paginate: {
                previous: "&laquo;",
                next: "&raquo;"
            }
        },
        processing: true,
        serverSide: true,
        ajax: "/database/supplier",
        columns: [{
                data: 'nomorid',
                name: 'nomorid'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'brand',
                name: 'brand'
            },
            {
                data: 'nohp',
                name: 'nohp'
            },
            {
                data: 'ins',
                name: 'ins'
            }
        ]
    });

    $.get('/database/supplier/create', function(result) {
            $('#RegisterSupplier').html(result)
        })

        $(document).on('keyup', '#id', function(e) {
            e.preventDefault()

            var id = $(this).val()
            if (id.length == 16) {
                $.get('/database/supplier/create?id=' + id, function(result) {
                    $('#RegisterSupplier').html(result)
                })
            }
        })

        $(document).on('click', '#SimpanSupplier', function(e) {
            e.preventDefault()
            $('small').html('')

            var form = $('#supplier')
            $.ajax({
                type: 'post',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    Swal.fire('Berhasil', result.msg, 'success').then(() => {
                        Swal.fire({
                            title: 'Tambah supplier Baru?',
                            text: "",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak'
                        }).then((res) => {
                            if (res.isConfirmed) {
                                $.get('/database/supplier/create', function(result) {
                                    $('#RegisterSupplier').html(result)
                                })
                            } else {
                                window.location.href = '/database/supplier'
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

        $.get('/database/supplier/' + data.id + "/edit", function (result) {
            $('#EditSupplier .modal-dialog').html(result)
            $('#EditSupplier').modal('show')
        })

    })

    $(document).on('click', '#simpanSupplier', function (e) {
        e.preventDefault()

        var form = $('#FormEditSupplier')
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (result) {
                Swal.fire('Berhasil', result.msg, 'success').then(async (result) => {
                    await $('#EditSupplier').modal('toggle')
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
