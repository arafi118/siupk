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
                    <i class="fa fa-bank"></i>
                </div>
                <div><b>Daftar Simpanan Dan Utang</b>
                    <div class="page-title-subheading">
                         {{ Session::get('nama_lembaga') }}
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <div class="card-body">
        <div class="row">
            <div class="col-lg-">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush table-hover table-click" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nomor Rekening</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Simpanan</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Buka</th>
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
            <span class="badge bg-success">
                Simpanan Umum
            </span>
            <span class="badge bg-danger">
                Simpanan Deposito
            </span>
            <span class="badge bg-warning">
                Simpanan Program
            </span>
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
            ajax: "/simpanan",
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    searchable: false
                },
                {
                    data: 'nomor_rekening',
                    name: 'nomor_rekening'
                },
                {
                    data: 'anggota.namadepan',
                    name: 'anggota.namadepan'
                },
                {
                    data: 'jenis_simpanan',
                    name: 'jenis_simpanan'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah',
                    // render: function(data, type, row) {
                    //     return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data);
                    // }
                },
                {
                    data: 'tgl_buka',
                    name: 'tgl_buka'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (data === 'A') {
                            return '<span class="badge badge-success">Aktif</span>';
                        } else if (data === 'T') {
                            return '<span class="badge badge-danger">Ditutup</span>';
                        } else if (data === 'P') {
                            return '<span class="badge badge-warning">Pending</span>';
                        }
                        return '<span class="badge badge-secondary">' + data + '</span>';
                    }
                }
            ],
            order: [
                [0, 'desc']
            ]
        });

        $('.table').on('click', 'tbody tr', function(e) {
            var data = table.row(this).data();
            window.location.href = '/simpanan/' + data.id;
        });
    </script>
@endsection
