@php
    use App\Utils\Tanggal;
    use Carbon\Carbon;

    $waktu = date('H:i');
    $tempat = 'Kantor DBM';

    $wt_cair = explode('_', $pinkel->wt_cair);
    if (count($wt_cair) == 1) {
        $waktu = $wt_cair[0];
    }

    if (count($wt_cair) == 2) {
        $waktu = $wt_cair[0];
        $tempat = $wt_cair[1];
    }

    $redaksi_spk = str_replace('<ol>', '', str_replace('</ol>', '', $kec->redaksi_spk));
    $redaksi_spk = str_replace('<ul>', '', str_replace('</ul>', '', $redaksi_spk));
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>SURAT PERJANJIAN KREDIT (SPK)</b>
                </div>
                <div style="font-size: 14px;">
                    Nomor: {{ $pinkel->spk_no }}
                </div>

            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>

    <div style="text-align: justify;">
        Dengan memohon rahmat Tuhan Yang Maha Kuasa serta kesadaran akan cita-cita luhur pemberdayaan masyarakat desa untuk
        mencapai kemajuan ekonomi dan kemakmuran bersama, pada hari ini {{ Tanggal::namaHari($pinkel->tgl_cair) }} tanggal
        {{ $keuangan->terbilang(Tanggal::hari($pinkel->tgl_cair)) }} bulan {{ Tanggal::namaBulan($pinkel->tgl_cair) }} tahun
        {{ $keuangan->terbilang(Tanggal::tahun($pinkel->tgl_cair)) }}, bertempat di {{ $tempat }} kami yang bertanda
        tangan dibawah ini;
    </div>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
            <td width="90">Nama Lengkap</td>
            <td width="10" align="center">:</td>
            <td>{{ $dir->namadepan }} {{ $dir->namabelakang }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td align="center">:</td>
            <td>{{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td align="center">:</td>
            <td>{{ $dir->nik }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>{{ $kec->alamat_kec }}</td>
        </tr>
    </table>

    <div style="text-align: justify;">
        Dalam hal ini bertindak untuk dan atas nama Pengurus {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }}
        {{ $kec->nama_kec }} selaku pengelola pelayanan
        kredit untuk {{ $pinkel->jpp->deskripsi_jpp }}
        ({{ $pinkel->jpp->nama_jpp }}) di {{ $kec->sebutan_kec }}
        {{ $kec->nama_kec }}, Selanjutnya disebut
        <b>Pihak Pertama</b>, dan
    </div>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
            <td width="90">Nama Lengkap</td>
            <td width="10" align="center">:</td>
            <td>{{ $pinkel->anggota->namadepan }}</td>
        </tr>
        <tr>
            <td>Jenis kelamin</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->jk }}</td>
        </tr>
        <tr>
            <td>Tempat, tangal lahir</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->tempat_lahir }},
                {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_lahir)->format('d F Y') }}
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->nik }}</td>
        </tr>
        <tr>
            <td>Berkedudukan di</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->alamat }}</td>
        </tr>
    </table>

    <div style="text-align: justify;">
        Dalam hubungan ini bertindak untuk dan atas nama diri sendiri yang menjadi bagian tidak terpisahkan dari dokumen
        perjanjian kredit ini, selanjutnya disebut PIHAK KEDUA.
    </div>
    <p style="text-align: justify;">
        Pihak Pertama dan Pihak Kedua dalam kedudukan masing-masing seperti telah diterangkan diatas, Pada hari
        {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_cair)->format('d F Y') }},
        bertempat di {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }}
        {{ $kec->nama_kec }} dengan sadar dan
        sukarela menyatakan telah membuat perjanjian utang piutang dengan ketentuan-ketentuan yang telah disepakati bersama
        sebagai berikut :
    </p>


    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 1</b>

        <ol style="text-align: justify;">
            <li> <b> Pihak Pertama</b> dengan ini setuju memberikan kredit kepada <b>Pihak Kedua</b> uang sebesar Rp.
                {{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah) Yaitu jumlah
                yang telah diputuskan dalam Rekomendasi rapat <b>Tim Pendanaan</b> mendasar pada surat Rekomendasi dari
                <b>Team Verifikasi</b> dan {{ $kec->nama_lembaga_sort }}, berdasarkan permohonan dari Pihak Kedua yang
                dilakukan secara perorangan sesuai Surat Permohonan kredit tanggal
                {{ Tanggal::tglLatin($pinkel->tgl_proposal) }}.
            </li>
            <li>
                <b> Pihak Kedua</b> dan Pemberi kuasa, mengaku telah menerima uang dalam jumlah sebagaimana yang diterangkan
                pada
                ayat 1 diatas, uang telah dibayarkan sesuai jumlah kelayakan pinjamannya masing-masing dan dibuktikan secara
                sah dengan daftar tanda terima uang terlampir, yang berlaku sebagai Surat Pengakuan Utang secara perorangan.
            </li>
        </ol>
    </div>

    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 2</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Penyerahan Pinjaman</i></h3>
        <div style="text-align: justify;">
            <b> Pihak Pertama</b> telah menyerahkan uang kepada Pihak Kedua sebagai pinjaman sebesar
            <b>{{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah)</b>
            tersebut secara tunai dan sekaligus kepada <b>Pihak Kedua</b> pada saat perjanjian ini dibuat dan ditanda
            tangani. <b>Pihak Kedua</b> menyatakan telah menerimanya dengan menandatangani bukti penerimaan (kwitansi) yang
            sah.
        </div>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 3</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Sistem Pengembalian
            </i></h3>
        <div style="text-align: justify;">
            <b> Pihak Pertama</b> telah menyerahkan uang kepada Pihak Kedua sebagai pinjaman sebesar
            <b>{{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah)</b>
            tersebut secara tunai dan sekaligus kepada <b>Pihak Kedua</b> pada saat perjanjian ini dibuat dan ditanda
            tangani. <b>Pihak Kedua</b> menyatakan telah menerimanya dengan menandatangani bukti penerimaan (kwitansi) yang
            sah.
            <b>Pihak Kedua</b> wajib membayar hutang tersebut kepada <b>Pihak Pertama</b> dengan cara pembayaran angsuran
            sebesar
            <b>{{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah)</b> ditambah
            jasa <b> {{ $pinkel->pros_jasa }} % Flat</b> sebesar <b>Rp.75,000,- (Tujuh Puluh Lima Ribu Rupiah)</b> setiap bulan, selama 6 bulan,
            yang dimulai pada {{ Tanggal::namaHari($pinkel->tgl_cair) }},
            {{ \Carbon\Carbon::parse($pinkel->anggota->tgl_cair)->format('d F Y') }} dan
            sampai target pelunasan, sebagaimana jadwal angsuran terlampir.
        </div>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 4</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Agunan</i></h3>
        <div style="text-align: justify;">
            Untuk menjamin pembayaran kembali yang tertib dan sebagaimana mestinya atas segala sesuatu yang berdasarkan
            perjanjian ini masih terutang oleh <b>Pihak Kedua</b>kepada <b>Pihak Pertama</b>, ditambah biaya yang timbul
            akibat
            eksekusi
            Agunan, maka akan dibuat sebuah perjanjian dimana :
            <ol style="text-align: justify;">
                <li>
                    <b> Pihak Kedua</b> akan menyerahkan Agunan kepada Pihak Pertama berupa.
                    berikut dengan segala hak dan kepentingan yang sekarang atau dikemudian hari akan diperoleh <b>Pihak
                        Pertama</b> atas tersebut diatas.
                </li>
                <li>
                    <b>Agunan</b> diikat sesuai dengan ketentuan peraturan perundang-undangan yang berlaku sesuai dengan
                    jenis <b>Agunan</b> yang diberikan.
                </li>
                <li>
                    Bukti pemilikan, izin-izin atau dokumen-dokumen yang berkaitan dengan Agunan serta akta-akta berkenaan
                    dengan pengikatan barang agunan yang diagunkan sebagaimana tersebut dalam ayat 2 pasal ini, dikuasai
                    oleh <b>{{ $kec->nama_lembaga_sort }}</b>sampai kredit dinyatakan lunas. Jika karena sebab apapun,
                    Agunan diserahkan menjadi tidak sah atau berkurang nilainya, maka Pihak Kedua wajib menyerahkan Agunan
                    Pengganti yang bentuk dan nilainya sama dan dapat disetujui oleh <b>{{ $kec->nama_lembaga_sort }}</b>.
                </li>
                <li>
                    Barang jaminan tersebut <b>Sah</b>milik <b>Pihak Kedua</b>dan sedang tidak dalam keadaan sengketa.
                </li>
            </ol>
        </div>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 5</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Pengalihan Kuasa Khusus atas Agunan </i></h3>

        <ol style="text-align: justify;">
            <li><b>Pihak Kedua</b> dengan ini memberikan kuasa kepada <b>Pihak Pertama</b> untuk mengambil dan menguasai
                obyek yang disebutkan sebagai Barang jaminan atau agunan dimaksud dalam pasal 5 secara sah dan memiliki hak
                sepenuhnya untuk menjual atau melakukan lelang atau memiliki sendiri atas barang jaminan/agunan tersebut
                dalam rangka melunasi hutang <b>Pihak Kedua</b>.
            </li>
            <li>Kuasa yang diberikan oleh <b>Pihak Kedua</b> kepada <b>Pihak Pertama</b> didalam atau berdasarkan perjanjian
                ini, merupakan bagian yang terpenting dan tidak terpisahkan dari perjanjian ini, kuasa mana tidak dapat
                ditarik kembali dan juga tidak akan berakhir karena meninggal dunianya Pihak Kedua atau karena sebab apapun
                juga.
            </li>
            <li>Dalam rangka menjalankan Kuasa Khusus Penjualan dan/atau melakukan pelelangan barang jaminan/agunan
                sebagaimana disebut dalam Pasal 6 Ayat 1 juncto Pasal 5, maka nilai penjualan dan/atau pelelangan setelah
                dikurangi biaya eksekusi barangjaminan/agunan beserta biaya yang timbul dari proses penjualan/pelelangan
                barang jaminan/agunan akan diperhitungkan sebagai kelebihan atau kekurangan bayar yang tetap menjadi
                hak/kewajiban <b> Pihak Kedua</b>.
            </li>
        </ol>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 6</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Penyelesaian Perselisihan </i></h3>

        <ol style="text-align: justify;">
            <li>Apabila ada hal-hal yang tidak atau belum diatur dalam perjanjian ini dan juga jika
                terjadi perbedaan penafsiran atas seluruh atau sebagian dari perjanjian ini maka
                kedua belah pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat.
            </li>
            <li>
                Apabila ada hal-hal yang tidak atau belum diatur dalam perjanjian ini dan juga jika
                terjadi perbedaan penafsiran atas seluruh atau sebagian dari perjanjian ini maka
                kedua belah pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat.
            </li>
        </ol>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 7</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Sistem Pengembalian
            </i></h3>
        <div style="text-align: justify;">
            Hal-hal yang belum atau belum cukup diatur dalam perjanjian ini akan diatur lebih lanjut dalam bentuk surat
            menyurat dan atau addendum perjanjian yang ditandatangani oleh para pihak yang merupakan satu kesatuan dan
            bagian yang tidak terpisahkan dari perjanjian ini.
        </div>
    </div>
    <div style="text-align: center;">
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;"class="p0">
            <tr>
                <td style="padding: 0px !important;">
                    <table class="p0" border="0" width="100%" cellspacing="0" cellpadding="0"
                        style="font-size: 12px;">
                        <tr>
                            <td style="padding: 0px !important;">
                                <div style="text-align: center;">
                                    <b style="font-size: 14px; text-align: center;">PASAL 8</b>
                                    <h3 class="fa fa-align-center" aria-hidden="true">Penyelesaian Perselisihan </i></h3>
                                </div>
                                <div style="text-align: justify;">
                                    Perjanjian Hutang Piutang uang ini dibuat rangkap 2 (dua) di atas kertas bermaterai
                                    cukup untuk masing-masing pihak yang mempunyai kekuatan hukum yang sama dan ditanda
                                    tangani oleh kedua belah pihak dalam keadaan sehat jasmani dan rohani, serta tanpa
                                    unsur paksaan dari pihak manapun.
                                </div>
                            </td>
                        </tr>
                    </table>

                    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td colspan="2" height="24">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="50%" align="center">Pihak Pertama</td>
                            <td width="50%" align="center">Pihak Kedua</td>
                        </tr>
                        <tr>
                            <td colspan="2" height="40">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center">{{ $dir->namadepan . ' ' . $dir->namabelakang }}</td>
                            <td align="center">
                                {{ $pinkel->anggota->namadepan }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endsection
