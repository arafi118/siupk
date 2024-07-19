<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-4">
            Edit Supplier {{ $supplier->supplier }} [{{ $supplier->kd_supplier }}]
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="/database/supplier/{{ $supplier->id }}" method="post" id="FormEditSupplier">
            @csrf
            @method('PUT')
            <input type="hidden" name="supplier" id="supplier" value="{{ $supplier->id }}">
            <div class="row">
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="" class="form-label">KD Supplier</label>
                        <input autocomplete="off"type="text" name="" id="" class="form-control" value="{{ $supplier->kd_supplier  }}" readonly>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="supplier" class="form-label">Nama Supplier</label>
                        <input autocomplete="off" type="text" name="supplier" id="supplier"
                            class="form-control money" value="{{ $supplier->supplier}}">
                        <small class="text-danger" id="msg_supplier"></small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control"
                            value="{{ $supplier->alamat }}">
                        <small class="text-danger" id="msg_alamat"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="DOMContentLoaded position-relative mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input autocomplete="off" type="text" name="brand" id="brand"
                               class="form-control" value="{{$supplier->brand}}">
                        <small class="text-danger" id="msg_brand"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="nohp" class="form-label">Nomor HP</label>
                        <input autocomplete="off" type="text" name="nohp" id="nohp"
                            class="form-control money" value="{{$supplier->nohp}}">
                        <small class="text-danger" id="msg_nohp"></small>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="simpanEditSupplier" class="btn btn-sm btn-github btn btn-sm btn-dark mb-0">Simpan</button>
    </div>
</div>

