<style>
    /* CSS untuk .app-wrapper-title */
    .app-title {
        background-color: #18cf008d; /* Warna latar belakang untuk app-page-title */
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
        color: #ffffff; /* Warna teks untuk subjudul */
        margin-top: 15px; /* Jarak atas dari judul */
    }
    </style>
                        <div class="card-body">
                                <div class="col-lg-6 col-xl-12">
                                    <div class="card mb-3 widget-content bg-happy-green">
                                        <div class="widget-content-wrapper text-white">
                                            <div class="app-bg-icon fa-solid fa-window-restore"></div>
                                            <div class="widget-content-left">
                                                <h5><b>Pendataan Utang {{ $anggota->namadepan }}</b></h5>
                                                <div class="app-text_fount">{{ $anggota->d->sebutan_desa->sebutan_desa }} {{ $anggota->d->nama_desa }},
                                                    <b>{{ $anggota->d->kd_desa }}</b></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <form action="/simpanan" method="post" id="FormRegisterSimpanan">
                                        @csrf
                                        
                                        <input type="hidden" name="nia" id="nia" value="{{ $anggota->id }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="position-relative mb-3">
                                                    <label for="jenis_simpanan" class="form-label">Jenis Produk</label>
                                                    <select class="select2T form-control" name="jenis_simpanan" id="jenis_simpanan">
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
                                        <div class="row" id="FormSimpanan">
                                            <i class="fa fa-refresh fa-w-16 fa-spin fa-2x"></i>
                                        </div>
                                    </form>
                            <button type="submit" id="SimpanUtang" class="btn btn-dark custom-button">Simpan Utang</button>
                        </div><br><br><br>
    <script>  
            $('.select2T').select2({
            theme: 'bootstrap-5'
            });  
            $(document).ready(function() {
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
    