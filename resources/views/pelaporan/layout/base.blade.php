@php
    if ($type == 'excel') {
        header('Content-type: application/vnd-ms-excel');
        header(
            'Content-Disposition: attachment; filename=' .
                ucwords(str_replace('_', ' ', $laporan)) .
                ' (' .
                ucwords($tgl) .
                ').xls',
        );
    }
@endphp

<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Sistem Informasi Unit Pengelola Kegiatan Berbasis Web">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="upk, online, siupk, upk online, siupk online, asta brata teknologi, abt">
    <meta name="author" content="Enfii">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ ucwords(str_replace('_', ' ', $laporan)) }} ({{ ucwords($tgl) }})</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        html {
            margin: 75.59px;
            margin-left: 94.48px;
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
        table tr td,
        table tr td table.p tr td {
            padding: 2px 4px !important;
        }

        table tr td table tr td {
            padding: 0 !important;
        }

        table.p0 tr th,
        table.p0 tr td {
            padding: 0px !important;
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

<body>
    <header>
        @if ($laporan == 'surat_pengantar')
            <table width="100%" style="border-bottom: 1px double #000; border-width: 4px;">
                <tr>
                    <td width="70">
                        <img src="../storage/app/public/logo/{{ $logo }}" height="70"
                            alt="{{ $kec->id }}">
                    </td>
                    <td align="center">
                        <div>{{ strtoupper($nama_lembaga) }}</div>
                        <div>
                            <b>{{ strtoupper($nama_kecamatan) }}</b>
                        </div>
                        <div style="font-size: 10px; color: grey;">
                            <i>{{ $nomor_usaha }}</i>
                        </div>
                        <div style="font-size: 10px; color: grey;">
                            <i>{{ $info }}</i>
                        </div>
                        <div style="font-size: 10px; color: grey;">
                            <i>{{ $email }}</i>
                        </div>
                    </td>
                </tr>
            </table>
        @else
            <table width="100%" style="border-bottom: 1px solid grey;">
                <tr>
                    <td width="30">
                        <img src="../storage/app/public/logo/{{ $logo }}" width="40"
                            alt="{{ $logo }}">
                    </td>
                    <td>
                        <div style="font-size: 12px;">{{ strtoupper($nama_lembaga) }}</div>
                        <div style="font-size: 12px;">
                            <b>{{ strtoupper($nama_kecamatan) }}</b>
                        </div>
                        <div style="font-size: 8px; color: grey;">
                            <i>{{ $nomor_usaha }}</i>
                        </div>
                        <div style="font-size: 8px;">
                            <i>{{ $info }}</i>
                        </div>
                    </td>
                </tr>
            </table>
        @endif
    </header>

    @php
        $style = 'position: relative; top: 60px; font-size: 12px; padding-bottom: 37.79px;';
        if ($laporan == 'surat_pengantar') {
            $style = 'margin-top: 80px; font-size: 12px; padding-bottom: 37.79px;';
        }
    @endphp

    <main style="{{ $style }}">
        @yield('content')
    </main>
</body>

</html>
