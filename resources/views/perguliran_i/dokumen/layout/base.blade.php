@php
    if ($type == 'excel') {
        header('Content-type: application/vnd-ms-excel');
        header('Content-Disposition: attachment; filename=' . ucwords(str_replace('_', ' ', $judul)) . '.xls');
    }
@endphp

<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucwords(str_replace('_', ' ', $judul)) }}</title>
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

        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
        }

        table tr th,
        table tr td {
            padding: 2px 4px;
        }

        table.p tr th,
        table.p tr td {
            padding: 4px 4px;
        }

        table.p0 tr th,
        table.p0 tr td {
            padding: 0px !important;
        }

        table tr td table:not(.padding) tr td {
            padding: 0 !important;
        }

        table tr.m td:first-child {
            margin-left: 24px;
        }

        table tr.m td:last-child {
            margin-right: 24px;
        }

        table tr.vt td,
        table tr.vb td.vt {
            vertical-align: top;
        }

        table tr.vb td,
        table tr.vt td.vb {
            vertical-align: bottom;
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
    @if ($report != 'suratKuasa')
        <style>
            header {
                position: fixed;
                top: -30px;
                left: 0px;
                right: 0px;
            }

            main {
                position: relative;
                top: 60px;
                font-size: 12px;
                padding-bottom: 37.79px;
            }
        </style>
        <header>
            <table width="100%" style="border-bottom: 1px double #000; border-width: 4px;">
                <tr>
                    <td width="70">
                        <img src="../storage/app/public/logo/{{ $logo }}" height="70"
                            alt="{{ $kec->id }}">
                    </td>
                    <td>
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
        </header>
    @else
        <style>
            main {
                position: relative;
                font-size: 12px;
                top: -20px;
            }
        </style>
    @endif

    <main>
        @yield('content')
    </main>

</body>

</html>
