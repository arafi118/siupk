<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fa fa-user-plus"></i>
            </div>
            <div><b>Form Register Pelanggan</b>
                <div class="page-title-subheading">
                    {{ Session::get('nama_lembaga') }} 
               </div>
            </div>
        </div> 
    </div>
</div>   
<form action="/database/penduduk" method="post" id="Penduduk">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="nik">NIK</label>
                <input autocomplete="off" maxlength="16" type="text" name="nik" id="nik" class="form-control"
                    value="{{ $nik }}">
                <small class="text-danger" id="msg_nik"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="nama_lengkap">Nama lengkap</label>
                <input autocomplete="off" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
                <small class="text-danger" id="msg_nama_lengkap"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="jenis_usaha" for="desa">Desa/Kelurahan</label>
                <select class="form-control" name="desa" id="desa">
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
            <div class="my-2">
                <label class="form-label" for="jenis_kelamin">Tempat Lahir</label>
                <input autocomplete="off" type="text" name="tempat_lahir" id="tempat_lahir"
                            class="form-control">
                        <small class="text-danger" id="msg_tempat_lahir"></small>
            </div>
        </div>
        <div class="col-md-2">
            <div class="my-2">
                <label class="form-label" for="jenis_kelamin">Tgl Lahir</label>
                <input autocomplete="off" type="text" name="tgl_lahir" id="tgl_lahir"
                            class="form-control date"  value="{{ date('d/m/Y') }}">
                        <small class="text-danger" id="msg_tgl_lahir"></small>
            </div>
        </div>
        <div class="col-md-2">
            <div class="my-2">
                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                    <option {{ $jk_dipilih == 'L' ? 'selected' : '' }} value="L">Laki Laki</option>
                    <option {{ $jk_dipilih == 'P' ? 'selected' : '' }} value="P">Perempuan</option>
                </select>
                <small class="text-danger" id="msg_desa"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="my-2">
                <label class="form-label" for="hubungan">Hubungan</label>
                <select class="form-control" name="hubungan" id="hubungan">
                    @foreach ($hubungan as $hb)
                        <option {{ $hubungan_dipilih == $hb->id ? 'selected' : '' }} value="{{ $hb->id }}">
                            {{ $hb->kekeluargaan }}
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
                <label for="alamat">Alamat</label>
                <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control">
                <small class="text-danger" id="msg_alamat"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="no_kk">No. KK</label>
                <input autocomplete="off" type="text" name="no_kk" id="no_kk" class="form-control"
                    value="{{ substr($nik, 0, 6) }}">
                <small class="text-danger" id="msg_no_kk"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="jenis_usaha">Jenis Usaha</label>
                <input autocomplete="off" type="text" name="jenis_usaha" id="jenis_usaha" class="form-control">
                <small class="text-danger" id="msg_jenis_usaha"></small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="nik_penjamin">NIK Penjamin</label>
                <input autocomplete="off" type="text" name="nik_penjamin" id="nik_penjamin" class="form-control"
                    value="{{ substr($nik, 0, 6) }}" maxlength="16" minlength="16">
                <small class="text-danger" id="msg_nik_penjamin"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="penjamin">Penjamin</label>
                <input autocomplete="off" type="text" name="penjamin" id="penjamin" class="form-control">
                <small class="text-danger" id="msg_penjamin"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="no_telp">No. Telp</label>
                <input autocomplete="off" type="text" name="no_telp" id="no_telp" class="form-control"
                    value="628">
                <small class="text-danger" id="msg_no_telp"></small>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-github btn-sm float-end btn-dark mb-0" id="SimpanPenduduk">Simpan Penduduk</button>
</form>

<script>
   

   $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });

</script>
