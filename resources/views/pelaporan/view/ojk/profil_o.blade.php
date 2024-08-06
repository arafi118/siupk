<title>PROFIL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@php
    use App\Utils\Keuangan;
    $keuangan = new Keuangan();
@endphp

@extends('pelaporan.layout.base')

@section('content')
<title>pop</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">

.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 24px; font-weight: bold; }
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;  }
.style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.top	{border-top: 1px solid #000000; }
.bottom	{border-bottom: 1px solid #000000; }
.left	{border-left: 1px solid #000000; }
.right	{border-right: 1px solid #000000; }
.all	{border: 1px solid #000000; }
.style27 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.align-justify {text-align:justify; }
.align-center {text-align:center; }

</style>
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr align="center">
    <td colspan="3" width="10%" class="style6 bottom">
    <br>
    <span><b>{{ strtoupper($nama_lembaga) }}</b></span><br>
    {{ strtoupper($nama_kecamatan) }}<br>
	<span class="style9">{{ $info }}<br>
	

</span>
						</td>
				  </tr>	
</table>
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
	    <td class="style6 align-center" colspan="3" ><b>PROFIL LKM</b> <br>
	    <span class="style9 align-center">Untuk Periode Yang Berakhir Pada Tanggal {{ $tgl }}</span>
	    <p class="style9 align-center"> &nbsp; </p>
	    </td>
	  </tr>
    <tr>
	        <td width="2%" class="style9">1.</td>
            <td width="30%" class="style9">Nama LKM</td>
            <td width="60%" class="style9">: {{$lkm->nama_lkm_long}}</td>
	    </tr>
	     <tr>
	        <td width="2%" class="style9">2.</td>
            <td width="30%" class="style9">Nomor Sandi LKM</td>
            <td width="60%" class="style9">: {{$lkm->sandi_lkm}}</td>
	    </tr>
	     <tr>
	        <td width="2%" class="style9">3.</td>
            <td width="30%" class="style9">Alamat Lengkap</td>
            <td width="60%" class="style9"></td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9"> </td>
            <td width="30%" class="style9">a. Alamat</td>
            <td width="60%" class="style9">: {{$lkm->alamat}} </td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9"> </td>
            <td width="30%" class="style9">b. Kelurahan/Desa</td>
            <td width="60%" class="style9">: {{$lkm->desa}} </td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9"> </td>
            <td width="30%" class="style9">c. Kecamatan</td>
            <td width="60%" class="style9">: {{$kec->nama_kec}}</td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9"> </td>
            <td width="30%" class="style9">d. Kabupaten/Kota</td>
            <td width="60%" class="style9">: {{$kab->nama_kab}}</td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9"> </td>
            <td width="30%" class="style9">e. Provinsi</td>
            <td width="60%" class="style9">: {{$lkm->provinsi}}</td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9"> </td>
            <td width="30%" class="style9">f. Kode Pos</td>
            <td width="60%" class="style9">: {{$lkm->kode_pos}}</td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9">4.</td>
            <td width="30%" class="style9">Telepon dan Fax</td>
            <td width="60%" class="style9">: {{$kec->telpon_kec}}</td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9">5.</td>
            <td width="30%" class="style9">Email</td>
            <td width="60%" class="style9">: {{$kec->email_kec}}td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9">6.</td>
            <td width="30%" class="style9">No. dan Tanggal Izin Usaha</td>
            <td width="50%" class="style9">:  {{$lkm->ijin_usaha}}</td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9">7.</td>
            <td width="30%" class="style9">Dasar Pencatatan</td>
            <td width="60%" class="style9">: {{$lkm->dasar_catat}}</td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9">8.</td>
            <td width="30%" class="style9">Pemegang Saham</td>
            <td width="60%" class="style9">: </td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9"></td>
	        <td colspan="2">
	            <br>
	         <table border="0" width="100%">
	             <tr>
	                 <td class="style9" width="33%">&nbsp; </td>
	                 <td colspan="2" class="style9 align-center" >Kepemilikan Saham **)</td>
	               </tr> 
	               <tr>
	                 <th class="style9 bottom top align-center" >Nama Pemegang Saham</th>
	                 <th class="style9 bottom top align-center" width="33%">Rupiah</th>
	                 <th class="style9 bottom top align-center" width="33%">Persentase(%)</th>
	                 </tr>
                   <tr>
	                 <td class="style9 bottom align-center" >{{ $n_saham1 }}&nbsp;</td>
	                 <td class="style9 bottom align-center" width="33%">{{ number_format($rp_saham1) }}&nbsp;</td>
	                 <td class="style9 bottom align-center" width="33%">{{ $pros_saham1 }}&nbsp;</td>
	                 </tr>
                   <tr>
	                 <td class="style9 bottom align-center" >&nbsp;</td>
	                 <td class="style9 bottom align-center" width="33%">&nbsp;</td>
	                 <td class="style9 bottom align-center" width="33%">&nbsp;</td>
	                 </tr>
	               <tr>
	                 <td class="style9 bottom align-center" >Total</td>
	                 <td class="style9 bottom align-center" width="33%">{{ number_format($jrp_saham1) }}&nbsp;</td>
	                 <td class="style9 bottom align-center" width="33%">{{ number_format($pros_saham1) }}&nbsp;</td>
	                 </tr>
	         </table> 
           </td>
	        </tr>
	        <tr>
	        <td width="2%" class="style9">&nbsp;</td>
	    </tr>
	        <tr>
	        <td width="2%" class="style9">9.</td>
            <td width="30%" class="style9">Direksi dan Komisaris</td>
            <td width="60%" class="style9">: </td>
	    </tr>
	    <tr>
	        <td width="2%" class="style9"></td>
	        <td colspan="2">
	         <table border="0" width="100%">
	               <tr>
	                   <td class="style9" width="50%"> <!-------DIREKSI---------->
    	                    <table border="0" width="100%">
        	                       <tr>
                	                 <th class="style9 bottom top align-center" width="50%">Nama Direksi</th>
                	                 <th class="style9 bottom top align-center" width="50%">Jabatan</th>
                	               </tr> 
                                 <tr>
                	                 <td class="style9 bottom align-center" width="50%">{{$lkm->nama_direksi}}&nbsp;</td>
                	                 <td class="style9 bottom align-center" width="50%">{{$lkm->jab_direksi}}&nbsp;</td>
                	                 </tr>
                                   </table>
                                   </td>
	                   <td class="style9" width="50%"> <!-------Komisaris---------->
    	                    <table border="0" width="100%">
        	                       <tr>
                	                 <th class="style9 bottom top align-center" width="50%">Nama Komisaris</th>
                	                 <th class="style9 bottom top align-center" width="50%">Jabatan</th>
                	               </tr>            
                                 <tr>
                	                 <td class="style9 bottom align-center" width="50%">{{$lkm->nama_kom}}&nbsp;</td>
                	                 <td class="style9 bottom align-center" width="50%">{{$lkm->jab_kom}}&nbsp;</td>
                	                 </tr>
                                   </table>
                                   <table>
                                   </td>
                                    </tr>
                                    <tr>
                                      <td class="style9 " width="50%">&nbsp;</td>
                                      <td class="style9 " width="50%">&nbsp;</td>
                                      </tr>
                                    
                              </table> 
                              </td>
                              </tr>
                              <tr>
                              <td width="2%" class="style9"></td>
                                <td width="40%" class="style9">*) coret yang tidak perlu
                                <br> **) hanya diisi untuk LKM berbentuk PT
                                </td>
                                   </table>
               <!-- <table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
               <tr>
              <td width="49%" height="36" colspan="1" class="style26"><div align="center" class="style9">
                <p>&nbsp;</p>
              </div></td>
              <td class="style26"><div align="center" class="style9">
          <p>&nbsp;</p>
                <p>----------</p>
            -----------
              </div></td>
            </tr>	
        <tr>
            <th height="24" colspan="-1" class="style9"><p align="center">&nbsp;</p>
              <p align="center">&nbsp;</p>
              <p>&nbsp;</p></th>
              <th class="style9"><p align="center">&nbsp;</p>
              <p align="center">&nbsp;</p>
              <p>--------</p></th>
        </tr>
        </tr>
	</table> -->
@endsection
