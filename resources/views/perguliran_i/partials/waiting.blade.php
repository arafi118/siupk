@php
    use App\Models\Kecamatan;
    $kecamatan = Kecamatan::where('web_kec', explode('//', URL::to('/'))[1])
            ->orWhere('web_alternatif', explode('//', URL::to('/'))[1])
            ->first();
@endphp

@if ($pinj_aktif && count($pinj_aktif) > 0)
    @foreach ($pinj_aktif as $pa)
    <div class="alert alert-danger text-black" role="alert">
        <span class="text-sm">
            <b>{{ ucwords(strtolower($pa->anggota->namadepan)) }}</b> masih memiliki kewajiban
            angsuran pinjaman dengan
            <a href="/detail_i/{{ $pa->id }}" target="_blank" class="alert-link text-black">
                Loan ID. {{ $pa->id }}
            </a>
        </span>
    </div>
    @endforeach
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
            <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenProposal"
                class="btn btn-info flex-grow-1 me-2" style="background-color: rgb(23, 203, 20);">
                <b>Cetak Dokumen Proposal</b>
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenPencairan"
                class="btn btn-info flex-grow-1 ms-2" style="background-color: rgb(4, 172, 250);">
                <b>Cetak Dokumen Pencairan</b>
            </button>
        </div>
    </form>
</div>

<form action="/perguliran_i/{{ $perguliran_i->id }}" method="post" id="FormInput">
    @csrf
    @method('PUT')

    <div class="tab-content">
        <div class="tab-pane fade show active" id="" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Input Realisasi Pencairan </h5>
                    <div class="card-body p-3">
                        <input type="hidden" name="_id" id="_id" value="{{ $perguliran_i->id }}">
                        <input type="hidden" name="status" id="status" value="A">
                        <input type="hidden" name="debet" id="debet" value="{{ $debet->kode_akun }}">
                        <input type="hidden" name="harga" id="harga" value="{{ $perguliran_i->harga }}">

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="tgl_cair" class="form-label">Tgl Cair</label>
                                <input autocomplete="off" type="text" name="tgl_cair" id="tgl_cair"
                                    class="form-control date" value="{{ date('d/m/Y') }}">
                                <small class="text-danger" id="msg_tgl_cair"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="alokasi" class="form-label">Alokasi Rp.</label>
                                <input autocomplete="off" disabled type="text" name="alokasi" id="alokasi"
                                    class="form-control money"
                                    value="{{ number_format($perguliran_i->alokasi,2) }}">
                                <small class="text-danger" id="msg_alokasi"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="sumber_pembayaran" class="form-label">Sumber Pembayaran (Kredit)</label>
                                <select class="js-example-basic-single form-control" name="sumber_pembayaran"
                                    id="sumber_pembayaran">
                                    @foreach ($sumber_bayar as $sb)
                                        <option value="{{ $sb->kode_akun }}">
                                            {{ $sb->kode_akun }}. {{ $sb->nama_akun }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger" id="msg_sumber_pembayaran"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="nama_agent" class="form-label">Nama Agent</label>
                                <input autocomplete="off" type="text" name="nama_agent" id="nama_agent"
                                    class="form-control" readonly value="{{ ($perguliran_i->agent) ? $perguliran_i->agent->agent:''; }}">
                                <small class="text-danger" id="msg_nama_agent"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="supplier" class="form-label">Nama Supplier</label>
                                <select class="js-example-basic-single form-control" name="supplier" id="supplier"
                                    style="width: 100%;">
                                    @foreach ($supplier as $sp)
                                        <option value="{{ $sp->id }}">
                                            ({{ $sp->nomorid }})
                                            {{ $sp->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger" id="msg_supplier"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="fee_supplier" class="form-label">Fee Dari Supplier</label>
                                <input autocomplete="off" type="text" name="fee_supplier" id="fee_supplier"
                                    class="form-control money"
                                    value="{{ number_format($perguliran_i->alokasi * ($kec->def_fee_supp / 100), 2) }}">
                                <small class="text-danger" id="msg_fee_supplier"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="fee_agent" class="form-label">Fee Agent</label>
                                <input autocomplete="off" type="text" name="fee_agent" id="fee_agent"
                                    class="form-control money"
                                    value="{{ number_format($perguliran_i->alokasi * ($kec->def_fee_agen / 100), 2) }}">
                                <small class="text-danger" id="msg_fee_agent"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="admin" class="form-label">Admin</label>
                                <input autocomplete="off" type="text" name="admin" id="admin"
                                    class="form-control money">
                                <small class="text-danger" id="msg_admin"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="depe" class="form-label">Down Payment</label>
                                <input autocomplete="off" disabled type="text" name="depe" id="depe"
                                    class="form-control money" value="{{ number_format($perguliran_i->depe, 2) }}">
                                <small class="text-danger" id="msg_depe"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="provisi" class="form-label">Provisi</label>
                                <input autocomplete="off" type="text" name="provisi" id="provisi"
                                    class="form-control money"
                                    value="{{ number_format($perguliran_i->alokasi * ($kec->provisi / 100), 2) }}">
                                <small class="text-danger" id="msg_provisi"></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="button" id="kembaliProposal" class="btn btn-info flex-grow-1 me-2"
                            style="background-color: rgb(240, 180, 0);">
                            <b><i class="fa fa-refresh"></i> &nbsp; KEMBALI KE PROPOSAL</b>
                        </button>
                        <button type="button" id="kembaliVerifikasi" class="btn btn-info flex-grow-1 me-2"
                            style="background-color: rgb(240, 80, 0);">
                            <b><i class="fa fa-refresh"></i> &nbsp; KEMBALI KE VERIFIKASI</b>
                        </button>
                        <button type="button" id="Simpan" {{ count($pinj_aktif) > 0 && $kecamatan->id != 280 ? 'disabled' : '' }}
                            class="btn btn-secondary flex-grow-1 ms-2" style="background-color: rgb(112, 109, 109);">
                            <b><i class="fa fa-search-plus"></i> Cairkan</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/perguliran_i/kembali_proposal/{{ $perguliran_i->id }}" method="post" id="formKembaliProposal">
    @csrf
</form>
<form action="/perguliran_i/kembali_verifikasi/{{ $perguliran_i->id }}" method="post" id="formKembaliVerifikasi">
    @csrf
</form>

<script>
    $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    var formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    })

    $(".money").maskMoney();

    $('.js-example-basic-single').select2({
        theme: 'bootstrap-5'
    });

    $(document).on('click', '#Simpan', async function(e) {
        e.preventDefault()
        $('small').html('')

        var alokasi = parseInt($('#alokasi').val().split(',').join('').split('.00').join(''))
        var __alokasi = parseInt($('#__alokasi').val())

        var lanjut = true;
        lanjut = await Swal.fire({
            title: 'Peringatan',
            text: 'Anda akan melakukan Pencairan Piutang sebesar Rp. ' + $('#harga').val().split(
                    '.00').join('') + 
                ' untuk Nasabah tersebut? Setelah klik tombol Lanjutkan data tidak dapat diubah kembali !',
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
