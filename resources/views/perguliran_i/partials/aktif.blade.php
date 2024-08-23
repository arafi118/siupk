<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h5 class="card-title">Proposal</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Tgl Pengajuan
                                        <div class="badge angka-warna-biru ">
                                            {{ Tanggal::tglIndo($perguliran_i->tgl_proposal) }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Pengajuan
                                        <div class="badge angka-warna-biru">
                                            {{ number_format($perguliran_i->proposal) }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Jenis Jasa
                                        <div class="badge angka-warna-biru">
                                            {{ $perguliran_i->jasa->nama_jj }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Jasa
                                        <div class="badge angka-warna-biru">
                                            {{ $perguliran_i->pros_jasa . '% / ' . $perguliran_i->jangka . ' bulan' }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Angs. Pokok
                                        <div class="badge angka-warna-biru">
                                            {{ $perguliran_i->sis_pokok->nama_sistem }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Angs. Jasa
                                        <div class="badge angka-warna-biru">
                                            {{ $perguliran_i->sis_jasa->nama_sistem }}
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h5 class="card-title">Verified</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Tgl Verifikasi
                                        <div class="badge angka-warna-merah ">
                                            {{ Tanggal::tglIndo($perguliran_i->tgl_verifikasi) }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Verifikasi
                                        <div class="badge angka-warna-merah">
                                            {{ number_format($perguliran_i->verifikasi) }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Jenis Jasa
                                        <div class="badge angka-warna-merah">
                                            {{ $perguliran_i->jasa->nama_jj }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Jasa
                                        <div class="badge angka-warna-merah">
                                            {{ $perguliran_i->pros_jasa . '% / ' . $perguliran_i->jangka . ' bulan' }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Angs. Pokok
                                        <div class="badge angka-warna-merah">
                                            {{ $perguliran_i->sis_pokok->nama_sistem }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Angs. Jasa
                                        <div class="badge angka-warna-merah">
                                            {{ $perguliran_i->sis_jasa->nama_sistem }}
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h5 class="card-title">Waiting</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Tgl Tunggu
                                        <div class="badge angka-warna-kuning ">
                                            {{ Tanggal::tglIndo($perguliran_i->tgl_tunggu) }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Pendanaan
                                        <div class="badge angka-warna-kuning">
                                            {{ number_format($perguliran_i->alokasi) }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Jenis Jasa
                                        <div class="badge angka-warna-kuning">
                                            {{ $perguliran_i->jasa->nama_jj }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Jasa
                                        <div class="badge angka-warna-kuning">
                                            {{ $perguliran_i->pros_jasa . '% / ' . $perguliran_i->jangka . ' bulan' }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Angs. Pokok
                                        <div class="badge angka-warna-kuning">
                                            {{ $perguliran_i->sis_pokok->nama_sistem }}
                                        </div>
                                    </li>
                                    <li class="list-group-item">Angs. Jasa
                                        <div class="badge angka-warna-kuning">
                                            {{ $perguliran_i->sis_jasa->nama_sistem }}
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-card mb-3 card">
    <form action="/perguliran_i/dokumen?status=A" target="_blank" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $perguliran_i->id }}">
        <div class="card-body d-flex justify-content-between">
            <a href="/perguliran_i/dokumen/kartu_angsuran/{{ $perguliran_i->id }}" target="_blank"  class="btn btn-outline-info flex-grow-1 me-2">
                <b style="color: rgb(2, 102, 251);">Kartu Angsuran</b>
            </a>
            <button type="submit" data-bs-toggle="modal" name="report" value="rencanaAngsuran#pdf"
                class="btn btn-outline-info flex-grow-1 me-2">
                <b style="color: rgb(2, 102, 251)">Rencana Angsuran</b>
            </button>
            <button type="submit" data-bs-toggle="modal" name="report" value="rekeningKoran#pdf"
                class="btn btn-outline-info flex-grow-1 me-2">
                <b style="color: rgb(2, 102, 251)">Rekening Koran</b>
            </button>
        </div>
    </form>
</div>

<div class="main-card mb-3 card">
        <div class="card-body d-flex justify-content-between">
            <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenProposal"
            class="btn btn-info flex-grow-1 me-2"
                style="background-color: rgb(23, 203, 20);">
                <b>Cetak Dokumen Proposal</b>
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenPencairan"
                class="btn btn-info flex-grow-1 ms-2" style="background-color: rgb(4, 172, 250);">
                <b>Cetak Dokumen Pencairan</b>
            </button>
        </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Riwayat Transaksi</h5>
                <table class="table table-striped align-items-center mb-0" width="100%">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>Tgl transaksi</th>
                            <th>Pokok</th>
                            <th>Jasa</th>
                            <th>Saldo Pokok</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perguliran_i->real_i as $real)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td align="center">{{ Tanggal::tglIndo($real->tgl_transaksi) }}</td>
                                <td align="right">{{ number_format($real->realisasi_pokok) }}</td>
                                <td align="right">{{ number_format($real->realisasi_jasa) }}</td>
                                <td align="right">{{ number_format($real->saldo_pokok) }}</td>
                                <td align="center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-instagram btn-icon-only btn-tooltip"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="btn-inner--icon"><i class="fas fa-file"></i></span>
                                        </button>
                                        <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item border-radius-md" target="_blank"
                                                    href="/transaksi/dokumen/struk/{{ $real->id }}">
                                                    Kuitansi
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item border-radius-md" target="_blank"
                                                    href="/transaksi/dokumen/struk_matrix/{{ $real->id }}">
                                                    Kuitansi Dot Matrix
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item border-radius-md" target="_blank"
                                                    href="/transaksi/dokumen/struk_thermal/{{ $real->id }}">
                                                    Kuitansi Thermal
                                                </a>
                                            </li>
                                        </ul>
                                        <button type="button"
                                            data-action="/perguliran_i/dokumen/kartu_angsuran/{{ $real->loan_id }}/{{ $real->id }}"
                                            class="btn btn-github btn-icon-only btn-tooltip btn-link"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="BKM"
                                            data-container="body" data-animation="true">
                                            <span class="btn-inner--icon"><i
                                                    class="fas fa-file-invoice"></i></span>
                                        </button>
                                        <button type="button"
                                            data-action="/transaksi/dokumen/bkm_angsuran/{{ $real->transaksi->idt }}"
                                            class="btn btn-github btn-icon-only btn-tooltip btn-link"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="BKM"
                                            data-container="body" data-animation="true">
                                            <span class="btn-inner--icon"><i
                                                    class="fas fa-file-circle-exclamation"></i></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            
            @if ($perguliran_i->status == 'A')
                <div class="card-body ">
                <button type="button" data-bs-toggle="modal" data-bs-target="#Rescedule"
                    class="btn btn-info flex-grow-1 me-2" style="background-color: rgb(240, 148, 0);">
                        <b><i class="fa fa-recycle"></i> &nbsp; Resceduling Pinjaman</b>
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#Penghapusan"
                    class="btn btn-secondary flex-grow-1 ms-2" style="background-color: rgb(253, 5, 5);">
                        <b><i class="fa fa-trash"></i> &nbsp; Penghapusan Pinjaman</b>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
