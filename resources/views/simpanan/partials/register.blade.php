<div class="card">
    <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
            <i class="material-icons opacity-10">note_add</i>
        </div>
        <h6 class="mb-0">
            Register Simpanan {{ $anggota->namadepan }}
        <button id="informasi" data-bs-toggle="modal" class="btn btn-sm" style="font-size: 1rem; padding: 8px 12px;" data-bs-target="#modal-info">
            <i class="fas fa-edit"></i>
        </button>
        <button  onclick="window.open('/form_simp/')" class="btn btn-primary btn-sm float-end"><i class="fas fa-file-alt"></i> Form Simpanan</button>
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





















<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-info" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="NamaDesa">
                    Detail Anggota [nama_anggota]
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form action="/database/desa/" method="post" id="FormEditDesa">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="nia" id="nia" value="">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="nama_desa">Nama Panggilan (alias)</label>
                                <input type="text" 
                                       name="nama_desa" 
                                       id="nama_desa" 
                                       class="form-control"
                                       value="">
                                <small class="text-danger" id="msg_nama_desa"></small>
                            </div>
                        </div>
                    </div>


                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="nama_desa">Agama</label>
                                <input type="text" 
                                       name="nama_desa" 
                                       id="nama_desa" 
                                       class="form-control"
                                       value="">
                                <small class="text-danger" id="msg_nama_desa"></small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="telp_desa">Status Pernikahan</label>
                                <input type="text" 
                                       name="telp_desa" 
                                       id="telp_desa" 
                                       class="form-control"
                                       value="">
                                <small class="text-danger" id="msg_telp_desa"></small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="alamat_desa">Pendidikan Terakhir</label>
                                <input type="text" 
                                       name="alamat_desa" 
                                       id="alamat_desa" 
                                       class="form-control"
                                       value="">
                                <small class="text-danger" id="msg_alamat_desa"></small>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="nama_desa">NPWP</label>
                                <input type="text" 
                                       name="nama_desa" 
                                       id="nama_desa" 
                                       class="form-control"
                                       value="">
                                <small class="text-danger" id="msg_nama_desa"></small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="telp_desa">Penghasilan</label>
                                <input type="text" 
                                       name="telp_desa" 
                                       id="telp_desa" 
                                       class="form-control"
                                       value="">
                                <small class="text-danger" id="msg_telp_desa"></small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="alamat_desa">Sumber Penghasilan</label>
                                <input type="text" 
                                       name="alamat_desa" 
                                       id="alamat_desa" 
                                       class="form-control"
                                       value="">
                                <small class="text-danger" id="msg_alamat_desa"></small>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="nama_desa">Nama Gadis Ibu Kandung</label>
                                <input type="text" 
                                       name="nama_desa" 
                                       id="nama_desa" 
                                       class="form-control"
                                       value="">
                                <small class="text-danger" id="msg_nama_desa"></small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="simpan-anggotas" class="btn btn-sm btn-github">Simpan</button>
            </div>
        </div>
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
