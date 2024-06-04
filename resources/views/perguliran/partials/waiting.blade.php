<form action="/perguliran/{{ $perguliran->id }}" method="post" id="FormInput">
    @csrf
    @method('PUT')

    @if ($pinj_a['jumlah_pinjaman'] > 0)
        <div class="alert alert-danger text-white" role="alert">
            <span class="text-sm">
                <b>Anggota Kelompok</b>
                terdeteksi memiliki kewajiban angsuran pinjaman
            </span>
        </div>
        <table class="table table-striped table-danger">
            <thead>
                <tr class="bg-danger">
                    <th align="center" width="10">No</th>
                    <th align="center">Nama</th>
                    <th>detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pinj_a['pinjaman'] as $pa)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td align="left">{{ ucwords(strtolower($pa->anggota->namadepan)) }} ({{ $pa->nia }})</td>
                        <td>
                            <a href="/detail/{{ $pa->id_pinkel }}" target="_blank"
                                class="text-danger text-gradient font-weight-bold">
                                detail pinjaman sebelumnya
                            </a>.
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($pinj_a['jumlah_pemanfaat'] > 0)
        <div class="alert alert-danger text-white" role="alert">
            <span class="text-sm">
                Salah satu anggota pemanfaat masih terdaftar pada pinjaman di kecamatan lain
            </span>
        </div>
    @endif

    @if ($pinj_a['jumlah_kelompok'] > 0)
        @foreach ($pinj_a['kelompok'] as $kel)
            <div class="alert alert-danger text-white" role="alert">
                <span class="text-sm">
                    <b>Kelompok {{ ucwords(strtolower($kel->kelompok->nama_kelompok)) }}</b> masih memiliki kewajiban
                    angsuran pinjaman dengan
                    <a href="/detail/{{ $kel->id }}" target="_blank" class="alert-link text-white">
                        Loan ID. {{ $kel->id }}
                    </a>.
                </span>
            </div>
        @endforeach
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <div class="row mt-0">
                <div class="col-md-4 mb-3">
                    <div class="border border-light border-2 border-radius-md p-3">
                        <h6 class="text-info text-gradient mb-0">
                            Proposal
                        </h6>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Tgl Pengajuan
                                <span class="badge badge-info badge-pill">
                                    {{ Tanggal::tglIndo($perguliran->tgl_proposal) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Pengajuan
                                <span class="badge badge-info badge-pill">
                                    {{ number_format($perguliran->proposal) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Jenis Jasa
                                <span class="badge badge-info badge-pill">
                                    {{ $perguliran->jasa->nama_jj }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Jasa
                                <span class="badge badge-info badge-pill">
                                    {{ $perguliran->pros_jasa . '% / ' . $perguliran->jangka . ' bulan' }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Angs. Pokok
                                <span class="badge badge-info badge-pill">
                                    {{ $perguliran->sis_pokok->nama_sistem }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Angs. Jasa
                                <span class="badge badge-info badge-pill">
                                    {{ $perguliran->sis_jasa->nama_sistem }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="border border-light border-2 border-radius-md p-3">
                        <h6 class="text-danger text-gradient mb-0">
                            Verified
                        </h6>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Tgl Verifikasi
                                <span class="badge badge-danger badge-pill">
                                    {{ Tanggal::tglIndo($perguliran->tgl_verifikasi) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Verifikasi
                                <span class="badge badge-danger badge-pill">
                                    {{ number_format($perguliran->verifikasi) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Jenis Jasa
                                <span class="badge badge-danger badge-pill">
                                    {{ $perguliran->jasa->nama_jj }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Jasa
                                <span class="badge badge-danger badge-pill">
                                    {{ $perguliran->pros_jasa . '% / ' . $perguliran->jangka . ' bulan' }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Angs. Pokok
                                <span class="badge badge-danger badge-pill">
                                    {{ $perguliran->sis_pokok->nama_sistem }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Angs. Jasa
                                <span class="badge badge-danger badge-pill">
                                    {{ $perguliran->sis_jasa->nama_sistem }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="border border-light border-2 border-radius-md p-3">
                        <h6 class="text-warning text-gradient mb-0">
                            Waiting
                        </h6>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Tgl Tunggu
                                <span class="badge badge-warning badge-pill">
                                    {{ Tanggal::tglIndo($perguliran->tgl_tunggu) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Pendanaan
                                <span class="badge badge-warning badge-pill">
                                    {{ number_format($perguliran->alokasi) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Jenis Jasa
                                <span class="badge badge-warning badge-pill">
                                    {{ $perguliran->jasa->nama_jj }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Jasa
                                <span class="badge badge-warning badge-pill">
                                    {{ $perguliran->pros_jasa . '% / ' . $perguliran->jangka . ' bulan' }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Angs. Pokok
                                <span class="badge badge-warning badge-pill">
                                    {{ $perguliran->sis_pokok->nama_sistem }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center text-sm">
                                Angs. Jasa
                                <span class="badge badge-warning badge-pill">
                                    {{ $perguliran->sis_jasa->nama_sistem }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr class="horizontal dark">

            <div class="table-responsive">
                <table class="table table-striped align-items-center mb-0" width="100%">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Pengajuan</th>
                            <th>Verifikasi</th>
                            <th>Alokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $proposal = 0;
                            $verifikasi = 0;
                            $alokasi = 0;
                        @endphp
                        @foreach ($perguliran->pinjaman_anggota as $pinjaman_anggota)
                            @php
                                $proposal += $pinjaman_anggota->proposal;
                                $verifikasi += $pinjaman_anggota->verifikasi;
                                $alokasi += $pinjaman_anggota->alokasi;
                            @endphp
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td>
                                    {{ ucwords($pinjaman_anggota->anggota->namadepan) }}
                                    ({{ $pinjaman_anggota->nia }})
                                </td>
                                <td>
                                    {{ number_format($pinjaman_anggota->proposal, 2) }}
                                </td>
                                <td>
                                    {{ number_format($pinjaman_anggota->verifikasi, 2) }}
                                </td>
                                <td>
                                    {{ number_format($pinjaman_anggota->alokasi, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Jumlah</th>
                            <th>
                                {{ number_format($proposal, 2) }}
                            </th>
                            <th id="jumlah">
                                {{ number_format($verifikasi, 2) }}
                            </th>
                            <th>
                                {{ number_format($alokasi, 2) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="card card-body p-2 pb-0 mb-3">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="d-grid">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenProposal"
                        class="btn btn-info btn-sm mb-2">Cetak Dokumen Proposal</button>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="d-grid">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenPencairan"
                        class="btn btn-info btn-sm mb-2">Cetak Dokumen Pencairan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header pb-0 p-3">
            <h6>
                Input Realisasi Pencairan
            </h6>
        </div>
        <div class="card-body p-3">
            <input type="hidden" name="_id" id="_id" value="{{ $perguliran->id }}">
            <input type="hidden" name="status" id="status" value="A">
            <input type="hidden" name="debet" id="debet" value="{{ $debet->kode_akun }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static my-3">
                        <label for="tgl_cair">Tgl Cair</label>
                        <input autocomplete="off" type="text" name="tgl_cair" id="tgl_cair"
                            class="form-control date" value="{{ Tanggal::tglIndo($perguliran->tgl_cair) }}">
                        <small class="text-danger" id="msg_tgl_cair"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static my-3">
                        <label for="alokasi">Alokasi Rp.</label>
                        <input autocomplete="off" readonly type="text" name="alokasi" id="alokasi"
                            class="form-control money" value="{{ number_format($perguliran->alokasi, 2) }}">
                        <small class="text-danger" id="msg_alokasi"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="my-2">
                        <label class="form-label" for="sumber_pembayaran">Sumber Pembayaran (Kredit)</label>
                        <select class="form-control" name="sumber_pembayaran" id="sumber_pembayaran">
                            @foreach ($sumber_bayar as $sb)
                                <option value="{{ $sb->kode_akun }}">
                                    {{ $sb->kode_akun }}. {{ $sb->nama_akun }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="msg_sistem_angsuran_jasa"></small>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="button" id="kembaliProposal" class="btn btn-warning btn-sm">
                    Kembalikan Ke Proposal
                </button>
                <button type="button"
                    {{ $pinj_a['jumlah_pinjaman'] > '0' || $pinj_a['jumlah_pemanfaat'] > '0' || $pinj_a['jumlah_kelompok'] > '0' ? 'disabled' : '' }}
                    id="Simpan" class="btn btn-github ms-1 btn-sm">
                    Cairkan Sekarang
                </button>

            </div>
        </div>
    </div>
</form>

<form action="/perguliran/kembali_proposal/{{ $perguliran->id }}" method="post" id="formKembaliProposal">
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
                            window.location.href = '/detail/' + result.id
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
