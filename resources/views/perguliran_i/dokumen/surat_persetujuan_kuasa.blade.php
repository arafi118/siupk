@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
        
<tr>
        <td height="70" colspan="3" class="bottom">
        <p align="center" class="style6" style="font-size: 18px; font-weight: bold;">SURAT KUASA KHUSUS</p>

        </td>
    </tr>
      
      <tr>
        <td height="10" colspan="3" class="style9"></td>
      </tr>
      <tr>
        <td height="10" colspan="3" class="style9">Yang bertanda tangan dan/atau membubuhkan cap jempol dibawah ini,</td>
      </tr>
      <tr>
        <td height="10" class="style9">Nama Lengkap </td>
        <td class="style27">: {{$pinkel->anggota->namadepan}}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      <tr>
        <td height="10" class="style9">Jenis Kelamin </td>
        <td class="style27">: {{$pinkel->anggota->jk}}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
	   <tr>
        <td height="10" class="style9">NIK</td>
        <td class="style27">: {{$pinkel->anggota->nik}}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      <tr>
        <td height="10" class="style9">Tempat,Tgl Lahir </td>
        <td class="style27">:  {{ $pinkel->anggota->tempat_lahir}} 
                {{ Tanggal::tglLatin($pinkel->anggota->tgl_lahir) }} 
            </td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      <tr>
        <td width="20%" height="10" class="style9">Alamat</td>
        <td width="42%" class="style27">: {{ $pinkel->anggota->alamat}} {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }}
          {{ $pinkel->anggota->d->desa }} {{$kec->sebutan_kec }} {{ $kec->nama_kec }}
          {{ $nama_kabupaten }} </td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      <tr>
        <td height="10" class="style9">Jenis Usaha</td>
        <td class="style27">
            :
            @if (is_numeric($pinkel->anggota->usaha))
            {{ $pinkel->anggota->u->nama_usaha }}
            @else
                {{ $pinkel->anggota->usaha }}
            @endif
        
        </td>
        <td height="10" class="style9">&nbsp;</td>
    </tr>
    
	  <tr>
        <td height="10" class="style9">Nomor HP</td>
        <td class="style27">: {{ $pinkel->anggota->hp }}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      
      
      <tr>
        <td height="20" colspan="3" class="style9">Dengan ini memberikan persetujuan dan kuasa sepenuhnya kepada,</td>
      </tr>
      <tr>
        <td height="10" class="style9">Nama Lengkap </td>
        <td class="style27">:   {{ $dir->namadepan }} {{$dir->namabelakang}}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      <tr>
        <td height="10" class="style9">Jabatan </td>
        <td class="style27">: {{ $dir->j->nama_jabatan }} {{ $kec->nama_lembaga_sort }}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      </table> 
	 
      <style>
    .align-justify {
        text-align: justify;
    }
</style>

<table>
    <tr>
        <td height="10" colspan="3" class="style9 align-justify">
            <p>
                Untuk  menggunakan barang jaminan yang kami serahterimakan kepada {{ $kec->nama_lembaga_sort }}, sebagaimana tertuang dalam bukti serah terima barang jaminan yang menjadi bagian tidak terpisahkan dari dokumen Pencairan Kredit berkaitan dengan permohonan kredit ini.
                Selanjutnya saya menyatakan sanggup untuk memberikan keterangan, memberikan dukungan dan/atau menandatangani kelengkapan dokumen apabila dikemudian hari diperlukan dalam proses eksekusi barang jaminan dalam rangka memenuhi kewajiban pengembalian kredit saya kepada {{ $kec->nama_lembaga_sort }}.
               <br> Demikian surat persetujuan/pernyataan sekaligus Surat kuasa khusus ini saya buat secara sadar tanpa tekanan dari pihak manapun serta untuk dapat dipergunakan dimana perlu.
            </p>
        </td>
    </tr>

      <tr>
        <td height="20" colspan="2" class="style9"></td>
        <td height="20" class="style9"><div align="right"><span class="style9"><br></span></div></td>
      </tr>
</table>
	  
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
   
  <tr>
        <td width="10%" height="36" colspan="1" class="style26"><div align="center" class="style9">
          <p></p>
        </div></td>
		 <td class="style26"><div align="center" class="style9">
          <p>&nbsp;</p>
          <p>Penerima Kuasa </p>
        </div></td>
        <td class="style26"><div align="center" class="style9">
          {{$pinkel->anggota->d->nama_desa}}, {{ Tanggal::tglLatin($pinkel->tgl_proposal) }} <br>
          <p>Pemberi Kuasa</p>
        </div></td>
      </tr>	
	<tr>
	    <td align="center"height="24" class="style9">&nbsp;</p>
        <p >&nbsp;</p>
        <p>
        </p></td>
		
        <td align="center" class="style9"><p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>{{ $dir->namadepan }} {{$dir->namabelakang}}<br></p></td>
		
		<td align="center" class="style9"><p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>{{$pinkel->anggota->namadepan}}<br></p></td>
		
  </tr>
</table>
@endsection
