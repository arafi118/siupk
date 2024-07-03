@if ($relasi)
    <div class="col-sm-7">
        <div class="input-group input-group-static my-3">
            <label for="relasi">Relasi&nbsp;</label>
            <input autocomplete="off" type="text" name="relasi" id="relasi" class="form-control">
            <small class="text-danger" id="msg_relasi"></small>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="input-group input-group-static my-3">
            <label for="keterangan">Keterangan&nbsp;</label>
            <input autocomplete="off" type="text" name="keterangan" id="keterangan" class="form-control"
                value="{{ $keterangan_transaksi }}">
            <small class="text-danger" id="msg_keterangan"></small>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="input-group input-group-static my-3">
            <label for="nominal">Nominal Rp.&nbsp;</label>
            <input autocomplete="off" type="text" name="nominal" id="nominal" class="form-control">
            <small class="text-danger" id="msg_nominal"></small>
        </div>
    </div>
@else
    <input type="hidden" name="relasi" id="relasi" value="">
    <div class="col-sm-12">
        <div class="input-group input-group-static my-3">
            <label for="keterangan">Keterangan&nbsp;</label>
            <input autocomplete="off" type="text" name="keterangan" id="keterangan" class="form-control"
                value="{{ $keterangan_transaksi }}">
            <small class="text-danger" id="msg_keterangan"></small>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="input-group input-group-static my-3">
            <label for="nominal">Nominal Rp.&nbsp;</label>
            <input autocomplete="off" type="text" name="nominal" id="nominal" class="form-control"
                value="{{ number_format($susut, 2) }}">
            <small class="text-danger" id="msg_nominal"></small>
        </div>
    </div>
@endif

