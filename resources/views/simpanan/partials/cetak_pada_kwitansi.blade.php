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
    <br><br><br>
    <table width="97%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
            <th width="5%" class="style9">&nbsp;</th>
            <td width="80%" class="style9">
                {{ $transaksi->idt }}.{{ $transaksi->nomor_rekening }} {{ $transaksi->tgl_transaksi }}-{{ strtoupper($user) }}<br>
                CIF-{{ $transaksi->id_simp }}-{{ $kode }}<br>
                Rp. {{ number_format($transaksi->jumlah) }}<br><br>
            </td>
        </tr>
    </table>
</body>
</html>
