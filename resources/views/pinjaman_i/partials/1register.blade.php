<div class="app-main__inner">
    <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                <i class="material-icons opacity-10">note_add</i>
            </div>
            <h6 class="mb-0">
                
            </h6>
            <div class="text-xs">
                
            </div>
        </div>
        <div class="card-body pt-0">
            <form action="/perguliran_i" method="post" id="FormRegisterProposal">
                @csrf

                <input type="hidden" name="nia" id="nia" value="{{ $anggota->id }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group input-group-static my-3">
                            <label for="tgl_proposal">Tgl Proposal</label>
                            <input autocomplete="off" type="text" name="tgl_proposal" id="tgl_proposal"
                                class="form-control date" value="{{ date('d/m/Y') }}">
                            <small class="text-danger" id="msg_tgl_proposal"></small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-static my-3">
                            <label for="pengajuan">Pengajuan Rp.</label>
                            <input autocomplete="off" type="text" name="pengajuan" id="pengajuan" class="form-control">
                            <small class="text-danger" id="msg_pengajuan"></small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-static my-3">
                            <label for="jangka">Jangka</label>
                            <input autocomplete="off" type="number" name="jangka" id="jangka" class="form-control"
                                value="{{ $kec->def_jangka }}">
                            <small class="text-danger" id="msg_jangka"></small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-static my-3">
                            <label for="pros_jasa">Prosentase Jasa (%)</label>
                            <input autocomplete="off" type="number" name="pros_jasa" id="pros_jasa" class="form-control"
                                value="{{ $kec->def_jasa }}">
                            <small class="text-danger" id="msg_pros_jasa"></small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="my-2">
                            <label class="form-label" for="jenis_jasa">Jenis Jasa</label>
                            <select class="js-example-basic-single form-control" name="jenis_jasa" id="jenis_jasa">
                                @foreach ($jenis_jasa as $jj)
                                    <option value="{{ $jj->id }}">
                                        {{ $jj->nama_jj }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="msg_jenis_jasa"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <label class="form-label" for="jenis_produk_pinjaman">Jenis Produk Pinjaman</label>
                            <select class="js-example-basic-single form-control" name="jenis_produk_pinjaman" id="jenis_produk_pinjaman">
                                @foreach ($jenis_pp as $jpp)
                                    <option {{ $jenis_pp_dipilih == $jpp->id ? 'selected' : '' }}
                                        value="{{ $jpp->id }}">
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
                        <div class="my-2">
                            <label class="form-label" for="sistem_angsuran_pokok">Sistem Angs. Pokok</label>
                            <select class="js-example-basic-single form-control" name="sistem_angsuran_pokok" id="sistem_angsuran_pokok">
                                @foreach ($sistem_angsuran as $sa)
                                    <option value="{{ $sa->id }}">
                                        {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="msg_sistem_angsuran_pokok"></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-2">
                            <label class="form-label" for="sistem_angsuran_jasa">Sistem Angs. Jasa</label>
                            <select class="js-example-basic-single form-control" name="sistem_angsuran_jasa" id="sistem_angsuran_jasa">
                                @foreach ($sistem_angsuran as $sa)
                                    <option value="{{ $sa->id }}">
                                        {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="msg_sistem_angsuran_jasa"></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-2">
                            <label class="form-label" for="jaminan">Jaminan</label>
                            <select class="js-example-basic-single form-control" name="jaminan" id="jaminan">
                                @foreach ($jaminan as $j)
                                    <option value="{{ $j['id'] }}">
                                        {{ $j['nama'] }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="msg_jaminan"></small>
                        </div>
                    </div>
                </div>

                <div class="row" id="formJaminan"></div>
            </form>

            <button type="submit" id="SimpanProposal" class="btn btn-github btn-sm float-end">Simpan Proposal</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $("#pengajuan").maskMoney();

   
    $(document).on('change', '#jaminan', function() {
        jaminan()
    })

    function jaminan() {
        let jaminan = $('#jaminan').val();
        $.get('/register_proposal_i/jaminan/' + jaminan, function(result) {
            $('#formJaminan').html(result.view)
        })
    }

    jaminan()
</script>
