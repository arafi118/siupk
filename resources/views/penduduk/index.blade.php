@extends('layouts.base')

@section('content')
<style>
    .status-active {
        color: green;
    }

    .status-inactive {
        color: red;
    }

    .status-pending {
        color: orange;
    }

    .status-default {
        color: black;
    }

</style>
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-street-view"></i>
                </div>
                <div><b>Data Nasabah</b>
                    <div class="page-title-subheading">
                        {{ Session::get('nama_lembaga') }}
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="submit" class="btn btn-success btn-sm mb-0" id="ExportExcel">
                        <i class="fa fa-print"></i> &nbsp;&nbsp; Export Excel
                    </button>
                    @if (in_array('data_penduduk.export_excel', Session::get('tombol', [])))
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-success btn-sm mb-0" id="ExportExcel">
                                    <i class="fa fa-print"></i>&nbsp;&nbsp;Export Excel
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
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
                            <table class="table table-hover" width="100%">
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
        </div>
        <div class="text-sm">
            <span class="badge bg-secondary">
                (N) Belum ada pinjaman
            </span>
            @foreach ($status_pinjaman as $status)
            <span class="badge bg-{{ $status->warna_status }}">
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
    <div class="dmodal-dialog moal-lg">


    </div>
</div>
@endsection

@section('script')
<script>
    var table = $('.table-hover').DataTable({
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
                searchable: false,
            }
        ],
        order: [
            [0, 'desc']
        ]
    });

    $('.table').on('click', 'tbody tr', function (e) {
        var data = table.row(this).data();
        window.location.href = '/database/penduduk/' + data.nik;
    });

    $(document).on('click', '#ExportExcel', function (e) {
        e.preventDefault()

        $('input#laporan').val('penduduk')
        $('input#type').val('excel')
        $('#FormLaporanSisipan').submit()
    })

</script>

@endsection
