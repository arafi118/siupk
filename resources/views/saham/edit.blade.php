<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-4">
            Edit Data {{ $saham->nama_saham }} [{{ $saham-> id}}]
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="/database/saham/{{ $saham->id }}" method="post" id="FormEditSaham">
            @csrf
            @method('PUT')
            <input type="hidden" name="saham" id="saham" value="{{ $saham->id }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="nama_saham" class="form-label">Nama Pemegang Saham</label>
                        <input autocomplete="off" type="text" name="nama_saham" id="nama_saham" value="{{ $saham->nama_saham }}" class="form-control">
                        <small class="text-danger" id="msg_nama_saham"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="rp_saham" class="form-label">Rupiah(Rp)</label>
                        <input autocomplete="off" type="text" name="rp_saham" id="rp_saham" value="{{ $saham->rp_saham }}" class="form-control">
                        <small class="text-danger" id="msg_rp_saham"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="pros_saham" class="form-label">Persentase(%)</label>
                        <input autocomplete="off" type="text" name="pros_saham" id="pros_saham" value="{{ $saham->pros_saham }}" class="form-control">
                        <small class="text-danger" id="msg_pros_saham"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="nama_direksi" class="form-label">Nama Direksi</label>
                        <input autocomplete="off" type="text" name="nama_direksi" id="nama_direksi" value="{{ $saham->nama_direksi }}" class="form-control">
                        <small class="text-danger" id="msg_nama_direksi"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="nama_kom" class="form-label">Nama Komisaris</label>
                        <input autocomplete="off" type="text" name="nama_kom" id="nama_kom" value="{{ $saham->nama_kom }}" class="form-control">
                        <small class="text-danger" id="msg_nama_kom"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="jab_direksi" class="form-label">Jabatan Direksi</label>
                        <input autocomplete="off" type="text" name="jab_direksi" id="jab_direksi" value="{{ $saham->jab_direksi }}" class="form-control">
                        <small class="text-danger" id="msg_jab_direksi"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="jab_kom" class="form-label">Jabatan Komisaris</label>
                        <input autocomplete="off" type="text" name="jab_kom" id="jab_kom" value="{{ $saham->jab_kom }}" class="form-control">
                        <small class="text-danger" id="msg_jab_kom"></small>
                    </div>
                </div>
            </div>
        </form>
    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger btn-delete">
            Hapus Direksi dan Komisaris
        </button>

        <button type="button" class="btn btn-sm btn-info" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="SimpanEditSaham" class="btn btn-sm btn-github btn btn-sm btn-dark mb-0">Simpan</button>
    </div>
</div>
<script>
    $('.js-example-basic-single').select2({
        theme: 'bootstrap-5'
        });
        $(document).on('change', '#desa', function (e) {
        e.preventDefault()

            var kd_desa = $(this).val()
            $.get('/database/saham/generatekode?kode=' + kd_desa, function (result) {
                $('#kd_saham').val(result.kd_saham)
            })
        });
</script>