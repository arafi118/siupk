@php
$startDate = \Carbon\Carbon::createFromDate(
    $tahunkop, 
    $bulankop == 0 ? 1 : $bulankop, 
    1
)->startOfMonth();

// Calculate previous balance
$sum = DB::table('real_simpanan_' . session('lokasi'))
    ->where('cif', $cif)
    ->where('tgl_transaksi', '<', $startDate)
    ->orderBy('tgl_transaksi', 'desc')
    ->orderBy('id', 'desc')
    ->value('sum') ?? 0;

    // Array bulan dalam bahasa Indonesia
    $bulanIndo = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    // Cek apakah bulan 0 atau nilai bulan lainnya
    $bulanTeks = $bulankop == 0 ? "Sepanjang Tahun $tahunkop" : $bulanIndo[$bulankop] . " $tahunkop";
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icon/favicon.png">
    <link rel="icon" type="image/png" href="/assets/img/icon/favicon.png">
    <title>
        {{ $title }} &mdash; Aplikasi SIUPK
    </title>

    <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro" />

    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link id="pagestyle" href="/assets/css/material-dashboard.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <style>
    .style6 { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; }
.style9 { font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #000000; }
.style10 { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000; }
.style26 { font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; }
.style27 { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000000; }

        .top {border-top: 1px solid #000000; }
        .bottom {border-bottom: 1px solid #000000; }
        .left {border-left: 1px solid #000000; }
        .right {border-right: 1px solid #000000; }
        .all {border: 1px solid #000000; }
        .align-justify {text-align:justify; }
    .align-center {
        text-align: center;
        padding-left: 5px;
        padding-right: 5px;
    }

    .align-right {
        text-align: right;
        padding-left: 5px;
        padding-right: 5px;
    }

    .align-left {
        text-align: left;
        padding-left: 5px;
        padding-right: 5px;
    }
</style>


</head>
<body class="g-sidenav-show  bg-gray-200" onload="window.print()">
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
        <td height="20" colspan="2" class="bottom">
            <div class="style9 text-align-left">{{ $kec->nama_lembaga_sort }} Kecamatan {{ $kec->nama_kec }}<br>
                {{ $kec->alamat_kec }} <i class="fa fa-phone-square"></i> {{ $kec->telpon_kec }}
            </div>
        </td>
        <td height="20" colspan="2" class="">
            <div align="right" class="style9">Dokumen Simpanan<br>
                CIF - {{ $simpanan->id }}
            </div>
        </td>
    </tr>
    <tr>
        <td height="50" colspan="4" class="">
            <p align="center" class="style6">REKENING KORAN {{ strtoupper($simpanan->js->nama_js) }} <br> {{$bulanTeks}}</p>
        </td>
    </tr>
    <tr>
        <td width="19%" height="20" class="style9">Nomor Rekening</td>
        <td width="32%" height="20"><span class="style9">:</span><span class="style27"> {{ strtoupper($simpanan->nomor_rekening) }}</span></td>
    </tr>
    <tr>
        <td height="20" class="style9">CIF / NIK </td>
        <td height="20"><span class="style9">:</span><span class="style27"> {{ $simpanan->id }} / {{ $simpanan->anggota->nik }} </span></td>
    </tr>
    <tr>
        <td width="19%" height="20" class="style9">Nama Kreditur</td>
        <td width="42%" height="20"><span class="style9">:</span><span class="style27"> {{ $simpanan->anggota->namadepan }}</span></td>
    </tr>
    <tr>
        <td height="20" class="style9">Tanggal Buka </td>
        <td height="20"><span class="style9">:</span><span class="style27"> {{($simpanan->tgl_buka) }}</span></td>
    </tr>
    @if($simpanan->jenis_simpanan == 3)
    <tr>
        <td height="20" class="style9">Jenis Program </td>
        <td height="20"><span class="style9">:</span><span class="style27"> {{ $simpanan->catatan_simpanan }}</span></td>
    </tr>
    @endif
    <tr>
        <td height="20" class="style9">Alamat </td>
        <td height="20"><span class="style9">:</span><span class="style27"> {{ $simpanan->anggota->alamat }}</span></td>
    </tr>
    <tr>
        <td height="20" class="style9">Telpon</td>
        <td height="20"><span class="style9">:</span><span class="style27"> {{ $simpanan->anggota->hp }}</span></td>
    </tr>
</table>
<table width="96%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
        <th width="4%" height="30" class="align-center">NO</th>
        <th width="8%" class="align-center">TANGGAL</th>
        <th width="6%" class="align-center">REF</th>
        <th width="40%" class="align-center">KETERANGAN</th>
        <th width="10%" class="align-center">DEBIT</th>
        <th width="10%" class="align-center">KREDIT</th>
        <th width="10%" class="align-center">SALDO</th>
        <th width="2%" class="align-center">P</th>
    </tr>
    @php  $no = 0;  @endphp
    
        @if ($bulankop != 0 && $tahunkop != 0 ) 
            <tr>
                <th colspan="3">&nbsp;</th>
                <th colspan="3" class="text-left">
                    <strong>Saldo Sebelum {{ \Carbon\Carbon::create(null, $bulankop)->translatedFormat('F') }} {{ $tahunkop }}</strong>
                </th>
                <th class="style9 align-right">{{ number_format($sum, 0, ',', '.') }}</td>
                <th colspan="2">&nbsp;</th>
            </tr>
        @elseif($bulankop != 0 && $tahunkop == 0 )
            <tr>
                <th colspan="9" class="text-center">
                    <strong>mohon untuk memilih tahun juga</strong>
                </th>
            </tr>
        @elseif($bulankop == 0 && $tahunkop != 0 )
            <tr>
                <th colspan="3">&nbsp;</th>
                <th colspan="3" class="text-left">
                    <strong>Saldo Sebelum {{ $tahunkop }})</strong>
                </th>
                <th class="style9 align-right">{{ number_format($sum, 0, ',', '.') }}</th>
                <th colspan="2">&nbsp;</th>
                </th>
            </tr>
        @endif
                @forelse($transaksi as $index => $trx)

            @php
                $id_simp = $trx->id_simp; //ini nanti di ganti ambil dari real_simpanan_$lokasi
                    if (strpos($id_simp, '-') !== false) {
                        // Jika ada tanda "-", pisahkan menjadi dua bagian
                        list($kd_trx, $cif) = explode("-", $id_simp);
                    } else {
                        // Jika tidak ada tanda "-", atur kd_trx = 0 dan cif = id_simp
                        $kd_trx = 0;
                        $cif = $id_simp;
                    }

                
                    $jumlah = floatval($trx->jumlah); // Ensure $trx->jumlah is numeric
                    
                    if(in_array(substr($trx->id_simp, 0, 1), ['1', '2', '5'])) {
                        $real_d = 0;
                        $real_k = $jumlah;
                        $sum += $jumlah;
                    } elseif(in_array(substr($trx->id_simp, 0, 1), ['3', '4', '6', '7'])) {
                        $real_d = $jumlah;
                        $real_k = 0;
                        $sum -= $jumlah;
                    } else {
                        $real_d = 0;
                        $real_k = 0;
                    }
                        
            @endphp
    <tr>
        <td width="4%" height="30" class="style9">{{ $index + 1 }}</td>
        <td width="15%" class="style9 align-center">{{ $trx->tgl_transaksi }}</td>
        <td width="6%" class="style9 align-center">{{ $trx->idt }}</td>
        <td width="35%" class="style9">{{ $trx->keterangan_transaksi }}</td>
        <td width="10%" class="style9 align-right">{{ number_format($real_d) }}</td>
        <td width="10%" class="style9 align-right">{{ number_format($real_k) }}</td>
        <td width="10%" class="style9 align-right">{{ number_format($sum) }}</td>
        <td width="2%" class="style9 align-center">{{ $trx->id_user }}</td>
    </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada transaksi di periode ini</td>
                </tr>
            @endforelse
            <tr>
                <td colspan="6" class="text-center">
                    <b>TOTAL SALDO</b>
                </td>
                <td class="style9 align-right"><b>{{ number_format($sum, 0, ',', '.') }}</b></td>
                <td colspan="2">&nbsp;</td>
            </tr>
</table>
</body>

</html>
