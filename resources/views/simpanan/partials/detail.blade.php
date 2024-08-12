@extends('layouts.base')
@section('content')
<div class="app-main__inner">       
    <div class="tab-pane fade show active" id="ProfilDebitur" role="tabpanel" aria-labelledby="ProfilDebitur">
        <div class="main-card mb-3 card">
            <div class="g-0 row">
                <div class="col-md-6">
                    <div class="widget-content">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Nasabah {{ $nia->anggota->namadepan }} CIF. {{$nia->id}} 
                                    ({{ $nia->js->nama_js }})</div>
                                <div class="widget-subheading">
                                    <span class="badge bg-{{ $nia->sts->warna_status }}">{{ $nia->anggota->nia }}</span>
                                    <span class="badge bg-{{ $nia->sts->warna_status }}">{{ $nia->anggota->alamat_anggota }}</span>
                                    <span class="badge bg-{{ $nia->sts->warna_status }}">
                                        {{ $nia->anggota->d->sebutan_desa->sebutan_desa }}
                                        {{ $nia->anggota->d->nama_desa }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-content">
                        <div class="widget-content-wrapper">
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
            </div>
        </div>
        <div class="tab-content">  
            <div class="row">
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form class="">
                                <div class="position-relative mb-3">
                                    <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                                    <input autocomplete="off" type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" value="{{$nia->nomor_rekening}}" disabled>
                                    <small class="text-danger" id="msg_nomor_rekening"></small>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="nama_debitur" class="form-label">Nama Debitur</label>
                                    <input autocomplete="off" type="text" name="nama_debitur" id="nama_debitur" class="form-control" value="{{$nia->anggota->namadepan}}" disabled>
                                    <small class="text-danger" id="msg_nama_debitur"></small>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input autocomplete="off" type="text" name="nik" id="nik" class="form-control" value="{{$nia->anggota->nik}}" disabled>
                                    <small class="text-danger" id="msg_nik"></small>
                                </div>
                                
                                <div class="input-group input-group-static my-3">
                                    <label>TRANSAKSI SIMPANAN</label>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="tgl_transaksi" class="form-label">Tgl Transaksi</label>
                                    <input autocomplete="off" type="text" name="tgl_transaksi" id="tgl_transaksi" class="form-control date" value="{{ date('d/m/Y') }}">
                                    <small class="text-danger" id="msg_tgl_transaksi"></small>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="tarik_tunai" class="form-label">Tarik Tunai</label>
                                    <div class="row">
                                        <div class="col-xs-1">
                                            <div class="radio radio-success">
                                                <input type="radio" name="jenis_mutasi" id="setor_tunai" value="1">
                                                <label for="setor_tunai">Setor Tunai</label>
                                            </div>
                                        </div>
                                        <div class="col-xs-1">
                                            <div class="radio radio-danger">
                                                <input type="radio" name="jenis_mutasi" id="tarik_tunai" value="2">
                                                <label for="">Tarik Tunai</label>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-danger" id="msg_jenis_mutasi"></small>
                                </div>
                                    <div class="position-relative mb-3">
                                    <label for="jumlah" class="form-label">Jumlah (Rp.)</label>
                                    <input autocomplete="off" type="text" name="jumlah" id="jumlah" class="form-control" value="">
                                    <small class="text-danger" id="msg_jumlah"></small>
                                </div>
                                
                                    <button id="simpanTransaksi" class="btn btn-primary btn-sm float-end ms-2" type="button">
                                    Simpan Transaksi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <style>
                                .forminline {
                                    display: flex;
                                    gap: 10px;
                                    align-items: center;
                                    display: flex;
                                    justify-content: flex-end; /* Align items to the right */
                                
                                }
                                .formcontrol {
                                    width: 150px; /* Set the same width for both select elements */
                                    padding-left: 10px;
                                    padding-right: 20px;
                                    appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    border: 1px solid #ccc;
                                }
                            </style>
                            <form class="forminline">
                                <select id="bulan" name="bulan" class="js-example-basic-single formcontrol">
                                    @foreach(range(1, 12) as $bulan)
                                        <option value="{{ $bulan }}" {{ date('n') == $bulan ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $bulan, 1)) }}
                                        </option>
                                    @endforeach
                                </select>
                                <select id="tahun" name="tahun" class="js-example-basic-single formcontrol">
                                    @foreach(range(date('Y')-5, date('Y')+5) as $tahun)
                                        <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>                          
                        </div>
                        <div class="divider mt-0" style="margin-bottom: 10px;"></div>
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
@endsection


@section('script')
<script>
    $('.js-example-basic-single').select2({
      theme: 'bootstrap-5'
    });

    $("#jumlah").maskMoney({
            allowNegative: true
        });

    $('.date').datepicker({
        dateFormat: 'dd/mm/yy'
    });
$(document).ready(function() {
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1;
    var currentYear = currentDate.getFullYear();

    $('#bulan').val(currentMonth);
    $('#tahun').val(currentYear);

    tableTransaksi(currentMonth, currentYear);

    function tableTransaksi(bulan, tahun) {
        $.get('/simpanan/get-transaksi', {
            cif: '{{ $nia->id }}',
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

    $('#simpanTransaksi').click(function() {
        var jenisMutasi = $('input[name="jenis_mutasi"]:checked').val();
        var tglTransaksi = $('#tgl_transaksi').val();
        var jumlah = $('#jumlah').val();
        var nomorRekening = $('#nomor_rekening').val();
        var namaDebitur = $('#nama_debitur').val();
        var nia = '{{ $nia->id }}';

        if (!jenisMutasi || !tglTransaksi || !jumlah) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Mohon lengkapi semua field.',
            });
            return;
        }

        Swal.fire({
            title: 'Mohon menunggu',
            text: 'Sedang memproses transaksi...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            },
        });

        $.ajax({
            url: '/simpanan/simpan-transaksi',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                jenis_mutasi: jenisMutasi,
                tgl_transaksi: tglTransaksi,
                jumlah: jumlah,
                nomor_rekening: nomorRekening,
                nama_debitur: namaDebitur,
                nia: nia
            },
            success: function(response) {
                if (response.success) {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Transaksi ' + (jenisMutasi == '1' ? 'setor' : 'tarik') + ' berhasil disimpan',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            refreshTransaksiContainer();
                            resetForm();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal menyimpan transaksi: ' + response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan: ' + error,
                });
            }
        });
    });

    function refreshTransaksiContainer() {
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();
        tableTransaksi(bulan, tahun);
    }

    function resetForm() {
        $('input[name="jenis_mutasi"]').prop('checked', false);
        $('#tgl_transaksi').val('');
        $('#jumlah').val('');
    }
});
</script>
@endsection