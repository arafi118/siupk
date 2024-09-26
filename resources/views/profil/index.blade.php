@php
    use App\Utils\Tanggal;
@endphp

@extends('layouts.base')

@section('content')
<style>
    .row.align-items-center {
    margin-bottom: 15px; /* Mengatur jarak antara gambar dan tulisan */
}

.avatar {
    margin-right: 15px; /* Jarak antara gambar dan teks */
}

.nama_user1 {
    font-size: 1.25rem; /* Ukuran font nama */
}

.text-sm {
    font-size: 0.875rem; /* Ukuran font jabatan */
}

</style>

        <div class="app-main__inner">
            <div class="main-card mb-3 card" id="profile">
                <div class="card-body">
                    <div class="row">
                        <div class="row align-items-center">
                            <div class="col-sm-auto col-4">
                                <div class="avatar avatar-xl position-relative pointer" id="fileUpload">
                                    <img src="{{ asset('/storage/profil/' . $user->foto) }}" alt="profile"
                                         class="w-100 rounded-circle shadow-sm" id="preview"
                                         style="width: 150px; height: 100px; margin-top: 2px;">
                                </div>
                        
                                <form action="/profil/{{ $user->id }}" method="post" enctype="multipart/form-data"
                                      id="formUpload">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="logo" id="logo" class="d-none">
                                </form>
                            </div>
                        
                            <!-- Kontainer untuk nama dan jabatan -->
                            <div class="col-md-10 d-flex flex-column justify-content-center">
                                <h5 class="mb-1 font-weight-bolder nama_user1">
                                    <b>{{ Session::get('nama') }}</b>
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    ( {{ $user->j ? $user->j->nama_jabatan : '' }} )
                                </p>
                            </div>
                        
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>      
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-4">
                        <div class="card-header pb-0">
                            <h5>Data Diri</h5>
                        </div>
                        <div class="card-body pt-0">
                            <form action="/profil/{{ $user->id }}" method="post" id="formDataDiri">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="type" id="type" value="data_diri">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control" name="nik" id="nik"
                                            placeholder="{{ str_replace('.', '', $user->kec->kd_kec) }}" value="{{ $user->nik }}"
                                            maxlength="16">
                                        <small class="text-danger" id="msg_nik"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Depan</label>
                                        <input type="text" name="nama_depan" id="nama_depan" class="form-control"
                                            placeholder="Nama Depan" value="{{ $user->namadepan }}">
                                        <small class="text-danger" id="msg_nama_depan"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Belakang</label>
                                        <input type="text" name="nama_belakang" id="nama_belakang" class="form-control"
                                            placeholder="Nama Belakang" value="{{ $user->namabelakang }}">
                                        <small class="text-danger" id="msg_nama_belakang"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Inisial</label>
                                        <input type="text" name="inisial" id="inisial" class="form-control" placeholder="Ins"
                                            value="{{ $user->ins }}">
                                        <small class="text-danger" id="msg_inisial"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                            placeholder="{{ $user->kec->kabupaten->nama_kab }}" value="{{ $user->tempat_lahir }}">
                                        <small class="text-danger" id="msg_tempat_lahir"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input autocomplete="off" type="text" name="tanggal_lahir" id="tanggal_lahir"
                                            class="form-control date" value="{{ Tanggal::tglIndo($user->tgl_lahir) }}">
                                        <small class="text-danger" id="msg_tanggal_lahir"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat">{{ $user->alamat }}</textarea>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Telepon</label>
                                        <input type="text" name="telpon" id="telpon" class="form-control" placeholder="628"
                                            value="{{ $user->hp }}" maxlength="13">
                                        <small class="text-danger" id="msg_telpon"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pendidikan</label>
                                        <select class="pendidikan form-control" name="pendidikan" id="pendidikan">
                                            @foreach ($pendidikan as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ $p->id == $user->pendidikan ? 'selected' : '' }}>
                                                    {{ $p->deskripsi_p }} ({{ $p->tingkat }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="msg_pendidikan"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Menjabat Sejak</label>
                                        <input autocomplete="off" type="text" name="menjabat_sejak" id="menjabat_sejak"
                                            class="form-control date" value="{{ Tanggal::tglIndo($user->sejak) }}">
                                        <small class="text-danger" id="msg_menjabat_sejak"></small>
                                        <div class="valid-feedback">
                                            success!!
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="d-flex justify-content-end">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#EditUser"
                                    class="btn btn-info btn-sm mb-0 mt-2">
                                    Edit User
                                </button>
                                <button type="submit" id="SimpanDataDiri" class="btn btn-dark btn-sm mb-0 mt-2 ms-3">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div><br><br><br>
        </div>
@endsection

@section('modal')
{{-- Modal Edit User --}}
<div class="modal fade" id="EditUser" tabindex="-1" aria-labelledby="EditUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditUserLabel">
                    Edit User Login
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="/profil/{{ $user->id }}" method="post" id="FormEditUser">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="type" id="type" value="data_user">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                    value="{{ $user->uname }}">
                                <small class="text-danger" id="msg_username"></small>
                            <div class="valid-feedback">
                                success!!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                    disabled value="{{ $pass }}">
                                <small class="text-danger" id="msg_password"></small>
                            <div class="valid-feedback">
                                success!!
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" name="password_baru"
                            id="password_baru">
                        <small class="text-danger" id="msg_password_baru"></small>
                            <div class="valid-feedback">
                                success!!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="konfirmasi_password"
                                    id="konfirmasi_password">
                                <small class="text-danger" id="msg_konfirmasi_password"></small>
                            <div class="valid-feedback">
                                success!!
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm mb-0" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="SimpanEditUser"
                    class="btn btn-dark btn-sm float-end mb-0">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
        });
        var formatter = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        })
        $('.pendidikan').select2({
        theme: 'bootstrap-5'
        });

        $(document).on('click', '#SimpanDataDiri', function(e) {
            e.preventDefault()

            var form = $('#formDataDiri')
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        Swal.fire('Berhasil', result.msg,
                            'success')

                        $('.nama_user').html(result.user.namadepan + ' ' + result.user.namabelakang)
                    }
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

        $(document).on('input', '#inisial', function() {
            var inisial = $(this).val()

            if (inisial.length >= 2) {
                $(this).val(inisial.substring(0, 2))
            }
        })

        $(document).on('click', '#SimpanEditUser', function(e) {
            e.preventDefault()

            var form = $('#FormEditUser')
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            icon: 'success',
                            text: result.msg,
                            showCancelButton: false,
                            confirmButtonText: 'Login Ulang'
                        }).then((result) => {
                            $('#formLogout').submit()
                        })
                    } else {
                        Swal.fire('Error', result.msg, 'error')
                    }
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

        $(document).on('click', '#fileUpload', function(e) {
            e.preventDefault()

            $('#logo').trigger('click')
        })

        $(document).on('change', '#logo', function(e) {
            e.preventDefault()

            var logo = $(this).get(0).files[0]
            if (logo) {


                var form = $('#formUpload')
                var formData = new FormData(document.querySelector('#formUpload'));
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        if (result.success) {
                            var reader = new FileReader();

                            reader.onload = function() {
                                $("#preview").attr("src", reader.result);
                                $("#profil_avatar").attr("src", reader.result);
                            }

                            reader.readAsDataURL(logo);
                        }
                    }
                })
            }
        })
    </script>
@endsection
