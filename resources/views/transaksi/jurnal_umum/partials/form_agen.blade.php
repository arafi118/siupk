@php
    use App\Utils\Anggota as Ang;
@endphp
<div>
<div class="row">
    <div class="col-md-6">
        <div class="position-relative mb-3">
            <label for="relasi">Nama Kreditur</label>
            <select class="js_select2 form-control" name="relasi" id="relasi"style="font-size: 9px;">
                <option value=""></option>
                @foreach ($Pinjaman as $Ang)
                    <option value="{{ $Ang->anggota->nik }}#{{ $Ang->anggota->namadepan }}#{{ $Ang->id }}#{{ $Ang->fee_agent }}">
                        ({{ $Ang->anggota->nik }}) {{ $Ang->anggota->namadepan }} - {{ $Ang->id }}
                    </option>
                @endforeach
            </select>            
            <small class="text-danger" id="msg_relasi"></small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative mb-3">
            <label for="fee_agen" >Fee Agen (Rp)</label>
            <input type="text" name="nominal" id="fee_agen" class="form-control">
            <small class="text-danger" id="msg_nominal"></small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="position-relative mb-3">
            <label for="keterangan">Keterangan</label>
            <input autocomplete="off" type="text" name="keterangan" id="keterangan" class="form-control" value="">
                <small class="text-danger" id="msg_keterangan"></small>
        </div>
    </div>
</div>
</div>
<script>
    $('.js_select2').select2({
     theme: 'bootstrap-5'
    })
</script>
