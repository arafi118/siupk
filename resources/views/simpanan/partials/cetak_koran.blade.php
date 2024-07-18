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
            <p align="center" class="style6">REKENING KORAN {{ strtoupper($simpanan->js->nama_js) }}</p>
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
        <th width="4%" height="30" class="style9">NO</th>
        <th width="8%" class="style9">TANGGAL</th>
        <th width="6%" class="style9">REF</th>
        <th width="40%" class="style9">KETERANGAN</th>
        <th width="10%" class="style9">DEBIT</th>
        <th width="10%" class="style9">KREDIT</th>
        <th width="10%" class="style9">SALDO</th>
        <th width="2%" class="style9">P</th>
    </tr>
    @php /* $no = 0; $saldosamping = 0; @endphp
    @foreach($transaksi as $row2)
    @php
    $no++;
    $rek = \App\Models\Rekening::where(['kd_jb' => $kd_jb, 'kd_rekening' => $row2->rekening_kredit])->count();
    $file = jenisrek("2-{$simpanan->jenis_simpanan}") ? "c_bkm" : "c_bkk";
    $debit = $rek > 0 ? 0 : $row2->jumlah;
    $kredit = $rek > 0 ? $row2->jumlah : 0;
    $prasaldo = $kredit - $debit;
    $saldosamping += $prasaldo;
    $user = \App\Models\User::find($row2->id_user);
    @endphp
    <tr>
        <td width="4%" height="30" class="style9">{{ $no }}</td>
        <td width="10%" class="style9 align-center">{{ $row2->tgl_transaksi }}</td>
        <td width="6%" class="style9 align-center">{{ $row2->idt }}</td>
        <td width="40%" class="style9">{{ $row2->keterangan_transaksi }}</td>
        <td width="10%" class="style9 align-right">{{ number_format($debit) }}</td>
        <td width="10%" class="style9 align-right">{{ number_format($kredit) }}</td>
        <td width="10%" class="style9 align-right">{{ number_format($saldosamping) }}</td>
        <td width="2%" class="style9 align-center">{{ $user->ins }}</td>
    </tr>
    @endforeach
    
    @endphp
</table>
</body>

</html>
