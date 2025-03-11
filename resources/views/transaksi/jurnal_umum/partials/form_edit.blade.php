<form id="editForm"  method="post" action="/transaksi/update_transaksi">
    @csrf
    <input type="hidden" name="idt" value="{{ $trx->idt }}">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="input-group input-group-static my-3">
                <label for="tgl_transaksi">Tgl Transaksi</label>
                <input autocomplete="off" type="text" name="tgl_transaksi" id="tgl_transaksi"
                    class="form-control{{ session('lokasi') != 197 ? ' date' : '' }}"
                    value="{{ $trx->tgl_transaksi }}"
                    @if(session('lokasi') == 197) readonly @endif>
                <small class="text-danger" id="msg_tgl_transaksi"></small>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row" id="kd_rekening">
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
            <div class="my-2">
                <label class="form-label" for="sumber_dana">Sumber Dana</label>
                <input autocomplete="off" type="text" name="sumber_dana" id="sumber_dana"
                value="{{ $trx->rekening_kredit }}"
                    class="form-control">
                <small class="text-danger" id="msg_sumber_dana"></small>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="my-2">
                <label class="form-label" for="disimpan_ke">Disimpan Ke</label>
                <input autocomplete="off" type="text" name="disimpan_ke" id="disimpan_ke"
                value="{{ $trx->rekening_debit }}"
                    class="form-control">
                <small class="text-danger" id="msg_disimpan_ke"></small>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row" id="form_nominal">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="input-group input-group-static my-3">
                <label for="keterangan">Keterangan</label>
                <input autocomplete="off" type="text" name="keterangan" id="keterangan"
                value="{{ $trx->keterangan_transaksi }}"
                    class="form-control">
                <small class="text-danger" id="msg_keterangan"></small>
            </div>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="input-group input-group-static my-3">
                <label for="nominal">Nominal Rp.</label>
                <input autocomplete="off" type="text" name="nominal" id="nominal"
                value="{{ $trx->jumlah }}"
                    class="form-control">
                <small class="text-danger" id="msg_nominal"></small>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
    
    <div class="row" id="form_nominal">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-end">
            <button type="button" class="btn btn-primary btn-save">Simpan</button>
        </div>
        <div class="col-sm-3"></div>
    </div>
</form>
