@php
    use App\Utils\Tanggal;
    use App\Models\RencanaAngsuran;

    $rowspan = 19;
    if ($nia->real_i_count > 16) {
        $rowspan = $nia->real_i_count + 3;
    }
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucwords(str_replace('_', ' ', $laporan)) }}</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        html {
            /* margin-left: 90px; */
            /* margin-right: 0px; */
            margin-bottom: 100px;
        }

        ul,
        ol {
            margin-left: -10px;
            page-break-inside: auto !important;
        }

        header {
            position: fixed;
            top: -10px;
            left: 0px;
            right: 0px;
        }

        table tr th,
        table tr td {
            padding: 2px 4px;
        }

        table tr th {
            font-size: 12px;
        }

        .break {
            page-break-after: always;
        }

        li {
            text-align: justify;
        }

        .l {
            border-left: 1px solid #000;
        }

        .t {
            border-top: 1px solid #000;
        }

        .r {
            border-right: 1px solid #000;
        }

        .b {
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body onload="window.print()">
    <main style="position: relative; font-size: 12px;">
        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td rowspan="7" align="center" width="400">
                    <div style="font-size: 14px; font-weight: bold;">
                        {{ $kec->nama_lembaga_sort }}
                    </div>
                    <div>
                        {{ $kec->alamat_kec }}
                    </div>
                    <div>
                        Telp. {{ $kec->telpon_kec }}
                    </div>
                    <div style="margin-top: 8px;">
                        <img width="150" src="data:image/png;base64,{{ $barcode }}"
                            alt="{{ $nia->anggota->nik }}">
                    </div>
                    <div style="font-size: 14px;">{{ $nia->anggota->nik }}</div>
                </td>
                <td width="150">Jenis Pinjaman</td>
                <td width="5" align="center">:</td>
                <td width="200">{{ $nia->jpp->nama_jpp }}</td>
                <td width="150">Loan Id.</td>
                <td width="5" align="center">:</td>
                <td width="200">{{ $nia->id }}</td>
            </tr>
            <tr>
                <td>Nama Peminjam</td>
                <td align="center">:</td>
                <td style="font-weight: bold;" colspan="4">{{ $nia->anggota->namadepan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td align="center">:</td>
                <td colspan="4">{{ $nia->anggota->alamat }}</td>
            </tr>
            <tr>
                <td>Telpon/SMS</td>
                <td align="center">:</td>
                <td>{{ $nia->anggota->hp }}</td>
                <td>Jumlah Angsuran</td>
                <td align="center">:</td>

                @php
                    $jumlah_angsuran = 0;
                    foreach ($nia->rencana as $renc) {
                        if ($jumlah_angsuran == 0) {
                            if ($renc->wajib_pokok + $renc->wajib_jasa > $jumlah_angsuran) {
                                $jumlah_angsuran = $renc->wajib_pokok + $renc->wajib_jasa;
                            }
                        }
                    }
                @endphp

                <td>{{ number_format($jumlah_angsuran) }} /
                    {{ $nia->sis_pokok->nama_sistem }}</td>
            </tr>
            <tr>
                <td>Tgl Cair</td>
                <td align="center">:</td>
                <td>{{ Tanggal::tglLatin($nia->tgl_cair) }}</td>
                <td>Jangka</td>
                <td align="center">:</td>
                <td>{{ $nia->jangka }} {{ $nia->sis_pokok->id == '12' ? 'Minggu' : 'Bulan' }}</td>
            </tr>
            <tr>
                <td>Alokasi</td>
                <td align="center">:</td>
                <td>{{ number_format($nia->alokasi) }}</td>
                <td>Jasa</td>
                <td align="center">:</td>
                <td>{{ $nia->pros_jasa / $nia->jangka . '%' }}</td>
            </tr>
            <tr>
                <td>&nbsp</td>
                <td align="center">&nbsp</td>
                <td>&nbsp</td>
                <td>&nbsp</td>
                <td align="center">&nbsp</td>
                <td>&nbsp</td>
            </tr>
            <tr>
                <td colspan="7" class="b t" style="font-weight: bold; font-size: 24px;" align="center">
                    KARTU ANGSURAN
                </td>
            </tr>
        </table>
        @php
            $baris_angsuran = ceil($nia->rencana_count / 2);
        @endphp

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td width="40">&nbsp;</td>
                <td colspan="9" style="font-weight: bold;" height="30">TABEL KEWAJIBAN PEMBAYARAN ANGSURAN</td>
                <td width="40">&nbsp;</td>
            </tr>

            <tr style="font-weight: bold;">
                <th rowspan="{{ $baris_angsuran + 1 }}">&nbsp;</th>
                <th height="30" class="l t b" align="center">Ke</th>
                <th class="l t b" align="center">Tanggal</th>
                <th class="l t b" align="center">Pokok</th>
                <th class="l t b r" align="center">Jasa</th>

                <th>&nbsp;</th>

                <th class="l t b" align="center">Ke</th>
                <th class="l t b" align="center">Tanggal</th>
                <th class="l t b" align="center">Pokok</th>
                <th class="l t b r" align="center">Jasa</th>
                <th rowspan="{{ $baris_angsuran + 1 }}">&nbsp;</th>
            </tr>
            @for ($j = 1; $j <= $baris_angsuran; $j++)
                @php
                    $i = $j - 1;
                @endphp
                <tr>
                    <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="center">
                        {{ $nia->rencana[$i]->angsuran_ke }}
                    </td>
                    <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="center">
                        {{ Tanggal::tglIndo($nia->rencana[$i]->jatuh_tempo) }}
                    </td>
                    <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="right">
                        {{ number_format($nia->rencana[$i]->wajib_pokok) }}
                    </td>
                    <td class="l {{ $j == $baris_angsuran ? 'b' : '' }} r" align="right">
                        {{ number_format($nia->rencana[$i]->wajib_jasa) }}
                    </td>

                    <td>&nbsp;</td>

                    @if (isset($nia->rencana[$i + $baris_angsuran]))
                        <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="center">
                            {{ $nia->rencana[$i + $baris_angsuran]->angsuran_ke }}
                        </td>
                        <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="center">
                            {{ Tanggal::tglIndo($nia->rencana[$i + $baris_angsuran]->jatuh_tempo) }}
                        </td>
                        <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="right">
                            {{ number_format($nia->rencana[$i + $baris_angsuran]->wajib_pokok) }}
                        </td>
                        <td class="l {{ $j == $baris_angsuran ? 'b' : '' }} r" align="right">
                            {{ number_format($nia->rencana[$i + $baris_angsuran]->wajib_jasa) }}
                        </td>
                    @else
                        <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="center">

                        </td>
                        <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="center">

                        </td>
                        <td class="l {{ $j == $baris_angsuran ? 'b' : '' }}" align="right">

                        </td>
                        <td class="l {{ $j == $baris_angsuran ? 'b' : '' }} r" align="right">

                        </td>
                    @endif
                </tr>
            @endfor

        </table>

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td width="40" rowspan="{{ $rowspan }}">&nbsp;</td>
                <td colspan="9" style="font-weight: bold;" height="30">REALISASI PEMBAYARAN ANGSURAN</td>
                <td width="40" rowspan="{{ $rowspan }}">&nbsp;</td>
            </tr>
            <tr>
                <th class="l t b" rowspan="2">No</th>
                <th class="l t b" rowspan="2">Tanggal</th>
                <th class="l t" colspan="2">Pokok</th>
                <th class="l t" colspan="2">Jasa</th>
                <th class="l t" colspan="2">Saldo Piutang</th>
                <th class="l t r b" rowspan="2">Sign</th>
            </tr>
            <tr>
                <th class="l b t">Dibayar</th>
                <th class="l b t">Tunggakan</th>
                <th class="l b t">Dibayar</th>
                <th class="l b t">Tunggakan</th>
                <th class="l b t">Pokok</th>
                <th class="l b t">Jasa</th>
            </tr>

            @php
                $jumlah = 0;
            @endphp
            @foreach ($nia->real_i as $real)
                @php
                    $jumlah++;
                    $nomor = $loop->iteration;

                    $b = $nomor + 3 == $rowspan ? 'b' : '';
                @endphp
                <tr>
                    <td class="l {{ $b }}" align="center">{{ $nomor }}</td>
                    <td class="l {{ $b }}" align="center">{{ Tanggal::tglIndo($real->tgl_transaksi) }}
                    </td>
                    <td class="l {{ $b }}" align="right">{{ number_format($real->realisasi_pokok) }}
                    </td>
                    <td class="l {{ $b }}" align="right">
                        {{ number_format($real->tunggakan_pokok < 0 ? 0 : $real->tunggakan_pokok) }}
                    </td>
                    <td class="l {{ $b }}" align="right">{{ number_format($real->realisasi_jasa) }}</td>
                    <td class="l {{ $b }}" align="right">
                        {{ number_format($real->tunggakan_jasa < 0 ? 0 : $real->tunggakan_jasa) }}
                    </td>
                    <td class="l {{ $b }}" align="right">{{ number_format($real->saldo_pokok) }}</td>
                    <td class="l {{ $b }}" align="right">{{ number_format($real->saldo_jasa) }}</td>
                    <td class="l {{ $b }} r" align="center">{{ $real->id }}</td>
                </tr>
            @endforeach

            @if ($jumlah < 16)
                @for ($i = 1; $i <= 16 - $jumlah; $i++)
                    <tr>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }}" align="center">&nbsp;</td>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }}" align="center">&nbsp;</td>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }}" align="right">&nbsp;</td>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }}" align="right">&nbsp;</td>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }}" align="right">&nbsp;</td>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }}" align="right">&nbsp;</td>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }}" align="right">&nbsp;</td>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }}" align="right">&nbsp;</td>
                        <td class="l {{ $i == 16 - $jumlah ? 'b' : '' }} r" align="center">&nbsp;</td>
                    </tr>
                @endfor
            @endif
        </table>

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td width="40" rowspan="5">&nbsp;</td>
                <td colspan="3" style="font-weight: bold;" height="30">&nbsp;</td>
                <td width="40" rowspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td width="350" rowspan="3">
                    <div>Lembar 1 : Untuk Peminjam</div>
                    <div>Lembar 2 : Arsip Lembaga</div>
                </td>
                <td style="font-weight: bold; font-size: 12px;" width="350" align="center">
                    <div>{{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}</div>
                </td>
                <td style="font-weight: bold; font-size: 12px;" width="350" align="center">Peminjam</td>
            </tr>
            <tr>
                <td colspan="2" height="50"></td>
            </tr>
            <tr style="font-weight: bold; font-size: 12px; text-transform: uppercase;">
                <td width="350" align="center">
                    <div>{{ $dir->namadepan }} {{ $dir->namabelakang }}</div>
                </td>
                <td width="350" align="center">
                    {{ $nia->anggota->namadepan }}
                </td>
            </tr>
            <tr>
                <td colspan="3" style="font-weight: bold;" height="10">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5">
                    <ol>
                        <b>Perhatian:</b>
                        <li>Bayarlah angsuran tepat waktu sesuai dengan jadwal diatas.</li>
                        <li>Untuk memudahkan pelayanan, bawalah kartu ini dan slip pembayaran terakhir setiap melakukan
                            angsuran.</li>
                        <li>Jagalah keutuhan kartu dan tidak melipatnya, jika hilang segera lapor
                            {{ $kec->nama_lembaga_sort }}.</li>
                        <li>Jika lembar ini tidak mencukupi, cetak pada lembar baliknya dengan dibubuhi stempel
                            {{ $kec->nama_lembaga_sort }}. </li>
                    </ol>
                </td>
            </tr>
        </table>
    </main>
</body>

</html>
