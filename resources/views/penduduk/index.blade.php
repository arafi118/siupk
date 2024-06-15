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
                                     <th>ID</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
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

</div>
@endsection

@section('modal')
<div class="modal fade" id="EditDesa" tabindex="-1" aria-labelledby="EditDesaLabel" aria-hidden="true">
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
        ajax: "/database/penduduk",
        columns: [{
                data: 'id',
                name: 'id',
                visible: false,
                searchable: false
            }, 
            {
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

    $('.table').on('click', 'tbody tr', function (e) {
        var data = table.row(this).data();

        window.location.href = '/database/penduduk/' + data.nik
    })

</script>
@endsection
