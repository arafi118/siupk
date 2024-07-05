@php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();

    $saldo_aset = 0;
    $calk = json_decode($kec->calk, true);
    $peraturan_desa = $calk['peraturan_desa'];

    $calk = [
        '0' => [
            'th_lalu' => 0,
            'th_ini' => 0,
        ],
        '1' => [
            'th_lalu' => 0,
            'th_ini' => 0,
        ],
        '2' => [
            'th_lalu' => 0,
            'th_ini' => 0,
        ],
        '3' => [
            'th_lalu' => 0,
            'th_ini' => 0,
        ],
        '4' => [
            'th_lalu' => 0,
            'th_ini' => 0,
        ],
        '5' => [
            'th_lalu' => 0,
            'th_ini' => 0,
        ],
    ];

    $i = 0;
    foreach ($saldo_calk as $_saldo) {
 

        $i++;
    }

    $rek_alokasi_laba = ['2.1.04.01', '2.1.04.02', '2.1.04.03'];
@endphp

@extends('pelaporan.layout.base')

@section('content')
    <style>
        ol,
        ul {
            margin-left: unset;
        }
    </style>

        <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>CATATAN ATAS LAPORAN KEUANGAN</b>
                </div>
                <div style="font-size: 18px; text-transform: uppercase;">
                    <b>{{ $kec->nama_lembaga_sort }}</b>
                </div>
                <div style="font-size: 16px;">
                    <b>{{ strtoupper($sub_judul) }}</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>

    <ol style="list-style: upper-alpha;">
        <li>
            <div style="text-transform: uppercase;">Gambaran Umum</div>
            <div style="text-align: justify">
                {{ $kec->nama_lembaga_sort }} adalah Lembaga yang berdiri sejak adanya PNPM-MPd untuk memberikan layanan
                perguliran bagi masyarakat se-kecamatan {{ $kec->nama_kec }} melalui produk layanan pinjaman bagi
                kelompok SPP dan UEP.
            </div>
            <p style="text-align: justify">
                Berdasarkan Keputusan MAD {{ $kec->nama_lembaga_sort }} bersepakat membentuk sebuah badan hukum dan telah
                mencatatkan
                mendapatkan legalisasi sesuai {{ $kec->nomor_bh }}. {{ $kec->nama_lembaga_sort }}. Dalam rangka menjalankan
                amanat pemberdayaan
                ekonomi masyarakat {{ $kec->nama_lembaga_sort }} menjalankan kegiatan Perguliran bagi Masyarakat sehingga
                masuk dalam
                kategori kegiatan mikrofinance dan berdomisili di {{ $kec->nama_kec }} dengan susunan pengurus sebagai
                berikut :

            <table style="margin-top: -10px; margin-left: 15px;">
                <tr>
                    <td style="padding: 0px; 4px;" width="100">{{ $kec->nama_bp_long }}</td>
                    <td style="padding: 0px; 4px;">:</td>
                    <td style="padding: 0px; 4px;">
                        {{ $pengawas ? $pengawas->namadepan . ' ' . $pengawas->namabelakang : '......................................' }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px; 4px;">{{ $kec->sebutan_level_1 }}</td>
                    <td style="padding: 0px; 4px;">:</td>
                    <td style="padding: 0px; 4px;">
                        {{ $dir ? $dir->namadepan . ' ' . $dir->namabelakang : '......................................' }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px; 4px;">{{ $kec->sebutan_level_2 }}</td>
                    <td style="padding: 0px; 4px;">:</td>
                    <td style="padding: 0px; 4px;">
                        {{ $sekr ? $sekr->namadepan . ' ' . $sekr->namabelakang : '......................................' }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px; 4px;">{{ $kec->sebutan_level_3 }}</td>
                    <td style="padding: 0px; 4px;">:</td>
                    <td style="padding: 0px; 4px;">
                        {{ $bend ? $bend->namadepan . ' ' . $bend->namabelakang : '......................................' }}
                    </td>
                </tr>
                {{-- <tr>
                    <td style="padding: 0px; 4px;">Unit Usaha</td>
                    <td style="padding: 0px; 4px;">:</td>
                    <td style="padding: 0px; 4px;">.................................</td>
                </tr> --}}
            </table>
            </p>
        </li>
        <li style="margin-top: 12px;"> 
            <div style="text-transform: uppercase;">
                Ikhtisar Kebijakan Akutansi
            </div>
            <ol>
                <li>
                    Pernyataan Kepatuhan
                    <ol style="list-style: lower-alpha;">
                        <li>
                            Laporan keuangan disusun menggunakan Standar Akuntansi Keuangan Usaha Jasa Keuangan Mikro.
                        </li>
                        <li>Laporan keuangan disusun berdasarkan hasil Keputusan  Musyawarah Antar Desa (MAD) dan/atau Forum Musyawarah Kecamatan (FMK) berkaitan dengan Tata kelola keuangan dan Penatausahaannya beserta penyajian pelaporan keuangan UPK.</li>
                        <li>
                            Dasar penyusunan laporan keuangan adalah biaya historis dan menggunakan asumsi dasar kas basis.
                            Mata uang penyajian yang digunakan untuk menyusun laporan keuangan ini adalah Rupiah.
                        </li>
                    </ol>
                </li>
                <li>
                    Piutang Usaha
                    <div>
                        Piutang usaha disajikan sebesar jumlah alokasi pencairan pinjaman ditambah resceduling setelah
                        dikurangi komulatif angsuran pada setiap pinjaman dan nilai penghapusan pinjaman yang diputuskan
                        dalam MAD.
                    </div>
                </li>
                <li>
                    Aset Tetap dan Inventaris dan Aset tak berwujud
                    <ol style="list-style: lower-alpha">
                        <li>
                            Aset tetap dan Inventaris beserta Aset tak berwujud dicatat sebesar biaya perolehannya pada saat
                            aset tersebut secara hukum mulai dimiliki oleh UPK.
                        </li>
                        <li>
                            Aset tetap beserta Inventaris disusutkan menggunakan metode garis lurus tanpa nilai.
                        </li>
                    </ol>
                </li>
                <li>
                    Pengakuan Pendapatan dan Beban
                    <ol style="list-style: lower-alpha;">
                        <li>
                            Jasa piutang kelompok dan masyarakat yang sudah dilakukan pembayaran/transaksi resceduling
                            diakui sebagai pendapatan meskipun dan wajib diterbitkan kuitansi sebagai bukti pembayaran jasa
                            piutang. demikian juga penerimaan atas denda keterlambatan pembayaran/pinalti diakui sebagai
                            pendapatan pada saat diterbitkan kuitansi pembayaran.
                        </li>
                        <li>
                            Adapun kewajiban bayar atas kebutuhan operasional, pemasaran maupun non operasional pada suatu
                            periode operasi tertentu sebagai akibat telah menikmati manfaat/menerima fasilitas, maka hal
                            tersebut sudah wajib diakui sebagai beban meskipun belum diterbitkan kuitansi pembayaran.
                        </li>
                    </ol>
                </li>
                <li>
                    Pajak Penghasilan
                    <div>
                        Pajak Penghasilan mengikuti ketentuan perpajakan yang berlaku di Indonesia.
                    </div>
                </li>
            </ol>
        </li>

        <li style="margin-top: 12px;">
            <div style="text-transform: uppercase;">
                Informasi Tambahan Laporan Keuangan
            </div>
            <div>
                <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
                    <tr>
                        <td colspan="3" height="5"></td>
                    </tr>
                    <tr style="background: #000; color: #fff;">
                        <td width="30">Kode</td>
                        <td width="300">Nama Akun</td>
                        <td align="right">Saldo</td>
                    </tr>
                    <tr>
                        <td colspan="3" height="2"></td>
                    </tr>

                    @foreach ($akun1 as $lev1)
                        @php
                            $sum_akun1 = 0;
                        @endphp
                        <tr style="background: rgb(74, 74, 74); color: #fff;">
                            <td height="20" colspan="3" align="center">
                                <b>{{ $lev1->kode_akun }}. {{ $lev1->nama_akun }}</b>
                            </td>
                        </tr>
                        @foreach ($lev1->akun2 as $lev2)
                            <tr style="background: rgb(167, 167, 167); font-weight: bold;">
                                <td>{{ $lev2->kode_akun }}.</td>
                                <td colspan="2">{{ $lev2->nama_akun }}</td>
                            </tr>

                            @foreach ($lev2->akun3 as $lev3)
                                @php
                                    $sum_saldo = 0;
                                    $akun_lev4 = [];
                                @endphp

                                @foreach ($lev3->rek as $rek)
                                    @php
                                        $saldo = $keuangan->komSaldo($rek);
                                        if ($rek->kode_akun == '3.2.02.01' && ($bulan != '1' && $hari != '1')) {
                                            $saldo = $keuangan->laba_rugi($tgl_kondisi);
                                        }

                                        $sum_saldo += $saldo;
                                        $akun_lev4[] = [
                                            'kode_akun' => $rek->kode_akun,
                                            'nama_akun' => $rek->nama_akun,
                                            'saldo' => $saldo,
                                        ];
                                    @endphp
                                @endforeach

                                @php
                                    if ($lev1->lev1 == '1') {
                                        $debit += $sum_saldo;
                                    } else {
                                        $kredit += $sum_saldo;
                                    }

                                    $sum_akun1 += $sum_saldo;
                                @endphp

                                <tr style="background: rgb(200,200,200);">
                                    <td>{{ $lev3->kode_akun }}.</td>
                                    <td>{{ $lev3->nama_akun }}</td>
                                    @if ($sum_saldo < 0)
                                        <td align="right">({{ number_format($sum_saldo * -1, 2) }})</td>
                                    @else
                                        <td align="right">{{ number_format($sum_saldo, 2) }}</td>
                                    @endif
                                </tr>

                                @foreach ($akun_lev4 as $lev4)
                                    <tr style="background: rgb(255,255,255);">
                                        <td>{{ $lev4['kode_akun'] }}.</td>
                                        <td>{{ $lev4['nama_akun'] }}</td>
                                        @if ($lev4['saldo'] < 0)
                                            <td align="right">({{ number_format($lev4['saldo'] * -1, 2) }})</td>
                                        @else
                                            <td align="right">{{ number_format($lev4['saldo'], 2) }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach

                        <tr style="background: rgb(167, 167, 167); font-weight: bold;">
                            <td height="20" colspan="2" align="left">
                                <b>Jumlah {{ $lev1->nama_akun }}</b>
                            </td>
                            <td align="right">{{ number_format($sum_akun1, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" height="2"></td>
                        </tr>

                        @php
                            if ($lev1->lev1 == '1') {
                                $saldo_aset = $sum_akun1;
                            }
                        @endphp
                    @endforeach
                    <tr style="background: rgb(167, 167, 167); font-weight: bold;">
                        <td height="20" colspan="2" align="left">
                            <b>Jumlah Liabilitas + Ekuitas </b>
                        </td>
                        <td align="right">{{ number_format($kredit, 2) }}</td>
                    </tr>
                </table>
            </div>

            @php
                $saldo_aset = $saldo_aset;
                $kredit = $kredit;

                $saldo_calk = $saldo_aset - $kredit;
                if ($saldo_calk < 0) {
                    $saldo_calk *= -1;
                }
            @endphp

            @if (floor($saldo_calk) != '0')
                <div style="color: #f44335">
                    Ada selisih antara Jumlah Aset dan Jumlah Liabilitas + Ekuitas sebesar
                    <b>Rp. {{ number_format(floor($saldo_aset - $kredit), 2) }}</b>
                </div>
            @endif
        </li>
        <li style="margin-top: 12px;">
            <div style="text-transform: uppercase;">
                Ketentuan Pembagian Laba Usaha
            </div>
            <ol>
                <li>
                    Pembagian atas laba usaha dibagi menjadi Laba dibagikan dan laba ditahan sesuai dengan ketentuan pada
                    Permendesa PDTT nomor 15 tahun 2021 yaitu:
                    <ol style="list-style: lower-latin;">
                        <li>
                            Hasil usaha yang dibagikan paling sedikit terdiri atas: bagian milik bersama masyarakat Desa;
                            dan bagian Desa;
                        </li>
                        <li>
                            Besaran masing-masing bagian dihitung berdasarkan persentase penyertaan modal dan dituangkan
                            dalamanggaran dasar.
                        </li>
                        <li>
                            <div>Bagian Desa;</div>
                            <ul>
                                <li style="list-style: none; margin-left: -20px;">
                                    <table cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="b" colspan="3" align="center">Desa</td>
                                            <td class="b" align="center">s/d Tahun lalu</td>
                                            <td class="b" align="center">Tahun ini</td>
                                            <td class="b" align="center">s/d Tahun Ini</td>
                                        </tr>

                                        @foreach ($kec->desa as $desa)
                                            @php
                                                $laba_th_lalu = 0;
                                                $laba_th_ini = 0;
                                                if ($desa->saldo) {
                                                    $laba_th_lalu = floatval($desa->saldo->debit);
                                                    $laba_th_ini = floatval($desa->saldo->kredit);
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>{{ $desa->sebutan_desa->sebutan_desa }} {{ $desa->nama_desa }}</td>
                                                <td>:</td>
                                                <td width="70" align="right">{{ number_format($laba_th_lalu, 2) }}
                                                </td>
                                                <td width="70" align="right">
                                                    {{ number_format($laba_th_ini - $laba_th_lalu, 2) }}</td>
                                                <td width="70" align="right">{{ number_format($laba_th_ini, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </li>
                            </ul>
                        </li>
                        <li>
                            Bagian milik bersama masyarakat Desa digunakan untuk:
                            <ol>
                                <li>
                                    Kegiatan sosial kemasyarakatan dan bantuan rumah tangga miskin
                                    <ul style="list-style: lower-alpha">
                                        <li>
                                            s/d Tahun Lalu Rp. {{ number_format($calk[0]['th_lalu'], 2) }}
                                        </li>
                                        <li>
                                            dan Tahun Ini Rp. {{ number_format($calk[0]['th_ini'], 2) }}
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    Pengembangan kapasitas kelompok simpan pinjam perempuan/usaha ekonomi produktif
                                    <ul style="list-style: lower-alpha">
                                        <li>
                                            s/d Tahun Lalu Rp. {{ number_format($calk[1]['th_lalu'], 2) }}
                                        </li>
                                        <li>
                                            dan Tahun Ini Rp. {{ number_format($calk[1]['th_ini'], 2) }}
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    Pelatihan masyarakat, dan kelompok pemanfaat umum
                                    <ul style="list-style: lower-alpha">
                                        <li>
                                            s/d Tahun Lalu Rp. {{ number_format($calk[2]['th_lalu'], 2) }}
                                        </li>
                                        <li>
                                            dan Tahun Ini Rp. {{ number_format($calk[2]['th_ini'], 2) }}
                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </li>
                    </ol>
                </li>
                <li>
                    <div>Laba Ditahan</div>
                    <ol style="list-style: lower-latin;">
                        <li>
                            Laba Ditahan untuk Penambahan Modal Kegiatan DBM Rp. {{ number_format($calk[3]['th_ini'], 2) }}
                        </li>
                        <li>
                            Laba Ditahan untuk Penambahan Investasi Usaha Rp. {{ number_format($calk[4]['th_ini'], 2) }}
                        </li>
                        <li>
                            Laba Ditahan untuk Pendirian Unit Usaha Rp. {{ number_format($calk[5]['th_ini'], 2) }}
                        </li>
                    </ol>
                </li>
            </ol>
        </li>
        
        <li style="margin-top: 12px;">
            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
                <tr>
                    <td align="justify">
                        <div style="text-transform: uppercase;">
                            Penutup
                        </div>
                        <div style="text-align: justify">
                            Catatan atas Laporan Keuangan (CaLK) ini merupakan bagian tidak terpisahkan dari Laporan
                            Keuangan {{ $kec->nama_lembaga_sort }} untuk Laporan Operasi Bulan {{ $nama_tgl }}.
                            Selanjutnya Catatan
                            atas Laporan Keuangan ini diharapkan untuk dapat berguna bagi pihak-pihak yang berkepentingan
                            (stakeholders) serta memenuhi prinsip-prinsip transparansi, akuntabilitas, pertanggungjawaban,
                            independensi, dan fairness dalam pengelolaan keuangan {{ $kec->nama_lembaga_sort }}.
                        </div>

                        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;"
                            class="p">
                            <tr>
                                <td>
                                    <div style="margin-top: 16px;"></div>
                                    {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </li>
    </ol>
@endsection
