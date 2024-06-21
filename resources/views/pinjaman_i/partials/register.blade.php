<style>
/* CSS untuk .app-wrapper-title */
.app-title {
    background-color: #c0c4c5b3; /* Warna latar belakang untuk app-page-title */
    padding: 20px; /* Padding untuk ruang di sekitar konten */
    border-radius: 8px; /* Membuat sudut melengkung */
    margin-bottom: 10px; /* Jarak bawah dari elemen lain */
}

/* CSS untuk .page-title-wrapper */
.app-wrapper {
    display: flex; /* Gunakan flexbox untuk mengatur tata letak */
    align-items: center; /* Menyelaraskan item di tengah secara vertikal */
}

/* CSS untuk .page-title-heading */
.app-heading {
    display: flex; /* Gunakan flexbox untuk mengatur tata letak */
    align-items: center; /* Menyelaraskan item di tengah secara vertikal */
}

/* CSS untuk .app-bg-icon */
.app-bg-icon {
    display: flex; /* Gunakan flexbox untuk mengatur tata letak ikon */
    align-items: center; /* Menyelaraskan ikon di tengah secara vertikal */
    justify-content: center; /* Menyelaraskan ikon di tengah secara horizontal */
    width: 40px; /* Lebar tetap untuk ikon */
    height: 40px; /* Tinggi tetap untuk ikon */
    background-color: #c0c4c505; /* Warna latar belakang untuk ikon */
    border-radius: 10%; /* Membuat ikon menjadi lingkaran */
    margin-right: 15px; /* Jarak kanan dari teks */
}


/* CSS untuk .page-title-subheading */
.app-text_fount {
    font-size: 14px; /* Ukuran font untuk subjudul */
    color: #373636; /* Warna teks untuk subjudul */
    margin-top: 15px; /* Jarak atas dari judul */
}

</style>

<div class="card-body">
    <div class="app-title">
        <div class="app-wrapper">
            <div class="app-heading">
                <div class="app-bg-icon fa-solid fa-file-circle-plus"> </div>
                <div class="app-text_fount">
                    <h5><b>Register Proposal {{ $anggota->namadepan }}</b></h5>
                    <div>
                        {{ $anggota->d->sebutan_desa->sebutan_desa }} {{ $anggota->d->nama_desa }},
                        <b>{{ $anggota->d->kd_desa }}</b>
                    </div>
                </div>
            </div> 
        </div>
    </div>
                        <form class="">
                            {{-- <div class="row">
                                <div class="col-md-3">
                                    <div class="position-relative mb-3">
                                        <label for="tgl_proposal" class="form-label">Tgl proposal</label>
                                        <input autocomplete="off" type="text" name="tgl_proposal" id="tgl_proposal"
                                        class="form-control date" value="{{ date('d/m/Y') }}">
                                    <small class="text-danger" id="msg_tgl_proposal"></small>                    
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative mb-3">
                                        <label for="pengajuan" class="form-label">Pengajuan Rp.</label>
                                        <input autocomplete="off" type="text" name="pengajuan" id="pengajuan" class="form-control">
                                        <small class="text-danger" id="msg_pengajuan"></small>                                                                                                                                             class="form-control"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative mb-3">
                                        <label for="jangka" class="form-label">Jangka</label>
                                        <input autocomplete="off" type="number" name="jangka" id="jangka" class="form-control"
                                        value="{{ $kec->def_jangka }}">
                                    <small class="text-danger" id="msg_jangka"></small>           
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative mb-3">
                                        <label for="pros_jasa" class="form-label">Prosentase Jasa (%)</label>
                                        <input autocomplete="off" type="number" name="pros_jasa" id="pros_jasa" class="form-control"
                                        value="{{ $kec->def_jasa }}">
                                    <small class="text-danger" id="msg_pros_jasa"></small>                                                                                                                                             class="form-control"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative mb-3">
                                        <label for="jenis_jasa" class="form-label">Jenis Jasa</label>
                                        <select class="js-example-basic-single form-control" name="jenis_jasa" id="jenis_jasa">
                                            @foreach ($jenis_jasa as $jj)
                                                <option value="{{ $jj->id }}">
                                                    {{ $jj->nama_jj }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="msg_jenis_jasa"></small>                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative mb-3">
                                        <label for="jenis_produk_pinjaman" class="form-label">Jenis Produk Pinjaman</label>
                                        <select class="js-example-basic-single form-control" name="jenis_produk_pinjaman" id="jenis_produk_pinjaman">
                                            @foreach ($jenis_pp as $jpp)
                                                <option {{ $jenis_pp_dipilih == $jpp->id ? 'selected' : '' }}
                                                    value="{{ $jpp->id }}">
                                                    {{ $jpp->nama_jpp }} ({{ $jpp->deskripsi_jpp }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="msg_jenis_produk_pinjaman"></small>                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="position-relative mb-3">
                                        <label for="sistem_angsuran_pokok" class="form-label">Sistem Angs. Pokok</label>
                                        <select class="js-example-basic-single form-control" name="sistem_angsuran_pokok" id="sistem_angsuran_pokok">
                                            @foreach ($sistem_angsuran as $sa)
                                                <option value="{{ $sa->id }}">
                                                    {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="msg_sistem_angsuran_pokok"></small>                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative mb-3">
                                        <label for="sistem_angsuran_jasa" class="form-label">Sistem Angs. Jasa</label>
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
                                    <div class="position-relative mb-3">
                                        <label for="jaminan" class="form-label">Jaminan</label>
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
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative mb-3">
                                        <label for="exampleEmail11" class="form-label">Email</label>
                                        <select class="js-example-basic-single form-select" name="sistem_angsuran_pokok" id="sistem_angsuran_pokok">
                                            @foreach ($sistem_angsuran as $sa)
                                                <option value="{{ $sa->id }}">
                                                    {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="msg_sistem_angsuran_pokok"></small> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative mb-3">
                                        <label for="examplePassword11" class="form-label">Password</label>
                                        <select class="js-example-basic-single form-select" name="sistem_angsuran_pokok" id="sistem_angsuran_pokok">
                                            @foreach ($sistem_angsuran as $sa)
                                                <option value="{{ $sa->id }}">
                                                    {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="msg_sistem_angsuran_pokok"></small> 
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="position-relative mb-3"><label for="exampleCity" class="form-label">City</label><input name="city" id="exampleCity" type="text" class="form-control"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative mb-3"><label for="exampleState" class="form-label">State</label><input name="state" id="exampleState" type="text" class="form-control"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative mb-3"><label for="exampleZip" class="form-label">Zip</label><input name="zip" id="exampleZip" type="text" class="form-control"></div>
                                </div>
                            </div>

                            <button class="mt-2 btn btn-primary">Sign in</button>
                        </form>
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
