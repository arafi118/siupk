@php
    use App\Utils\Tanggal;

    $keterangan = '';
    $denda = 0;
    $idt = 0;

    $angsur_bulan_depan = true;

    $target_pokok = 0;
    $target_jasa = 0;
    $angsuran_ke = 1;
    $wajib_pokok = 0;
    $wajib_jasa = 0;
    if ($ra_bulan_ini) {
        $wajib_pokok = $ra_bulan_ini->wajib_pokok;
        $wajib_jasa = $ra_bulan_ini->wajib_jasa;
        $target_pokok = $ra_bulan_ini->target_pokok;
        $target_jasa = $ra_bulan_ini->target_jasa;
        $angsuran_ke = $ra_bulan_ini->angsuran_ke;
    }

    $jum_angsuran = $pinkel->jangka / $pinkel->sis_pokok->sistem;
    if ($real->saldo_pokok + $real->saldo_jasa <= 0) {
        $angsuran_ke = $jum_angsuran;
    }

    if ($ra->jatuh_tempo <= $real->tgl_transaksi) {
        $angsur_bulan_depan = false;
    }
    $tunggakan_pokok = $target_pokok - $real->sum_pokok;
    if ($tunggakan_pokok < 0) {
        $tunggakan_pokok = 0;
    }
    $tunggakan_jasa = $target_jasa - $real->sum_jasa;
    if ($tunggakan_jasa < 0) {
        $tunggakan_jasa = 0;
    }

    $pokok_bulan_depan = $pinkel->alokasi - $real->sum_pokok;
    $jasa_bulan_depan = ($pinkel->alokasi * $pinkel->pros_jasa) / 100 - $real->sum_jasa;

    $pokok_bulan_depan = $pinkel->alokasi - $real->sum_pokok;
    $jasa_bulan_depan = ($pinkel->alokasi * $pinkel->pros_jasa) / 100 - $real->sum_jasa;

    if ($pokok_bulan_depan > 0 && $angsuran_ke + 1 <= $jum_angsuran) {
        $pokok_bulan_depan = $wajib_pokok;
    }

    if ($jasa_bulan_depan > 0 && $angsuran_ke + 1 <= $jum_angsuran) {
        $jasa_bulan_depan = $wajib_jasa;
    }

    if ($angsuran_ke >= $jum_angsuran) {
        $pokok_bulan_depan = 0;
        $jasa_bulan_depan = 0;
    }

    if (!$angsur_bulan_depan) {
        $pokok_bulan_depan = 0;
        $jasa_bulan_depan = 0;
    }
    $nama_user = '';

    $no_kuitansi = '';
@endphp
@foreach ($real->trx as $trx)
    @php
        $keterangan .= $trx->keterangan_transaksi . '<br>';
        if (
            $trx->rekening_kredit == '4.1.01.04' ||
            $trx->rekening_kredit == '4.1.01.05' ||
            $trx->rekening_kredit == '4.1.01.06'
        ) {
            $denda += $trx->jumlah;
        }

        $no_kuitansi .= $trx->idt . '/';

        if ($trx->user) {
            $nama_user = $trx->user->namadepan . ' ' . $trx->user->namabelakang;
        }
    @endphp
@endforeach

<style type="text/css">
    .style1 {
        letter-spacing: 5px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
    }

    .style2 {
        letter-spacing: 3px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 7px;
    }

    .top {
        border-top: 1px solid #000000;
    }

    .bottom {
        border-bottom: 1px solid #000000;
    }

    .left {
        border-left: 1px solid #000000;
    }

    .right {
        border-right: 1px solid #000000;
    }

    .allborder {
        border: 1px solid #000000;
    }

    .style26 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        letter-spacing: 5px;
    }

    .style27 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 7px;
        font-weight: bold;
        letter-spacing: 5px;
    }
</style>

