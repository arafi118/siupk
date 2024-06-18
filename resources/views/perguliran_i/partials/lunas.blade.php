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
if ($saldo_pokok <= 0) {
    $saldo_pokok = 0;
    $keterangan1 = 'Lunas';
}
if ($saldo_jasa <= 0) {
    $saldo_jasa = 0;
    $keterangan2 = 'Lunas';
} @endphp
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card"><br>
                                <div class="page-title-heading">&nbsp;&nbsp;&nbsp;
                                    <div>
                                        <h5 class="mb-1"><b> Atas Nama {{ $perguliran_i->anggota->namadepan }} Loan ID. {{ $perguliran_i->id }}
                                            {{ $perguliran_i->jpp->nama_jpp }} {{$kec->nama_lembaga_sort}}</b></h5>
                                      
                                        <div class="page-title-subheading">
                                            <span class="badge mb-2 me-2 btn badge-light-reed">{{ $perguliran_i->anggota->nik }}</span>
                                            <span
                                                class="badge mb-2 me-2 btn badge-light-reed">{{ $perguliran_i->anggota->alamat }}</span>
                                            <span class="badge mb-2 me-2 btn badge-light-reed">
                                                {{ $perguliran_i->anggota->d->sebutan_desa->sebutan_desa }}
                                                {{ $perguliran_i->anggota->d->nama_desa }}
                                            </span>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
                     
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="main-card mb-3 card">
                            
                            <div class="card-body"><h5 class="card-title">Dengan mempertimbangkan Standar Operasional Prosedur (SOP) yang berlaku, dengan ini Saya selaku  {{ $kec->sebutan_level_1 }},{{$kec->nama_lembaga_sort}}
                                menyatakan dengan sebenar-benarnya bahwa : </h5>
                                <table class="table p-0 mb-3">
                                    <tr>
                                        <td>Nama Pemanfaat</td>
                                        <td>: {{$perguliran_i->anggota->namadepan}}</td>
                                        <td>Alokasi</td>
                                        <td>: {{ number_format($perguliran_i->alokasi) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Desa</td>
                                        <td>: {{ $perguliran_i->anggota->d->nama_desa }}</td>
                                        <td>Jasa</td>
                                        <td>: {{ $perguliran_i->pros_jasa }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Pinjaman</td>
                                        <td>: {{ $perguliran_i->jpp->nama_jpp }}</td>
                                        <td>Sistem</td>
                                        <td>: {{ $perguliran_i->jangka }} bulan / {{ $perguliran_i->sis_pokok->nama_sistem }}</td>
                                    </tr>
                                </table>  
                            </div>
                            <div class="card-body"><h5 class="card-title"> REKAPITULASI ANGSURAN </h5>
                                <table class="mb-0 table table-striped">
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
                                         <div class="form-check">
                                            <input id="checkboxLunaskan" type="checkbox" value="checked" class="form-check-input custom-checkbox"/>
                                            <label class="form-check-label" for="checkboxLunaskan">
                                                            Pinjaman tersebut diatas telah kami nyatakan
                                                LUNAS dan Surat Perjanjian Kredit (SPK) nomor {{ $perguliran_i->spk_no }} tanggal
                                                {{ Tanggal::tglLatin($perguliran_i->tgl_cair) }}
                                                dinyatakan selesai
                                                beserta
                                                seluruh hak dan kewajibannya.
                                                        </label>
                                                    </div>
                                        <div class="d-flex justify-content-end" style="gap: .5em;">
                                            <button class="btn btn-warning btn-sm"
                                                onclick="window.open('/cetak_keterangan_lunas_i/{{ $perguliran_i->id }}')" type="button">
                                                <i class="fa fa-print"></i> Cetak Keterangan Pelunasan
                                            </button>
                                            @if ($is_dir)
                                                <button class="btn btn-danger btn-sm" type="button" id="TombolLunaskan" disabled>
                                                    <i class="fa fa-gavel"></i> Validasi Lunas
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/perguliran_i/{{ $perguliran_i->id }}" method="post" id="FormPelunasan">
                    @csrf
                    @method('PUT')
            
                    <input type="hidden" name="status" id="status" value="L">
                </form>
            <div class="main-card mb-3 card">
                <div class="card-body">
                        <a href="/perguliran_i?status=L" class="btn-shadow me-3 btn btn-primary"
                            style="float: right;">
                            <i class="fa fa-reply-all"></i>&nbsp;<b>KEMBALI</b></a>
                </div>
            </div>
            <br><br><br>
        </div> 
@endsection

@section('script')
    <script>
        $(document).on('click', '.form-check', function(e) {
            var checkbox = $('#checkboxLunaskan')

            if (checkbox[0].checked == true) {
                $('#TombolLunaskan').removeAttr('disabled')
            } else {
                $('#TombolLunaskan').attr('disabled', true)
            }
        })

        $(document).on('click', '#TombolLunaskan', function(e) {
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
                        success: function(result) {
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
