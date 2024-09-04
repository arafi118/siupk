@php
    use App\Models\TandaTanganLaporan;
    $ttd = TandaTanganLaporan::where([['lokasi', Session::get('lokasi')]])->first();
    $tanggal = false;
    if ($ttd) {
        $str = strpos($ttd->tanda_tangan_pelaporan, '{tanggal}');
        if ($str !== false) {
            $tanggal = true;
        }
    }
    $id_search = 'cariAnggota';
    $label = 'Individu (NIK/Nama Peminjam)';
@endphp
<div class="app-header header-shadow">
    <div class="app-header__logo">
        <a href="/dashboard" class="logo" id="nama_lembaga_sort" style="color: rgb(0, 0, 0);">
            <b> {{ Session::get('nama_lembaga') }} </b>
        </a>
        <div class="header__pane ms-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header__content">
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input id="{{ $id_search }}" type="text" class="search-input"
                        placeholder="{{ $label }}" autocomplete="off">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="btn-close"></button>
            </div>


        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pe-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a href="/profil" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="p-0 btn">
                                    <img width="42"
                                        class="rounded-circle"src="{{ asset('storage/profil/' . Session::get('foto')) }}"
                                        class="avatar" id="profil_avatar">
                                    <i class="fa fa-angle-down ms-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu dropdown-menu-right">

                                    <button type="button" tabindex="0" class="dropdown-item" id="btnAcount"><i
                                            class="pe-7s-users">&nbsp;</i>&nbsp;Account</button>
                                    <button type="button" tabindex="0" class="dropdown-item"
                                        id="btnLaporanPelunasan"><i
                                            class="pe-7s-cloud-download">&nbsp;</i>&nbsp;Reminder</button>
                                    <button type="button" tabindex="0" class="dropdown-item" id="btnInvoiceTs"><i
                                            class="pe-7s-monitor">&nbsp;</i>&nbsp;TS dan Invoice</button>
                                    <button type="button" tabindex="0" class="dropdown-item"><i
                                            class="pe-7s-mail">&nbsp;</i>&nbsp;Maintenance dan Server</button>
                                    <button type="button" tabindex="0" class="dropdown-item" id="btnLaporanMou"><i
                                            class="pe-7s-comment">&nbsp;</i>&nbsp;MoU</button>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item" id="logout"><i
                                            class="pe-7s-next-2">&nbsp;</i>&nbsp;Logout</button>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ms-3 header-user-info">
                            <div class="widget-heading">
                                <a href="/profil" class="nav-link text-black">
                                    <span class="nav-link-text ms-2 ps-1 nama_user">{{ Session::get('nama') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="widget-content-right header-user-info ms-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <i class="fa text-white fa-solid fa-image"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="/pelaporan/preview" method="post" id="FormLaporanSisipan" target="_blank">
    @csrf
    <input type="hidden" name="type" id="type" value="pdf">
    <input type="hidden" name="tahun" id="tahun" value="{{ date('Y') }}">
    <input type="hidden" name="bulan" id="bulan" value="{{ date('m') }}">
    <input type="hidden" name="hari" id="hari" value="{{ date('d') }}">
    <input type="hidden" name="laporan" id="laporan" value="pelunasan">
    <input type="hidden" name="sub_laporan" id="sub_laporan" value="">
</form>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Scan Kartu Angsuran
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="reader"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-info" id="stopScan">Stop</button>
            </div>
        </div>
    </div>
</div>
<style>
    .header-menu {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 15px;
        /* Adjust the gap between items if necessary */
    }
    .header-menu .nav-item {
        position: relative;
    }
    .header-menu .dropdown-menu {
        right: 0;
        /* Align dropdown menu to the right */
        left: auto;
    }
    .header-menu .nav-link {
        display: flex;
        align-items: center;
        gap: 5px;
        /* Adjust the gap between icon and text if necessary */
    }
</style>
