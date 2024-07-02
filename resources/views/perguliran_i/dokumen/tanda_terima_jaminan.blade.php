@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')

<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
        
<tr>
        <td height="50" colspan="3" class="bottom">
        <p align="center" class="style6" style="font-size: 18px; font-weight: bold;">KESANGGUPAN PENGADAAN<br>BARANG JAMINAN</p>

        </td>
    </tr>
      
      <tr>
        <td height="10" colspan="3" class="style9"></td>
      </tr>
      <tr>
        <td height="10" colspan="3" class="style9">Yang bertanda tangan dibawah ini,</td>
      </tr>
      <tr>
      </tr>
      <tr>
        <td height="10" class="style9">Nama Lengkap </td>
        <td class="style27">: {{$pinkel->anggota->namadepan}}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      <tr>
        <td height="10" class="style9">NIK</td>
        <td class="style27">: {{$pinkel->anggota->nik}}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      <tr>
        <td width="20%" height="10" class="style9">Alamat</td>
        <td width="42%" class="style27">: {{ $pinkel->anggota->d->nama_desa }}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
	  <tr>
        <td height="10" class="style9">Nomor HP</td>
        <td class="style27">: {{ $pinkel->anggota->hp }}</td>
        <td height="10" class="style9">&nbsp;</td>
      </tr>
      
      
      <tr>
        <td height="20" colspan="3" class="style9">Menyatakan sanggup melakukan pengadaan  barang jaminan berupa 
                    @php
                        $jaminan = json_decode($pinkel->jaminan, true);
                    @endphp

                    @if (is_array($jaminan) || is_object($jaminan))
                    
        </td>
      </tr>
                            @foreach ($jaminan as $key => $value)
                                
	  <tr>
        <td height="10" class="style9">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
        <td class="style27">: {{ ucwords($value)}}</td>
        <td height="10" class="style9">&nbsp;</td>
                                </tr>
                            @endforeach                 
	  <tr>
        <td height="20" colspan="3" class="style9">
                    @else
                         <STRONG> {{$pinkel->jaminan}} </STRONG>
                    @endif
                    guna memenuhi persyaratan permohonan pinjaman dengan Nomor Registrasi {{$pinkel->id}} di {{$kec->nama_lembaga_sort}},<br>
          Demikian surat pernyataan kesanggupan ini kami buat dengan penuh kesadaran dan untuk menjadikan
          periksa bagi yang berkepentingan.
        </td>
      </tr>
       
      <tr>
        <td height="20" colspan="2" class="style9"></td>
        <td height="20" class="style9"><div><span class="style9"><br>{{$pinkel->anggota->d->nama_desa}}, {{ Tanggal::tglLatin(date('Y-m-d')) }}</span></div></td>
      </tr>
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
            <p>Yang menerima <br><br><br><br>
           {{$pinkel->anggota->namadepan }}
</p>
            </div>
        </td>
    </tr>
</table>	  

@endsection
