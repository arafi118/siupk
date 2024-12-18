<div class="card">
    <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
            <i class="material-icons opacity-10">note_add</i>
        </div>
        <h6 class="mb-0">
            Register Simpanan {{ $anggota->namadepan }}
        <button id="informasi" class="btn btn-sm" style="font-size: 1rem; padding: 8px 12px;">
            <i class="material-icons" style="font-size: 24px; margin-right: 5px;">info</i>
        </button>
        <button type="submit" name="report" class="btn btn-primary btn-sm float-end">Form Simpanan</button>
        </h6>
        <div class="text-xs">
            {{ $anggota->d->sebutan_desa->sebutan_desa }} {{ $anggota->d->nama_desa }},
            {{ $anggota->d->kd_desa }}
        </div>
    </div>
    <div class="card-body pt-0">
        <form action="/simpanan/store" method="post" id="FormRegisterProposal">
            @csrf

            <input type="hidden" name="nia" id="nia" value="{{ $anggota->id }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="my-2">
                        <label class="form-label" for="jenis_simpanan">Jenis Produk Simpanan</label>
                        <select class="form-control" name="jenis_simpanan" id="jenis_simpanan">
                            @foreach ($js as $jps)
                                <option {{ $js_dipilih == $jps->id ? 'selected' : '' }} value="{{ $jps->id }}">
                                    {{ $jps->nama_js }} ({{ $jps->deskripsi_js }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="msg_jenis_simpanan"></small>
                    </div>
                </div>
            </div>
            <div class="row" id="FormSimpanan">mohon menunggu . . . </div>
        </form>

        <button type="submit" id="SimpanProposal" class="btn btn-github btn-sm float-end">Simpan Proposal</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".date").flatpickr({
            dateFormat: "d/m/Y"
        });

        // Atur nilai awal jenis_simpanan ke 1
        $('#jenis_simpanan').val('1');

        // Panggil fungsi jenis_simpanan() saat halaman dimuat
        jenis_simpanan();

        $(document).on('change', '#jenis_simpanan', function() {
            jenis_simpanan();
        });

        function jenis_simpanan() {
            let jenis_simpanan = $('#jenis_simpanan').val();
            let nia = $('#nia').val();
            $.get('/register_simpanan/jenis_simpanan/' + jenis_simpanan, {
                nia: nia
            }, function(result) {
                if (result.success) {
                    $('#FormSimpanan').html(result.view);
                } else {
                    console.error('Error saat mengambil jenis_simpanan');
                }
            }).fail(function(xhr, status, error) {
                console.error('Error AJAX:', status, error);
            });
        }
    });
</script>
