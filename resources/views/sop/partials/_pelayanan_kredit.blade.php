<form action="/pengaturan/pengelola/{{ $kec->id }}" method="post" id="FormPengelola">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label"for="sebutan_pengawas">Default Jasa (%)</label>
                <input autocomplete="off" type="text" name="sebutan_pengawas" id="sebutan_pengawas"
                    class="form-control" value="{{ $kec->nama_bp_long }}">
                <small class="text-danger" id="msg_sebutan_pengawas"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label"for="sebutan_verifikator">Default Jangka Waktu</label>
                <input autocomplete="off" type="text" name="sebutan_verifikator" id="sebutan_verifikator"
                    class="form-control" value="{{ $kec->nama_tv_long }}">
                <small class="text-danger" id="msg_sebutan_verifikator"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label" for="kepala_lembaga">Default Fee dari Supplier (%)</label>
                <input autocomplete="off" type="text" name="kepala_lembaga" id="kepala_lembaga" class="form-control"
                    value="{{ $kec->sebutan_level_1 }}">
                <small class="text-danger" id="msg_kepala_lembaga"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3"><label class="form-label" for="kabag_administrasi">Default Pembulatan</label>
                <input autocomplete="off" type="text" name="kabag_administrasi" id="kabag_administrasi"
                    class="form-control" value="{{ $kec->sebutan_level_2 }}">
                <small class="text-danger" id="msg_kabag_administrasi"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label"for="kabag_keuangan">Default Fee Agen (%)</label>
                <input autocomplete="off" type="text" name="kabag_keuangan" id="kabag_keuangan" class="form-control"
                    value="{{ $kec->sebutan_level_3 }}">
                <small class="text-danger" id="msg_kabag_keuangan"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label" for="bkk_bkm">Default Biaya Admin (Rp)</label>
                <input autocomplete="off" type="text" name="bkk_bkm" id="bkk_bkm" class="form-control"
                    value="{{ $kec->disiapkan }}">
                <small class="text-danger" id="msg_bkk_bkm"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label"for="kabag_keuangan">Rumus Fee Agen</label><br>
                    
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female"> Rumus 1 (Pros % Fee x Harga Barang)</label><br>
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other"> Rumus 2 (Pros % Fee x Total Jasa)</label><br><br>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label" for="bkk_bkm">Jenis Angsuran</label><br>
                
                <input type="radio" id="female" name="gender" value="female">
                <label for="female"> Angsuran di Awal</label><br>
                <input type="radio" id="other" name="gender" value="other">
                <label for="other"> Angsuran di Akhir Periode</label><br><br>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb-3">
                <label class="form-label"for="kabag_keuangan">Rumus Fee Agen</label><br>
                    
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Hanya satu</label><br>
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Lebih dari satu</label><br><br>
            </div>
        </div>
    </div>
</form>

<div class="d-flex justify-content-end">
    <button type="button" id="SimpanPengelola" data-target="#FormPengelola" class="btn btn-secondary mb-0 btn-simpan">
        Simpan Perubahan
    </button>
</div>