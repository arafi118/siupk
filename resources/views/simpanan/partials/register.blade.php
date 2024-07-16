<div class="card">
    <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
            <i class="material-icons opacity-10">note_add</i>
        </div>
        <h6 class="mb-0">
            Register Proposal {{ $anggota->namadepan }}
        </h6>
        <div class="text-xs">
            {{ $anggota->d->sebutan_desa->sebutan_desa }} {{ $anggota->d->nama_desa }},
            {{ $anggota->d->kd_desa }}
        </div>
    </div>
    <div class="card-body pt-0">
        <form action="/perguliran_i" method="post" id="FormRegisterProposal">
            @csrf

            <input type="hidden" name="nia" id="nia" value="{{ $anggota->id }}">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="my-2">
                        <label class="form-label" for="jenis_simpanan">Jenis Simpanan</label>
                        <select class="form-control" name="jenis_simpanan" id="jenis_simpanan">
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
                <div class="col-md-4">
                    <div class="my-2">
                        <label class="form-label" for="jaminan">Jaminan</label>
                        <select class="form-control" name="jaminan" id="jaminan">
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

<script>
    new Choices($('#jenis_jasa')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })
    new Choices($('#sistem_angsuran_pokok')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })
    new Choices($('#sistem_angsuran_jasa')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })
    new Choices($('#jaminan')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })
    new Choices($('#jenis_produk_pinjaman')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })

    $("#pengajuan").maskMoney();

    $(".date").flatpickr({
        dateFormat: "d/m/Y"
    })
    6
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
