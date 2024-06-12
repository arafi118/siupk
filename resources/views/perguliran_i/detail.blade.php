@extends('layouts.base')

@section('content')
    <div class="app-main__inner">

        {{-- <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item"><a data-bs-toggle="tab" id="tab-0" href="#tab-content-0" class="active nav-link">
                            <i class="fa-solid fa-tree-city"></i> &nbsp; Proposal (P)</a>
                    </li>
                    <li class="nav-item"><a data-bs-toggle="tab" id="tab-1" href="#tab-content-1" class="nav-link">
                            <i class="fa-solid fa-calendar-check-o"></i> &nbsp; Verified (V)</a>
                    </li>
                    <li class="nav-item"><a data-bs-toggle="tab" id="tab-2" href="#tab-content-2" class="nav-link">
                            <i class="fa-solid fa-tree-city"></i> &nbsp; Waiting (W)</a>
                    </li>
                    <li class="nav-item"><a data-bs-toggle="tab" id="tab-3" href="#tab-content-3" class="nav-link">
                            <i class="fa-solid fa-tree-city"></i> &nbsp;Aktif (A)</a>
                    </li>
                    <li class="nav-item"><a data-bs-toggle="tab" id="tab-4" href="#tab-content-4" class="nav-link">
                            <i class="fa-solid fa-tree-city"></i> &nbsp;Lunas (L)</a>
                    </li>
                </ul>
            </div>
        </div> --}}
        <div class="card-body">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item"><a data-bs-toggle="tab" id="tab-0" href="#tab-content-0" class="active nav-link">
                        <i class="fa-solid fa-file-circle-plus"></i> <b>&nbsp; &nbsp;Proposal (P)</b>
                    </a>
                </li>
                <li class="nav-item"><a data-bs-toggle="tab" id="tab-1" href="#tab-content-1" class="nav-link">
                        <i class="fa-solid fa-tarp-droplet"></i> <b>&nbsp; &nbsp;Verified (V)</b></a>
                </li>
                <li class="nav-item"><a data-bs-toggle="tab" id="tab-2" href="#tab-content-2" class="nav-link">
                        <i class="fa-solid fa-diagram-next"></i> <b> &nbsp; &nbsp;Waiting (W)</b></a>
                </li>
                <li class="nav-item"><a data-bs-toggle="tab" id="tab-3" href="#tab-content-3" class="nav-link">
                        <i class="fa-solid fa-arrow-down-up-across-line"></i> <b>&nbsp; &nbsp;Aktif (A)</b></a>
                </li>
                <li class="nav-item"><a data-bs-toggle="tab" id="tab-4" href="#tab-content-4" class="nav-link">
                        <i class="fa-solid fa-person-circle-check"></i> <b>&nbsp;&nbsp;Lunas (L)</b></a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <table class="table table-flush table-hover table-click" width="100%" id="TbProposal">
                                    <thead>
                                        <tr>
                                            <th>Nama Anggota P</th>
                                            <th>Alamat</th>
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
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 card">

                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <table class="table table-flush table-hover table-click" width="100%" id="TbVerified">
                                    <thead>
                                        <tr>
                                            <th>Nama Anggota</th>
                                            <th>Alamat</th>
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
            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <table class="table table-flush table-hover table-click" width="100%" id="TbWaiting">
                                    <thead>
                                        <tr>
                                            <th>Nama Anggota</th>
                                            <th>Alamat</th>
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
            <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <table class="table table-flush table-hover table-click" width="100%" id="TbAktif">
                                    <thead>
                                        <tr>
                                            <th>Nama Anggota</th>
                                            <th>Alamat</th>
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
            <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
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
@endsection
