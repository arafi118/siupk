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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" style="margin-top:10px;">
    <tr>
        <td class="style9">&nbsp;<br>&nbsp;<br></td>
    </tr>
    <tr>
        <td colspan="2" class="style9">&nbsp;</td>
        <td width="10%" class="style9 align-right">&nbsp;</td>
        <td width="30%" class="style9">&nbsp;</td>
    </tr>
    <tr>
        <td class="style9">Rekening </td>
        <td class="style9">: {{ $simpanan->nomor_rekening }}</td>
        <td width="10%" class="style9 align-right"><strong> CIF - {{ $simpanan->id }} </strong></td>
    </tr>
    <tr>
        <td width="20%" class="style9">Nama Nasabah </td>
        <td colspan="2" class="style9">: {{ $simpanan->anggota->namadepan }}</td>
    </tr>
    <tr>
        <td class="style9">Alamat </td>
        <td colspan="2" class="style9">: {{ $simpanan->anggota->alamat }} {{ $simpanan->nama_desa }}</td>
    </tr>
    <tr>
        <td class="style9">Telpon</td>
        <td colspan="2" height="5" class="style9">: {{ $simpanan->anggota->hp }}</td>
    </tr>
    <tr>
        <td class="style9">Jenis Simpanan </td>
        <td colspan="2" class="style9">: {{ $simpanan->js->nama_js }}</td>
    </tr>
</table>

</body>

</html>
