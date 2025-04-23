
<form action="/pengaturan/simpanan/{{ $kec->id }}" method="post" id="FormSimpanan">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="my-2">
                <label class="form-label" for="hitung_bunga" >hitung bunga</label>
                <select class="form-control" name="hitung_bunga" id="hitung_bunga">
                    <option {{ $kec->hitung_bunga == '0' ? 'selected' : '' }} value="0">Silakan Pilih Perhitungan</option>
                    <option {{ $kec->hitung_bunga == '1' ? 'selected' : '' }} value="1">Saldo Terakhir</option>
                    <option {{ $kec->hitung_bunga == '2' ? 'selected' : '' }} value="2">Saldo Terendah</option>
                    <option {{ $kec->hitung_bunga == '3' ? 'selected' : '' }} value="3">Saldo Rata-rata</option>
                </select>
                <small class="text-danger" id="msg_hitung_bunga"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="tgl_bunga">Tanggal Perhitungan Bunga</label>
                <input autocomplete="off" type="number" name="tgl_bunga" id="tgl_bunga" class="form-control"
                    value="{{ $kec->tgl_bunga }}">
                <small class="text-danger" id="msg_tgl_bunga"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="min_bunga">Minimal Saldo untuk mendapat Bunga</label>
                <input autocomplete="off" type="number" name="min_bunga" id="min_bunga" class="form-control"
                    value="{{ $kec->min_bunga }}">
                <small class="text-danger" id="msg_min_bunga"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="min_pajak">Minimal Bunga untuk dikenai Pajak</label>
                <input autocomplete="off" type="number" name="min_pajak" id="min_pajak" class="form-control"
                    value="{{ $kec->min_pajak }}">
                <small class="text-danger" id="msg_min_pajak"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="def_bunga">Default Besaran Bunga (%)</label>
                <input autocomplete="off" type="number" name="def_bunga" id="def_bunga" class="form-control"
                    value="{{ $kec->def_bunga }}">
                <small class="text-danger" id="msg_def_bunga"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="def_pajak_bunga">Default Besaran Pajak Bunga (%)</label>
                <input autocomplete="off" type="number" name="def_pajak_bunga" id="def_pajak_bunga" class="form-control"
                    value="{{ $kec->def_pajak_bunga }}">
                <small class="text-danger" id="msg_def_pajak_bunga"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="def_admin">Default Admin Bulanan</label>
                <input autocomplete="off" type="number" name="def_admin" id="def_admin" class="form-control"
                    value="{{ $kec->def_admin }}">
                <small class="text-danger" id="msg_def_admin"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="def_open_rek">Default Admin Buka Rekening</label>
                <input autocomplete="off" type="number" name="def_open_rek" id="def_open_rek" class="form-control"
                    value="{{ $kec->def_open_rek }}">
                <small class="text-danger" id="msg_def_open_rek"></small>
            </div>
        </div>
    </div>
</form>

<div class="d-flex justify-content-end">
    <button type="button" id="SimpanSnmpanan" data-target="#FormSimpanan"
        class="btn btn-sm btn-github mb-0 btn-simpan">
        Simpan Perubahan
    </button>
</div>
