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
                                <button class="btn btn-info btn-sm float-end ms-2" type="button" onclick="window.location.href='/simpanan'">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </button>
                                <button class="btn btn-warning btn-sm float-end ms-2" onclick="window.open('/cetak_kop/{{ $nia->id }}')" type="button">
                                    <i class="fa fa-print"></i> Cetak KOP Buku
                                </button>
                                <button class="btn btn-warning btn-sm float-end ms-2" onclick="window.open('/cetak_koran/{{ $nia->id }}')" type="button">
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
                                    <button class="btn btn-primary btn-sm float-end ms-2" onclick="window.open('/cetak_keterangan_lunas/" type="button">
                                        Simpan Transaksi
                                    </button>
                                </div>





                                <div class="col-md-9">
                                    <div class="row mb-3">
                                        <div class="col-md-6">&nbsp;</div>
                                        <div class="col-md-3">
                                            <div style="position: relative;">
                                                <select id="bulan" name="bulan" class="form-control select2" style="padding-left: 10px; padding-right: 30px; appearance: none; -webkit-appearance: none; -moz-appearance: none; border: 1px solid #ccc;">
                                                    @foreach(range(1, 12) as $bulan)
                                                    <option value="{{ $bulan }}" {{ date('n') == $bulan ? 'selected' : '' }}>
                                                        {{ date('F', mktime(0, 0, 0, $bulan, 1)) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                                                    ▼
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div style="position: relative;">
                                                <select id="tahun" name="tahun" class="form-control select2" style="padding-left: 10px; padding-right: 30px; appearance: none; -webkit-appearance: none; -moz-appearance: none; border: 1px solid #ccc;">
                                                    @foreach(range(date('Y')-5, date('Y')+5) as $tahun)
                                                    <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                                                    ▼
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pb-2">
                                        <div id="transaksi-container">
                                            <!-- Tabel transaksi akan dimuat di sini -->
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

@endsection
@section('script')
<script>
$(".date").flatpickr({
    dateFormat: "d/m/Y"
})
$(document).ready(function() {
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1; 
    var currentYear = currentDate.getFullYear();

    $('#bulan').val(currentMonth);
    $('#tahun').val(currentYear);

    tableTransaksi(currentMonth, currentYear);

    function tableTransaksi(bulan, tahun) {
        $.get('/simpanan/get-transaksi', {
            nia: '{{ $nia->nia }}',
            bulan: bulan,
            tahun: tahun
        }, function(result) {
            $('#transaksi-container').html(result);
        }).fail(function(xhr, status, error) {
            console.error("Error loading transactions:", error);
            $('#transaksi-container').html('<p>Error loading transactions. Please try again.</p>');
        });
    }

    $('#bulan, #tahun').change(function() {
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();
        tableTransaksi(bulan, tahun);
    });
});
</script>
@endsection
