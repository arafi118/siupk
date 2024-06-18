@php
    use App\Utils\Tanggal;
    $waktu = date('H:i');
    $tempat = '';

    $sum_pokok = 0;
    if ($real) {
        $sum_pokok = $real->sum_pokok;
    }

    $saldo_pokok = $perguliran_i->alokasi - $sum_pokok;
    if ($saldo_pokok < 0) {
        $saldo_pokok = 0;
    }
    $dokumen_proposal = [
        [
            'title' => 'Cover',
            'file' => 'coverProposal',
            'withExcel' => false,
        ],
        [
            'title' => 'Surat Permohonan Pinjaman',
            'file' => 'suratPengajuanPinjaman',
            'withExcel' => false,
        ],
        [
            'title' => 'Surat Rekomendasi Kredit',
            'file' => 'suratRekomendasi',
            'withExcel' => false,
        ],

        [
            'title' => 'Surat Pernyataan Peminjam',
            'file' => 'pernyataanPeminjam',
            'withExcel' => false,
        ],

        [
            'title' => 'Form Verifikasi',
            'file' => 'formVerifikasi',
            'withExcel' => false,
        ],

        [
            'title' => 'Rencana Angsuran',
            'file' => 'rencanaAngsuran',
            'withExcel' => false,
        ],
        [
            'title' => 'Surat Kuasa Khusus',
            'file' => 'SuratPersetujuanKuasa',
            'withExcel' => false,
        ],
        [
            'title' => 'Kesanggupan Penyerahan Jaminan',
            'file' => 'tandaTerimaJaminan',
            'withExcel' => false,
        ],
    ];

    $dokumen_pencairan = [
        [
            'title' => 'Cover',
            'file' => 'coverPencairan',
            'withExcel' => false,
        ],
        [
            'title' => 'Surat Perjanjian Kredit',
            'file' => 'spk',
            'withExcel' => false,
        ],
        [
            'title' => 'Rencana Angsuran',
            'file' => 'rencanaAngsuran',
            'withExcel' => false,
        ],
        [
            'title' => 'Berita Acara Pencairan',
            'file' => 'BaPencairan',
            'withExcel' => false,
        ],
        [
            'title' => 'Kuitansi',
            'file' => 'kuitansi',
            'withExcel' => false,
        ],
        [
            'title' => 'Kartu Angsuran',
            'file' => 'kartuAngsuran',
            'withExcel' => false,
        ],
        [
            'title' => 'analisis keputusan kredit',
            'file' => 'analisiskeputusankredit',
            'withExcel' => false,
        ],
        [
            'title' => 'surat pemberitahuan',
            'file' => 'suratpemberitahuan',
            'withExcel' => false,
        ],
        [
            'title' => 'pengikat diri sebagai penjamin',
            'file' => 'pengikatdirisebagaipenjamin',
            'withExcel' => false,
        ],
        [
            'title' => 'surat pernyataan suami',
            'file' => 'suratpernyataansuami',
            'withExcel' => false,
        ],
        [
            'title' => 'Surat Tagihan',
            'file' => 'suratTagihan',
            'withExcel' => false,
        ],
        [
            'title' => 'Surat Kelayakan',
            'file' => 'suratKelayakan',
            'withExcel' => false,
        ],
        [
            'title' => 'Daftar Hadir Pencairan',
            'file' => 'daftarHadirPencairan',
            'withExcel' => false,
        ],
        [
            'title' => 'Pemberitahuan Ke Desa',
            'file' => 'pemberitahuanDesa',
            'withExcel' => false,
        ],

        [
            'title' => 'Surat Ahli Waris',
            'file' => 'suratAhliWaris',
            'withExcel' => false,
        ],
        [
            'title' => 'Form Verifikasi',
            'file' => 'formVerifikasi',
            'withExcel' => false,
        ],
    ];
