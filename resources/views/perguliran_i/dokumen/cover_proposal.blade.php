@php
    use App\Utils\Keuangan;
    use App\Utils\Tanggal;
    if (Keuangan::startWith($kec->kabupaten->nama_kab, 'KOTA') || Keuangan::startWith($kec->kabupaten->nama_kab, 'KAB')) {
        $nama_kab = ucwords(strtolower($kec->kabupaten->nama_kab));
    } else {
        $nama_kab = ' Kabupaten ' . ucwords(strtolower($kec->kabupaten->nama_kab));
    }
@endphp

<title>COVER PROPOSAL ({{ $pinkel->anggota->namadepan . ' - Loan ID. ' . $pinkel->id }})</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
    }

    html {
        margin: 75.59px;
        margin-left: 94.48px;
    }

    body {
        width: 100%;
        height: fit-content;
        border: 1px solid #000;
        position: relative;
    }

    header {
        position: relative;
        top: 60px;
        text-align: center;
    }

    footer {
        position: absolute;
        bottom: 0px;
        width: 100%;
        border-top: 1px solid #000;
    }

    .center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .bottom {
        position: absolute;
        bottom: 12%;
        width: 100%;
        text-align: center;
    }
</style>

<body>
    <header>
        <h1 style="margin: 0px;">DOKUMEN <br> PERMOHONAN KREDIT</h1>
        
    </header>

    <main>
        <div class="center">
            <img src="../storage/app/public/logo/{{ $logo }}" width="290" alt="{{ $logo }}">
            <div style="margin-top: 10px; font-size: 18px;">
             Pemohon :
            </div>
            <div style="margin-top: 10px; font-size: 20px;">
                 {{ $pinkel->anggota->namadepan }} 
            </div>
            <div style="font-size: 17px;">
            NIK: {{$pinkel->anggota->nik}}     
               </div>
             <div style="margin-top: 10px; font-size: size: 18px;">
                {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }} {{ $pinkel->anggota->d->nama_desa }}
            </div> <br> <br> <br> <br> <br>
            <div style="margin: 0px; font-size: 18px;">
                Jenis Kredit : <br> {{ strtoupper($pinkel->jpp->nama_jpp) }}
            </div>
        </div>
        
        <div class="bottom">
            <div style="font-weight: bold;">Pengajuan Rp. {{ number_format($pinkel->proposal) }}</div>
            <div style="font-weight: bold;">Tanggal Proposal {{ Tanggal::tglLatin($pinkel->tgl_proposal) }}</div>
            <div style="font-weight: bold;">Tenor {{ $pinkel->jangka }} Bulan</div>
            <div style="font-weight: bold;"> </div>
            <div style="font-weight: bold;"> </div>


        </div>
    </main>

    <footer>
        <table width="100%">
            <tr>
                <td align="center">
                    <div>{{ strtoupper($nama_lembaga) }} </div>
                    <div>
                        <b>{{ strtoupper($nama_kecamatan) }} </b>
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
                    <div style="font-size: 10px; color: grey; margin-top: 10px;">
                        <i> </i>
                    </div>
                </td>
            </tr>
        </table>
    </footer>
</body>
