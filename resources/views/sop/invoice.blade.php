@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Table Invoice</h5>
                            <div class="table-responsive">
                                <table class="table table-flush table-hover table-click" width="100%" id="TbInvoice">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Pembayaran</th>
                                            <th>Tgl Invoice</th>
                                            <th>Tgl Lunas</th>
                                            <th>Tagihan</th>
                                            <th>Saldo</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        </tr>
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

@section('script')
    <script>
        var table = $('#TbInvoice').DataTable({
            language: {
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            },
            processing: true,
            serverSide: true,
            ajax: '/pengaturan/invoice',
            columns: [{
                data: 'idv',
                name: 'idv'
            }, {
                data: 'jp.nama_jp',
                name: 'jp.nama_jp'
            }, {
                data: 'tgl_invoice',
                name: 'tgl_invoice'
            }, {
                data: 'tgl_lunas',
                name: 'tgl_lunas'
            }, {
                data: 'jumlah',
                name: 'jumlah'
            }, {
                data: 'saldo',
                name: 'saldo',
                orderable: false,
                searchable: false
            }, {
                data: 'status',
                name: 'status'
            }],
            order: [
                [0, 'desc']
            ]
        });

        $('#TbInvoice').on('click', 'tbody tr', function(e) {
            var data = table.row(this).data();

            window.location.href = '/pengaturan/' + data.idv + '/invoice'
        });
    </script>
@endsection
