<form action="/perguliran_i/{{ $perguliran_i->id }}" method="post" id="FormInput">
    @csrf
    @method('PUT')
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
                                            <div class="badge angka-warna-biru">
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
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="card-title">&nbsp;</h5>
                                    <ul class="list-group">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body p-2 pb-0 mb-3">
        <div class="d-grid">
            <button type="button" data-bs-toggle="modal" data-bs-target="#CetakDokumenProposal"
                class="btn btn-info btn-sm mb-2">Cetak Dokumen Proposal</button>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Input Rekom Verifikator</h5>
                    <input type="hidden" name="_id" id="_id" value="{{ $perguliran_i->id }}">
                    <input type="hidden" name="status" id="status" value="V">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="DOMContentLoaded position-relative mb-3">
                                    <label for="tgl_verifikasi" class="form-label">Tgl Verifikasi</label>
                                    <input autocomplete="off" type="text" name="tgl_verifikasi" id="tgl_verifikasi"
                                           class="form-control date" value="{{ date('d/m/Y') }}">
                                    <small class="text-danger" id="msg_tgl_verifikasi"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative mb-3">
                                    <label for="verifikasi" class="form-label">Verifikasi Rp.</label>
                                    <input autocomplete="off" type="text" name="verifikasi" id="verifikasi"
                                        class="form-control money" value="{{ number_format($perguliran_i->proposal, 2) }}">
                                    <small class="text-danger" id="msg_verifikasi"></small>
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
                                   <input autocomplete="off"  type="number" name="pros_jasa" id="pros_jasa" class="form-control"
                                        value="{{ $perguliran_i->pros_jasa }}">
                                    <small class="text-danger" id="msg_pros_jasa"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="jenis_jasa" class="form-label">Jenis Jasa</label>
                                    <select class="selectproposal form-control" name="jenis_jasa" id="jenis_jasa">
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
                                    <select class="selectproposal form-control" name="sistem_angsuran_pokok" id="sistem_angsuran_pokok">
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
                                    <select class="selectproposal form-control" name="sistem_angsuran_jasa" id="sistem_angsuran_jasa">
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
                            <div class="col-md-12">
                                <div class="position-relative mb-3">
                                    <label for="catatan_verifikasi" class="form-label">Catatan Verifikasi</label>
                                    <textarea class="form-control" name="catatan_verifikasi" id="catatan_verifikasi" rows="3"
                                    placeholder="Catatan" spellcheck="false">{{ $perguliran_i->catatan_verifikasi }}</textarea>
                                <small class="text-danger" id="msg_catatan_verifikasi"></small>
                                </div>
                            </div>
                        </div>
                        <button id="Simpan" class="mt-2 btn btn-primary float-end btn-sm">SIMPAN REKOM VERIFIKATOR</button>
                </div>
            </div>
        </div>
    </div>

</form>


<script>

    $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });
    var formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    })

    $('.selectproposal').select2({
        theme: 'bootstrap-5'
    });

    $(".money").maskMoney();


    $(document).on('click', '#Simpan', async function(e) {
        e.preventDefault()
        $('small').html('')

        var form = $('#FormInput')
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
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