@endphp
@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user icon-gradient bg-sunny-morning">
                        </i>
                    </div>
                    <div>
                        <b>Anggota {{ $perguliran_i->anggota->namadepan }} Loan ID. {{ $perguliran_i->id }}
                            ({{ $perguliran_i->jpp->nama_jpp }})</b>
                        <div class="page-title-subheading">
                            <span class="badge mb-2 me-2 btn badge-light-blue">{{ $perguliran_i->anggota->nia }}</span>
                            <span
                                class="badge mb-2 me-2 btn badge-light-blue">{{ $perguliran_i->anggota->alamat_anggota }}</span>
                            <span class="badge mb-2 me-2 btn badge-light-blue">
                                {{ $perguliran_i->anggota->d->sebutan_desa->sebutan_desa }}
                                {{ $perguliran_i->anggota->d->nama_desa }}
                            </span>
                        </div>
                    </div>
                </div>
                @if ($perguliran_i->status == 'P')
                    <div class="page-title-actions">
                        <button type="button" data-bs-toggle="tooltip" title="EDIT PROPOSAL" data-bs-placement="bottom"
                            class="btn-shadow me-3 btn btn-success" id="BtnEditProposal">
                            <i class="fa fa-edit"></i>&nbsp; EDIT PROPOSAL
                        </button>
                        <button type="button" data-bs-toggle="tooltip" title="HAPUS PROPOSAL" data-bs-placement="bottom"
                            class="btn-shadow me-3 btn btn-danger"id="HapusProposal">
                            <i class="fa fa-trash"></i>&nbsp; HAPUS PROPOSAL
                        </button>
                    </div>
                @endif
                {{-- <div class="card-body d-flex justify-content-end">
                    @if ($perguliran_i->status == 'L' || $perguliran_i->status == 'H')
                        @if ($perguliran_i->status != 'H')
                            <button type="button" data-bs-toggle="tooltip"
                                onclick="window.open('/cetak_keterangan_lunas/{{ $perguliran_i->id }}')" type="button"
                                class="btn-shadow me-3 btn btn-danger">
                                <i class="fa fa-print"></i>&nbsp; Cetak Keterangan Pelunasan
                            </button>
                        @endif
                        <a href="/database/anggota/{{ $perguliran_i->anggota->nia }}"
                            class="btn-shadow me-3 btn btn-primary" style="float: right;">
                            <i class="fa fa-reply-all"></i>&nbsp;<b>KEMBALI</b></a>
                    @else
                        @if ($perguliran_i->status == 'P')
                            <button type="button" data-bs-toggle="tooltip" title="EDIT PROPOSAL" data-bs-placement="bottom"
                                class="btn-shadow me-2 btn btn-success" id="BtnEditProposal">
                                <i class="fa fa-edit"></i>&nbsp; EDIT PROPOSAL
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title="HAPUS PROPOSAL"
                                data-bs-placement="bottom" class="btn-shadow btn btn-danger" id="HapusProposal">
                                <i class="fa fa-trash"></i>&nbsp; HAPUS PROPOSAL
                            </button>&nbsp;&nbsp;
                        @endif
                        <a href="/perguliran_i?status={{ $perguliran_i->status }}" class="btn-shadow me-3 btn btn-primary"
                            style="float: right;">
                            <i class="fa fa-reply-all"></i>&nbsp;<b>KEMBALI</b></a>
                    @endif
                </div> --}}

            </div>
        </div>

        <div id="layout">

        </div>

        <div class="main-card mb-3 card">
            <div class="card-body">
                @if ($perguliran_i->status == 'L' || $perguliran_i->status == 'H')
                    @if ($perguliran_i->status != 'H')
                        <button type="button" data-bs-toggle="tooltip"
                            onclick="window.open('/cetak_keterangan_lunas/{{ $perguliran_i->id }}')" type="button"
                            class="btn-shadow me-3 btn btn-danger">
                            <i class="fa fa-print"></i>&nbsp; Cetak Keterangan Pelunasan
                        </button>
                    @endif
                    <a href="/database/anggota/{{ $perguliran_i->anggota->nia }}" class="btn-shadow me-3 btn btn-primary"
                        style="float: right;">
                        <i class="fa fa-reply-all"></i>&nbsp;<b>KEMBALI</b></a>
                @else
                    <a href="/perguliran_i?status={{ $perguliran_i->status }}" class="btn-shadow me-3 btn btn-primary"
                        style="float: right;">
                        <i class="fa fa-reply-all"></i>&nbsp;<b>KEMBALI</b></a>
                @endif
            </div>
        </div><br><br><br>
    </div>
    {{-- Modal Cetak Dokumen Proposal --}}
    <div class="modal fade" id="CetakDokumenProposal" tabindex="-1" aria-labelledby="CetakDokumenProposalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="CetakDokumenProposalLabel">Cetak Dokumen Proposal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label" for="tglProposal">Tanggal Proposal</label>
                                <input autocomplete="off" type="text" name="tglProposal" id="tglProposal"
                                    class="form-control" readonly
                                    value="{{ Tanggal::tglIndo($perguliran_i->tgl_proposal) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label" for="tglVerifikasi">Tanggal Verifikasi</label>
                                <input autocomplete="off" type="text" name="tglVerifikasi" id="tglVerifikasi"
                                    class="form-control" readonly
                                    value="{{ Tanggal::tglIndo($perguliran_i->tgl_verifikasi) }}">
                            </div>
                        </div>
                    </div>

                    <form action="/perguliran_i/dokumen?status=P" target="_blank" method="post">
                        @csrf

                        <input type="hidden" name="id" value="{{ $perguliran_i->id }}">
                        <div class="row">
                            @foreach ($dokumen_proposal as $doc => $val)
                                <div class="col-md-3 d-grid">
                                    @if ($val['withExcel'])
                                        <div class="btn-group">
                                            <button class="btn btn-linkedin btn-sm text-start" type="submit" name="report"
                                                value="{{ $val['file'] }}#pdf">
                                                {{ $loop->iteration }}. {{ $val['title'] }}
                                            </button>
                                            <button class="btn btn-icon btn-sm btn-instagram" type="submit" name="report"
                                                value="{{ $val['file'] }}#excel">
                                                <i class="fas fa-file-excel"></i>
                                            </button>
                                        </div>
                                    @else
                                        <button class="btn btn-linkedin btn-sm text-start" type="submit" name="report"
                                            value="{{ $val['file'] }}#pdf">
                                            {{ $loop->iteration }}. {{ $val['title'] }}
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @php
        $readonly = 'readonly';
        if ($perguliran_i->status == 'W') {
            $readonly = '';
        }

        $wt_cair = explode('_', $perguliran_i->wt_cair);
        if (count($wt_cair) == 1) {
            $waktu = $wt_cair[0];
        }

        if (count($wt_cair) == 2) {
            $waktu = $wt_cair[0];
            $tempat = $wt_cair[1];
        }
    @endphp
   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
  

