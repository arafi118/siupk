@if ($id == '1')
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="nomor_sertifikat" class="form-label">Nomor Sertifikat</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nomor_sertifikat]" id="nomor_sertifikat"
                    class="form-control">
                    <small class="text-danger" id="msg_nomor_sertifikat"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nama_pemilik]" id="nama_pemilik"
                    class="form-control">
                    <small class="text-danger" id="msg_nama_pemilik"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input autocomplete="off" type="text" name="data_jaminan[alamat]" id="alamat" class="form-control">
                    <small class="text-danger" id="msg_alamat"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="luas" class="form-label">Luas (m²)</label>
                    <input autocomplete="off" type="text" name="data_jaminan[luas]" id="luas" class="form-control">
                    <small class="text-danger" id="msg_luas"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nilai_jual_tanah" class="form-label">Nilai Jual Tanah</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nilai_jual_tanah]" id="nilai_jual_tanah"
                        class="form-control">
                    <small class="text-danger" id="msg_nilai_jual_tanah"></small>
                </div>
            </div>
        </div>
        <script>
            $("#nilai_jual_tanah").maskMoney();
        </script>    
@elseif ($id == '2')
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="nomor" class="form-label">Nomor</label>
                        <input autocomplete="off" type="text" name="data_jaminan[nomor]" id="nomor" class="form-control">
                        <small class="text-danger" id="msg_nomor"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nama_pemilik]" id="nama_pemilik"
                    class="form-control">
                    <small class="text-danger" id="msg_nama_pemilik"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                    <input autocomplete="off" type="text" name="data_jaminan[jenis_kendaraan]" id="jenis_kendaraan"
                    class="form-control">
                    <small class="text-danger" id="msg_jenis_kendaraan"></small>  
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nopol" class="form-label">Nopol</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nopol]" id="nopol" class="form-control">
                    <small class="text-danger" id="msg_nopol"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nilai_jual_kendaraan" class="form-label">Nilai Jual Kendaraan</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nilai_jual_kendaraan]" id="nilai_jual_kendaraan"
                    class="form-control">
                    <small class="text-danger" id="msg_nilai_jual_kendaraan"></small>   
                </div>
            </div>
        </div>
        <script>
            $("#nilai_jual_kendaraan").maskMoney();
        </script>
@elseif ($id == '3')
        <div class="row">
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nomor" class="form-label">Nomor</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nomor]" id="nomor"
                    class="form-control">
                    <small class="text-danger" id="msg_nomor"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nama_pegawai]" id="nama_pegawai"
                    class="form-control">
                    <small class="text-danger" id="msg_nama_pegawai"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nama_kuitansi_penerbit" class="form-label">Nama Instansi Penerbit</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nama_kuitansi_penerbit]"
                    id="nama_kuitansi_penerbit" class="form-control">
                    <small class="text-danger" id="msg_nama_kuitansi_penerbit"></small>
                </div>
            </div>
        </div>
@elseif ($id == '4')
        <div class="row">
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nama_jaminan" class="form-label">Nama Jaminan</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nama_jaminan]" id="nama_jaminan"
                    class="form-control">
                    <small class="text-danger" id="msg_nama_jaminan"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input autocomplete="off" type="text" name="data_jaminan[keterangan]" id="keterangan"
                    class="form-control">
                    <small class="text-danger" id="msg_keterangan"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nilai_jaminan" class="form-label">Nilai Jaminan</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nilai_jaminan]" id="nilai_jaminan"
                    class="form-control">
                    <small class="text-danger" id="msg_nilai_jaminan"></small>
                </div>
            </div>
        </div>
        <script>
            $("#nilai_jaminan").maskMoney();
        </script>
@else
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="nomor_sertifikat" class="form-label">Nomor Sertifikat</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nomor_sertifikat]" id="nomor_sertifikat"
                    class="form-control">
                    <small class="text-danger" id="msg_nomor_sertifikat"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nama_pemilik]" id="nama_pemilik"
                    class="form-control">
                    <small class="text-danger" id="msg_nama_pemilik"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input autocomplete="off" type="text" name="data_jaminan[alamat]" id="alamat" class="form-control">
                    <small class="text-danger" id="msg_alamat"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="luas" class="form-label">Luas (m²)</label>
                    <input autocomplete="off" type="text" name="data_jaminan[luas]" id="luas" class="form-control">
                    <small class="text-danger" id="msg_luas"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nilai_jual_tanah" class="form-label">Nilai Jual Tanah</label>
                    <input autocomplete="off" type="text" name="data_jaminan[nilai_jual_tanah]" id="nilai_jual_tanah"
                        class="form-control">
                    <small class="text-danger" id="msg_nilai_jual_tanah"></small>
                </div>
            </div>
        </div>
            <script>
                $("#nilai_jual_tanah").maskMoney();
            </script>
@endif
