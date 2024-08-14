
<div class="card-body">
    @if ($id == '1')
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                    <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"value="{{$nomor_rekening}}" readonly>
                    <small class="text-danger" id="msg_nomor_rekening"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="tgl_buka_rekening" class="form-label">Tgl Buka Rekening</label>
                    <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                    <small class="text-danger" id="msg_tgl_buka_rekening"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <input autocomplete="off" type="hidden" name="tgl_minimal_tutup_rekening" id="tgl_minimal_tutup_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="setoran_awal" class="form-label">Setoran awal</label>
                    <input autocomplete="off" type="text" name="setoran_awal" id="setoran_awal" class="form-control">
                        <small class="text-danger" id="msg_setoran_awal"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="bunga" class="form-label">Bunga</label>
                    <input autocomplete="off" type="number" name="bunga" id="bunga" class="form-control">
                        <small class="text-danger" id="msg_bunga"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="pajak_bunga" class="form-label">Pajak Bunga</label>
                    <input autocomplete="off" type="number" name="pajak_bunga" id="pajak_bunga" class="form-control"
                            value="">
                        <small class="text-danger" id="msg_pajak_bunga"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="admin" class="form-label">Admin</label>
                    <input autocomplete="off" type="text" name="admin" id="admin" class="form-control"value="">
                    <small class="text-danger" id="msg_admin"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative mb-3">
                    <label for="kuasa" class="form-label">Kuasa</label>
                    <select class="js-example-basic-single form-control" name="kuasa" id="kuasa" style="width: 100%;">
                        @foreach ($fromkuasa as $fk)
                            <option value="{{ $fk['id'] }}">
                                {{ $fk['nama'] }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_kuasa"></small>                                                                                                                                             
                </div>
            </div>
            
        <div class="row" id="formKuasa"></div>
        </div>  
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="ahli_waris">Ahli Waris / Pengampu</label>
                    <input autocomplete="off" type="text" name="ahli_waris" id="ahli_waris" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_ahli_waris"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="hubungan">Hubungan</label>
                    <select class="js-example-basic-single form-control" name="hubungan" id="hubungan">
                        @foreach ($hubungan as $hb)
                            <option {{ $hubungan_dipilih == $hb->id ? 'selected' : '' }} value="{{ $hb->id }}">
                                {{ $hb->kekeluargaan }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_hubungan"></small>
                </div>
            </div>
        </div>
    @elseif ($id == '2')
        <div class="row">
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nomor_rekening">Nomor Rekening</label>
                    <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"
                            value="{{$nomor_rekening}}" readonly>
                        <small class="text-danger" id="msg_nomor_rekening"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="tgl_buka_rekening">Tgl Buka Rekening</label>
                    <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening"
                        class="form-control date" value="{{ date('d/m/Y') }}">
                    <small class="text-danger" id="msg_tgl_buka_rekening"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="tgl_minimal_tutup_rekening">Tgl Minimal Tutup Rekening</label>
                    <input autocomplete="off" type="text" name="tgl_minimal_tutup_rekening" id="tgl_minimal_tutup_rekening"
                        class="form-control date" value="{{ date('d/m/Y') }}">
                    <small class="text-danger" id="msg_tgl_minimal_tutup_rekening"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="setoran_awal">Setoran awal</label>
                    <input autocomplete="off" type="text" name="setoran_awal" id="setoran_awal" class="form-control">
                    <small class="text-danger" id="msg_setoran_awal"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="bunga">Bunga</label>
                    <input autocomplete="off" type="number" name="bunga" id="bunga" class="form-control">
                    <small class="text-danger" id="msg_bunga"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="pajak_bunga">Pajak Bunga</label>
                    <input autocomplete="off" type="number" name="pajak_bunga" id="pajak_bunga" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_pajak_bunga"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="admin">Admin</label>
                    <input autocomplete="off" type="text" name="admin" id="admin" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_admin"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative mb-3">
                    <label for="kuasa" class="form-label">Kuasa</label>
                    <select class="js-example-basic-single form-control" name="kuasa" id="kuasa" style="width: 100%;">
                        @foreach ($fromkuasa as $fk)
                            <option value="{{ $fk['id'] }}">
                                {{ $fk['nama'] }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_kuasa"></small>                                                                                                                                             
                </div>
            </div>
        </div>  
        <div class="row" id="formKuasa"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="ahli_waris">Ahli Waris / Pengampu</label>
                    <input autocomplete="off" type="text" name="ahli_waris" id="ahli_waris" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_ahli_waris"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="hubungan">Hubungan</label>
                    <select class="js-example-basic-single form-control" name="hubungan" id="hubungan">
                        @foreach ($hubungan as $hb)
                            <option {{ $hubungan_dipilih == $hb->id ? 'selected' : '' }} value="{{ $hb->id }}">
                                {{ $hb->kekeluargaan }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_hubungan"></small>
                </div>
            </div>
        </div>
    @elseif ($id == '3')
        <div class="row">
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="nomor_rekening">Nomor Rekening</label>
                    <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"
                        value="{{$nomor_rekening}}" readonly>
                    <small class="text-danger" id="msg_nomor_rekening"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="tgl_buka_rekening">Tgl Buka Rekening</label>
                        <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening"
                            class="form-control date" value="{{ date('d/m/Y') }}">
                        <small class="text-danger" id="msg_tgl_buka_rekening"></small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative mb-3">
                    <label for="tgl_minimal_tutup_rekening">Tgl Minimal Tutup Rekening</label>
                    <input autocomplete="off" type="text" name="tgl_minimal_tutup_rekening" id="tgl_minimal_tutup_rekening"
                        class="form-control date" value="{{ date('d/m/Y') }}">
                    <small class="text-danger" id="msg_tgl_minimal_tutup_rekening"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="setoran_awal">Setoran awal</label>
                        <input autocomplete="off" type="text" name="setoran_awal" id="setoran_awal" class="form-control">
                        <small class="text-danger" id="msg_setoran_awal"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="bunga">Bunga</label>
                    <input autocomplete="off" type="number" name="bunga" id="bunga" class="form-control">
                    <small class="text-danger" id="msg_bunga"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="pajak_bunga">Pajak Bunga</label>
                    <input autocomplete="off" type="number" name="pajak_bunga" id="pajak_bunga" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_pajak_bunga"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="admin">Admin</label>
                    <input autocomplete="off" type="text" name="admin" id="admin" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_admin"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative mb-3">
                    <label for="kuasa" class="form-label">Kuasa</label>
                    <select class="js-example-basic-single form-control" name="kuasa" id="kuasa" style="width: 100%;">
                        @foreach ($fromkuasa as $fk)
                            <option value="{{ $fk['id'] }}">
                                {{ $fk['nama'] }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_kuasa"></small>                                                                                                                                             
                </div>
            </div>
        </div>  
        <div class="row" id="formKuasa"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="ahli_waris">Ahli Waris / Pengampu</label>
                    <input autocomplete="off" type="text" name="ahli_waris" id="ahli_waris" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_ahli_waris"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="hubungan">Hubungan</label>
                    <select class="js-example-basic-single form-control" name="hubungan" id="hubungan">
                        @foreach ($hubungan as $hb)
                            <option {{ $hubungan_dipilih == $hb->id ? 'selected' : '' }} value="{{ $hb->id }}">
                                {{ $hb->kekeluargaan }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_hubungan"></small>
                </div>
            </div>
        </div>
    @elseif ($id == '4')
    <div class="row">
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="nomor_rekening">Nomor Rekening</label>
                <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"
                    value="{{$nomor_rekening}}" readonly>
                <small class="text-danger" id="msg_nomor_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="tgl_buka_rekening">Tgl Buka Rekening</label>
                    <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening"
                        class="form-control date" value="{{ date('d/m/Y') }}">
                    <small class="text-danger" id="msg_tgl_buka_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="tgl_minimal_tutup_rekening">Tgl Minimal Tutup Rekening</label>
                <input autocomplete="off" type="text" name="tgl_minimal_tutup_rekening" id="tgl_minimal_tutup_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_minimal_tutup_rekening"></small>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="setoran_awal">Setoran awal</label>
                        <input autocomplete="off" type="text" name="setoran_awal" id="setoran_awal" class="form-control">
                        <small class="text-danger" id="msg_setoran_awal"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="bunga">Bunga</label>
                    <input autocomplete="off" type="number" name="bunga" id="bunga" class="form-control">
                    <small class="text-danger" id="msg_bunga"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="pajak_bunga">Pajak Bunga</label>
                    <input autocomplete="off" type="number" name="pajak_bunga" id="pajak_bunga" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_pajak_bunga"></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative mb-3">
                    <label for="admin">Admin</label>
                    <input autocomplete="off" type="text" name="admin" id="admin" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_admin"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative mb-3">
                    <label for="kuasa" class="form-label">Kuasa</label>
                    <select class="js-example-basic-single form-control" name="kuasa" id="kuasa" style="width: 100%;">
                        @foreach ($fromkuasa as $fk)
                            <option value="{{ $fk['id'] }}" {{ ($fk['id'] == '2') ? 'selected':'' }}>
                                {{ $fk['nama'] }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_kuasa"></small>                                                                                                                                             
                </div>
            </div>
        </div>        
        <div class="row" id="formKuasa"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="ahli_waris">Ahli Waris / Pengampu</label>
                    <input autocomplete="off" type="text" name="ahli_waris" id="ahli_waris" class="form-control"
                        value="">
                    <small class="text-danger" id="msg_ahli_waris"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="hubungan">Hubungan</label>
                    <select class="js-example-basic-single form-control" name="hubungan" id="hubungan">
                        @foreach ($hubungan as $hb)
                            <option {{ $hubungan_dipilih == $hb->id ? 'selected' : '' }} value="{{ $hb->id }}">
                                {{ $hb->kekeluargaan }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_hubungan"></small>
                </div>
            </div>
        </div>
    @else
        jika anda melihat pesan ini, silakan hubungi TS
    @endif
</div>
<script>
    $('.js-example-basic-single').select2({
      theme: 'bootstrap-5'
    });  
    $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });
    $(document).on('change', '#kuasa', function() {
        fromkuasa()
    })
    function fromkuasa() {
        let fromkuasa = $('#kuasa').val();
        $.get('/simpanan/kuasa/' + fromkuasa, function(result) {
            $('#formKuasa').html(result.view)
        })
    }
    
    fromkuasa()
</script>