@endsection

@section('script')
    <script>
        var formatter = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        })

        $.get('/perguliran_i/{{ $perguliran_i->id }}', function(result) {
            $('#layout').html(result)
        })

        $('#BtnEditProposal').click(function(e) {
            e.preventDefault()

            $.get('/perguliran_i/{{ $perguliran_i->id }}/edit', function(result) {
                $('#LayoutEditProposal').html(result)
                $('#EditProposal').modal('show')
            })
        })

        $('#HapusProposal').click(function(e) {
            e.preventDefault()

            Swal.fire({
                title: 'Hapus Proposal Ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('#FormDeleteProposal')
                    $.ajax({
                        type: 'post',
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(result) {
                            if (result.hapus) {
                                Swal.fire('Berhasil!', result.msg, 'success').then(() => {
                                    window.location.href = '/perguliran_i'
                                })
                            } else {
                                Swal.fire('Peringatan', result.msg, 'warning')
                            }
                        }
                    })
                }
            })
        })

        $(document).on('click', '#SimpanEditProposal', function(e) {
            e.preventDefault()
            $('small').html('')

            var form = $('#FormEditProposal')
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    Swal.fire('Berhasil', result.msg, 'success').then(() => {
                        $.get('/perguliran_i/{{ $perguliran_i->id }}', function(result) {
                            $('#layout').html(result)

                            $('#EditProposal').modal('hide')
                            window.location.reload()
                        })
                    })
                },
                error: function(result) {
                    const respons = result.responseJSON;

                    Swal.fire('Error', 'Cek kembali input yang anda masukkan', 'error')
                    $.map(respons, function(res, key) {
                        $('#' + key).parent('.input-group.input-group-static')
                            .addClass(
                                'is-invalid')
                        $('#FormEditProposal #msg_' + key).html(res)
                    })
                }
            })
        })

        $(document).on('change', '.save', function() {
            var form = $('#simpanData')
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        $('[name=tgl_cair]').val(result.tgl_cair)
                        Swal.fire('Berhasil', result.msg, 'success')
                    }
                }
            })
        })

        $(document).on('click', '#kembaliProposal', function() {
            Swal.fire({
                title: 'Peringatan',
                text: 'Anda yakin ingin mengembalikan pinjaman menjadi P (Pengajuan/Proposal)?',
                showCancelButton: true,
                confirmButtonText: 'Kembalikan',
                cancelButtonText: 'Batal',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('#formKembaliProposal')
                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(result) {
                            if (result.success) {
                                Swal.fire('Berhasil', result.msg, 'success').then(() => {
                                    window.location.href = '/detail_i/' + result
                                        .id_pinkel
                                })
                            }
                        }
                    })
                }
            })
        })

        $(document).on('click', '#SimpanRescedule', async function(e) {
            e.preventDefault()
            $('#Rescedule').modal('hide')

            const {
                value: spk
            } = await Swal.fire({
                title: 'Masukkan Nomor SPK baru',
                input: 'text',
                inputLabel: 'Spk No.',
                confirmButtonText: 'Simpan Perubahan'
            })

            if (spk) {
                var form = $('#formRescedule')
                $.ajax({
                    type: 'POST',
                    url: form.attr('action') + '?spk=' + spk,
                    data: form.serialize(),
                    success: function(result) {
                        if (result.success) {
                            var id = result.id
                            $.get('/perguliran_i/generate/' + result.id + '?status=' + result
                                .status +
                                '&save',
                                function(result) {
                                    if (result.success) {
                                        Swal.fire('Berhasil', result.msg, 'success').then(
                                            () => {
                                                window.location.href = '/detail_i/' + id
                                            })
                                    }
                                })
                        }
                    }
                })
            }
        })

        $(document).on('click', '#SimpanHapus', function(e) {
            e.preventDefault()

            Swal.fire({
                title: 'Peringatan',
                text: 'Anda yakin ingin melakukan penghapusan untuk pinjaman ini?',
                showCancelButton: true,
                confirmButtonText: 'Hapus Pinjaman',
                cancelButtonText: 'Batal',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('#FormPenghapusanPinjaman')
                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(result) {
                            if (result.success) {
                                Swal.fire('Berhasil', result.msg, 'success').then(() => {
                                    window.location.href = '/perguliran_i'
                                })
                            }
                        }
                    })
                }
            })
        })

        $(document).on('click', '.btn-link', function(e) {
            var action = $(this).attr('data-action')

            open_window(action)
        })
    </script>
@endsection
