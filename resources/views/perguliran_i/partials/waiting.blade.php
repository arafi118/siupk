<form action="/perguliran_i/{{ $perguliran_i->id }}" method="post" id="FormInput">
    @csrf
    @method('PUT')

    @if ($pinj_aktif)
        <div class="alert alert-danger text-white" role="alert">
            <span class="text-sm">
                <b>{{ ucwords(strtolower($pinj_aktif->anggota->namadepan)) }}</b> masih memiliki kewajiban
                angsuran pinjaman dengan
                <a href="/detail_i/{{ $pinj_aktif->id }}" target="_blank" class="alert-link text-white">
                    Loan ID. {{ $pinj_aktif->id }}
                </a>
            </span>
        </div>
    @endif

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
        <form action="/perguliran_i/dokumen?status=P" target="_blank" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $perguliran_i->id }}">
            <div class="card-body d-flex justify-content-between">
                <button type="submit" name="report" value="RekomendasiVerifikator#pdf"
                    class="btn btn-info flex-grow-1 me-2" style="background-color: rgb(23, 203, 20);">
                    <b>Cetak Dokumen Proposal</b>
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenProposal"
                    class="btn btn-info flex-grow-1 ms-2" style="background-color: rgb(4, 172, 250);">
                    <b>Cetak Dokumen Pencairan</b>
                </button>
            </div>
        </form>
    </div>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Input Realisasi Pencairan </h5>
                    <form class="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="exampleCity" class="form-label">Tgl Cair</label>
                                    <input name="city" id="exampleCity" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="exampleState" class="form-label">Alokasi Rp.</label>
                                    <input name="state" id="exampleState" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="exampleZip" class="form-label">Sumber Pembayaran (Kredit)</label>
                                    <input name="zip" id="exampleZip" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="card-body">
                                <button type="submit" name="report" value="RekomendasiVerifikator#pdf"
                                    class="btn btn-info flex-grow-1 me-2" style="background-color: rgb(240, 148, 0);">
                                    <b><i class="fa fa-refresh"></i> &nbsp; KEMBALI KE PROPOSAL</b>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenProposal"
                                    class="btn btn-secondary flex-grow-1 ms-2"
                                    style="background-color: rgb(112, 109, 109);">
                                    <b><i class="fa fa-search-plus"></i> &nbsp; SIMPAN KEPUTUSAN PENDANAAN</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/perguliran_i/kembali_proposal/{{ $perguliran_i->id }}" method="post" id="formKembaliProposal">
    @csrf
</form>

<script>
    var formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    })

    new Choices($('#sumber_pembayaran')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })

    $(".money").maskMoney();

    $(".date").flatpickr({
        dateFormat: "d/m/Y"
    })

    $(document).on('click', '#Simpan', async function(e) {
        e.preventDefault()
        $('small').html('')

        var alokasi = parseInt($('#alokasi').val().split(',').join('').split('.00').join(''))
        var __alokasi = parseInt($('#__alokasi').val())

        var lanjut = true;
        lanjut = await Swal.fire({
            title: 'Peringatan',
            text: 'Anda akan melakukan Pencairan Piutang sebesar Rp. ' + $('#alokasi').val().split(
                    '.00').join('') +
                ' untuk kelompok tersebut? Setelah klik tombol Lanjutkan data tidak dapat diubah kembali !',
            showCancelButton: true,
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal',
            icon: 'warning'
        }).then((result) => {
            if (result.isConfirmed) {
                return true
            }

            return false
        })

        if (lanjut) {
            var form = $('#FormInput')
            $.ajax({
                type: 'POST',
                url: form.attr('action') + '?save=true',
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        Swal.fire('Berhasil', result.msg, 'success').then(() => {
                            window.location.href = '/detail_i/' + result.id
                        })
                    } else {
                        Swal.fire('Error', result.msg, 'error')
                    }
                },
                error: function(result) {
                    const respons = result.responseJSON;

                    Swal.fire('Error', 'Cek kembali input yang anda masukkan', 'error')
                    $.map(respons, function(res, key) {
                        $('#' + key).parent('.input-group.input-group-static')
                            .addClass(
                                'is-invalid')
                        $('#msg_' + key).html(res)
                    })
                }
            })
        }
    })
</script>
