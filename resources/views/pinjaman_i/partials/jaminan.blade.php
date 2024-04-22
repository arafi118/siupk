@if ($id == '1')
    <div class="col-md-6">
        <div class="input-group input-group-static my-3">
            <label for="nomor_sertifikat">Nomor Sertifikat</label>
            <input autocomplete="off" type="text" name="nomor_sertifikat" id="nomor_sertifikat" class="form-control">
            <small class="text-danger" id="msg_nomor_sertifikat"></small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group input-group-static my-3">
            <label for="nama_pemilik">Nama Pemilik</label>
            <input autocomplete="off" type="text" name="nama_pemilik" id="nama_pemilik" class="form-control">
            <small class="text-danger" id="msg_nama_pemilik"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="alamat">Alamat</label>
            <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control">
            <small class="text-danger" id="msg_alamat"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="luas">Luas</label>
            <input autocomplete="off" type="text" name="luas" id="luas" class="form-control">
            <small class="text-danger" id="msg_luas"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="nilai_jual_tanah">Nilai Jual Tanah</label>
            <input autocomplete="off" type="text" name="nilai_jual_tanah" id="nilai_jual_tanah" class="form-control">
            <small class="text-danger" id="msg_nilai_jual_tanah"></small>
        </div>
    </div>

    <script>
        $("#nilai_jual_tanah").maskMoney();
    </script>
@elseif ($id == '2')
    <div class="col-md-6">
        <div class="input-group input-group-static my-3">
            <label for="nomor">Nomor</label>
            <input autocomplete="off" type="text" name="nomor" id="nomor" class="form-control">
            <small class="text-danger" id="msg_nomor"></small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group input-group-static my-3">
            <label for="nama_pemilik">Nama Pemilik</label>
            <input autocomplete="off" type="text" name="nama_pemilik" id="nama_pemilik" class="form-control">
            <small class="text-danger" id="msg_nama_pemilik"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="jenis_kendaraan">Jenis Kendaraan</label>
            <input autocomplete="off" type="text" name="jenis_kendaraan" id="jenis_kendaraan" class="form-control">
            <small class="text-danger" id="msg_jenis_kendaraan"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="nopol">Nopol</label>
            <input autocomplete="off" type="text" name="nopol" id="nopol" class="form-control">
            <small class="text-danger" id="msg_nopol"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="nilai_jual_kendaraan">Nilai Jual Kendaraan</label>
            <input autocomplete="off" type="text" name="nilai_jual_kendaraan" id="nilai_jual_kendaraan"
                class="form-control">
            <small class="text-danger" id="msg_nilai_jual_kendaraan"></small>
        </div>
    </div>

    <script>
        $("#nilai_jual_kendaraan").maskMoney();
    </script>
@elseif ($id == '3')
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="nomor">Nomor</label>
            <input autocomplete="off" type="text" name="nomor" id="nomor" class="form-control">
            <small class="text-danger" id="msg_nomor"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="nama_pegawai">Nama Pegawai</label>
            <input autocomplete="off" type="text" name="nama_pegawai" id="nama_pegawai" class="form-control">
            <small class="text-danger" id="msg_nama_pegawai"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="nama_kuitansi_penerbit">Nama Kuitansi Penerbit</label>
            <input autocomplete="off" type="text" name="nama_kuitansi_penerbit" id="nama_kuitansi_penerbit"
                class="form-control">
            <small class="text-danger" id="msg_nama_kuitansi_penerbit"></small>
        </div>
    </div>
@else
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="nama_jaminan">Nama Jaminan</label>
            <input autocomplete="off" type="text" name="nama_jaminan" id="nama_jaminan" class="form-control">
            <small class="text-danger" id="msg_nama_jaminan"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="keterangan">Keterangan</label>
            <input autocomplete="off" type="text" name="keterangan" id="keterangan" class="form-control">
            <small class="text-danger" id="msg_keterangan"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-group-static my-3">
            <label for="nilai_jaminan">Nilai Jaminan</label>
            <input autocomplete="off" type="text" name="nilai_jaminan" id="nilai_jaminan" class="form-control">
            <small class="text-danger" id="msg_nilai_jaminan"></small>
        </div>
    </div>

    <script>
        $("#nilai_jaminan").maskMoney();
    </script>
@endif
