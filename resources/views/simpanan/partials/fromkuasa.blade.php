@if ($id == '2')
<div class="col-md-4">
    <div class="position-relative mb-3">
        <label for="lembaga">Nama Lembaga</label>
        <input autocomplete="off" type="text" name="lembaga" id="lembaga" class="form-control" value="">
        <small class="text-danger" id="msg_lembaga"></small>
    </div>
</div>
<div class="col-md-4">
    <div class="position-relative mb-3">
        <label for="jabatan">Jabatan</label>
        <input autocomplete="off" type="text" name="jabatan" id="jabatan" class="form-control" value="">
        <small class="text-danger" id="msg_jabatan"></small>
    </div>
</div>
<div class="col-md-4">
    <div class="position-relative mb-3">
        <label for="catatan_simpanan">Keterangan</label>
        <input autocomplete="off" type="text" name="catatan_simpanan" id="catatan_simpanan" class="form-control" value="">
        <small class="text-danger" id="msg_catatan_simpanan"></small>
    </div>
</div>
@else
<input autocomplete="off" type="hidden" name="lembaga" id="lembaga" class="form-control" value="-">
<input autocomplete="off" type="hidden" name="jabatan" id="jabatan" class="form-control" value="-">
<input autocomplete="off" type="hidden" name="catatan_simpanan" id="catatan_simpanan" class="form-control" value="-">
@endif
