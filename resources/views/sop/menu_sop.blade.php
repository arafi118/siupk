<style>
    /* CSS untuk membuat tautan responsif */
    .nav-item {
        display: flex;
        justify-content: left;
    }


    /* Media query untuk mengatur lebar tautan pada layar kecil */
    @media (max-width: 576px) {
        .btn {
            width: 100%;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="mb-12 card">
            <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">&nbsp;
                <li class="nav-item">
                    <a href="/sop/partials/_lembaga" class="btn btn-outline-primary" active>
                        <i class="fa-solid fa-tree-city"></i>
                        <span>Identitas Lembaga</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengaturan/pengelola/{kec}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-person-chalkboard"></i>
                        <span>Sebutan Pengelola</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengaturan/pinjaman/{kec}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span>Sistem Pinjaman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengaturan/asuransi/{kec}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        <span>Pengaturan Asuransi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengaturan/spk/{kec}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-laptop-file"></i>
                        <span>Redaksi Dok.SPK</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengaturan/logo/{kec}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-panorama"></i>
                        <span>Logo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengaturan/calk/{kec}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-camera-rotate"></i>
                        <span>Whatsapp</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
