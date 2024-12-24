@php
    use App\Utils\Tanggal;

    $title_form = [
        1 => 'Kelembagaan',
        2 => 'Dana Sosial',
        3 => 'Bonus UPK',
        4 => 'Lain-lain',
    ];
@endphp

@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($success)
                <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                    <span class="alert-icon align-middle">
                        <span class="material-icons text-md">
                            thumb_up_off_alt
                        </span>
                    </span>
                    <span class="alert-text">
                        <strong>Tutup Buku Tahun {{ $tahun }}</strong> berhasil.
                        Anda dapat melanjutkan proses pembagian laba di lain hari,
                        klik <a href="/transaksi/tutup_buku" class="fw-bold text-white">Disini</a>
                        untuk kembali.
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h4 class="font-weight-normal mt-3">
                <div class="row">
                    <span class="col-sm-6"> &nbsp; Surplus/Devisit Tahun {{ Tanggal::tahun($tgl_kondisi) }}</span>
                    <span class="col-sm-6 text-end">Rp. {{ number_format($surplus, 2) }}</span>
                </div>
            </h4>

            <form action="/transaksi/simpan_laba" method="post" id="SimpanAlokasiLaba">
                @csrf
                <input type="hidden" name="tgl_kondisi" id="tgl_kondisi" value="{{ $tgl_kondisi }}">
                <input type="hidden" name="tgl_mad" id="tgl_mad">
                <div class="row">
                    <input type="hidden" name="surplus" id="surplus" value="{{ $surplus }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive mb-3">
                                <table class="table table-striped midle">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th width="50%">
                                                <span class="text-sm">Cadangan Resiko</span>
                                            </th>
                                            <th width="50%">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-sm">Jumlah</span>
                                                    <span class="text-sm">
                                                        Rp. <span data-id="total_cadangan_resiko">
                                                            {{ number_format($surplus, 2) }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="total_cadangan_resiko" id="total_cadangan_resiko"
                                            class="form-control total form-control-sm text-end" value="0">
                                        @forelse ($cadangan_resiko as $cr)
                                            <tr>
                                                <td>{{ $cr->nama_akun }}</td>
                                                <td>
                                                    <div class="input-group input-group-outline my-0">
                                                        <input type="text" name="cadangan_resiko[{{ $cr->kode_akun }}]"
                                                            id="{{ $cr->kode_akun }}"
                                                            class="form-control nominal cadangan_resiko form-control-sm text-end"
                                                            value="0.00">
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <input type="hiden" name="cadangan_resiko[0]" id="0"
                                                class="form-control nominal cadangan_resiko form-control-sm text-end"
                                                value="0.00">
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="font-weight-normal">
                                Alokasi Surplus Bersih
                            </h4>

                            <div class="table-responsive mb-3">
                                <table class="table table-striped midle">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th width="50%">
                                                <span class="text-sm">
                                                    Alokasi Surplus Bersih
                                                </span>
                                            </th>
                                            <th width="50%">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-sm">Jumlah</span>
                                                    <span class="text-sm">
                                                        Rp. <span data-id="total_surplus_bersih">0,00</span>
                                                    </span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembagian_surplus as $saldo)
                                            <tr>
                                                <td>{{ $saldo->nama_akun }}</td>
                                                <td>
                                                    <div class="input-group input-group-outline my-0">
                                                        <input type="text"
                                                            name="surplus_bersih[{{ $saldo->kode_akun }}]"
                                                            id="surplus_bersih_{{ $saldo->kode_akun }}"
                                                            class="form-control nominal surplus_bersih form-control-sm text-end"
                                                            value="0.00">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <input type="hidden" class="total" name="total_surplus_bersih"
                                            id="total_surplus_bersih">
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive mb-3">
                                <table class="table table-striped midle">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th width="50%">
                                                <span class="text-sm">Laba Ditahan</span>
                                            </th>
                                            <th width="50%">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-sm">Jumlah</span>
                                                    <span class="text-sm">
                                                        Rp. <span data-id="total_laba_ditahan">
                                                            {{ number_format($surplus, 2) }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="total_laba_ditahan" id="total_laba_ditahan"
                                            class="form-control form-control-sm text-end" value="{{ $surplus }}">
                                        <tr>
                                            <td>Pemupukan modal</td>
                                            <td>
                                                <div class="input-group input-group-outline my-0">
                                                    <input type="text" name="laba_ditahan[3.2.01.01]" id="laba_ditahan"
                                                        class="form-control laba_ditahan form-control-sm text-end"
                                                        value="{{ number_format($surplus, 2) }}" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" id="btnSimpanLaba" class="btn btn-github btn-sm">
                                    Simpan Alokasi Laba
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".nominal").maskMoney({
            allowNegative: true
        });

        var formatter = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        })

        $(document).on('change', '.cadangan_resiko', function(e) {
            var total = 0;
            $('.cadangan_resiko').map(function() {
                var value = $(this).val()
                if (value == '') {
                    value = 0
                } else {
                    value = value.split(',').join('')
                    value = value.split('.00').join('')
                }

                value = parseFloat(value)

                total += value
            })

            $('#total_cadangan_resiko').val(formatter.format(total)).trigger('change')
            $('[data-id=total_cadangan_resiko]').html(formatter.format(total))
        })

        $(document).on('change', '.surplus_bersih', function(e) {
            var total = 0;
            $('.surplus_bersih').map(function() {
                var value = $(this).val()
                if (value == '') {
                    value = 0
                } else {
                    value = value.split(',').join('')
                    value = value.split('.00').join('')
                }

                value = parseFloat(value)

                total += value
            })

            $('#total_surplus_bersih').val(formatter.format(total)).trigger('change')
            $('[data-id=total_surplus_bersih]').html(formatter.format(total))
        })

        $(document).on('change', '.total', function(e) {
            var total = 0;
            $('.total').map(function() {
                var value = $(this).val()
                if (value == '') {
                    value = 0
                } else {
                    value = value.split(',').join('')
                    value = value.split('.00').join('')
                }

                value = parseFloat(value)

                total += value
            })

            var surplus = $('#surplus').val()
            surplus = surplus.split(',').join('')
            surplus = surplus.split('.00').join('')

            var sisa_surplus = surplus - total

            $('#total_laba_ditahan').val(formatter.format(sisa_surplus))
            $('#laba_ditahan').val(formatter.format(sisa_surplus))
            $('[data-id=total_laba_ditahan]').html(formatter.format(sisa_surplus))
        })

        $(document).on('click', '#btnSimpanLaba', function(e) {
            e.preventDefault()

            Swal.fire({
                title: 'Masukkan Tanggal MAD',
                html: `<div class="input-group input-group-static"><input autocomplete="off" type="text" name="tanggal" id="tanggal" class="form-control date" value="{{ date('d/m/Y') }}"></div>`,
                showDenyButton: true,
                confirmButtonText: "Simpan",
                denyButtonText: "Batal",
                stopKeydownPropagation: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#tgl_mad').val($('#tanggal').val())

                    var loading = Swal.fire({
                        title: "Mohon Menunggu..",
                        html: "Menyimpan Alokasi Pembagian Laba",
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    })

                    var form = $('#SimpanAlokasiLaba')
                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(result) {
                            if (result.success) {
                                Swal.fire('Selamat', result.msg, 'success').then(() => {
                                    window.location.href = '/transaksi/tutup_buku'
                                })
                            }
                        }
                    })
                }
            });

            flatpickr("#tanggal", {
                dateFormat: "d/m/Y",
                static: true
            })
        })
    </script>
@endsection
