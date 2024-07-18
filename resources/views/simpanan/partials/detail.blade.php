@extends('layouts.base')
@section('content')
<div class="nav-wrapper position-relative end-0">
    <div class="tab-content mt-2">
        <div class="tab-pane fade show active" id="ProfilDebitur" role="tabpanel" aria-labelledby="ProfilDebitur">
            <div class="card">
                <div class="card mb-3">
             <div class="row">
                                <div class="col-md-6">
                    <div class="card-body p-3">
                        <h5 class="mb-1">
                            Nasabah {{ $nia->anggota->namadepan }} CIF. {{ $nia->id}}
                            ({{ $nia->js->nama_js }})
                        </h5>
                        <p class="mb-0">
                            <span class="badge badge-{{ $nia->sts->warna_status }}">{{ $nia->anggota->nia }}</span>
                            <span class="badge badge-{{ $nia->sts->warna_status }}">{{ $nia->anggota->alamat_anggota }}</span>
                            <span class="badge badge-{{ $nia->sts->warna_status }}">
                                {{ $nia->anggota->d->sebutan_desa->sebutan_desa }}
                                {{ $nia->anggota->d->nama_desa }}
                            </span>
                        </p>
                    </div>
                    </div>
                                <div class="col-md-6">
                    <div class="card-body p-3">
                        <button class="btn btn-warning btn-sm float-end ms-2"
                            onclick="window.open('/cetak_kop/{{ $nia->id }}')" type="button">
                            <i class="fa fa-print"></i> Cetak KOP Buku
                        </button>
                        <button class="btn btn-warning btn-sm float-end ms-2"
                            onclick="window.open('/cetak_koran/{{ $nia->id }}')" type="button">
                            <i class="fa fa-print"></i> Cetak Rekening Koran
                        </button>
                    </div>
                    </div>
                    
                </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group input-group-static my-3">
                                        <label for="nomor_rekening">Nomor Rekening</label>
                                        <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" value="{{$nia->nomor_rekening}}" disabled>
                                        <small class="text-danger" id="msg_nomor_rekening"></small>
                                    </div>
                                    <div class="input-group input-group-static my-3">
                                        <label for="nomor_rekening">Nama Debitur</label>
                                        <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" value="{{$nia->anggota->namadepan}}" disabled>
                                        <small class="text-danger" id="msg_nomor_rekening"></small>
                                    </div>
                                    <div class="input-group input-group-static my-3">
                                        <label for="nomor_rekening">NIK</label>
                                        <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" value="{{$nia->anggota->nik}}" disabled>
                                        <small class="text-danger" id="msg_nomor_rekening"></small>
                                    </div>
                                    <div class="input-group input-group-static my-3">
                                        <label for="nomor_rekening">TRANSAKSI SIMPANAN</label>
                                    </div>
                                    <div class="input-group input-group-static my-3">
                                        <label for="tgl_buka_rekening">Tgl Transaksi</label>
                                        <input autocomplete="off" type="text" name="tgl_buka_rekening" id="tgl_buka_rekening" class="form-control date" value="{{ date('d/m/Y') }}">
                                        <small class="text-danger" id="msg_tgl_buka_rekening"></small>
                                    </div>
                                    <div class="input-group input-group-static my-3">
                                        <label for="nomor_rekening">Jenis Mutasi</label>
                           
                            <div class="row">
					<div class="col-xs-1">
						<div class="radio radio-success">
							<input type="radio" name="radio1" id="radio1" value="option1">
							<label for="radio1">Setor Tunai</label>
						</div>
					</div>
					<div class="col-xs-1">
						<div class="radio radio-danger">
							<input type="radio" name="radio1" id="radio2" value="option2">
							<label for="radio2">Tarik Tunai</label>
						</div>
					</div>
				</div>
                                        <small class="text-danger" id="msg_nomor_rekening"></small>
                                    </div>
                                    <div class="input-group input-group-static my-3">
                                        <label for="nomor_rekening">Jumlah (Rp.)</label>
                                        <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" value="">
                                        <small class="text-danger" id="msg_nomor_rekening"></small>
                                    </div>
                                    
                    <button class="btn btn-primary btn-sm float-end ms-2"
                        onclick="window.open('/cetak_keterangan_lunas/" type="button">
                        Simpan Transaksi
                    </button>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body pb-2">
                                        <div class="table-responsive">
                                            <table class="table table-striped align-items-center mb-0" width="100%">
                                                <thead>
                                                    <tr class="bg-dark text-white">
                                                        <th>#</th>
                                                        <th>Tgl transaksi</th>
                                                        <th>Keterangan</th>
                                                        <th>KD.TRX</th>
                                                        <th>Debit (Tarik)</th>
                                                        <th>Kredit (Setor)</th>
                                                        <th>Saldo</th>
                                                        <th>P</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <td colspan=9><center>sedang dalam proses</td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body p-2">
        <a href="/simpanan" class="btn btn-info btn-sm float-end mb-0">Kembali</a>
    </div>
</div>
</div>
<form action="/database/penduduk/{{ $nia->nik }}/blokir" method="post" id="Blokir">
    @csrf
    @php
    $status = '0';
    if ($nia->status == '0') {
    $status = '1';
    }
    @endphp
    <input type="hidden" name="status" id="status" value="{{ $status }}">
</form>
@endsection
@section('script')
<script>
new Choices($('#desa')[0], {
    shouldSort: false,
    fuseOptions: {
        threshold: 0.1,
        distance: 1000
    }
})
new Choices($('#jenis_kelamin')[0], {
    shouldSort: false,
    fuseOptions: {
        threshold: 0.1,
        distance: 1000
    }
})
new Choices($('#hubungan')[0], {
    shouldSort: false,
    fuseOptions: {
        threshold: 0.1,
        distance: 1000
    }
})

$(".date").flatpickr({
    dateFormat: "d/m/Y"
})

$(document).on('click', '#SimpanPenduduk', function(e) {
    e.preventDefault()
    $('small').html('')

    var form = $('#Penduduk')
    $.ajax({
        type: 'post',
        url: form.attr('action'),
        data: form.serialize(),
        success: function(result) {
            Swal.fire('Berhasil', result.msg, 'success')
        },
        error: function(result) {
            const respons = result.responseJSON;

            Swal.fire('Error', 'Cek kembali input yang anda masukkan', 'error')
            $.map(respons, function(res, key) {
                $('#' + key).parent('.input-group.input-group-static').addClass(
                    'is-invalid')
                $('#msg_' + key).html(res)
            })
        }
    })
})

$(document).on('click', '#BlokirPenduduk', function(e) {
    e.preventDefault()
    let blokir = $('#Blokir #status').val()
    let title = 'Blokir Penduduk?'
    let text = 'Dengan klik Ya maka penduduk ini tidak akan bisa mengajukan pinjaman lagi. Yakin?'
    if (blokir != '0') {
        title = 'Lepaskan Blokiran?'
        text = 'Dengan klik Ya maka penduduk ini akan dilepas dari blokirannya. Yakin lepaskan?'
    }

    Swal.fire({
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((res) => {
        if (res.isConfirmed) {
            var form = $('#Blokir')
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: result.msg,
                            icon: 'success',
                        }).then(() => {
                            window.location.reload();
                        })
                    }
                }
            })
        }
    })
})

$(document).on('click', '.blockquote', function(e) {
    e.preventDefault()

    var link = $(this).attr('data-link')
    window.location.href = link
})
</script>
@endsection
