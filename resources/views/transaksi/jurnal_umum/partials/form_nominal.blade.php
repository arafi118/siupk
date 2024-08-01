@if ($relasi)
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="relasi">Relasi&nbsp;</label>
                <input autocomplete="off" type="text" name="relasi" id="relasi" class="form-control">
                <small class="text-danger" id="msg_relasi"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="keterangan">Keterangan&nbsp;</label>
                <input autocomplete="off" type="text" name="keterangan" id="keterangan" class="form-control"
                    value="{{ $keterangan_transaksi }}">
                <small class="text-danger" id="msg_keterangan"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb-3">
                <label for="nominal">Nominal Rp.&nbsp;</label>
                <input autocomplete="off" type="text" name="nominal" id="nominal" class="form-control">
                <small class="text-danger" id="msg_nominal"></small>
            </div>
        </div>
    </div>
</div>
@else
<div>
    <input type="hidden" name="relasi" id="relasi" value="">
    <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb-3">
                <label for="keterangan">Keterangan&nbsp;</label>
                <input autocomplete="off" type="text" name="keterangan" id="keterangan" class="form-control"
                    value="{{ $keterangan_transaksi }}">
                <small class="text-danger" id="msg_keterangan"></small>
            </div>
        </div>
        <div class="col-md-12">
            <div class="position-relative mb-3">
                <label for="nominal">Nominal Rp.&nbsp;</label>
                <input autocomplete="off" type="text" name="nominal" id="nominal" class="form-control"
                    value="{{ number_format($susut, 2) }}">
                <small class="text-danger" id="msg_nominal"></small>
            </div>
        </div>
    </div>
</div>
@endif
<script>
$("#nominal").maskMoney({
            allowNegative: true
        });
</script>