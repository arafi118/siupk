@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Simpanan</h3>
            <div class="float-right">

            <!--    <a href="{{ route('simpanan.generate') }}" class="btn btn-primary">Generate Simpanan</a> -->
            <a href="generate_bunga.php" class="btn btn-info " target="_blank">Generate Bunga</a>

            </div>
        </div>
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
                    <tbody></tbody>
                </table>
            </div>

            <div class="text-sm mt-3">
                <span class="btn btn-success">
                    Simpanan Umum
                </span>
                <span class="btn btn-danger">
                    Simpanan Deposito
                </span>
                <span class="btn btn-warning">
                    Simpanan Program
                </span>
                <!-- Tambahkan status lain sesuai kebutuhan -->
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
                    name: 'jumlah'
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
                            return '<span class="btn btn-success" style="background-color: green; color: white;">Aktif</span>';
                        } else if (data === 'T') {
                            return '<span class="btn btn-danger">Ditutup</span>';
                        } else if (data === 'P') {
                            return '<span class="btn btn-warning">Pending</span>';
                        }
                        return ' ' + data + ' ';
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
