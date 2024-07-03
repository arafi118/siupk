<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-4" id="NamaDesa">
            Edit Desa {{ $supplier->nama }} [{{ $supplier->nomorid }}]
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="/database/supplier/{{ $supplier->id }}" method="post" id="FormEditSupplier">
            @csrf
            @method('PUT')
            <input type="hidden" name="supplier" id="supplier" value="{{ $supplier->id }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="DOMContentLoaded position-relative mb-3">
                        <label for="nomorid" class="form-label">Nomor ID</label>
                        <input autocomplete="off" type="text" name="nomorid" id="nomorid"
                               class="form-control" value="{{ $supplier->nomorid }}">
                        <small class="text-danger" id="msg_nomorid"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input autocomplete="off" type="text" name="nama" id="nama"
                            class="form-control money" value="{{ $supplier->nama}}">
                        <small class="text-danger" id="msg_nama"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control"
                            value="{{ $supplier->alamat }}">
                        <small class="text-danger" id="msg_alamat"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="DOMContentLoaded position-relative mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input autocomplete="off" type="text" name="brand" id="brand"
                               class="form-control" value="{{$supplier->brand}}">
                        <small class="text-danger" id="msg_brand"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="nohp" class="form-label">Nomor HP</label>
                        <input autocomplete="off" type="text" name="nohp" id="nohp"
                            class="form-control money" value="{{$supplier->nohp}}">
                        <small class="text-danger" id="msg_nohp"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="ins" class="form-label">Ins</label>
                        <input autocomplete="off" type="text" name="ins" id="ins" class="form-control"
                            value="{{ $supplier->ins }}">
                        <small class="text-danger" id="msg_ins"></small>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="simpanSupplier" class="btn btn-sm btn-github btn btn-sm btn-dark mb-0">Simpan</button>
    </div>
</div>

