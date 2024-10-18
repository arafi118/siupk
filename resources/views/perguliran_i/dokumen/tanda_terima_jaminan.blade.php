@php
    use App\Utils\Tanggal;
    $jaminan  = json_decode($pinkel->jaminan, true);
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')

<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">        
      <tr>
        <td height="50" colspan="3" class="bottom">
          <p align="center" class="style6" style="font-size: 18px; font-weight: bold;">KESANGGUPAN<br>PENGADAAN BARANG JAMINAN</p>
        </td>
      </tr>      
      <tr>
        <td height="10" colspan="3" class="style9"></td>
      </tr>
      <tr>
        <td height="10" colspan="3" class="style9">Yang bertanda tangan dibawah ini,</td>
      </tr>
      <tr>
        <td width="5">&nbsp;</td>
        <td height="10" class="style9">Nama Lengkap </td>
        <td class="style27" >: {{$pinkel->anggota->namadepan}}</td>
      </tr>
      <tr>
        <td width="5">&nbsp;</td>
        <td height="10" class="style9">NIK</td>
        <td class="style27">: {{$pinkel->anggota->nik}}</td>
      </tr>
      <tr>
        <td width="5">&nbsp;</td>
        <td width="20%" height="10" class="style9">Alamat</td>
        <td width="42%" class="style27">: {{ $pinkel->anggota->d->nama_desa }}</td>
      </tr>
	    <tr>
        <td width="5">&nbsp;</td>
        <td height="10" class="style9">Nomor HP</td>
        <td class="style27">: {{ $pinkel->anggota->hp }}</td>
      </tr>
      @if ($jaminan['jenis_jaminan'] == '1')
            <tr>
              <td  height="10" colspan="3" class="style9">Menyatakan sanggup mengadakan barang jaminan berupa: </td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nomor Sertifikat</td>
              <td class="style27">: {{($jaminan['nomor_sertifikat'])}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nama Pemilik</td>
              <td class="style27">: {{$jaminan['nama_pemilik']}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Alamat</td>
              <td class="style27">: {{$jaminan['alamat']}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Luas</td>
              <td class="style27">: {{ $jaminan['luas']}} (m²)</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nilai Jual Tanah</td>
              <td class="style27">: {{$jaminan['nilai_jual_tanah']}}</td>
            </tr>
            <tr>
              <td  height="10" colspan="3" class="style9"> guna memenuhi persyaratan permohonan kredit dengan Nomor Registrasi {{$pinkel->id}} pada {{$kec->nama_lembaga_sort}}.
                    Demikian surat pernyataan kesanggupan ini saya buat dengan penuh kesadaran dan untuk menjadikan
                    periksa bagi yang berkepentingan.
              </td>
            </tr>
      @elseif ($jaminan['jenis_jaminan'] == '2')
            <tr>
              <td  height="10" colspan="3" class="style9">Menyatakan sanggup mengadakan barang jaminan berupa: </td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nomor</td>
              <td class="style27">: {{($jaminan['nomor'])}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nama Pemilik</td>
              <td class="style27">: {{$jaminan['nama_pemilik']}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nopol</td>
              <td class="style27">: {{$jaminan['nopol']}}</td>
            </tr>
            <tr> 
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nilai Jual Kendaraan</td>
              <td class="style27">: {{ $jaminan['nilai_jual_kendaraan']}}</td>
            </tr>
            <tr>
              <td  height="10" colspan="3" class="style9"> guna memenuhi persyaratan permohonan kredit dengan Nomor Registrasi {{$pinkel->id}} pada {{$kec->nama_lembaga_sort}}.
                Demikian surat pernyataan kesanggupan ini saya buat dengan penuh kesadaran dan untuk menjadikan
                periksa bagi yang berkepentingan.
              </td>
            </tr>
      @elseif ($jaminan['jenis_jaminan'] == '3')
            <tr>
              <td  height="10" colspan="3" class="style9">Menyatakan sanggup mengadakan barang jaminan berupa: </td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nomor</td>
              <td class="style27">: {{($jaminan['nomor'])}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nama Pegawai</td>
              <td class="style27">: {{$jaminan['nama_pegawai']}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nama Instansi Penerbit</td>
              <td class="style27">: {{$jaminan['nama_kuitansi_penerbit']}}</td>
            </tr>
            <tr>
              <td  height="10" colspan="3" class="style9"> guna memenuhi persyaratan permohonan kredit dengan Nomor Registrasi {{$pinkel->id}} pada {{$kec->nama_lembaga_sort}}.
                Demikian surat pernyataan kesanggupan ini saya buat dengan penuh kesadaran dan untuk menjadikan
                periksa bagi yang berkepentingan.
              </td>
            </tr>
      @elseif ($jaminan['jenis_jaminan'] == '4')
            <tr>
              <td  height="10" colspan="3" class="style9">Menyatakan sanggup mengadakan barang jaminan berupa: </td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nomor Jaminan</td>
              <td class="style27">: {{($jaminan['nama_jaminan'])}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Keterangan</td>
              <td class="style27">: {{$jaminan['keterangan']}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nilai Jaminan</td>
              <td class="style27">: {{$jaminan['nilai_jaminan']}}</td>
            </tr>
            <tr>
              <td  height="10" colspan="3" class="style9"> guna memenuhi persyaratan permohonan kredit dengan Nomor Registrasi {{$pinkel->id}} pada {{$kec->nama_lembaga_sort}}.
                Demikian surat pernyataan kesanggupan ini saya buat dengan penuh kesadaran dan untuk menjadikan
                periksa bagi yang berkepentingan.
              </td>
            </tr>
      @else
            <tr>
              <td  height="10" colspan="3" class="style9">Menyatakan sanggup mengadakan barang jaminan berupa: </td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nomor Sertifikat</td>
              <td class="style27">: {{($jaminan['nomor_sertifikat'])}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nama Pemilik</td>
              <td class="style27">: {{$jaminan['nama_pemilik']}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Alamat</td>
              <td class="style27">: {{$jaminan['alamat']}}</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Luas</td>
              <td class="style27">: {{ $jaminan['luas']}} (m²)</td>
            </tr>
            <tr>
              <td width="5">&nbsp;</td>
              <td height="10" class="style9">Nilai Jual Tanah</td>
              <td class="style27">: {{$jaminan['nilai_jual_tanah']}}</td>
            </tr>
            <tr>
              <td  height="10" colspan="3" class="style9"> guna memenuhi persyaratan permohonan kredit dengan Nomor Registrasi {{$pinkel->id}} pada {{$kec->nama_lembaga_sort}}.
                    Demikian surat pernyataan kesanggupan ini saya buat dengan penuh kesadaran dan untuk menjadikan
                    periksa bagi yang berkepentingan.
              </td>
            </tr>
      @endif
      <br colspan="3">
</table>
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
        <td width="32%" height="36" colspan="1" class="style26">
            <div align="center" class="style9">
                <p> <br></p>
            </div>
        </td>
        <td class="style26">
            <div align="center" class="style9">
                <p>Yang menerima</p>
            </div>
        </td>
    </tr>
    <tr>        
        <td width="7"align="center" colspan="-1" class="style9">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p> <br></p>
        </td>
        <td width="7"align="center" class="style9">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>
              {{ $pinkel->user->namadepan }}
              {{ $pinkel->user->namabelakang }}<br>                                
            </p>
        </td>
    </tr>
</table>	  

@endsection