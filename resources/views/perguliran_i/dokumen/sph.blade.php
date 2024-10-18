@php
    use App\Utils\Tanggal;
    use Illuminate\Support\Facades\DB;

    $jaminan  = json_decode($pinkel->jaminan, true);
    
    use Carbon\Carbon;
    Carbon::setLocale('id');
    $waktu = date('H:i');
    $tempat = 'Kantor lkm';
    $wt_cair = explode('_', $pinkel->wt_cair);
    if (count($wt_cair) == 1) {
        $waktu = $wt_cair[0];
    }
    if (count($wt_cair) == 2) {
        $waktu = $wt_cair[0];
        $tempat = $wt_cair[1] ?? ' . . . . . . . ';
    }
    $redaksi_spk = str_replace(' <ol> ', '', str_replace(' </ol> ', '', $kec->redaksi_spk));
    $redaksi_spk = str_replace(' <ul> ', '', str_replace(' </ul> ', '', $redaksi_spk));

@endphp
@extends('perguliran_i.dokumen.layout.base')
@section('content')
    <style>
        /* styles.css */
        .centered-text {
            font-size: 11px;   
            text-align: center;
            text-align: justify;
        }
    </style>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 14px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 16px;">
                    <b> SURAT PERJANJIAN UTANG PIUTANG </b>
                </div>
                <div style="font-size: 12px;">
                    Nomor: {{ $pinkel->spk_no }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"> </td>
        </tr>
    </table>
    <div class="centered-text">
        Pada hari ini <b>{{ Tanggal::namaHari($pinkel->tgl_cair) }}</b> tanggal <b>{{ $keuangan->terbilang(Tanggal::hari($pinkel->tgl_cair)) }}</b>  bulan <b>{{ Tanggal::namaBulan($pinkel->tgl_cair) }}</b>
        tahun <b>{{ $keuangan->terbilang(Tanggal::tahun($pinkel->tgl_cair)) }}</b>, 
        kami yang bertandatangan di bawah ini setuju membuat Surat Perjanjian Utang Piutang, yaitu :
    </div>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="5"> &nbsp; </td>
            <td width="90"> Nama Lengkap </td>
            <td width="10" align="center"> : </td>
            <td> {{ $pinkel->anggota->namadepan }} </td>
        </tr>
        <tr>
            <td width="5"> &nbsp; </td>
            <td> Jenis kelamin </td>
            <td align="center"> : </td>
            <td> {{ $pinkel->anggota->jk }} </td>
        </tr>
        <tr>
            <td width="5"> &nbsp; </td>
            <td> Tempat, tangal lahir </td>
            <td align="center"> : </td>
            <td> {{ $pinkel->anggota->tempat_lahir }},
                {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_lahir)->format('d F Y') }}
            </td>
        </tr>
        <tr>
            <td width="5"> &nbsp; </td>
            <td> NIK </td>
            <td align="center"> : </td>
            <td> {{ $pinkel->anggota->nik }} </td>
        </tr>
        <tr>
            <td width="5"> &nbsp; </td>
            <td> Berkedudukan di </td>
            <td align="center"> : </td>
            <td> {{ $pinkel->anggota->alamat }} </td>
        </tr>
    </table>
    <div class="centered-text">
        Untuk selanjutnya disebut sebagai <b>PIHAK PERTAMA</b>, dan :
    </div>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="5"> &nbsp; </td>
            <td width="90"> Nama Lengkap </td>
            <td width="10" align="center"> : </td>
            <td> {{ $dir->namadepan }} {{ $dir->namabelakang }} </td>
        </tr>
        <tr>
            <td width="5"> &nbsp; </td>
            <td> Jabatan </td>
            <td align="center"> : </td>
            <td> {{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }} </td>
        </tr>
        <tr>
            <td width="5"> &nbsp; </td>
            <td> NIK </td>
            <td align="center"> : </td>
            <td> {{ $dir->nik }} </td>
        </tr>
        <tr>
            <td width="5"> &nbsp; </td>
            <td> Alamat </td>
            <td align="center"> : </td>
            <td> {{ $kec->alamat_kec }} </td>
        </tr>
    </table>
    <div class="centered-text">
        Untuk selanjutnya disebut sebagai <b>PIHAK KEDUA</b>
    </div>
    <div style="text-align: center;">
        <div class="centered-text">
            Dengan ini kedua belah pihak sepakat dan setuju untuk melaksanakan pinjam meminjam, 
            dengan ketentuan-ketentuan sebagaimana tercantum di bawah ini:
            <ol class="centered-text">
                <li>
                    Pihak Pertama telah menerima uang sebesar Rp.  {{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah) 
                     dari Pihak Kedua dimana uang tersebut adalah hutang atau pinjaman dari   {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }}  {{ $kec->nama_kec }}
                </li>
                <li>
                    Pihak Pertama berjanji akan mengangsur kepada Pihak Kedua selama {{ $pinkel->jangka }} bulan,
                    @php
                    $wajib_pokok = ($pinkel->alokasi / $pinkel->jangka);
                    $wajib_jasa = (($pinkel->pros_jasa * $pinkel->alokasi) / $pinkel->jangka) / 100;
                @endphp
                     dengan masing-masing angsuran pokok sebesar Rp. {{ number_format($wajib_pokok) }}- dan bunga 
                     sebesar Rp. {{ number_format($wajib_jasa) }}  .
                     Serta selambat-lambatnya akan dibayar lunas pada tanggal
                     @if ($tgl_terakhir)
                        {{ Tanggal::tglLatin($tgl_terakhir->jatuh_tempo) }}
                    @endif.
                </li>
                <li>
                    Pihak Pertama bersedia memberikan jaminan berupa 
                    @if ($jaminan['jenis_jaminan'] == '1')
                                Nomor Sertifikat: {{($jaminan['nomor_sertifikat']?? 0)}},
                                Nama jaminan: {{$jaminan['nama_pemilik']?? 0}},
                                Alamat : {{$jaminan['alamat']?? 0}} Luas: {{ $jaminan['luas']?? 0}} (m²),
                                Nilai Jual Tanah: {{ number_format($jaminan['nilai_jual_tanah']?? 0) }},
                    @elseif ($jaminan['jenis_jaminan'] == '2')
                                Nomor: {{($jaminan['nomor']?? 0)}},
                                Nama jaminan: {{$jaminan['jenis_kendaraan']?? 0}},
                                Nopol: {{$jaminan['nopol']?? 0}},
                                Nilai Jual Kendaraan: {{ number_format($jaminan['nilai_jual_kendaraan']?? 0) }},
                    @elseif ($jaminan['jenis_jaminan'] == '3')
                                Nomor: {{($jaminan['nomor']?? 0)}},
                                Nama Pegawai: {{$jaminan['nama_pegawai']?? 0}},
                                Nama Instansi Penerbit: {{$jaminan['nama_kuitansi_penerbit']?? 0}},
                    @elseif ($jaminan['jenis_jaminan'] == '4')
                                Nomor Jaminan: {{($jaminan['nama_jaminan']?? 0)}},
                                Keterangan: {{$jaminan['keterangan']?? 0}},
                                Nilai Jaminan: {{ number_format($jaminan['nilai_jaminan']?? 0) }},
                    @else                    
                                Nomor Sertifikat: {{($jaminan['nomor_sertifikat']?? 0)}},
                                Nama jaminan: {{$jaminan['nama_pemilik']?? 0}},
                                Alamat : {{$jaminan['alamat']?? 0}} Luas: {{ $jaminan['luas']?? 0}} (m²),
                                Nilai Jual Tanah: {{ number_format($jaminan['nilai_jual_tanah']?? 0) }},
                    @endif
                    atas Nama {{ $pinkel->anggota->namadepan }} Yang nilainya dianggap sama dengan uang pinjaman dari Pihak Kedua.
                    Apabila kemudian hari ternyata {{ $pinkel->anggota->namadepan }} tidak dapat membayar hutang tersebut sesuai dengan perjanjian ini,
                    maka Pihak Kedua memiliki hak penuh 
                    atas barang jaminan baik untuk dimiliki {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }} {{ $kec->nama_kec }} maupun dijual/dipindahtangankan kepada orang lain.
                </li>
                <li>
                    Dikenakan Denda 0.1% per bulan dari jumlah angsuran apabila ada keterlambatan membayar angsuran.
                </li>
                <li>
                    Akan dikenakan Pinalti apabila ada pelunasan pinjaman sebelum jangka waktu yang telah disepakati.
                </li>
                <li>
                    {{ str_replace('"', '', stripslashes(strip_tags($kec->redaksi_spk))) }}
                </li>
            </ol>
        </div>
    </div>
    <div style="text-align: center;">
        <div class="centered-text">
            Surat perjanjian ini dibuat dalam 2 (dua) rangkap dan bermaterai cukup dan memiliki kekuatan hukum yang sama,
             masing-masing surat untuk <b>Pihak Pertama</b> dan <b>Pihak Kedua</b>. Surat Perjanjian dibuat dan ditandatangani oleh kedua 
             belah pihak secara sadar dan tanpa tekanan dari pihak manapun di tempat dan waktu penandatanganan Surat Perjanjian ini.
        </div>
    </div>
    <div style="text-align: center;" style="font-size: 11px;">
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;" class="p0">
            <tr>
                <td style="padding: 0px !important;">
                    <table class="p0" border="0" width="100%" cellspacing="0" cellpadding="0"
                        style="font-size: 11px;">
                        <br>
                        <tr>
                            <td style="padding: 0px !important;">
                                <div class="centered-text">
                                    Demikian Surat Perjanjian Hutang ini dibuat bersama di hadapan saksi-saksi dalam keadaan sehat jasmani dan 
                                    rohani untuk dijadikan pegangan hukum bagi masing-masing pihak.
                                </div>
                            </td>
                        </tr>
                    </table> <br>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;" align="center">
                        <tr>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="20" align="center"> Pihak Kedua </td>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="70" align="center"> Pihak Pertama </td>
                        </tr> <br> <br> <br> <br> <br><br><br><br>
                        <tr>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="20" align="center">{{ $dir->namadepan }} {{ $dir->namabelakang }}<br> Direktur Utama LKM
                            </td>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="70" align="center">{{ $pinkel->anggota->namadepan }} <br>
                                Debitur </td>
                        </tr> <br>
                        <tr>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="20" align="center"> SAKSI PIHAK KEDUA, </td>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="70" align="center"> SAKSI PIHAK PERTAMA, </td>
                        </tr> <br> <br> <br> <br> <br><br>
                        <tr>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="20" align="center">________________________________</td>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="70" align="center"> __________________________________ </td>
                        </tr>
                    </table>
                    {{-- <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;" class="p">
                        <tr>
                            <td>
                                {!! $ttd !!}
                            </td>
                        </tr>
                    </table> --}}
                </td>
            </tr>
        </table>
    </div>
@endsection
