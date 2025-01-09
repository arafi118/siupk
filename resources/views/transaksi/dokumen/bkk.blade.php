<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKTI KAS KELUAR</title>
    <style>
        body {
            font-size: 9px;
            color: rgba(0, 0, 0, 0.8);
            font-family: Arial, Helvetica, sans-serif;
            padding: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .box {
            width: 14cm;
            min-height: 9cm;
            border: 2px solid #000;
            padding: 16px 22px 12px 12px;
            display: flex;
            flex-direction: column;
        }

        .box-header {
            padding: 0 16px 8px 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.5);
        }

        .box-body {
            flex: 1;
            padding: 0 24px;
            display: flex;
            flex-direction: column;
        }

        .content-section {
            flex: 1;
        }

        .signature-section {
            margin-top: auto;
            padding-top: 20px;
            padding-bottom: 10px;
        }

        .flex {
            display: flex;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fs-10 { font-size: 10px; }
        .fs-12 { font-size: 12px; }

        .ml-4 { margin-left: 4px; }

        .align-items-center {
            align-items: center;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .keterangan {
            padding: 2px 4px;
            font-weight: normal;
        }

        h1 {
            text-align: center;
            font-size: 14px;
            margin: 10px 0;
        }

        table {
            width: 100%;
        }

        .main-content td {
            padding: 4px 0;
        }

        .signature-table td {
            text-align: center;
            padding: 4px 0;
        }

        .signature-space {
            height: 40px;
        }
    </style>
</head>
<body onLoad="window.print()">
    <div class="box">
        <div class="box-header flex align-items-center justify-content-between fs-10">
            <div class="flex align-items-center">
                <img src="<?php echo $gambar; ?>" width="50" height="50">
                <div class="ml-4">
                    <div class="block fw-bold">{{ strtoupper($kec->nama_lembaga_sort) }}</div>
                    <div class="block fw-bold">
                        {{ strtoupper('Kec. ' . $kec->nama_kec . ' Kab. ' . $kec->kabupaten->nama_kab . ' ' . $kec->kabupaten->nama_prov) }}
                    </div>
                    <div class="block fs-10">{{ 'SK Kemenkumham RI No. ' . $kec->nomor_bh }}</div>
                    <div class="block fs-10">{{ $kec->alamat_kec . ', Telp. ' . $kec->telpon_kec }}</div>
                </div>
            </div>
            <div>
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td>:</td>
                        <td><?php echo $trx->idt . '/BKK'; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{ Tanggal::tglIndo($trx->tgl_transaksi) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="box-body fs-12">
            <div class="content-section">
                <h1>BUKTI KAS KELUAR</h1>
                <table class="main-content">
                    <tr>
                        <td width="30%">Dibayar Kepada</td>
                        <td width="2%">:</td>
                        <td class="keterangan">
                            @if ($trx->id_pinj > 0)
                                {{ ucwords('Kelompok ' . $trx->relasi) }}
                            @else
                                {{ ucwords($trx->relasi) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td class="keterangan">{{ ucwords($trx->keterangan_transaksi) }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td class="keterangan">Rp. {{ number_format($trx->jumlah, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Kode Akun (D/K)</td>
                        <td>:</td>
                        <td class="keterangan">
                            Debit {{ ucwords($trx->rekening_debit . ' - ' . $trx->rek_debit->nama_akun) }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="keterangan">
                            Kredit {{ ucwords($trx->rekening_kredit . ' - ' . $trx->rek_kredit->nama_akun) }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="signature-section">
                <table class="signature-table">
                    <tr>
                        <td align="center">Disetujui,</td>
                        <td align="center">Diverifikasi,</td>
                        <td align="center">Disiapkan Oleh :</td>
                    </tr>
                    <tr>
                        <td align="center"><?php echo $kec->sebutan_level_1; ?></td>
                        <td align="center"><?php echo $kec->sebutan_level_3; ?></td>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="signature-space"></td>
                    </tr>
                    <tr>
                        <td align="center">{{ $dir->namadepan . ' ' . $dir->namabelakang }}</td>
                        <td align="center">{{ $sekr->namadepan . ' ' . $sekr->namabelakang }}</td>
                        <td align="center"><?php echo $kec->disiapkan; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
