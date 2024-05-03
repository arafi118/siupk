@php
$is_dir = false;
if (auth()->user()->jabatan == '1' && auth()->user()->level == '1') {
$is_dir = true;
}
@endphp

@extends('layouts.base')

@section('content')
@php
    $saldo_pokok = $ra->target_pokok - $real->sum_pokok;
    $saldo_jasa = $ra->target_jasa - $real->sum_jasa;

    $keterangan1 = 'Belum Lunas';
    $keterangan2 = 'Belum Lunas';
    
    if ($saldo_pokok == 0) {
        $keterangan1 = 'Lunas';
    }
    
    if ($saldo_pokok < 0) {
        $keterangan1 = 'Lunas sebelum jatuh tempo';
    }
    if ($saldo_jasa == 0) {
        $keterangan2 = 'Lunas';
    }
    if ($saldo_jasa < 0) {
        $keterangan2 = 'Lunas (Pembayaran lebih dari target)';
    }
 @endphp <div
    class="card mb-3">
    <div class="card-body p-3">
        <h5 class="mb-1">
            Atas Nama {{ $perguliran_i->anggota->namadepan }} Loan ID. {{ $perguliran_i->id }}
            {{ $perguliran_i->jpp->nama_jpp }} {{$kec->nama_lembaga_sort}}
        </h5>
        <p class="mb-0">
            <span class="badge badge-{{ $perguliran_i->sts->warna_status }}">{{ $perguliran_i->anggota->nik }}</span>
            <span class="badge badge-{{ $perguliran_i->sts->warna_status }}">{{ $perguliran_i->anggota->alamat }}</span>
            <span class="badge badge-{{ $perguliran_i->sts->warna_status }}">
                {{ $perguliran_i->anggota->d->sebutan_desa->sebutan_desa }}
                {{ $perguliran_i->anggota->d->nama_desa }}
            </span>
        </p>
    </div>
    </div>

    <div class="card">
        <div class="card-body text-sm">
            Dengan mempertimbangkan Standar Operasional Prosedur (SOP) yang berlaku, dengan ini Saya selaku
            {{ $kec->sebutan_level_1 }},{{$kec->nama_lembaga_sort}}
            menyatakan dengan sebenar-benarnya bahwa :
            <table class="table p-0 mb-3">
                <tr>
                    <td>Nama Pemanfaat</td>
                    <td>: {{$perguliran_i->anggota->namadepan}}</td>
                    <td>Alokasi</td>
                    <td>{{ number_format($perguliran_i->alokasi) }}</td>
                </tr>
                <tr>
                    <td>Desa</td>
                    <td>: {{ $perguliran_i->anggota->d->nama_desa }}</td>
                    <td>Jasa</td>
                    <td>{{ $perguliran_i->pros_jasa }}%</td>
                </tr>
                <tr>
                    <td>Jenis Pinjaman</td>
                    <td>: {{ $perguliran_i->jpp->nama_jpp }}</td>
                    <td>Sistem</td>
                    <td>{{ $perguliran_i->jangka }} bulan / {{ $perguliran_i->sis_pokok->nama_sistem }}</td>
                </tr>
            </table>

            REKAPITULASI ANGSURAN
            <table class="table f-12">
                <thead class="bg-light">
                    <tr>
                        <th>&nbsp;</th>
                        <th>Target</th>
                        <th>Realisasi</th>
                        <th>Saldo</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pokok</td>
                        <td>{{ number_format($ra->target_pokok) }}</td>
                        <td>{{ number_format($real->sum_pokok) }}</td>
                        <td>{{ number_format($saldo_pokok) }}</td>
                        <td>{{ $keterangan1 }}</td>
                    </tr>
                    <tr>
                        <td>Jasa</td>
                        <td>{{ number_format($ra->target_jasa) }}</td>
                        <td>{{ number_format($real->sum_jasa) }}</td>
                        <td>{{ number_format($saldo_jasa) }}</td>
                        <td>{{ $keterangan2 }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="row mt-2">
                <div class="col-sm-4">
                    <img src="/assets/img/lunas.png">
                </div>
                <div class="col-sm-8">
                    <form action="/perguliran_i/dokumen?status=P" target="_blank" method="post">
                        @csrf

                        <input type="hidden" name="id" value="{{ $perguliran_i->id }}">
                        <div class="checkbox">
                            <input id="checkboxLunaskan" type="checkbox" class="d-none">
                            <label for="checkboxLunaskan">Pinjaman tersebut diatas telah kami nyatakan
                                LUNAS dan Surat Perjanjian Kredit (SPK) nomor {{ $perguliran_i->spk_no }} tanggal
                                {{ Tanggal::tglLatin($perguliran_i->tgl_cair) }}
                                dinyatakan selesai
                                beserta
                                seluruh hak dan kewajibannya.</label>
                        </div>
                        <div class="d-flex justify-content-end" style="gap: .5em;">
                            <button class="btn btn-warning btn-sm"
                                onclick="window.open('/cetak_keterangan_lunas_i/{{ $perguliran_i->id }}')"
                                type="button">
                                <i class="fa fa-print"></i> Cetak Keterangan Pelunasan
                            </button>

                            <button class="btn btn-dark btn-sm" name="report" value="Pengembalian#pdf" type="submit">
                                <i class="fa fa-print"></i> Bukti Pengambilan Jaminan
                            </button>

                            @if ($is_dir)
                            <button class="btn btn-danger btn-sm" type="button" id="TombolLunaskan" disabled>
                                <i class="fa fa-gavel"></i> Validasi Lunas
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <form action="/perguliran_i/{{ $perguliran_i->id }}" method="post" id="FormPelunasan">
        @csrf
        @method('PUT')

        <input type="hidden" name="status" id="status" value="L">
    </form>

    <div class="card mt-3">
        <div class="card-body p-2">
            <a href="/perguliran_i?status=L" class="btn btn-info float-end btn-sm mb-0">Kembali</a>
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        $(document).on('click', '.checkbox', function (e) {
            var checkbox = $('#checkboxLunaskan')

            if (checkbox[0].checked == true) {
                $('#TombolLunaskan').removeAttr('disabled')
            } else {
                $('#TombolLunaskan').attr('disabled', true)
            }
        })

        $(document).on('click', '#TombolLunaskan', function (e) {
            e.preventDefault()

            Swal.fire({
                title: 'Peringatan',
                text: 'Anda akan melakukan validasi pelunasan untuk kelompok {{ $perguliran_i->anggota->nama_kelompok }} dengan Loan ID. {{ $perguliran_i->id }}. Setelah klik tombol Lunaskan data tidak dapat diubah kembali',
                showCancelButton: true,
                confirmButtonText: 'Lunaskan',
                cancelButtonText: 'Batal',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('#FormPelunasan')

                    $.ajax({
                        type: 'post',
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function (result) {
                            Swal.fire('Berhasil', result.msg, 'success').then(() => {
                                window.location.href = '/perguliran_i'
                            })
                        }
                    })
                }
            })
        })

    </script>
    @endsection
