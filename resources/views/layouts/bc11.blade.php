<div class="header-container">
    <div class="header-logo">
        <!-- Logo and other items on the left side -->
    </div>
    <ul class="header-menu nav">
        <li class="nav-item">
            <a href="#" class="nav-link text-body p-0 position-relative" target="_blank" id="btnLaporanPelunasan" data-bs-toggle="tooltip" data-bs-placement="top" title="Reminder" data-container="body" data-animation="true">
                <i class="nav-link-icon fa-solid fa-bell"></i> Reminder
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="nav-link-icon fa-solid fa-envelope"></i> TS dan Invoice
            </a>
            <ul class="dropdown-menu">
                <li>
                    @if ($jumlah > 0)
                    <span
                        class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger border border-white small py-1 px-2">
                        <span class="small">{{ $jumlah }}</span>
                        <span class="visually-hidden">Notifikasi</span>
                    </span>
                @endif
                    @if ($jumlah > 0)
                    @foreach ($inv as $in)
                        <a class="dropdown-item border-radius-md"
                            href="/pelaporan/invoice/{{ $in->idv }}" target="_blank">
                            <div class="d-flex align-items-center py-1">
                                <span class="material-icons">event</span>
                                <div class="ms-2">
                                    <h6 class="text-sm font-weight-normal my-auto">
                                        {{ $in->jp->nama_jp }}
                                    </h6>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    @endif
                    @if (!$tanggal)
                        <a class="dropdown-item border-radius-md" href="/pengaturan/ttd_pelaporan">
                            <div class="d-flex align-items-center py-1">
                                <span class="material-icons">date_range</span>
                                <div class="ms-2">
                                    <h6 class="text-sm font-weight-normal my-auto">
                                        Tanggal pada laporan
                                    </h6>
                                </div>
                            </div>
                        </a>
                    @endif
                    <a class="dropdown-item" href="#">Biaya Perpanjangan Maintenance dan Server</a>
                </li>
                <li><a class="dropdown-item" href="/pelaporan/ts" target="_blank">Technical Support</a></li>
                <li><a class="dropdown-item" href="/pelaporan/mou" target="_blank">MoU</a></li>
            </ul>
        </li>
        <li class="dropdown nav-item">
            <a href="javascript:;" class="nav-link text-body p-0" id="logout" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-container="body" data-animation="true">
                <i class="nav-link-icon fa-solid fa-arrow-up-right-from-square"></i> Logout
            </a>
        </li>
        <li class="nav-item d-xl-none d-flex align-items-center ps-3">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </a>
        </li>
    </ul>
</div>