<body onLoad="window.print()">
    <table width="100%" action="" border="0" align="center" cellpadding="1" cellspacing="1.5" class="style1">

        <tr>
            <th colspan="4" class="bottom">
                <b>{{ strtoupper($kec->nama_lembaga_sort . ' ' . $kec->nama_kec) }}</b>
                <br>
                {{ $kec->alamat_kec }}
                <br>
                Telp. {{ $kec->telpon_kec }}
            </th>
            <td width="4%" rowspan="17">&nbsp;</td>
            <td width="19%">
                Kode Transaksi
                <br>
                Tanggal Transasksi
            </td>
            <td width="15%">
                : {{ substr($no_kuitansi, 0, -1) }}
                <br>
                : {{ Tanggal::tglLatin($real->tgl_transaksi) }}
            </td>
            <th width="14%" class="style26">BUKTI ANGSURAN</th>
        </tr>

        <tr>
            <td width="15%">Loan ID</td>
            <td width="11%"><strong>: {{ $pinkel->id }} - {{ $pinkel->jpp->nama_jpp }}</strong></td>
            <td colspan="2">
                <div align="right">Angsuran ke: {{ $ra_bulan_ini->angsuran_ke > 0 ? $ra_bulan_ini->angsuran_ke : 1 }}
                    dari {{ $jum_angsuran }}</div>
            </td>
            <th class="bottom top">STATUS PINJAMAN</th>
            <th class="bottom top">POKOK</th>
            <th class="bottom top">JASA</th>
        </tr>
        <tr>
            <td>NIK </td>
            <td colspan="3">: {{ $pinkel->anggota->nik }}</td>
            <td>Alokasi Pinjaman </td>
            <td align="right">{{ number_format($pinkel->alokasi) }}</td>
            <td align="right">{{ number_format(($pinkel->alokasi * $pinkel->pros_jasa) / 100) }}</td>
        </tr>
        <tr>
            <td>Nama Anggota </td>
            <td colspan="3"><b>: {{ $pinkel->anggota->namadepan }}</b></td>
            <td>Target Pengembalian (x)</td>
            <td align="right">{{ number_format($target_pokok) }}</td>
            <td align="right">{{ number_format($target_jasa) }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td colspan="3">: {{ $pinkel->anggota->d->nama_desa }}</td>
            <td class="bottom">Realisasi Pengembalian</td>
            <td class="bottom" align="right">{{ number_format($real->sum_pokok) }}</td>
            <td class="bottom" align="right">{{ number_format($real->sum_jasa) }}</td>
        </tr>
        <tr>
            <td>Tanggal Cair </td>
            <td colspan="3">: {{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
            <th>Saldo Pinjaman</th>
            <th align="right">{{ number_format($real->saldo_pokok) }}</th>
            <th align="right">{{ number_format($real->saldo_jasa) }}</th>
        </tr>
        <tr>
            <td>Sistem Angsuran </td>
            <td colspan="3">:
                {{ $pinkel->jangka }} {{ '@' . $pinkel->sis_pokok->nama_sistem }} = {{ $jum_angsuran }} x
            </td>

        </tr>
        <tr>
            <td>Pokok</td>
            <td>: </td>
            <td width="10%">
                <div align="right">{{ number_format($real->realisasi_pokok) }}</div>
            </td>
            <td width="12%">&nbsp;</td>
            <th class="bottom top">TAGIHAN BULAN DEPAN</th>
            <th class="bottom top">POKOK</th>
            <th class="bottom top">JASA</th>
        </tr>
        <tr>
            <td>Jasa</td>
            <td>: </td>
            <td>
                <div align="right">{{ number_format($real->realisasi_jasa) }}</div>
            </td>
            <td>&nbsp;</td>
            <td>Tunggakan s.d. Bulan Ini</td>
            <td align="right">{{ number_format($tunggakan_pokok) }}</td>
            <td align="right">{{ number_format($tunggakan_jasa) }}</td>
        </tr>
        <tr>
            <td class="bottom">Denda</td>
            <td class="bottom">: </td>
            <td class="bottom">
                <div align="right">{{ number_format($denda) }}</div>
            </td>
            <td class="bottom">&nbsp;</td>
            <td class="bottom">Angsuran Bulan Depan</td>
            <td align="right" style="border-bottom:1px solid #000;">
                {{ number_format($pokok_bulan_depan) }}
            </td>
            <td align="right" style="border-bottom:1px solid #000;">
                {{ number_format($jasa_bulan_depan) }}
            </td>
        </tr>
        <tr>
            <th height="27">JUMLAH BAYAR </th>
            <td>:</td>
            <td>
                <div align="right">
                    <b>
                        {{ number_format($real->realisasi_pokok + $real->realisasi_jasa + $denda) }}
                    </b>
                </div>
            </td>
            <td>&nbsp;</td>
            <th class="bottom">TOTAL TAGIHAN (M+1)</td>
            <th align="right" style="border-bottom:1px solid #000;">
                {{ number_format($tunggakan_pokok + $pokok_bulan_depan + ($tunggakan_jasa + $jasa_bulan_depan)) }}
            </th>
            <th align="right" style="border-bottom:1px solid #000;">&nbsp;</th>

        </tr>

        <tr>
            <td colspan="4">Terbilang : </td>
            <td>
                <div align="center">Diterima Oleh </div>
            </td>
            <td rowspan="5">&nbsp;</td>
            <td>
                <div align="center">Penyetor,</div>
            </td>
        </tr>
        <tr>
            <th colspan="4" rowspan="3">
                {{ strtoupper($keuangan->terbilang($real->realisasi_pokok + $real->realisasi_jasa + $denda)) }} RUPIAH
            </th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" rowspan="2" class="style2 top">
                - <br>
                - Dicetak pada {{ date('Y-m-d H:i:s A') }}<br>
                - Lembar 1 untuk Kelompok, lembar 2 Arsip UPK<br>
                - Bawalah kartu angsuran dan slip ini pada saat mengangsur bulan depan<br>
                - Cek status pinjaman kelompok anda di {{ $kec->web_kec }} </td>
            <th valign="top">
                <div align="center" class="bottom">
                    {{ $nama_user }}
                </div>
            </th>
            <th valign="top">
                <div align="center" class="bottom">&nbsp;</div>
            </th>
        </tr>
        <tr>
            <th colspan="3" valign="middle">&nbsp;</th>
        </tr>
    </table>

    <title>Struk Angsuran Kelompok {{ $pinkel->anggota->namadepan }} &mdash; {{ $pinkel->id }}</title>
</body>
