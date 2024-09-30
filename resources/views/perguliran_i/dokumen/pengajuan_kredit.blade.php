@php
    use App\Utils\Tanggal;
    use App\Utils\Keuangan;

    $keuangan = new Keuangan();
@endphp

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
    table tr td {
        padding: 2px 4px;
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

<title>{{ $judul }}</title>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
    <tr>
        <td width="30">&nbsp;</td>
        <td width="30">Nomor</td>
        <td width="5" align="right">:</td>
        <td width="500">
            ______/ ______/{{ Tanggal::tglRomawi($pinkel->tgl_proposal) }}
        </td>
    </tr>
    
    <tr>
        <td width="30">&nbsp;</td>
        <td width="30">Perihal</td>
        <td width="5" align="right">:</td>
        <td width="500">
            <b>Pengajuan Kredit</b>
        </td>
    </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
    <tr>
        <td width="175">&nbsp;</td>
        <td width="100">
            <div>Kepada Yth.</div>
            <div>{{ $kec->sebutan_level_1 }}</div>
            <div>{{ $kec->nama_lembaga_sort }}</div>
            <div>{{ $kec->sebutan_kec }} {{ $kec->nama_kec }}</div>
            <div>Di Tempat</div>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
    <tr>
        <td colspan="3" align="center">
            <div style="font-size: 50px;">
                
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="3" height="5"></td>
    </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
    <tr>
        <td width="30">&nbsp;</td>
        <td colspan="3">Yang bertanda tangan di bawah ini :</td>
    </tr>
    <tr>
        <td width="30">&nbsp;</td>
        <td width="80">Nama Lengkap</td>
        <td width="5" align="right">:</td>
        <td style="font-weight: bold;">{{ $pinkel->anggota->namadepan }}</td>
    </tr>
    <tr>
        <td width="30">&nbsp;</td>
        <td>Jenis Kelamin</td>
        <td width="5" align="right">:</td>
        <td style="font-weight:">{{$pinkel->anggota->jk}}</td>
    </tr>
    <tr>
        <td width="30">&nbsp;</td>
        <td>NIK</td>
        <td width="5" align="right">:</td>
        <td style="font-weight: ">{{$pinkel->anggota->nik}}</td>
    </tr>
    <tr>
        <td width="30">&nbsp;</td>
        <td>Tempat/Tanggal lahir</td>
        <td width="5" align="right">:</td>
        <td style="font-weight: ">
        {{ $pinkel->anggota->tempat_lahir}}, 
              {{ Tanggal::tglLatin($pinkel->anggota->tgl_lahir) }}</td>
    </tr>
    <tr>
        <td width="30">&nbsp;</td>
        <td>Alamat</td>
        <td width="5" align="right">:</td>
        <td style="font-weight: ">{{ $pinkel->anggota->d->nama_desa }}</td>
    </tr>
    <tr>
        <td width="30">&nbsp;</td>
        <td>Telpon</td>
        <td width="5" align="right">:</td>
        <td style="font-weight: ">{{ $pinkel->anggota->hp}}</td>
    </tr>
    <tr>
        <td width="30">&nbsp;</td>
        <td>Usaha</td>
        <td width="5" align="right">:</td>
        <td style="font-weight:">
        @if (is_numeric($pinkel->anggota->usaha))
            {{$pinkel->anggota->u->nama_usaha}}
        @else
            {{$pinkel->anggota->usaha}}
        @endif
        </td>
    </tr>
   
        <td width="30">&nbsp;</td>
        <td colspan="3">
            <div>
            Dalam  hal ini bertindak untuk dan atas nama diri sendiri, dengan ini bermaksud mengajukan               
                permohonan kredit sebesar Rp. {{ number_format($pinkel->proposal) }}
                ({{ $keuangan->terbilang($pinkel->proposal) }}). 
                {{ $pinkel->pinjaman_anggota_count }}Kredit atau pinjaman tersebut di atas, akan kami
                kembalikan dalam jangka waktu {{ $pinkel->jangka }} bulan, dengan sistem angsuran
                {{ $pinkel->sis_pokok->nama_sistem }} ({{ $pinkel->sis_pokok->deskripsi_sistem }}).
            </div>
            <div>
                Sebagai bahan pertimbangan, bersama ini kami lampirkan:
            </div>
            <ol>
                <li>Fotokopi KTP dan KK;</li>
                <li>Surat Rekomendasi dari Kepala Desa/Lurah;</li>
                <li>Surat Kesanggupan Penyerahan Jaminan;</li>
                <li>Surat Pernyataan Piutang;</li>
                <li>Tabel Rencana Angsuran;</li>
                <!-- <li>Surat Keterangan Gaji/Surat Keterangan Usaha.</li> -->
            </ol>
            <div>Demikian permohonan kami, atas perhatiannya kami ucapkan terima kasih.</div>
        </td>
    </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px; margin-top: 40px;">
    
    <tr>
      <td width="30%" class="style9 align-justify">&nbsp;</td>
      <td width="20%" class="style9 align-justify">&nbsp;</td>
      <td width="30%" class="style9 align-justify"><div align="center">{{ $kec->nama_kec }}, {{ Tanggal::tglLatin($pinkel->tgl_proposal) }}<br>
      </div></td>
	<tr>
        <td width="32%" height="36" colspan="1" class="style26"><div align="center" class="style9">
          <p>Mengetahui,<br>Penjamin</p>
        </div></td><td>&nbsp;</td>
        <td class="style26"><div align="center" class="style9">
          <p>Pemohon <br>&nbsp;</p>
        </div></td>
      </tr>	
	<tr>
	    <td align="center" height="24" colspan="-1" class="style9">
            <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>{{$pinkel->anggota->penjamin}}<br></th>
    </td>
    <td>&nbsp;</td>
        <td align="center" width="32%" class="style9"><p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>{{$pinkel->anggota->namadepan}}<br> </p></td>
  </tr>
    <tr>
        <td colspan="2" height="30"></td>
    </tr>
    
</table>
