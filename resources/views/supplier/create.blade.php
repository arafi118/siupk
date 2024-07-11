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
                        <label for="nomorid" class="form-label">Nomor ID</label>
                        <input autocomplete="off"type="text" name="nomorid" id="nomorid" class="form-control">
                        <small class="text-danger" id="msg_nomorid"></small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input autocomplete="off" type="text" name="nama" id="nama" class="form-control">
                        <small class="text-danger" id="msg_nama"></small>
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