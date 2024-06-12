@extends('layouts.base')

@section('content')
<div class="app-main__inner">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <table class="mb-0 table table-borderless" width="100%">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Desa</th>
                                    <th>Alamat</th>
                                    <th>Telpon</th>
                                    <th>Kades</th>
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
    @endsection

    @section('modal')
    <div class="modal fade bd-example-modal-lg" id="EditDesa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in,
                        egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel
                        augue laoreet rutrum faucibus dolor auctor.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    var table = $('.table').DataTable({
        language: {
            paginate: {
                previous: "&laquo;",
                next: "&raquo;"
            }
        },
        processing: true,
        serverSide: true,
        ajax: "/database/desa",
        columns: [{
                data: 'kd_desa',
                name: 'kd_desa'
            },
            {
                data: 'nama_desa',
                name: 'nama_desa'
            },
            {
                data: 'alamat_desa',
                name: 'alamat_desa'
            },
            {
                data: 'telp_desa',
                name: 'telp_desa'
            },
            {
                data: 'kades',
                name: 'kades'
            }
        ]
    });

    $('.table').on('click', 'tbody tr', function (e) {
        var data = table.row(this).data();

        $.get('/database/desa/' + data.kd_desa + "/edit", function (result) {
            $('#EditDesa .modal-dialog .modal-content .modal-body').html(result)
        })

        $('#EditDesa').modal('show')
    })

    $(document).on('click', '#simpanDesa', function (e) {
        e.preventDefault()

        var form = $('#FormEditDesa')
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (result) {
                Swal.fire('Berhasil', result.msg, 'success').then(async (result) => {
                    await $('#EditDesa').modal('toggle')
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
