<form action="/database/kelompok" method="post" id="FormRegistrasiKelompok">
    @csrf
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input autocomplete="off" maxlength="16" type="text" name="nik" id="nik" class="form-control"
                    value="{{ $nik }}">
                <small class="text-danger" id="msg_nik"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input autocomplete="off" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
                <small class="text-danger" id="msg_nama_lengkap"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="desa" class="form-label">Desa/Kelurahan</label>
                <select class="form-select" name="desa" id="desa">
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
        <div class="col-md-2">
            <div class="position-relative mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input autocomplete="off" type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                <small class="text-danger" id="msg_tempat_lahir"></small>
            </div>
        </div>
        <div class="col-md-2">
            <div class="position-relative mb-3">
                <label for="tgl_lahir" class="form-label">Tgl Lahir</label>
                <input autocomplete="off" type="date" name="tgl_lahir" id="tgl_lahir" class="form-control date"
                    value="{{ $value_tanggal }}">
                <small class="text-danger" id="msg_tgl_lahir"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis_kelamin</label>
                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                    <option {{ $jk_dipilih == 'L' ? 'selected' : '' }} value="L">Laki Laki</option>
                    <option {{ $jk_dipilih == 'P' ? 'selected' : '' }} value="P">Perempuan</option>
                </select>
                <small class="text-danger" id="msg_desa"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input autocomplete="off" type="text" name="no_telp" id="no_telp" class="form-control"
                    value="628">
                <small class="text-danger" id="msg_no_telp"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control">
                <small class="text-danger" id="msg_alamat"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="no_kk" class="form-label">No. KK</label>
                <input autocomplete="off" type="text" name="no_kk" id="no_kk" class="form-control"
                    value="{{ substr($nik, 0, 6) }}">
                <small class="text-danger" id="msg_no_kk"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                <input autocomplete="off" type="text" name="jenis_usaha" id="jenis_usaha" class="form-control">
                <small class="text-danger" id="msg_jenis_usaha"></small>
            </div>
        </div>
    </div>
</form><br>
<button type="submit" class="btn btn-dark btn-sm" id="SimpanPenduduk">Simpan Penduduk</button>
