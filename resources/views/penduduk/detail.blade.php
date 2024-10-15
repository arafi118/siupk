@extends('layouts.base')
@section('content')
<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
        font-size: 14px; /* Default font size */
    }
</style>
<div class="app-main__inner">
    <div class="card-body">
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#ProfilPenduduk" role="tab"
                        aria-controls="ProfilPenduduk" aria-selected="true">&nbsp;&nbsp;
                        <i class="fa-solid fa fa-users"></i> &nbsp;&nbsp;
                        Profil Penduduk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#RiwayatPiutang" role="tab"
                        aria-controls="RiwayatPiutang" aria-selected="false">&nbsp;&nbsp;
                        <i class="fa-solid fa fa-history"></i> &nbsp;&nbsp;
                        Riwayat Piutang
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-2">
                <div class="tab-pane fade show active" id="ProfilPenduduk" role="tabpanel" aria-labelledby="ProfilPenduduk">
                    <div class="card">
                        <div class="card-body">
                            <form action="/database/penduduk/{{ $penduduk->nik }}" method="post" id="Penduduk">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="_nik" id="_nik" value="{{ $penduduk->nik }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="nik">NIK</label>
                                            <input autocomplete="off" maxlength="16" type="text" name="nik"
                                                id="nik" class="form-control" value="{{ $penduduk->nik }}">
                                            <small class="text-danger" id="msg_nik"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="nama_lengkap">Nama lengkap</label>
                                            <input autocomplete="off" type="text" name="nama_lengkap" id="nama_lengkap"
                                                class="form-control" value="{{ $penduduk->namadepan }}">
                                            <small class="text-danger" id="msg_nama_lengkap"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="nama_pangilan">Nama Pangilan</label>
                                            <input autocomplete="off" type="text" name="nama_pangilan" id="nama_pangilan" class="form-control"
                                            value="{{ $penduduk->nama_pangilan }}">
                                            <small class="text-danger" id="msg_nama_pangilan"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input autocomplete="off" type="text" name="tempat_lahir"
                                             id="tempat_lahir" class="form-control" value="{{ $penduduk->tempat_lahir }}">
                                            <small class="text-danger" id="msg_tempat_lahir"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative mb-3">
                                            <label for="tgl_lahir">Tgl Lahir</label>
                                            <input autocomplete="off" type="text" name="tgl_lahir" id="tgl_lahir"
                                            class="form-control date" value="{{ $penduduk->tgl_lahir }}">
                                            <small class="text-danger" id="msg_tgl_lahir"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative mb-3">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="js-select-2 form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                <option>Pilih Jenis Kelamin</option>
                                                <option {{ $jk_dipilih == 'L' ? 'selected' : '' }} value="L">Laki Laki</option>
                                                <option {{ $jk_dipilih == 'P' ? 'selected' : '' }} value="P">Perempuan</option>
                                            </select>
                                            <small class="text-danger" id="msg_jenis_kelamin"></small>
                                        </div>
                                    </div>        
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="no_kk">No. KK</label>
                                            <input autocomplete="off" type="text" name="no_kk" id="no_kk" class="form-control"
                                            value="{{ $penduduk->kk }}">
                                            <small class="text-danger" id="msg_no_kk"></small>
                                        </div>
                                    </div>      
                                </div> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="alamat">Alamat KTP</label>
                                            <input autocomplete="off" type="text" name="alamat" id="alamat"
                                            class="form-control" value="{{ $penduduk->alamat }}">
                                            <small class="text-danger" id="msg_alamat"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="domisi">Domisi saat ini</label>
                                            <input autocomplete="off" type="text" name="domisi" id="domisi" class="form-control"
                                            value="{{ $penduduk->domisi}}">
                                            <small class="text-danger" id="msg_domisi"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="desa">Desa/Kelurahan</label>
                                            <select class="js-select-2 form-control" name="desa" id="desa">
                                                <option>Pilih Desa/Kelurahan</option>
                                                @foreach ($desa as $ds)
                                                    <option {{ $desa_dipilih == $ds->kd_desa ? 'selected' : '' }} value="{{ $ds->kd_desa }}">
                                                        {{ $ds->sebutan_desa->sebutan_desa }} {{ $ds->nama_desa }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="msg_desa"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="agama">Agama</label>
                                            <select class="js-select-2 form-control" name="agama" id="agama" class="form-control">
                                                <option value="{{$penduduk->agama}}">{{ $penduduk->agama}}</option>
                                                <option value="islam">Islam</option>
                                                <option value="kristen_protestan">Kristen Protestan</option>
                                                <option value="kristen_katolik">Kristen Katolik</option>
                                                <option value="hindu">Hindu</option>
                                                <option value="buddha">Buddha</option>
                                                <option value="konghucu">Konghucu</option>
                                            </select>
                                            <small class="text-danger" id="msg_agama"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative mb-3">
                                            <label for="pendidikan">Pendidikan</label>
                                            <select class="js-select-2 form-control" name="pendidikan" id="pendidikan" class="form-control">
                                                <option value="{{ $penduduk->pendidikan}}">{{ $penduduk->pendidikan}}</option>
                                                <option value="sd_mi">SD/MI</option>
                                                <option value="smp_mts">SMP/MTs</option>
                                                <option value="sma_smk_ma">SMA/SMK/MA</option>
                                                <option value="diploma_1">Diploma 1 (D1)</option>
                                                <option value="diploma_2">Diploma 2 (D2)</option>
                                                <option value="diploma_3">Diploma 3 (D3)</option>
                                                <option value="sarjana">Sarjana (S1)</option>
                                                <option value="magister">Magister (S2)</option>
                                                <option value="doktor">Doktor (S3)</option>
                                            </select>
                                            <small class="text-danger" id="msg_pendidikan"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative mb-3">
                                            <label for="status_pernikahan">Status Pernikahan</label>
                                            <select class="js-select-2 form-control" name="status_pernikahan" id="status_pernikahan" class="form-control">
                                                <option value="{{ $penduduk->status_pernikahan}}">{{ $penduduk->status_pernikahan}}</option>
                                                <option value="lajang">Lajang</option>
                                                <option value="menikah">Menikah</option>
                                                <option value="cerai hidup">Cerai Hidup</option>
                                                <option value="cerai mati">Cerai Mati</option>
                                            </select>
                                            <small class="text-danger" id="msg_status_pernikahan"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="no_telp">No. Telp</label>
                                             <input autocomplete="off" type="text" name="no_telp" id="no_telp"
                                            class="form-control"
                                            value="{{ strlen($penduduk->hp) < 11 ? '628' : $penduduk->hp }}">
                                        <small class="text-danger" id="msg_no_telp"></small>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="nama_ibu">Nama Ibu Kandung</label>
                                            <input autocomplete="off" type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                                            value="{{ $penduduk->nama_ibu}}">
                                            <small class="text-danger" id="msg_nama_ibu"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="tempat_kerja">Alamat Tempat Kerja</label>
                                            <input autocomplete="off" type="text" name="tempat_kerja" id="tempat_kerja" class="form-control"
                                            value="{{ $penduduk->tempat_kerja}}">
                                            <small class="text-danger" id="msg_tempat_kerja"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="jenis_usaha">Jenis Usaha</label>
                                            <input autocomplete="off" type="text" name="jenis_usaha" id="jenis_usaha"
                                            class="form-control" value="{{ $penduduk->usaha }}">
                                            <small class="text-danger" id="msg_jenis_usaha"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="nik_penjamin">NIK Penjamin</label>
                                            <input autocomplete="off" type="text" name="nik_penjamin" id="nik_penjamin" class="form-control"
                                            value="{{ $penduduk->nik_penjamin}}" maxlength="16" minlength="16">
                                            <small class="text-danger" id="msg_nik_penjamin"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="penjamin">Penjamin</label>
                                            <input autocomplete="off" type="text" name="penjamin" id="penjamin" class="form-control"
                                            value="{{ $penduduk->penjamin}}">
                                            <small class="text-danger" id="msg_penjamin"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative mb-3">
                                            <label for="hubungan">Hubungan</label>
                                            <select class="js-select-2 form-control" name="hubungan" id="hubungan">
                                                @foreach ($hubungan as $hb)
                                                    <option {{ $hubungan_dipilih == $hb->id ? 'selected' : '' }} value="{{ $hb->id }}">
                                                        {{ $hb->kekeluargaan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="msg_hubungan"></small>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-github btn-sm float-end btn btn-sm btn-dark mb-0" id="SimpanPenduduk">
                                    Simpan Penduduk
                                </button>
                                <button type="button" class="btn btn-danger btn-sm me-3 float-end" id="BlokirPenduduk">
                                    @php
                                        $status = '0';
                                        if ($penduduk->status == '0') {
                                            $status = '1';
                                        }
                                    @endphp
                                    @if ($status == '0')
                                        Blokir Penduduk
                                    @else
                                        Lepaskan Blokiran
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="RiwayatPiutang" role="tabpanel" aria-labelledby="RiwayatPiutang">
                    <div class="card bg-gradient-default">
                        <div class="card-body">
                            <h5 class="font-weight-normal text-info text-gradient">
                                Riwayat Piutang {{ ucwords($penduduk->namadepan) }}
                            </h5>
                            <ul class="list-group list-group-flush mt-2">
                                @foreach ($penduduk->pinjaman_anggota as $pinj)
                                    @php
                                        $pinkel = $pinj;
                                        $detail = 'detail_i';
                                        if ($pinj->pinkel) {
                                            $detail = 'detail';
                                            $pinkel = $pinj->pinkel;
                                        }
                                    @endphp
                                     <li class="list-group-item">
                                        @php
                                            if ($pinkel->status == 'P') {
                                                $tgl = $pinkel->tgl_proposal;
                                                $jumlah = $pinj->proposal;
                                            } elseif ($pinkel->status == 'V') {
                                                $tgl = $pinkel->tgl_verifikasi;
                                                $jumlah = $pinj->verifikasi;
                                            } elseif ($pinkel->status == 'W') {
                                                $tgl = $pinkel->tgl_cair;
                                                $jumlah = $pinj->alokasi;
                                            } else {
                                                $tgl = $pinkel->tgl_cair;
                                                $jumlah = $pinj->alokasi;
                                            }
                                        @endphp
                                        <blockquote data-link="/{{ $detail }}/{{ $pinkel->id }}"
                                            class="blockquote text-white mb-1 pointer">
                                            <p class="text-dark ms-3">
                                                <span class="badge badge-{{ $pinkel->sts->warna_status }}">
                                                    Loan ID. {{ $pinkel->id }}
                                                    {{ $pinj->pinkel ? $pinj->kelompok->nama_kelompok : $penduduk->namadepan }}
                                                </span>
                                               |
                                                <span>
                                                    {{ Tanggal::tglIndo($tgl) }}
                                                </span>
                                                |
                                                <span>
                                                    {{ number_format($jumlah) }}
                                                </span>
                                                |
                                                <span>
                                                    {{ $pinkel->pros_jasa / $pinkel->jangka }}% @ {{ $pinkel->jangka }} Bulan
                                                    --
                                                    {{ $pinkel->angsuran_pokok->nama_sistem }}
                                                </span>
                                                |
                                                <span>
                                                    {{ $pinkel->sts->nama_status }}
                                                </span>
                                               
                                            </p>
                                        </blockquote>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body p-2">
                    <a href="/database/penduduk" class="btn btn-info btn-sm float-end mb-0">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
    <form action="/database/penduduk/{{ $penduduk->nik }}/blokir" method="post" id="Blokir">
        @csrf
        @php
            $status = '0';
            if ($penduduk->status == '0') {
                $status = '1';
            }
        @endphp
        <input type="hidden" name="status" id="status" value="{{ $status }}">
    </form>
@endsection

@section('script')
    <script>
    $('.js-select-2').select2({
            theme: 'bootstrap-5'
        });
        // Function to set font size
        function setFontSize(size) {
            $('.select2-container .select2-selection--single .select2-selection__rendered').css('font-size', size + 'px');
        }
        $('.date').datepicker({
            dateFormat: 'dd/mm/yy'
        });
        $(document).on('click', '#SimpanPenduduk', function(e) {
            e.preventDefault()
            $('small').html('')
            var form = $('#Penduduk')
            $.ajax({
                type: 'post',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    Swal.fire('Berhasil', result.msg, 'success')
                },
                error: function(result) {
                    const respons = result.responseJSON;

                    Swal.fire('Error', 'Cek kembali input yang anda masukkan', 'error')
                    $.map(respons, function(res, key) {
                        $('#' + key).parent('.input-group.input-group-static').addClass(
                            'is-invalid')
                        $('#msg_' + key).html(res)
                    })
                }
            })
        })
        $(document).on('click', '#BlokirPenduduk', function(e) {
            e.preventDefault()
            let blokir = $('#Blokir #status').val()
            let title = 'Blokir Penduduk?'
            let text = 'Dengan klik Ya maka penduduk ini tidak akan bisa mengajukan pinjaman lagi. Yakin?'
            if (blokir != '0') {
                title = 'Lepaskan Blokiran?'
                text = 'Dengan klik Ya maka penduduk ini akan dilepas dari blokirannya. Yakin lepaskan?'
            }
            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((res) => {
                if (res.isConfirmed) {
                    var form = $('#Blokir')
                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(result) {
                            if (result.success) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: result.msg,
                                    icon: 'success',
                                }).then(() => {
                                    window.location.reload();
                                })
                            }
                        }
                    })
                }
            })
        })
        $(document).on('click', '.blockquote', function(e) {
            e.preventDefault()
            var link = $(this).attr('data-link')
            window.location.href = link
        })
    </script>
@endsection
