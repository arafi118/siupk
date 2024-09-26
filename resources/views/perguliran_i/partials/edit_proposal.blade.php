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
        <div class="col-md-3">
            <div class="position-relative mb-3">
                <label for="id_agent" class="form-label">Nama Agen</label>
                <select class="js-example-basic-single form-control" name="id_agent" id="id_agent" style="width: 100%;">
                 
                    @foreach ($agent as $ag)
                        <option {{ $ag->id == $perguliran_i->id_agent ? 'selected' : '' }} value="{{ $ag->id }}">
                            ( {{ $ag->nomorid}} )  {{ $ag->agent}}
                        </option>
                    @endforeach
                </select>
                <small class="text-danger" id="msg_id_agent"></small>            
            </div>
        </div>
        <div class="col-md-3">
            <div class="position-relative mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input autocomplete="off" type="text" name="nama_barang" id="nama_barang" value="{{ $perguliran_i->nama_barang }}" class="form-control">
                <small class="text-danger" id="msg_nama_barang"></small>
            </div>
        </div>    
        <div class="col-md-3">
            <div class="position-relative mb-3">
                    <label for="jenis_jasa_proposal" class="form-label">Jenis Jasa</label>
                    <select class="js-example-basic-single form-control" name="jenis_jasa_proposal" id="jenis_jasa_proposal">
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
        <div class="col-md-3">
            <div class="position-relative mb-3">
                <label for="jenis_produk_pinjaman" class="form-label">Jenis Produk Pinjaman</label>
                <select class="js-example-basic-single form-control" name="jenis_produk_pinjaman" id="jenis_produk_pinjaman">
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
        <div class="col-md-4">
            <div class="position-relative mb-3">
                    <label for="sistem_angsuran_pokok_proposal" class="form-label">Sistem Angs. Pokok</label>
                    <select class="js-example-basic-single form-control" name="sistem_angsuran_pokok_proposal" id="sistem_angsuran_pokok_proposal">
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
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="sistem_angsuran_jasa_proposal" class="form-label">Sistem Angs. Jasa</label>
                <select class="js-example-basic-single form-control" name="sistem_angsuran_jasa_proposal" id="sistem_angsuran_jasa_proposal">
                    @foreach ($sistem_angsuran as $sa)
                        <option {{ $sa->id == $perguliran_i->sa_jasa ? 'selected' : '' }} value="{{ $sa->id }}">
                            {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                        </option>
                    @endforeach
                </select>
                <small class="text-danger" id="msg_sistem_angsuran_jasa_proposal"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3">
                <label for="jaminan" class="form-label">Jaminan</label>
                <select class="js-example-basic-single form-control" name="jaminan" id="jaminan" style="width: 100%;">
                    @foreach ($editjaminan as $j)
                        <option {{ (is_array($jaminan) && isset($jaminan['jenis_jaminan']) && $jaminan['jenis_jaminan'] == $j['id']) ? 'selected' : '' }} value="{{ $j['id'] }}">
                            {{ $j['nama'] }}
                        </option>

                    @endforeach
                </select>
                <small class="text-danger" id="msg_jaminan"></small>                                                                                                                                             
            </div>
        </div>
        
        <div id="formJaminan"></div>
    </div>
    <div class="col-md-12">
        <div class="font-icon-wrapper">
            <p><p><b>Catatan : </b> ( Jika Ada data atau inputan yang kosong bisa di isi ( 0 ) atau ( - ) )</p></p>
        </div>
    </div>

</form>

<script>

    $(".money").maskMoney();

    $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $('.js-example-basic-single').select2({
            theme: 'bootstrap-5'
        });

    $(document).on('change', '#jaminan', function () {
        jaminan()
    })

    function jaminan() {
        let jaminan = $('#jaminan').val();
        $.get('/perguliran_i/jaminan/' + jaminan, function(result) {
            $('#formJaminan').html(result.view)
        })
    }
    jaminan()
</script>
