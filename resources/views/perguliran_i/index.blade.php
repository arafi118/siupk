@extends('layouts.base')

@section('content')

    <div class="app-main__inner">
        <div class="card-body">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a data-bs-toggle="tab" id="tab-0" href="#Proposal" class="nav-link {{ $status == 'p' ? 'active' : '' }}">
                        <i class="fa-solid fa-file-circle-plus"></i><b>&nbsp; &nbsp;Proposal (P)</b>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="tab" id="tab-1" href="#Verified" class="nav-link {{ $status == 'v' ? 'active' : '' }}">
                        <i class="fa fa-window-restore"></i><b>&nbsp; &nbsp;Verified (V)</b>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="tab" id="tab-2" href="#Waiting" class="nav-link {{ $status == 'w' ? 'active' : '' }}">
                        <i class="fa-solid fa-history"></i><b>&nbsp; &nbsp;Waiting (W)</b>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="tab" id="tab-3" href="#Aktif" class="nav-link {{ $status == 'a' ? 'active' : '' }}">
                        <i class="fa-solid fa-arrow-down-up-across-line"></i><b>&nbsp; &nbsp;Aktif (A)</b>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="tab" id="tab-4" href="#Lunas" class="nav-link {{ $status == 'l' ? 'active' : '' }}">
                        <i class="fa-solid fa-person-circle-check"></i><b>&nbsp; &nbsp;Lunas (L)</b>
                    </a>
                </li>
            </ul>
        </div>
        
        <style>
            @media (max-width: 576px) {
                .nav-item .nav-link {
                    display: flex;
                    justify-content: center;
                }
            }
        </style>
        

        <div class="tab-content">
            <div class="tab-pane tabs-animation fade  {{ $status == 'p' ? 'show active' : '' }}" id="Proposal" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <div class="table-responsive">
                                    <table class="table table-flush table-hover table-click " width="100%" id="TbProposal">
                                        <thead>
                                            <tr>
                                                <th>Loan id</th>
                                                <th>Nama Anggota P</th>
                                                <th>Desa</th>
                                                <th>Nama Barang</th>
                                                <th>Tgl Pengajuan</th>
                                                <th>Pengajuan</th>
                                                <th>Jasa/Jangka</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade{{ $status == 'v' ? 'show active' : '' }}" id="Verified" role="tabpanel" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 card">

                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <div class="table-responsive">
                                    <table class="table table-flush table-hover table-click" width="100%" id="TbVerified">
                                        <thead>
                                            <tr>
                                                <th>Loan id</th>
                                                <th>Nama Anggota V</th>
                                                <th>Desa</th>
                                                <th>Tgl Verified</th>
                                                <th>Verifikasi</th>
                                                <th>Jasa/Jangka</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade{{ $status == 'w' ? 'show active' : '' }}" id="Waiting" role="tabpanel" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <div class="table-responsive">
                                    <table class="table table-flush table-hover table-click" width="100%" id="TbWaiting">
                                        <thead>
                                            <tr>
                                                <th>Loan id</th>
                                                <th>Nama Anggota W</th>
                                                <th>Desa</th>
                                                <th>Tgl Waiting</th>
                                                <th>Alokasi</th>
                                                <th>Jasa/Jangka</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade{{ $status == 'a' ? 'show active' : '' }}" id="Aktif" role="tabpanel" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <div class="table-responsive">
                                    <table class="table table-flush table-hover table-click" width="100%" id="TbAktif">
                                        <thead>
                                            <tr>
                                                <th>Loan id</th>
                                                <th>Nama Anggota A</th>
                                                <th>Desa</th>
                                                <th>Tgl Cair</th>
                                                <th>Alokasi</th>
                                                <th>Jasa/Jangka</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade{{ $status == 'l' ? 'show active' : '' }}" id="Lunas" role="tabpanel" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <div class="table-responsive">
                                    <table class="table table-flush table-hover table-click" width="100%" id="TbLunas">
                                        <thead>
                                            <tr>
                                                <th>Nama Anggota</th>
                                                <th>Alamat</th>
                                                <th>Tgl Cair</th>
                                                <th>Verifikasi</th>
                                                <th>Jasa/Jangka</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
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
        var tbProposal = CreateTable('#TbProposal', '/perguliran_i/proposal', [ {
            data: 'id',
            name: 'id'
        }, {
            data: 'anggota.namadepan',
            name: 'anggota.namadepan'
        }, {
            data: 'anggota.d.nama_desa',
            name: 'anggota.d.nama_desa'
        }, {
            data: 'nama_barang',
            name: 'nama_barang'
        }, {
            data: 'tgl_proposal',
            name: 'tgl_proposal'
        }, {
            data: 'proposal',
            name: 'proposal'
        }, {
            data: 'jasa',
            name: 'jasa',
            orderable: false,
            searchable: false
        }])

        var tbVerified = CreateTable('#TbVerified', '/perguliran_i/verified', [{
            data: 'id',
            name: 'id'
        },{
            data: 'anggota.namadepan',
            name: 'anggota.namadepan'
        }, {
            data: 'anggota.d.nama_desa',
            name: 'anggota.d.nama_desa'
        }, {
            data: 'tgl_verifikasi',
            name: 'tgl_verifikasi'
        }, {
            data: 'verifikasi',
            name: 'verifikasi'
        }, {
            data: 'jasa',
            name: 'jasa',
            orderable: false,
            searchable: false
        }])

        var tbWaiting = CreateTable('#TbWaiting', '/perguliran_i/waiting', [{
            data: 'id',
            name: 'id'
        },{
            data: 'anggota.namadepan',
            name: 'anggota.namadepan'
        }, {
            data: 'anggota.d.nama_desa',
            name: 'anggota.d.nama_desa'
        }, {
            data: 'tgl_tunggu',
            name: 'tgl_tunggu'
        }, {
            data: 'alokasi',
            name: 'alokasi'
        }, {
            data: 'jasa',
            name: 'jasa',
            orderable: false,
            searchable: false
        }])

        var tbAktif = CreateTable('#TbAktif', '/perguliran_i/aktif', [{
            data: 'id',
            name: 'id'
        },{
            data: 'anggota.namadepan',
            name: 'anggota.namadepan'
        }, {
            data: 'anggota.d.nama_desa',
            name: 'anggota.d.nama_desa'
        }, {
            data: 'tgl_cair',
            name: 'tgl_cair'
        }, {
            data: 'alokasi',
            name: 'alokasi'
        }, {
            data: 'jasa',
            name: 'jasa',
            orderable: false,
            searchable: false
        }])

        var tbLunas = CreateTable('#TbLunas', '/perguliran_i/lunas', [{
            data: 'anggota.namadepan',
            name: 'anggota.namadepan'
        }, {
            data: 'anggota.alamat',
            name: 'anggota.alamat'
        }, {
            data: 'tgl_cair',
            name: 'tgl_cair'
        }, {
            data: 'alokasi',
            name: 'alokasi'
        }, {
            data: 'jasa',
            name: 'jasa',
            orderable: false,
            searchable: false
        }])

        function CreateTable(tabel, url, column) {
            var table = $(tabel).DataTable({
                language: {
                    paginate: {
                        previous: "&laquo;",
                        next: "&raquo;"
                    }
                },
                processing: true,
                serverSide: true,
                ajax: url,
                columns: column,
                order: [
                    [2, 'desc']
                ]
            })

            return table
        }

        $('#TbProposal').on('click', 'tbody tr', function(e) {
            var data = tbProposal.row(this).data();

            window.location.href = '/detail_i/' + data.id
        })

        $('#TbVerified').on('click', 'tbody tr', function(e) {
            var data = tbVerified.row(this).data();

            window.location.href = '/detail_i/' + data.id
        })

        $('#TbWaiting').on('click', 'tbody tr', function(e) {
            var data = tbWaiting.row(this).data();

            window.location.href = '/detail_i/' + data.id
        })

        $('#TbAktif').on('click', 'tbody tr', function(e) {
            var data = tbAktif.row(this).data();

            window.location.href = '/detail_i/' + data.id
        })

        $('#TbLunas').on('click', 'tbody tr', function(e) {
            var data = tbLunas.row(this).data();

            window.location.href = '/lunas_i/' + data.id
        })
    </script>
@endsection
