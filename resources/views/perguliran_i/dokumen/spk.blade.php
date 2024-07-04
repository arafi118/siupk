@php
    use App\Utils\Tanggal;
    use Carbon\Carbon;

    $waktu = date('H:i');
    $tempat = 'Kantor LKM';

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
            <td width="5">&nbsp;</td>
            <td width="90">Nama Lengkap</td>
            <td width="10" align="center">:</td>
            <td>{{ $dir->namadepan }} {{ $dir->namabelakang }}</td>
        </tr>
        <tr>
            <td width="5">&nbsp;</td>
            <td>Jabatan</td>
            <td align="center">:</td>
            <td>{{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}</td>
        </tr>
        <tr>
            <td width="5">&nbsp;</td>
            <td>NIK</td>
            <td align="center">:</td>
            <td>{{ $dir->nik }}</td>
        </tr>
        <tr>
            <td width="5">&nbsp;</td>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>{{ $kec->alamat_kec }}</td>
        </tr>
    </table>

    <div style="text-align: justify;">
        Dalam hal ini bertindak untuk dan atas nama Pengurus {{ $kec->nama_lembaga_sort }} {{ $kec->sebutan_kec }}
        {{ $kec->nama_kec }} selaku pengelola pelayanan kredit, Kredit Barang (KB), Selanjutnya disebut <b>PIHAK PERTAMA</b>, dan
    </div>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
        <tr>
            <td width="5">&nbsp;</td>
            <td width="90">Nama Lengkap</td>
            <td width="10" align="center">:</td>
            <td>{{ $pinkel->anggota->namadepan }}</td>
        </tr>
        <tr>
            <td width="5">&nbsp;</td>
            <td>Jenis kelamin</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->jk }}</td>
        </tr>
        <tr>
            <td width="5">&nbsp;</td>
            <td>NIK</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->nik }}</td>
        </tr>
        <tr>
            <td width="5">&nbsp;</td>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>{{ $pinkel->anggota->alamat }}</td>
        </tr>
    </table>

    <div style="text-align: justify;">
        Dalam hubungan ini bertindak untuk dan atas nama diri sendiri yang menjadi bagian 
        tidak terpisahkan dari dokumen perjanjian kredit ini, selanjutnya disebut <b>PIHAK KEDUA</b>.
    </div>
    <p style="text-align: justify;">
        Pihak Pertama dan Pihak Kedua dalam kedudukan masing-masing seperti telah diterangkan diatas, Pada hari ini
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
                dilakukan secara perseorangan sesuai Surat Permohonan kredit tanggal
                {{ Tanggal::tglLatin($pinkel->tgl_proposal) }}.
            </li>
            <li>
                <b> Pihak Kedua</b> telah menyerahkan uang kepada Pihak Kedua sebagai pinjaman sebesar Rp.
                {{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah) tersebut secara
                 tunai dan sekaligus kepada  Pihak Kedua  pada saat perjanjian ini dibuat dan ditanda tangani, sekaligus 
                 membuat dan/atau menandatangani bukti penerimaan uang (kwitansi) yang sah.
            </li>
            <li>
                Selanjutnya <b>Pihak Kedua</b> mengaku telah menerima uang dalam jumlah sebagaimana yang diterangkan 
                pada ayat 1 dan 2 diatas, yang berlaku sebagai Surat Pengakuan Utang secara perseorangan dan menjadi 
                bagian yang tidak terpisahkan dari Surat Perjanjian Kredit (SPK) ini.
            </li>
        </ol>
    </div>

    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 2</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Jangka Waktu Pembayaran Utang dan Sistem Angsuran</i></h3>
        <div style="text-align: justify;">
            <li>
                 Sejumlah utang dimaksud dalam Pasal 1 wajib dibayar lunas dalam jangka waktu 10 bulan ditambah
                 jasa yang dihitung secara Flat sebesar 1.5% dari pokok utang oleh Pihak Kedua dengan sistim angsuran 
                 Pokok dibayar setiap bulan dan Jasa dibayar setiap bulan.
            </li>
            <li>
                <b>Pihak Kedua</b> wajib membayar angsuran sebagaimana Pasal 2 Ayat 1 dengan jumlah angsuran Rp.
                <b>{{ number_format($pinkel->alokasi) }} ({{ $keuangan->terbilang($pinkel->alokasi) }} Rupiah)</b> 
                untuk angsuran Pokok ditambah Rp. 75.000,00 (Tujuh Puluh Lima Ribu Rupiah) 
                setiap bulan, selama 10 bulan, yang dimulai pada tanggal 29 Juni 2024 dan sampai target pelunasan,
                sebagaimana jadwal angsuran terlampir yang menjadibagian tidak terpisahkan dari Surat Perjanjian Kredit (SPK) ini.
            </li>
        </div>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 3</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Barang Jaminan/Agunan</h3>
        <div style="text-align: justify;">
            <li>
                Guna menjamin pembayaran utang dilakukan secara tertib sesuai rencana angsuran 
                sebagaimana dimaksud dalam Pasal 2 dan agar dilakukan sebagaimana mestinya sesuai dengan perjanjian ini,
                maka berkaitan dengan barang jamainan berupa Sertifikat Hak Milik (SHM) Nomor 2345 yang dijadikan agunan
                oleh Pihak Kedua oleh Pihak Kedua kepada Pihak Pertama yang selanjutnya dibuatkan bukti penyerahan barang
                jaminan/agunan dari Pihak Kedua kepada Pihak Pertama dan selanjutnya bisa diambil kembali apabila sudah 
                dinyatakan lunas atas angsuran pokok maupun jasa dan segala kewajiban yang timbul dari pelayanan atas pelayanan
                kredit ini terpenuhi.
            </li>
            <li>
                <b>Pihak Pertama</b> wajib melakukan penyimpanan/pengamanan atas barang jaminan/agunan sebagaimana dimaksud dalam 
                Pasal 3 Ayat 1 secara layak dan sebagaimana mestinya serta menyerahkan kembali kepada Pihak Kedua apabila 
                Pihak Kedua sudah dinyatakan lunas atas seluruh kewajiban angsuran pokok dan jasa beserta segala kewajiban 
                lain yang timbul dalam pelayanan dan penanganan kredit ini.
            </li>
        </div>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 4</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Pengalihan Kuasa atas Barang Jaminan/Agunan</i></h3>
        <div style="text-align: justify;">
            Dalam hal Pihak Kedua tidak memenuhi kewajiban angsuran kepada Pihak Pertama sebagaimana dimaksud dalam jadwal 
            angsuran Pasal 2, maka Pihak Kedua secara suka rela akan melakukan pengalihan kekuasaan atas barang jaminan/agunan 
            dengan mekanisme :
            <ol style="text-align: justify;">
                <li>
                    <b>Pihak kedua</b> menyerahkan barang jaminan/agunan yang sah kepada <b>Pihak Pertama</b> sebagaimana tersebut 
                    dalam Pasal 3 berikut dengan segala hak dan kepentingan yang sekarang atau dikemudian hari akan 
                    diperoleh dari barang jaminan tersebut.
                </li>
                <li>
                    <b>Pihak kedua</b> memberikan persetujuan untuk dilakukan perikatan agunan sesuai dengan ketentuan peraturan 
                    perundang-undangan yang berlaku sesuai dengan jenis barang jaminan/agunan yang diberikan.
                </li>
                <li>
                    <b>Pihak kedua</b> akan menyerahkan bukti kepemilikan, izin-izin atau dokumen-dokumen yang berkaitan dengan agunan 
                    serta akta-akta berkenaan dengan pengikatan barang yang diagunkan sebagaimana tersebut dalam Pasal 3 secara 
                    sukarela untuk dikuasai oleh <b>{{ $kec->nama_lembaga_sort }}</b> sampai kredit dinyatakan lunas. 
                </li>
                <li>
                    Apabila karena sebab apapun, Agunan yang diserahkan menjadi tidak sah atau berkurang nilainya dan/atau nilainya 
                    tidak lagi sesuai dengan kewajiban Pihak Kedua, maka Pihak Kedua wajib menyerahkan Agunan Pengganti yang Sah 
                    milik Pihak Kedua dan sedang tidak dalam keadaan sengketa dengan nilai agunan yang dapat memenuhi kewajiban 
                    Pihak Kedua dan dapat disetujui oleh <b>{{ $kec->nama_lembaga_sort }}</b>       
                </li>
            </ol>
        </div>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 5</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Pengalihan Kuasa Khusus atas Agunan </i></h3>

        <ol style="text-align: justify;">
            <li>
                <b>Pihak Kedua</b> bersedia membuat dan/atau menandatangani dokumen surat kuasa khusus kepada <b>Pihak Pertama</b> untuk 
                mengambil dan menguasai obyek yang disebutkan sebagai barang jaminan atau agunan dimaksud dalam Pasal 3 juncto 
                Pasal 4 secara sah dan memiliki hak sepenuhnya untuk menjual atau melakukan lelang atau memiliki sendiri atas 
                barang jaminan/agunan tersebut dalam rangka melunasi hutang <b>Pihak Kedua</b> .
            </li>
            <li>
                Kuasa yang diberikan oleh <b>Pihak Kedua</b> kepada <b>Pihak Pertama</b> didalam atau berdasarkan perjanjian ini, 
                merupakan bagian yang  tidak terpisahkan dari perjanjian ini, dan tidak dapat ditarik kembali serta tidak 
                akan berakhir karena meninggal dunianya Pihak Kedua atau karena sebab apapun juga.
            </li>
            <li>
                Dalam rangka menjalankan Kuasa Khusus Penjualan dan/atau melakukan pelelangan barang jaminan/agunan sebagaimana 
                disebut dalam Pasal 3 juncto Pasal 4, maka nilai penjualan dan/atau pelelangan setelah dikurangi biaya eksekusi 
                barangjaminan/agunan beserta biaya yang timbul dari proses penjualan/pelelangan barang jaminan/agunan akan 
                diperhitungkan sebagai kelebihan atau kekurangan bayar yang tetap menjadi hak/kewajiban <b>Pihak Kedua</b> .
            </li>
        </ol>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 6</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Penyelesaian Perselisihan </i></h3>

        <ol style="text-align: justify;">
            <li>
                Apabila ada hal-hal yang tidak atau belum diatur dalam perjanjian ini dan juga 
                jika terjadi perbedaan penafsiran atas seluruh atau sebagian dari perjanjian ini 
                maka kedua belah pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat.
            </li>
            <li>
                Jika penyelesaian secara musyawarah untuk mufakat juga ternyata tidak menyelesaikan 
                perselisihan tersebut maka perselisihan tersebut akan diselesaikan secara hukum yang berlaku 
                di Indonesia dan oleh karena itu kedua belah pihak setuju menunjuk Pengadilan Negeri Tasikmalaya 
                sebagai upaya hukum dalam menyelesaikan persengketaan tersebut.
            </li>
        </ol>
    </div>
    <div style="text-align: center;">
        <b style="font-size: 14px;">PASAL 7</b>
        <h3 class="fa fa-align-center" aria-hidden="true">Lain lain
            </i></h3>
        <div style="text-align: justify;">
            Hal-hal yang belum atau belum cukup diatur dalam perjanjian ini akan diatur lebih lanjut dalam 
            bentuk surat menyurat dan atau addendum perjanjian yang ditandatangani oleh para pihak yang merupakan satu 
            kesatuan dan bagian yang tidak terpisahkan dari perjanjian ini.
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

                    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;"
                        class="p">
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
