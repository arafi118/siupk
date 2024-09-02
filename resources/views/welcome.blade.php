<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Jembatan Akuntabilitas Bumdesma">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords"
        content="dbm, sidbm, sidbm.net, demo.sidbm.net, app.sidbm.net, asta brata teknologi, abt, dbm, kepmendesa 136, kepmendesa nomor 136 tahun 2022">
    <meta name="author" content="Enfii">
    <title>
        User Login
    </title>

    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link id="pagestyle" href="/assets/css/material-dashboard.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/style.css">

    <style>
        table.table tr td,
        table.table tr th {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <main class="main-content mt-6">
        <section class="container">
            <div class="nav-wrapper position-relative end-0">
                <div class="tab-content mt-2">
                    <div class="tab-pane fade show active" id="" role="tabpanel" aria-labelledby="">
                        <div class="card">
                            <div class="card-body" id="">
                                <div>Kecamatan {{ $kec->nama_kec }} [{{ $kec->id }}], {{ $kec->kabupaten->nama_kab }}</div>
                                <form action="" method="post" target="_blank">
                                    @csrf
                                
                                    <input type="hidden" name="" id="" value="">
                                    <input type="hidden" name="" id="" value="">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Level</th>
                                                    <th>Jabatan</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $u)
                                                    <tr>
                                                        <td>
                                                            <div class="input-group input-group-static">
                                                                <input type="text" value="{{ $u->namadepan . ' ' . $u->namabelakang }}" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-static">
                                                                <input type="text" value="{{ $u->l->nama_level }}" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-static">
                                                                <input type="text" value="{{ $u->j->nama_jabatan }}" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-static">
                                                                <input type="text" value="{{ $u->uname }}" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-static">
                                                                <input type="text" value="{{ $u->pass }}" class="form-control">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                
                                    <div class="d-flex justify-content-end">
                                        <a href="/" target="_blank" class="btn btn-info btn-sm">{{ $kec->web_kec }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/js/material-dashboard.min.js"></script>
    <script src="/assets/js/plugins/sweetalert.min.js"></script>
</body>

</html>
