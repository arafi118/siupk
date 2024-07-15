<title>COVER</title>
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

    img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<body>
<table width="100%" border="0"style="font-size: 10px;>
            <tr>
                <td align="center">
                    <div>{{ strtoupper($nama_lembaga) }}</div>
                    <div>
                        <b>{{ strtoupper($nama_kecamatan) }}</b>
                    </div>
                    <div style="font-size: 10px; color: grey;">
                        <i>{{ $info }}</i>
                    </div>
                    <hr style="border: none; border-top: 1px solid grey; margin: 10px 0;">

                  
                    
                </td>
            </tr>
        </table>

    <header>

        <h1 style="margin: 0px;">{{ strtoupper($judul) }}</h1>
        <div style="margin: 0px; font-size: 24px;">{{ strtoupper($sub_judul) }}</div>
        <main><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <table width="25%" border="0" align="center"style="font-size: 13px;">
        <tr>
            <td align="center"colspan="2">Disusun Oleh</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td width="15">Ketua</td>
            <td width="15" colspan="1">:</td>
        </tr>
        <tr>
            <td width="15">Sekretaris</td>
            <td width="15" colspan="1">:</td>
        </tr>
        <tr>
            <td width="15">Bendahara</td>
            <td width="15" colspan="1">:</td>
        </tr>
        <tr>
            <td width="15">Staff UPK</td>
            <td width="15" colspan="1">:</td>
        </tr>
       </table>

</main>
    </header>

    <main>
        <img src="../storage/app/public/logo/{{ $logo }}" width="290" alt="{{ $logo }}">
     
    </main>
    <table>
        <tr></tr>
    </table>
    
    <footer>
        <table width="100%">
            <tr>
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
                    <div style="font-size: 10px; color: grey; margin-top: 10px;">
                        <i>Tahun {{ $tahun }}</i>
                    </div>
                </td>
            </tr>
        </table>
    </footer>
</body>
