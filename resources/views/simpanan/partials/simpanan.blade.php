@if ($id == '1')
    <div class="row">
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="nomor_rekening">Nomor Rekening</label>
                <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"
                    value="{{$nomor_rekening}}" readonly>
                <small class="text-danger" id="msg_nomor_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="tgl_buka_rekening">Tgl Buka Rekening</label>
                <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_buka_rekening"></small>
            </div>
        </div>
        
        <div class="col-md-4">
                <input autocomplete="off" type="hidden" name="tgl_minimal_tutup_rekening" id="tgl_minimal_tutup_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="setoran_awal">Setoran awal</label>
                <input autocomplete="off" type="text" name="setoran_awal" id="setoran_awal" class="form-control">
                <small class="text-danger" id="msg_setoran_awal"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="bunga">Bunga</label>
                <input autocomplete="off" type="number" name="bunga" id="bunga" class="form-control" value="{{$kec->def_bunga}}">
                <small class="text-danger" id="msg_bunga"></small>
            </div>
        </div> 
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="pajak_bunga">Pajak Bunga</label>
                <input autocomplete="off" type="number" name="pajak_bunga" id="pajak_bunga" class="form-control"
                    value="{{$kec->def_pajak_bunga}}">
                <small class="text-danger" id="msg_pajak_bunga"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="admin">Admin</label>
                <input autocomplete="off" type="text" name="admin" id="admin" class="form-control"
                    value="{{$kec->def_admin}}">
                <small class="text-danger" id="msg_admin"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="my-2">
                <label class="form-label" for="kuasa">Kuasa</label>
                <select class="form-control" name="kuasa" id="kuasa">
                    <option value="1">Pribadi</option>
                    <option value="2">Lembaga</option>
                </select>
                <small class="text-danger" id="msg_kuasa"></small>
            </div>
        </div>
                <div class="row" id="formKuasa"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="ahli_waris">Ahli Waris / Pengampu</label>
                <input autocomplete="off" type="text" name="ahli_waris" id="ahli_waris" class="form-control"
                    value="">
                <small class="text-danger" id="msg_ahli_waris"></small>
            </div>
        </div>
        <div class="col-md-6">
                <input autocomplete="off" type="hidden" name="hubungan" id="hubungan" class="form-control"
                    value="1">
        </div>
    </div>
@elseif ($id == '2')
    <div class="row">
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="nomor_rekening">Nomor Rekening</label>
                <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"
                    value="{{$nomor_rekening}}" readonly>
                <small class="text-danger" id="msg_nomor_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="tgl_buka_rekening">Tgl Buka Rekening</label>
                <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_buka_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="tgl_minimal_tutup_rekening">Tgl Minimal Tutup Rekening</label>
                <input autocomplete="off" type="text" name="tgl_minimal_tutup_rekening" id="tgl_minimal_tutup_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_minimal_tutup_rekening"></small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="setoran_awal">Setoran awal</label>
                <input autocomplete="off" type="text" name="setoran_awal" id="setoran_awal" class="form-control">
                <small class="text-danger" id="msg_setoran_awal"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="bunga">Bunga</label>
                <input autocomplete="off" type="number" name="bunga" id="bunga" class="form-control" value="{{$kec->def_bunga}}">
                <small class="text-danger" id="msg_bunga"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="pajak_bunga">Pajak Bunga</label>
                <input autocomplete="off" type="number" name="pajak_bunga" id="pajak_bunga" class="form-control"
                    value="{{$kec->def_pajak_bunga}}">
                <small class="text-danger" id="msg_pajak_bunga"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="admin">Admin</label>
                <input autocomplete="off" type="text" name="admin" id="admin" class="form-control"
                    value="{{$kec->def_admin}}">
                <small class="text-danger" id="msg_admin"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="my-2">
                <label class="form-label" for="kuasa">Kuasa</label>
                <select class="form-control" name="kuasa" id="kuasa">
                    <option value="1">Pribadi</option>
                    <option value="2">Lembaga</option>
                </select>
                <small class="text-danger" id="msg_kuasa"></small>
            </div>
        </div>
                <div class="row" id="formKuasa"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="ahli_waris">Ahli Waris / Pengampu</label>
                <input autocomplete="off" type="text" name="ahli_waris" id="ahli_waris" class="form-control"
                    value="">
                <small class="text-danger" id="msg_ahli_waris"></small>
            </div>
        </div>
        <div class="col-md-6">
                <input autocomplete="off" type="hidden" name="hubungan" id="hubungan" class="form-control"
                    value="1">
        </div>
    </div>
