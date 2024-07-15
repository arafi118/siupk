<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-4">
            TAMBAH DATA AGENT
        </h1>
    </div>
    <div class="modal-body">
        <form action="/database/agent" method="post" id="FormRegisterAgent">
            @csrf
        
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="desa" class="form-label">Desa</label>
                        <select class="js-example-basic-single form-control" name="desa" id="desa" style="width: 100%;">
                            @foreach ($desa as $ds)
                                <option value="{{ $ds->id }}">
                                    {{ $ds->nama_desa}}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="msg_desa"></small>  
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="nomorid" class="form-label">NomorID</label>
                        <input autocomplete="off"type="text" name="nomorid" id="nomorid" class="form-control" readonly>
                        <small class="text-danger" id="msg_nomorid" ></small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="agent" class="form-label">Agent</label>
                        <input autocomplete="off" type="text" name="agent" id="agent" class="form-control">
                        <small class="text-danger" id="msg_agent"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control">
                        <small class="text-danger" id="msg_alamat"></small>
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
            {{-- <div class="row">
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="uname" class="form-label">Username</label>
                        <input autocomplete="off" type="text" name="uname" id="uname" class="form-control">
                        <small class="text-danger" id="msg_uname"></small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="position-relative mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input autocomplete="off" type="text" name="pass" id="pass" class="form-control">
                        <small class="text-danger" id="msg_pass"></small>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="ins" class="form-label">Ins</label>
                        <input autocomplete="off" type="text" name="ins" id="ins" class="form-control">
                        <small class="text-danger" id="msg_ins"></small>
                    </div>
                </div>
            </div> --}}
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark btn-sm" id="SimpanAgent">Simpan Agent</button>
    </div>
</div>
<script>
     $('.js-example-basic-single').select2({
        theme: 'bootstrap-5'
        });
</script>