@extends('layouts.base')

@section('content')
<style>
    /* CSS untuk .app-wrapper-title */
    .app-title {
        background-color: #6797a385; /* Warna latar belakang untuk app-page-title */
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
    .header {
    display: flex;
    align-items: flex-start;
    }

    .header img {
        width: 150px;
        /* Tambahkan margin kanan untuk memberikan jarak antara gambar dan teks */
        margin-right: 15px; /* Atur sesuai keinginan Anda */
    }

    .header h3 {
        margin: 40px;
        /* Jika ingin mengatur margin kiri untuk memberikan jarak dari gambar */
        margin-left:100px; /* Atur sesuai keinginan Anda */
    }

    </style>
    <div class="app-main__inner"><br>
        <div class="app-title">
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label class="form-label"><b>{{$kec->sebutan_level_1}}</b></label>
                        <input autocomplete="off" type="text" name="" id=""
                            class="form-control" value="{{$dir->namadepan}}" readonly>
                        <small class="text-danger" id=""></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="" class="form-label"><b>{{$kec->sebutan_level_2}}</b></label>
                        <input autocomplete="off" type="text" name="" id="" value="{{$seke->namadepan}}" class="form-control" readonly>
                        <small class="text-danger" id=""></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="" class="form-label"><b>{{$kec->sebutan_level_3}}</b></label>
                        <input autocomplete="off" type="text" name="" id="" value="{{$bend->namadepan}}" class="form-control" readonly>
                        <small class="text-danger" id=""></small> 
                    </div>
                </div>
                @if ($manaj)
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="" class="form-label"><b>Manajer</b></label>
                        <input autocomplete="off" type="text" name="" id="" value="{{$manaj->namadepan}}" class="form-control" readonly>
                    <small class="text-danger" id=""></small>  
                    </div>
                </div>
                @else
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="" class="form-label"><b>Manajer</b></label>
                        <input autocomplete="off" type="text" name="" id="" value="" class="form-control" readonly>
                    <small class="text-danger" id=""></small>  
                    </div>
                </div>
                @endif
            </div> <br>
            <div class="header">
                <span><img src="/assets/img/upe.png" class="mt-n-xlg"></span>
                <h3 align="center"><b>Daftar Users Penggunaan Aplikasi LKM <br>
                    {{ $kec->nama_lembaga_sort }}</b>
                </h3>               
            </div>
        </div>        
    </div>
@endsection