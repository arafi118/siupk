@php
    use App\Models\Kecamatan;

    $kecamatan = Kecamatan::where('web_kec', explode('//', URL::to('/'))[1])
            ->orWhere('web_alternatif', explode('//', URL::to('/'))[1])
            ->first();@endphp
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner"><br><br>
        <ul class="vertical-nav-menu">
            <li>
                <a href="/dashboard" class="mm-active">
                    <i class="metismenu-icon pe-7s-keypad"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-settings"></i>
                    Pengaturan
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="/pengaturan/sop">
                            <i class="metismenu-icon"></i>
                            Personalisasi SOP
                        </a>
                    </li>
                    <li>
                        <a href="/pengaturan/coa">
                            <i class="metismenu-icon">
                            </i>Cart Of Account
                        </a>
                    </li>
                    <li>
                        <a href="/pengaturan/ttd_pelaporan">
                            <i class="metismenu-icon">
                            </i>Ttd Pelaporan
                        </a>
                    </li>
                    <li>
                        <a href="/pengaturan/ttd_spk">
                            <i class="metismenu-icon">
                            </i>Ttd SPK
                        </a>
                    </li>
                    <li>
                        <a href="/database/saham">
                            <i class="metismenu-icon">
                            </i>Direksi dan Komisaris
                        </a>
                    </li>
                    <li>
                        <a href="/pengaturan/invoice">
                            <i class="metismenu-icon">
                            </i>Invoice
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-note"></i>
                    Basis Data
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    {{-- <li>
                        <a href="/pengaturan/users">
                            <i class="metismenu-icon">
                                <i class="metismenu-icon pe-7s-note"></i>
                            </i>Data User
                        </a>
                    </li> --}}
                    
                    <li>
                        <a href="/database/penduduk/register_penduduk">
                            <i class="metismenu-icon">
                            </i>Register Nasabah
                        </a>
                    </li>
                    <li>
                        <a href="/database/penduduk">
                            <i class="metismenu-icon">
                            </i>Data Nasabah
                        </a>
                    </li>

                    <li>
                        <a href="/database/desa">
                            <i class="metismenu-icon">
                                <i class="metismenu-icon pe-7s-note"></i>
                            </i>Data Desa
                        </a>
                    </li>
                    <li>
                        <a href="/database/agent">
                            <i class="metismenu-icon">
                            </i>Data Agen
                        </a>
                    </li>
                    <li>
                        <a href="/database/supplier">
                            <i class="metismenu-icon">
                            </i>Data Supplier
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Pelayanan Kredit
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="/register_proposal_i">
                            <i class="metismenu-icon">
                            </i>Register Kredit
                        </a>
                    </li>
                    <li>
                        <a href="/perguliran_i">
                            <i class="metismenu-icon">
                            </i>Status Kredit
                        </a>
                    </li>
                </ul>
            </li>
            @if($kecamatan && ($kecamatan->id == 318 || $kecamatan->id == 1))
            <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diskette"></i>
                        Simpanan & Utang
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="/register_simpanan">
                                <i class="metismenu-icon"></i>Pendataan Utang
                            </a>
                        </li>
                        <li>
                            <a href="/simpanan">
                                <i class="metismenu-icon"></i>Daftar Simpanan & Utang
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-graph3"></i>
                    Transaksi
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="/transaksi/jurnal_umum">
                            <i class="metismenu-icon">
                            </i>Jurnal Umum
                        </a>
                    </li>
                    <li>
                        <a href="/transaksi/jurnal_angsuran_individu">
                            <i class="metismenu-icon">
                            </i>Jurnal Angsuran
                        </a>
                    </li>
                    <li>
                        <a href="/transaksi/ebudgeting">
                            <i class="metismenu-icon">
                            </i>E-Budgeting
                        </a>
                    </li>
                    <li>
                        <a href="/transaksi/tutup_buku">
                            <i class="metismenu-icon">
                            </i>Tutup Buku
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/pelaporan">
                    <i class="metismenu-icon pe-7s-print"></i>
                    Laporan
                </a>
            </li>
        </ul>
    </div>
</div>