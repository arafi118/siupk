<!DOCTYPE html>
<html>
<head>
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
        .align-center {text-align:center; }
        .align-right {text-align:right; }
    </style>
    <title>{{ $title }}</title>
</head>
<body onload="window.print()">
    @php
        // Calculate transaction count
        $jum_trans = $transaksiCount;
        $parts = explode('-', $transaksi->id_simp);
        $cif=$parts[1];
        // Calculate line breaks needed
        $i = $jum_trans - 1;
        $a = $i % 24;
        $br = ($a <= 10) ? $a : $a + 2;

// Calculate previous balance
$sum = DB::table('real_simpanan_' . session('lokasi'))
    ->where('cif', $cif)
    ->where('tgl_transaksi', '<=', $transaksi->tgl_transaksi)
    ->orderBy('tgl_transaksi', 'desc')
    ->orderBy('id', 'desc')
    ->value('sum') ?? 0;
    
                    $sum_tampil=$sum+$kredit-$debit;
    

@endphp

    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
            <th width="10%" class="style10">
                <br><br><br><br><br>
            </th>
        </tr>

        @for($no = 1; $no <= $br; $no++)
            <tr>
                <th width="10%" class="style9">&nbsp;</th>
            </tr>
        @endfor

        <tr>
            <td width="12%" class="style9 align-center">{{ $transaksi->tgl_transaksi }}</td>
            <td width="5%" class="style9 align-center">{{ $kode }}</td>
            <td width="16%" class="style9 align-center">{{ number_format($debit) }}</td>
            <td width="16%" class="style9 align-center">{{ number_format($kredit) }}</td>
            <td width="16%" class="style9 align-center">{{ number_format($sum_tampil) }}</td>
            <td width="10%" class="style9 align-center">{{ strtoupper($user) }}-{{ $transaksi->idt }}</td>
            <td width="25%" class="style9 align-center">&nbsp;</td>
        </tr>
    </table>
</body>
</html>
