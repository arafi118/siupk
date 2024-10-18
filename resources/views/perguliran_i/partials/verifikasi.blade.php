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
                                <h5 class="card-title"text-danger>Verified</h5>
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
                class="btn btn-warning flex-grow-1 me-2" style="background-color: rgb(214, 184, 118);">
                <b style="color: white;">&nbsp;Cetak Rekomendasi Verifikator/Analis&nbsp;</b>
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenProposal"
                class="btn btn-success flex-grow-1 ms-2" style="background-color: rgb(12, 209, 18);">
                <b>Cetak Dokumen Proposal</b>
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
                <h5 class="card-title">Input Rekom Verifikator</h5>
                <input type="hidden" name="_id" id="_id" value="{{ $perguliran_i->id }}">
                <input type="hidden" name="status" id="status" value="W">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="tgl_tunggu" class="form-label">Tgl Tunggu</label>
                                <input autocomplete="off" type="text" name="tgl_tunggu" id="tgl_tunggu"
                                    class="form-control date" value="{{ date('d/m/Y') }}">
                                <small class="text-danger" id="msg_tgl_tunggu"></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="harga" class="form-label">Harga Rp.</label>
                                <input autocomplete="off" type="text" name="harga" id="harga"
                                class="form-control money" value="{{ number_format($perguliran_i->verifikasi, 2) }}">
                            <small class="text-danger" id="msg_harga"></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="jangka" class="form-label">Jangka</label>
                                <input autocomplete="off" type="number" name="jangka" id="jangka" class="form-control"
                                value="{{ $perguliran_i->jangka }}">
                            <small class="text-danger" id="msg_jangka"></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="pros_jasa" class="form-label">Prosentase Jasa (%)</label>
                                <input autocomplete="off" type="number" name="pros_jasa" id="pros_jasa"
                                    class="form-control" value="{{ $perguliran_i->pros_jasa }}">
                                <small class="text-danger" id="msg_pros_jasa"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="jenis_jasa" class="form-label">Jenis Jasa</label>
                                <select class="selectverived form-control" name="jenis_jasa" id="jenis_jasa">
                                    @foreach ($jenis_jasa as $jj)
                                        <option {{ $jj->id == $perguliran_i->jenis_jasa ? 'selected' : '' }}
                                            value="{{ $jj->id }}">
                                            {{ $jj->nama_jj }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger" id="msg_jenis_jasa"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="sistem_angsuran_pokok" class="form-label">Sistem Ang. Pokok</label>
                                <select class="selectverived form-control" name="sistem_angsuran_pokok" id="sistem_angsuran_pokok">
                                    @foreach ($sistem_angsuran as $sa)
                                        <option {{ $sa->id == $perguliran_i->sistem_angsuran ? 'selected' : '' }}
                                            value="{{ $sa->id }}">
                                            {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger" id="msg_sistem_angsuran_pokok"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="sistem_angsuran_jasa" class="form-label">Sistem Ang. Jasa</label>
                                <select class="selectverived form-control" name="sistem_angsuran_jasa" id="sistem_angsuran_jasa">
                                    @foreach ($sistem_angsuran as $sa)
                                        <option {{ $sa->id == $perguliran_i->sa_jasa ? 'selected' : '' }}
                                            value="{{ $sa->id }}">
                                            {{ $sa->nama_sistem }} ({{ $sa->deskripsi_sistem }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger" id="msg_sistem_angsuran_jasa"></small>
                            </div>
                        </div>
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
                                <label for="depe" class="form-label">Down Payment (%)</label>
                                <input autocomplete="off" type="text" name="depe" id="depe"
                                class="form-control money" value="{{ number_format($perguliran_i->verifikasi * $kec->def_depe /100 ,2) }}">
                            <small class="text-danger" id="msg_depe"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="nomor_spk" class="form-label">Nomor SPK</label>
                                <input autocomplete="off" type="text" name="nomor_spk" id="nomor_spk"
                                class="form-control" value="{{ $perguliran_i->spk_no }}">
                            <small class="text-danger" id="msg_nomor_spk"></small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <button type="button" id="kembaliProposal" class="btn btn-info flex-grow-1 me-2" style="background-color: rgb(240, 148, 0);">
                            <b><i class="fa fa-refresh"></i> &nbsp; KEMBALI KE PROPOSAL</b>
                        </button>
                        <button type="button" id="Simpan" class="btn btn-secondary flex-grow-1 ms-2" style="background-color: rgb(112, 109, 109);">
                            <b><i class="fa fa-search-plus"></i> &nbsp; SIMPAN KEPUTUSAN PENDANAAN</b>
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

<script>
    $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });
    var formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    })

    $('.selectverived').select2({
        theme: 'bootstrap-5'
    });

    $(".money").maskMoney();


    $(document).on('click', '#Simpan', async function(e) {
        e.preventDefault()
        $('small').html('')

        var form = $('#FormInput')
        $.ajax({
            type: 'POST',
            url: form.attr('action') + '?save=true',
            data: form.serialize(),
            success: function(result) {
                Swal.fire('Berhasil', result.msg, 'success').then(() => {
                    window.location.href = '/detail_i/' + result.id
                })
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
    })
</script>
