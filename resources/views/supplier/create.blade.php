<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-4" id="NamaDesa">
            TAMBAH DATA SUPPLIER
        </h1>
    </div>
    <div class="modal-body">
        <form action="/database/supplier" method="post" id="FormRegisterSupplier">
            @csrf
        
            <br>
            <div class="row">
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="kd_supplier" class="form-label">KD Supplier</label>
                        <input autocomplete="off"type="text" name="kd_supplier" id="kd_supplier" class="form-control" value="{{ $kd_supplier }}" readonly>
                        <small class="text-danger" id="msg_kd_supplier"></small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="supplier" class="form-label">Nama Supplier</label>
                        <input autocomplete="off" type="text" name="supplier" id="supplier" class="form-control">
                        <small class="text-danger" id="msg_supplier"></small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control">
                        <small class="text-danger" id="msg_alamat"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input autocomplete="off" type="text" name="brand" id="brand" class="form-control">
                        <small class="text-danger" id="msg_brand"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="nohp" class="form-label">No HP</label>
                        <input autocomplete="off" type="text" name="nohp" id="nohp" class="form-control">
                        <small class="text-danger" id="msg_nohp"></small>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark btn-sm" id="SimpanSupplier">Simpan Supplier</button>
    </div>
</div>
<script>
    $(document).on('change', '#desa', function (e) {
        e.preventDefault()

            var kd_desa = $(this).val()
            $.get('/database/agent/generatekode?kode=' + kd_desa, function (result) {
                $('#kd_agent').val(result.kd_agent)
            })
        });

    function submit() {
        console.log("Data disimpan");
        const supplierName = document.getElementById('supplierName').value;
        console.log("Supplier Name: " + supplierName);
        // Logika untuk menyimpan data
    }
</script>