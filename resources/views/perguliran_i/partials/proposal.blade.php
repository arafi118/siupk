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
                    <form class="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="position-relative mb-3">
                                    <label for="exampleEmail11" class="form-label">Tgl Verifikasi</label>
                                    <input name="email" id="exampleEmail11" placeholder="with a placeholder"
                                        type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative mb-3">
                                    <label for="examplePassword11" class="form-label">Verifikasi Rp.</label>
                                    <input name="password" id="examplePassword11" placeholder="password placeholder"
                                        type="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative mb-3">
                                    <label for="exampleEmail11" class="form-label">Jangka</label>
                                    <input name="email" id="exampleEmail11" placeholder="with a placeholder"
                                        type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative mb-3">
                                    <label for="examplePassword11" class="form-label">Prosentase Jasa (%)</label>
                                    <input name="password" id="examplePassword11" placeholder="password placeholder"
                                        type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="exampleCity" class="form-label">Jenis Jasa</label>
                                    <input name="city" id="exampleCity" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="exampleState" class="form-label">Sistem Ang. Pokok</label>
                                    <input name="state" id="exampleState" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="exampleZip" class="form-label">Sistem Ang. Jasa</label>
                                    <input name="zip" id="exampleZip" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative mb-3">
                                    <label for="exampleCity" class="form-label">Catatan Verifikasi</label>
                                    <input name="city" id="exampleCity" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button class="mt-2 btn btn-primary">SIMPAN REKOM VERIFIKATOR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</form>

<script>
    var formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    })

    new Choices($('#jenis_jasa')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })
    new Choices($('#sistem_angsuran_pokok')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })
    new Choices($('#sistem_angsuran_jasa')[0], {
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
