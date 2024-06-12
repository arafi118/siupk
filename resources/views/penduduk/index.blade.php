@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <table class="table table-flush table-hover table-click table-borderless" width="100%">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Alamat</th>
                                        <th>Nama Lengkap</th>
                                        <th>Telpon</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-sm">
                <span class="badge badge-secondary">
                    (N) Belum ada pinjaman
                </span>
                @foreach ($status_pinjaman as $status)
                    <span class="badge badge-{{ $status->warna_status }}">
                        ({{ $status->kd_status }})
                        {{ $status->nama_status }}
                    </span>
                @endforeach
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
            ajax: "/database/penduduk",
            columns: [{
                    data: 'id',
                    name: 'id',
                    visible: false,
                    searchable: false
                }, {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'namadepan',
                    name: 'namadepan'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'hp',
                    name: 'hp'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [0, 'desc']
            ]
        });

        $('.table').on('click', 'tbody tr', function(e) {
            var data = table.row(this).data();

            window.location.href = '/database/penduduk/' + data.nik
        })
    </script>
@endsection
