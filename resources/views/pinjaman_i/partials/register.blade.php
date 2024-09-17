<style>
/* CSS untuk .app-wrapper-title */
.app-title {
    background-color: #c0c4c5; /* Warna latar belakang untuk app-page-title */
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
.custom-button {
    width: 200px; /* Atur panjang tombol sesuai kebutuhan */
    float: right; /* Tempatkan tombol di sebelah kanan */
    margin: 20px; /* Atur margin untuk tata letak */
    padding: 10px; /* Atur padding untuk ukuran tombol */
    text-align: center; /* Pusatkan teks di tombol */
    background-color: #343a40; /* Warna latar belakang */
    color: white; /* Warna teks */
    border: none; /* Hilangkan border */
    border-radius: 5px; /* Atur radius sudut */
    cursor: pointer; /* Ubah kursor saat dihover */
}

.custom-button:hover {
    background-color: #495057; /* Warna latar belakang saat dihover */
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
                        <form action="/perguliran_i" method="post" id="FormRegisterProposal">
                            @csrf

                            <input type="hidden" name="nia" id="nia" value="{{ $anggota->id }}">
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
                                        <label for="pengajuan" class="form-label">Pengajuan Rp.</label>
                                        <input autocomplete="off" type="text" name="pengajuan" id="pengajuan" class="form-control">
                                        <small class="text-danger" id="msg_pengajuan"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative mb-3">
                                        <label for="jangka" class="form-label">Jangka</label>
                                        <input autocomplete="off" type="number" name="jangka" id="jangka" class="form-control"
                                        value="{{ $kec->def_jangka }}">
                                        <small class="text-danger" id="msg_jangka"></small> 
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative mb-3">
                                        <label for="pros_jasa" class="form-label">Prosentase Jasa (%)</label>
                                        <input autocomplete="off" type="number" name="pros_jasa" id="pros_jasa" class="form-control"
                                        value="{{ $kec->def_jasa }}">
                                    <small class="text-danger" id="msg_pros_jasa"></small>  
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative mb-3">
                                        <label for="jenis_jasa" class="form-label">Jenis Jasa</label>
                                        <select class="js-example-basic-single form-control" name="jenis_jasa" id="jenis_jasa" style="width: 100%;    ">
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
                                    <div class="position-relative mb-3">
                                        <label for="jenis_produk_pinjaman" class="form-label">Jenis Produk Pinjaman</label>
                                        <select class="js-example-basic-single form-control " name="jenis_produk_pinjaman" id="jenis_produk_pinjaman" style="width: 100%;">
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
                                    <div class="position-relative mb-3">
                                        <label for="id_agent" class="form-label">Nama Agen</label>
                                        <select class="js-example-basic-single form-control" name="id_agent" id="id_agent" style="width: 100%;">
                                         
                                            @foreach ($agent as $ag)
                                                <option value="{{ $ag->id }}">
                                                    ( {{ $ag->nomorid}} )  {{ $ag->agent}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="msg_id_agent"></small>            
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="position-relative mb-3">
                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                        <input autocomplete="off" type="text" name="nama_barang" id="nama_barang" class="form-control">
                                        <small class="text-danger" id="msg_nama_barang"></small>
                                    </div>
                                </div>                               
                            </div>                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="position-relative mb-3">
                                        <label for="sistem_angsuran_pokok" class="form-label">Sistem Angs. Pokok</label>
                                        <select class="js-example-basic-single form-control" name="sistem_angsuran_pokok" id="sistem_angsuran_pokok" style="width: 100%;">
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
                                    <div class="position-relative mb-3">
                                        <label for="sistem_angsuran_jasa" class="form-label">Sistem Angs. Jasa</label>
                                        <select class="js-example-basic-single form-control" name="sistem_angsuran_jasa" id="sistem_angsuran_jasa" style="width: 100%;">
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
                                        <select class="js-example-basic-single form-control" name="jaminan" id="jaminan" style="width: 100%;">
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
                        <div class="col-md-12">
                            <div class="font-icon-wrapper">
                                <p><p><b>Catatan : </b> ( Jika Ada data atau inputan yang kosong bisa di isi ( 0 ) atau ( - ) )</p></p>
                            </div>
                        </div>
                        <button type="submit" id="SimpanProposal" class="btn btn-dark btn-sm custom-button">Simpan Proposal</button>
                        <br><br><br>
                    </div>
<script>

$('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });

  
    $('.js-example-basic-single').select2({
        theme: 'bootstrap-5'
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