@elseif ($id == '3')
    <div class="row">
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="nomor_rekening">Nomor Rekening</label>
                <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"
                    value="{{$nomor_rekening}}" readonly>
                <small class="text-danger" id="msg_nomor_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="tgl_buka_rekening">Tgl Buka Rekening</label>
                <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_buka_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="tgl_minimal_tutup_rekening">Tgl Minimal Tutup Rekening</label>
                <input autocomplete="off" type="text" name="tgl_minimal_tutup_rekening" id="tgl_minimal_tutup_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_minimal_tutup_rekening"></small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="setoran_awal">Setoran awal</label>
                <input autocomplete="off" type="text" name="setoran_awal" id="setoran_awal" class="form-control">
                <small class="text-danger" id="msg_setoran_awal"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="bunga">Bunga</label>
                <input autocomplete="off" type="number" name="bunga" id="bunga" class="form-control" value="{{$kec->def_bunga}}">
                <small class="text-danger" id="msg_bunga"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="pajak_bunga">Pajak Bunga</label>
                <input autocomplete="off" type="number" name="pajak_bunga" id="pajak_bunga" class="form-control"
                    value="{{$kec->def_pajak_bunga}}">
                <small class="text-danger" id="msg_pajak_bunga"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="admin">Admin</label>
                <input autocomplete="off" type="text" name="admin" id="admin" class="form-control"
                    value="{{$kec->def_admin}}">
                <small class="text-danger" id="msg_admin"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="my-2">
                <label class="form-label" for="kuasa">Kuasa</label>
                <select class="form-control" name="kuasa" id="kuasa">
                    <option value="1">Pribadi</option>
                    <option value="2">Lembaga</option>
                </select>
                <small class="text-danger" id="msg_kuasa"></small>
            </div>
        </div>
                <div class="row" id="formKuasa"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="ahli_waris">Ahli Waris / Pengampu</label>
                <input autocomplete="off" type="text" name="ahli_waris" id="ahli_waris" class="form-control"
                    value="">
                <small class="text-danger" id="msg_ahli_waris"></small>
            </div>
        </div>
        <div class="col-md-6">
                <input autocomplete="off" type="hidden" name="hubungan" id="hubungan" class="form-control"
                    value="1">
        </div>
    </div>


@elseif ($id == '4')
    <div class="row">
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="nomor_rekening">Nomor Rekening</label>
                <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"
                    value="{{$nomor_rekening}}" readonly>
                <small class="text-danger" id="msg_nomor_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="tgl_buka_rekening">Tgl Buka Rekening</label>
                <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_buka_rekening"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-static my-3">
                <label for="tgl_minimal_tutup_rekening">Tgl Minimal Tutup Rekening</label>
                <input autocomplete="off" type="text" name="tgl_minimal_tutup_rekening" id="tgl_minimal_tutup_rekening"
                    class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_minimal_tutup_rekening"></small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="setoran_awal">Setoran awal</label>
                <input autocomplete="off" type="text" name="setoran_awal" id="setoran_awal" class="form-control">
                <small class="text-danger" id="msg_setoran_awal"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="bunga">Bunga</label>
                <input autocomplete="off" type="number" name="bunga" id="bunga" class="form-control" value="{{$kec->def_bunga}}">
                <small class="text-danger" id="msg_bunga"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="pajak_bunga">Pajak Bunga</label>
                <input autocomplete="off" type="number" name="pajak_bunga" id="pajak_bunga" class="form-control"
                    value="{{$kec->def_pajak_bunga}}">
                <small class="text-danger" id="msg_pajak_bunga"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="admin">Admin</label>
                <input autocomplete="off" type="text" name="admin" id="admin" class="form-control"
                    value="{{$kec->def_admin}}">
                <small class="text-danger" id="msg_admin"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="my-2">
                <label class="form-label" for="kuasa">Kuasa</label>
                <select class="form-control" name="kuasa" id="kuasa">
                    <option value="1">Pribadi</option>
                    <option value="2">Lembaga</option>
                </select>
                <small class="text-danger" id="msg_kuasa"></small>
            </div>
        </div>
                <div class="row" id="formKuasa"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group input-group-static my-3">
                <label for="ahli_waris">Ahli Waris / Pengampu</label>
                <input autocomplete="off" type="text" name="ahli_waris" id="ahli_waris" class="form-control"
                    value="">
                <small class="text-danger" id="msg_ahli_waris"></small>
            </div>
        </div>
        <div class="col-md-6">
                <input autocomplete="off" type="hidden" name="hubungan" id="hubungan" class="form-control"
                    value="1">
        </div>
    </div>
@else
    jika anda melihat pesan ini, silakan hubungi TS
@endif
