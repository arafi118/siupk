<form action="/perguliran_i/{{ $perguliran_i->id }}" method="post" id="FormEditProposal">
    @csrf
    @method('PUT')
    <input type="hidden" name="_id" id="_id" value="{{ $perguliran_i->id }}">
    <input type="hidden" name="status" id="status" value="P">
    <div class="row">
        <div class="col-md-3">
            <div class="position-relative mb-3">
                <label for="tgl_proposal" class="form-label">Tgl proposal</label>
                <input autocomplete="off" type="text" name="tgl_proposal" id="tgl_proposal"
                       class="form-control date" value="{{ date('d/m/Y') }}">
                <small class="text-danger" id="msg_tgl_proposal"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="position-relative mb-3">
                <label for="proposal" class="form-label">Pengajuan Rp.</label>
                <input autocomplete="off" type="text" name="proposal" id="proposal" class="form-control money"
                    value="{{ number_format($perguliran_i->proposal, 2) }}">
                    <small class="text-danger" id="msg_proposal"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="position-relative mb-3">
                <label for="jangka_proposal" class="form-label">Jangka</label>
                <input autocomplete="off" type="number" name="jangka_proposal" id="jangka_proposal"
                           class="form-control" value="{{ $perguliran_i->jangka }}">
                    <small class="text-danger" id="msg_jangka_proposal"></small>
            </div>
        </div>    
        <div class="col-md-3">
            <div class="position-relative mb-3">
                <label for="pros_jasa_proposal" class="form-label">Prosentase Jasa (%)</label>
                <input autocomplete="off" type="number" name="pros_jasa_proposal" id="pros_jasa_proposal"
                        class="form-control" value="{{ $perguliran_i->pros_jasa }}">
                    <small class="text-danger" id="msg_pros_jasa_proposal"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                    <label for="jenis_jasa_proposal" class="form-label">Jenis Jasa</label>
                    <select class="form-control" name="jenis_jasa_proposal" id="jenis_jasa_proposal">
                        @foreach ($jenis_jasa as $jj)
                            <option {{ $jj->id == $perguliran_i->jenis_jasa ? 'selected' : '' }}
                                value="{{ $jj->id }}">
                                {{ $jj->nama_jj }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_jenis_jasa_proposal"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="jenis_produk_pinjaman" class="form-label">Jenis Produk Pinjaman</label>
                <select class="form-control" name="jenis_produk_pinjaman" id="jenis_produk_pinjaman">
                    @foreach ($jenis_pp as $jpp)
                        <option {{ $jenis_pp_dipilih == $jpp->id ? 'selected' : '' }} value="{{ $jpp->id }}">
                            {{ $jpp->nama_jpp }} ({{ $jpp->deskripsi_jpp }})
                        </option>
                    @endforeach
                </select>
                <small class="text-danger" id="msg_jenis_produk_pinjaman"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                    <label for="sistem_angsuran_pokok_proposal" class="form-label">Sistem Angs. Pokok</label>
                    <select class="form-control" name="sistem_angsuran_pokok_proposal" id="sistem_angsuran_pokok_proposal">
                        @foreach ($sistem_angsuran as $sa)
                            <option {{ $sa->id == $perguliran_i->sistem_angsuran ? 'selected' : '' }}
                                value="{{ $sa->id }}">
                                {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="msg_sistem_angsuran_pokok_proposal"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="sistem_angsuran_jasa_proposal" class="form-label">Sistem Angs. Jasa</label>
                <select class="form-control" name="sistem_angsuran_jasa_proposal" id="sistem_angsuran_jasa_proposal">
                    @foreach ($sistem_angsuran as $sa)
                        <option {{ $sa->id == $perguliran_i->sa_jasa ? 'selected' : '' }} value="{{ $sa->id }}">
                            {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                        </option>
                    @endforeach
                </select>
                <small class="text-danger" id="msg_sistem_angsuran_jasa_proposal"></small>
            </div>
        </div>
    </div>



    <div class="card">
        <div class="card-body p-2">
            <div class="d-none d-sm-block p-4"></div>
        </div>
    </div>
</form>

<script>
    $(".money").maskMoney();

    $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });

</script>
