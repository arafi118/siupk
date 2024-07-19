<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-4">
            Edit Agent {{ $agent->nama }} [{{ $agent->nomorid }}]
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="/database/agent/{{ $agent->id }}" method="post" id="FormEditAgent">
            @csrf
            @method('PUT')
            <input type="hidden" name="agent" id="agent" value="{{ $agent->id }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label class="form-label" for="desa">Desa/Kelurahan</label>
                        <select class="js-example-basic-single form-control" name="desa" id="desa">
                            <option value="">Pilih ......</option>
                            @foreach ($desa as $ds)
                                <option {{ $desa_dipilih == $ds->kd_desa ? 'selected' : '' }} value="{{ $ds->kd_desa }}">
                                    {{ $ds->sebutan_desa->sebutan_desa }} {{ $ds->nama_desa }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="msg_desa"></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="DOMContentLoaded position-relative mb-3">
                        <label for="kd_agent" class="form-label">Kd Agent</label>
                        <input autocomplete="off" type="text" name="kd_agent" id="kd_agent"
                               class="form-control" value="{{ $agent->kd_agent }}" readonly>
                        <small class="text-danger" id="msg_kd_agent"></small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="agent" class="form-label">Agent</label>
                        <input autocomplete="off" type="text" name="agent" id="agent"
                            class="form-control money" value="{{ $agent->agent}}">
                        <small class="text-danger" id="msg_agent"></small>
                    </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control"
                            value="{{ $agent->alamat }}">
                        <small class="text-danger" id="msg_alamat"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="nohp" class="form-label">Nomor HP</label>
                        <input autocomplete="off" type="text" name="nohp" id="nohp"
                            class="form-control money" value="{{$agent->nohp}}">
                        <small class="text-danger" id="msg_nohp"></small>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="SimpanEditAgent" class="btn btn-sm btn-github btn btn-sm btn-dark mb-0">Simpan</button>
    </div>
</div>
<script>
    $('.js-example-basic-single').select2({
        theme: 'bootstrap-5'
        });
        $(document).on('change', '#desa', function (e) {
        e.preventDefault()

            var kd_desa = $(this).val()
            $.get('/database/agent/generatekode?kode=' + kd_desa, function (result) {
                $('#kd_agent').val(result.kd_agent)
            })
        });
</script>