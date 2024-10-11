@php
    use App\Utils\Tanggal;
    use Carbon\Carbon;
    Carbon::setLocale('id');
    $waktu = date('H:i');
    $tempat = 'Kantor UPK';
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
            font-size: 10px;
            text-align: center;
            text-align: justify;
        }
    </style>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 14px;">
                    <b> SURAT PERJANJIAN KREDIT (SPK) <br>
                        PENGKREDITAN BARANG {{ $pinkel->jpp->nama_jpp }} </b>
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
        Dengan memohon rahmat Tuhan Yang Maha Kuasa serta kesadaran akan cita-cita luhur pemberdayaan masyarakat desa untuk
        mencapai kemajuan ekonomi dan kemakmuran bersama, pada hari ini {{ Tanggal::namaHari($pinkel->tgl_cair) }} tanggal
        {{ $keuangan->terbilang(Tanggal::hari($pinkel->tgl_cair)) }} bulan {{ Tanggal::namaBulan($pinkel->tgl_cair) }}
        tahun
        {{ $keuangan->terbilang(Tanggal::tahun($pinkel->tgl_cair)) }}, bertempat di {{ $tempat }} kami yang bertanda
        tangan dibawah ini;
    </div>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 10px;">
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
        Dalam hal ini bertindak untuk dan atas nama Pengurus {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }}
        {{ $kec->nama_kec }} selaku pengelola pelayanan
        kredit untuk {{ $pinkel->jpp->deskripsi_jpp }}
        ({{ $pinkel->jpp->nama_jpp }}) di {{ $kec->sebutan_kec }}
        {{ $kec->nama_kec }}, Selanjutnya disebut
        <b> Pihak Pertama </b> , dan
    </div>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 10px;">
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
        Dalam hubungan ini bertindak untuk dan atas nama diri sendiri yang menjadi bagian tidak terpisahkan dari dokumen
        perjanjian kredit ini, selanjutnya disebut <b>Pihak kedua</b>.
    </div>
    <p class="centered-text">
        Pihak Pertama dan Pihak Kedua dalam kedudukan masing-masing seperti telah diterangkan diatas, Pada hari
        {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_cair)->locale('id')->translatedFormat('d F Y') }}
        bertempat di {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }}
        {{ $kec->nama_kec }} dengan sadar dan
        sukarela menyatakan telah membuat perjanjian kredit barang kepada <b>Pihak Kedua berupa {{ $pinkel->nama_barang }}. </b>Kedua belah pihak sepakat untuk mengikatkan diri dalam perjanjian ini dengan syarat-syarat sebagai berikut:
    </p>
    <div style="text-align: center;">
        <b class="centered-text"> PASAL 1 </b><br>
        <b class="centered-text">Perjanjian</b>
        <ol class="centered-text">
            <li>Perjanjian ini dibuat untuk menyepakati ketentuan yang disetujui oleh kedua belah pihak.
            </li>
            <li>
                Perjanjian kredit ini berlaku setelah ditandatanganinya perjanjian ini.
            </li>
        </ol>
    </div>
    <div style="text-align: center;">
        <b class="centered-text"> PASAL 2 </b><br>
        <b class="centered-text">Nilai dan Barang</b>
        <ol class="centered-text">
            <li>Barang yang dikreditkan adalah berupa {{ $pinkel->nama_barang }} .</li>
            <li>Nilai barang tersebut diatas sebesar  <b> {{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah). </b></li>
            <li>Status kepemilikan barang sampai dengan sebelum perjanjian ini dinyatakan berakhir adalah <b>Fidusia atau Sewa Beli.</b></li>
            <li>Perjanjian ini berakhir ketika <b>Pihak Pertama</b> telah selesai melakukan pembayaran sesuai dengan kesepakatan.</li>
        </ol>
    </div>
    <br>
    <div style="text-align: center;">
        <b class="centered-text"> PASAL 3 </b><br>
        <b class="centered-text">Sistem Pengembalian</b>
        <b>&nbsp;</b>
            </i> </h3>
        <ol class="centered-text">
            <li><b> Pihak Kedua </b> wajib membayar hutang tersebut kepada <b> Pihak Pertama </b> dengan cara pembayaran
                angsuran
                sebesar
                <b> {{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah) </b>
                ditambah
                jasa <b> {{ $pinkel->pros_jasa / $pinkel->jangka }} % Flat </b> sebesar
                <b> {{ number_format($pinkel->alokasi * ($pinkel->pros_jasa / $pinkel->jangka / 100)) }}
                    ({{ $keuangan->terbilang($pinkel->alokasi * ($pinkel->pros_jasa / $pinkel->jangka / 100)) }} Rupiah)
                </b>
                setiap bulan, selama {{ $pinkel->jangka }} bulan,
                yang dimulai pada {{ Tanggal::namaHari($pinkel->tgl_cair) }},
                {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_cair)->translatedFormat('d F Y') }} dan
                sampai target pelunasan, sebagaimana jadwal angsuran terlampir.</li>
            <li>Jika Kredit dapat diselesaikan sebelum jangka waktu pengembalian, maka <b>Pihak Kedua</b> diwajibkan membayar <b>sisa pokok + sisa jasa sepenuhnya.</b>  </li>

        </ol>
    </div>
    <br>
    <div style="text-align: center;">
        <b class="centered-text"> PASAL 4 </b><br>
        <b class="centered-text">Sanksi Keterlambatan Pembayaran</b>
        <ol class="centered-text">
            <li>Keterlambatan angsuran <b>Pihak Kedua</b> telah melampaui masa toleransi 2(dua) hari, maka <b>Pihak kedua</b> di bebani denda sebesar <b>5%,8% dan 10% seiring waktu keterlambatan</b></li>
        </ol>
    </div>
    <br><br>
    <div style="text-align: center;">
        <b class="centered-text"> PASAL 5 </b><br>
        <b class="centered-text">Penyelesaian Perselisihan</b>
        </h3>
        <ol class="centered-text">
          <li>Penggunaan kembali barang oleh <b>Pihak Kedua</b> setelah diterapkannya sanksi sebagaimana pada <b>Pasal 4 Ayat 3</b> dapat dilakukan apabila seluruh kewajiban angsuran dan denda dibayar lunas sesuai target angsuran berjalan.</li>
            <li>Hal-hal yang tidak diatur dan/atau belum diatur dalam perjanjian ini dan/atau terjadi perbedaan penafsiran atas seluruh atau sebagian dari perjanjian ini maka kedua belah pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat.</li>
            <li>Apabila tidak tercapai kata mufakat dalam proses penyelesaian perselisihan sebagaimana dimaksud dalam <b>Pasal 5 Ayat 1</b> maka  akan diselesaikan secara hukum sesuai hukum yang berlaku di Indonesia melalui Pengadilan Negeri {{$kab->nama_kab}}</li>

        </ol>
    </div> <br>
    <div style="text-align: center;">
        <b class="centered-text"> PASAL 6 </b><br>
        <b class="centered-text">Lain lain</b>
            </i> </h3>
            <div class="centered-text">
                Hal-hal yang belum atau belum cukup diatur dalam perjanjian ini akan diatur lebih lanjut dalam bentuk surat menyurat dan atau addendum perjanjian yang ditandatangani oleh para pihak yang merupakan satu kesatuan dan bagian yang tidak terpisahkan dari perjanjian ini.
    
            </div>
    </div> <br>
    <div style="text-align: center;">
        <b class="centered-text"> PASAL 7 </b><br>
        <b class="centered-text">Penutup</b>
            </i> </h3>
            <div class="centered-text">
                Perjanjian Kredit barang ini dibuat rangkap 2 (dua) di atas kertas bermaterai cukup untuk masing-masing pihak yang mempunyai kekuatan hukum yang sama dan ditanda tangani oleh kedua belah pihak dalam keadaan sehat jasmani dan rohani, serta tanpa unsur paksaan dari pihak manapun.
            </div>
    </div>
    <div style="text-align: center;" style="font-size: 10px;">
       <br>
                    {{-- <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
                        <tr>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="70" align="center"> Pihak Pertama </td>
                            <td width="60" align="center"> &nbsp; </td>
                            <td width="50" align="center" colspan="2"> Pihak Kedua </td>
                        </tr> <br> <br> <br> <br> <br><br><br><br>
                        <tr>
                            <td width="10" align="center"> &nbsp; </td>
                            <td width="70" align="center"> {{ $dir->namadepan }} {{ $dir->namabelakang }} <br>
                                Kepala
                                UPK </td>
                            <td width="50" align="center"> &nbsp; </td>
                            <td width="60" align="center"> {{ $pinkel->anggota->namadepan }} <br> Peminjam
                            </td>
                            <td width="50" align="center"> {{ $pinkel->anggota->penjamin }} <br> Penjamin </td>
                        </tr> <br>
                        <tr>
                        <td width="10" align="center"> &nbsp; </td>
                        <td width="70" align="center"> &nbsp; </td>
                        <td width="60" align="center"> Mengetahui
                            <br> {{ $pinkel-> anggota-> d-> sebutan_desa-> sebutan_kades }}&nbsp;{{ $pinkel-> anggota-> d-> nama_desa }}
                        </td>
                        <td width="50" align="center"> &nbsp; </td>
                        <td width="50" align="center"> &nbsp; </td>
                    </tr> <br> <br> <br> <br> <br>
                    <tr>
                        <td width="10" align="center"> &nbsp; </td>
                        <td width="70" align="center"> &nbsp; </td>
                        <td width="60" align="center"> {{ $pinkel-> anggota-> d-> kades }}
                        </td>
                        <td width="50" align="center"> &nbsp; </td>
                        <td width="50" align="center"> &nbsp; </td>
                    </tr>
                    </table> --}}
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;" class="p">
                    <tr>
                        <td>
                            {!! $ttd !!}
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
    </div>
@endsection
