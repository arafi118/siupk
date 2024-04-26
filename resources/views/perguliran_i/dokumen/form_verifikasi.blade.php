@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
<<<<<<< HEAD
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>FORM VERIFIKASI OLEH VERIFIKATOR</b>
                </div>
                <div style="font-size: 16px;">
                    <b>PINJAMAN KELOMPOK {{ strtoupper($pinkel->jpp->nama_jpp) }}</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="6">
                <b>IDENTITAS KELOMPOK :</b>
            </td>
        </tr>
        <tr>
            <td width="90">ID Kelompok</td>
            <td width="5" align="center">:</td>
            <td width="130">
                <b>{{ $pinkel->anggota->kd_kelompok }}</b>
            </td>
            <td width="90">Tanggal Berdiri</td>
            <td width="5" align="center">:</td>
            <td width="130">
                {{-- <b>{{ Tanggal::tglLatin($pinkel->anggota->tgl_berdiri) }}</b> --}}
            </td>
        </tr>
        <tr>
            <td>Nama Kelompok </td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->anggota->nama_kelompok }}</b>
            </td>
            <td>Jenis Produk Pinjaman</td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->jpp->nama_jpp }}</b>
            </td>
        </tr>
        <tr>
            <td>Alamat Kelompok</td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->anggota->alamat_kelompok }}</b>
            </td>
            <td>Jenis Usaha </td>
            <td>:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->usaha->nama_usaha }}</b> --}}
            </td>
        </tr>
        <tr>
            <td>
                {{ $pinkel->anggota->d->sebutan_desa->sebutan_desa }}
            </td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->anggota->d->nama_desa }}</b>
            </td>
            <td>Jenis Kegiatan</td>
            <td>:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->kegiatan->nama_jk }}</b> --}}
            </td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td>
                <b>{{ $kec->nama_kec }}</b>
            </td>
            <td>Tingkat Kelompok </td>
            <td>:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->tk->nama_tk }}</b> --}}
            </td>
        </tr>
        <tr>
            <td>Telpon</td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->anggota->telpon }}</b>
            </td>
            <td>Fungsi Kelompok </td>
            <td>:</td>
            <td>
                {{-- <b>{{ $pinkel->anggota->fk->nama_fk }}</b> --}}
            </td>
        </tr>
        <tr>
            <td>Nama Ketua</td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->anggota->ketua }}</b>
            </td>
            <td>Last Update</td>
            <td>:</td>
            <td>
                <b>{{ Tanggal::tglLatin(date('Y-m-d', strtotime($pinkel->lu))) }}</b>
            </td>
        </tr>
        <tr>
            <td>Nama Sekretaris</td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->anggota->sekretaris }}</b>
            </td>
            <td>Petugas/PJ</td>
            <td>:</td>
            <td>
                <b>{{ $pinkel->user->namadepan }} {{ $pinkel->user->namabelakang }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
    </table>
=======
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
	 
<tr>
        <td height="50" colspan="5" class="bottom">
        <p align="center" class="style6" style="font-size: 18px; font-weight: bold;">PENILAIAN PERMOHONAN PINJAMAN INDIVIDU<br>
		 </p>
        </td>
    </tr>
>>>>>>> c8014486a1beef4ddc091f3e97a67c2bc5a0f280

      
      <tr>
        <td height="25" colspan="6" class="style27">A. IDENTITAS PEMINJAM (ANGGOTA)</td>
      </tr>
      
      <tr>
        <td width="4%" class="align-justify style9"><div align="right">1.</div></td>
        <td width="25%" class="align-justify style9">Nama anggota</td>
        <td colspan="4" class="style27">:{{$pinkel->anggota->namadepan}}</td>
      </tr>
      <tr>
        <td class="align-justify style9"><div align="right">2.</div></td>
        <td class="align-justify style9">Jenis Kelamin</td>
        <td colspan="4" class="style27">: {{$pinkel->anggota->jk}}</td>
      </tr>
      <tr>
        <td height="0" class="align-justify style9"><div align="right">3.</div></td>
        <td height="0" class="align-justify style9">N I K</td>
        <td height="0" colspan="4" class="style27">: {{$pinkel->anggota->nik}}</td>
      </tr>
      <tr>
        <td height="0" class="align-justify style9"><div align="right">4.</div></td>
        <td height="0" class="align-justify style9">Tempat, anggal Lahir </td>
        <td height="0" colspan="4" class="style27">: {{ $pinkel->anggota->tempat_lahir}} 
                {{ Tanggal::tglLatin($pinkel->anggota->tgl_lahir)}}

        </td>
      </tr>
      <tr>
        <td height="0" class="align-justify style9"><div align="right">5.</div></td>
        <td height="0" class="align-justify style9">Alamat</td>
        <td height="0" colspan="4" class="style27"><span class="style27">: {{ $pinkel->anggota->alamat}} {{ $pinkel->anggota->d->nama_desa }}</span></td>
      </tr>
      <tr>
        <td height="0" class="align-justify style9"><div align="right">6.</div></td>
        <td height="0" class="align-justify style9">No. Handphone</td>
        <td height="0" colspan="4" class="style27"><span class="style27">: {{$pinkel->anggota->hp}}</span></td>
      </tr>
      <tr>
        <td class="align-justify style9"><div align="right">7.</div></td>
        <td class="align-justify style9">Jenis Usaha</td>
        <td colspan="4" class="style27">: {{ $pinkel->anggota->u->nama_usaha }}</td>
      </tr>
      <tr>
        <td class="align-justify style9"><div align="right">8.</div></td>
        <td class="align-justify style9">Jumlah Kredit yang diminta</td>
        <td colspan="4" class="style27"><span class="style27">: {{ $pinkel->proposal }} </span></td>
      </tr>
      <tr>
        <td class="align-justify style9"><div align="right">9.</div></td>
        <td class="align-justify style9">Sistem angsuran</td>
        <td colspan="4" class="style27">:  {{ $pinkel->sis_pokok->nama_sistem }} ({{ $pinkel->sis_pokok->deskripsi_sistem }})</td>
      </tr>
      <tr>
        <td class="align-justify style9"><div align="right">10.</div></td>
        <td class="align-justify style9">jangka waktu</td>
        <td colspan="4" class="style27">: {{$pinkel->jangka}}  bulan</td>
      </tr>
 </table>     
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td height="25" colspan="6" class="align-justify style9"><strong>B. INFORMASI PENDAPATAN &amp; PENGELUARAN</strong></td>
      </tr>
      <tr>
        <td rowspan="6" align="right" valign="top" class="style9 align-justify"><div align="right">1.</div></td>
        <td width="60%" colspan="2" class="style9 align-justify">Pendapatan Keluarga 1 (satu) bulan</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pendapatan dari usaha suami</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pendapatan dari usaha istri</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pendapatan dari hasil kebun, sawah, ladang</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pendapatan lain-lain</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <th colspan="2" class="style9 align-justify"><div align="center" class="style28">Jumlah pendapatan </div></th>
        <td colspan="3" class="align-justify style9"><strong>: Rp. </strong></td>
      </tr>
      <tr>
        <td rowspan="10" valign="top" class="style9 align-justify"><div align="right">2.</div></td>
        <td colspan="2" class="style9 align-justify">Pengeluaran keluarga</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pembelian alat/barang dagangan</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pengeluaran Kebutuhan Makan/minum</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pengeluaran Sabun-Cuci-mandi</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pengeluaran untuk Sekolah</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pengeluaran untuk sosial</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pengeluaran listrik, air, telphon dll</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Angsuran pinjaman di bank/koperasi/perorangan</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify">Pengeluaran lain-lain</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td colspan="2" class="style9 align-justify"><div align="center" class="style28"><strong>Jumlah Pengeluaran </strong></div></td>
        <td colspan="3" class="align-justify style9"><strong>: Rp. </strong></td>
      </tr>
      <tr>
        <td colspan="6" class="align-justify style9"><strong>C. IDENTITAS JAMINAN</strong></td>
      </tr>
      <tr>
        <td class="style9 align-justify"><div align="right">1.</div></td>
        <td colspan="2" class="style9 align-justify">Tabungan di Bank/Koperasi/BMT atas nama pribadi</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td class="style9 align-justify"><div align="right">2.</div></td>
        <td colspan="2" class="style9 align-justify">Nilai harta lain berupa ...............................................</td>
        <td colspan="3" class="style9 align-justify">: Rp. </td>
      </tr>
      <tr>
        <td class="style9 align-justify">&nbsp;</td>
        <td colspan="2" class="style9 align-justify"><div align="center" class="style28"><strong>Total Nilai Jaminan</strong></div></td>
        <td colspan="3" class="style9 align-justify"><strong>: Rp. </strong></td>
      </tr>
      <tr>
        <td colspan="6" class="align-justify style9"><strong>D. PENILAIAN</strong></td>
      </tr>
      <tr>
        <td class="style9 align-justify"><div align="right">1.</div></td>
        <td colspan="2" class="style9 align-justify">Ratio  pendapatan keluarga (bersih)  per bulan dibagi angsuran per bulan</td>
        <td colspan="3" class="style9 align-justify">: ............% (min 200%)</td>
      </tr>
      <tr>
        <td class="style9 align-justify"><div align="right">2.</div></td>
        <td colspan="2" class="style9 align-justify">Ratio tabungan di kelompok dibagi kredit yang diajukan</td>
        <td colspan="3" class="style9 align-justify">: ............% (min 20%)</td>
      </tr>
</table>
	  
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0">
      

    <tr>
      <td width="45%" class="style9 align-justify"><p><span class="style27"> E. KESIMPULAN</span><br>
        Anggota/peminjam ini LAYAK / TIDAK LAYAK untuk diberikan kredit sebesar:<br>
        <br> 
        <strong><u></u>Rp. {{$pinkel->alokasi}} </u></strong></p>
        <p>Dengan Catatan :<br><br><br><br>
		*) coret yang tidak perlu. </p>
      </td>
	    <td width="5%" height="20" colspan="-1" class="style9 align-justify"><p>&nbsp;</p>      </td>
        <td width="50%" colspan="2" class="style9"><p><br>
        Diverifikasi Pada : ................................................<br>
        Oleh : Tim Verifikasi {{$kec->sebutan_kec }} {{ $kec->nama_kec }} <br>
        </p>
		
			<table width='100%'>
        <tr>
          <td>&nbsp;</td>
        </tr>
				<tr>
				<td width='60%' class='style27'> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class='style9'> </span></td>
				<td width='30%' class='bottom'></td>
				</tr>
				<tr>
				<td width='60%' class='style27'>{{$user->namadepan }} {{$user->namabelakang }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class='style9'>{{$user->j->nama_jabatan }}</span></td>
				<td width='30%' class='bottom'></td>
				</tr>
			</table>
		
		   </td>
  </tr>
</table>
</body>

<<<<<<< HEAD
    <div style="margin-top: 12px;">
        <b>DATA PINJAMAN ANGGOTA :</b>
    </div>
    <table border="1" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <th width="5%" align="center">No</th>
            <th width="20%" align="center">Nama Anggota</th>
            <th width="15%" align="center">Pinj. Lalu</th>
            <th width="15%" align="center">Proposal (Rp.)</th>
            <th width="15%" align="center">Rekom TV</th>
            <th width="15%" align="center">Rekom TP</th>
            <th align="center">Catatan</th>
        </tr>

        @php
            $proposal = 0;
            $proposal_lalu = 0;
            $verifikasi = 0;
            $alokasi = 0;
            $no = 0;
        @endphp
        {{-- @foreach ($pinkel->pinjaman_anggota as $pa)
            @php
                $proposal += $pa->proposal;
                $verifikasi += $pa->verifikasi;
                $alokasi += $pa->alokasi;

                $pinjaman_lalu = 0;
                if (isset($data_nia[$pa->nia])) {
                    $proposal_lalu += $data_nia[$pa->nia]['alokasi'];
                    $pinjaman_lalu = $data_nia[$pa->nia]['alokasi'];

                    unset($data_nia[$pa->nia]);
                }

                $no = $loop->iteration;
            @endphp
            <tr>
                <td align="center">{{ $no }}</td>
                <td>{{ $pa->anggota->namadepan }}</td>
                <td align="right">{{ number_format($pinjaman_lalu) }}</td>
                <td align="right">{{ number_format($pa->proposal) }}</td>
                <td align="right">
                    {!! $statusDokumen != 'P' || $pinkel->status == 'V' ? number_format($pa->verifikasi) : '&nbsp;' !!}
                </td>
                <td align="right">
                    {!! $statusDokumen == 'W' || $statusDokumen == 'A' ? number_format($pa->alokasi) : '&nbsp;' !!}
                </td>
                <td>
                    {!! $statusDokumen != 'P' || $pinkel->status == 'V' ? $pa->catatan_verifikasi : '&nbsp;' !!}
                </td>
            </tr>
        @endforeach --}}

        @foreach ($data_nia as $nia => $val)
            @php
                $proposal_lalu += $val['alokasi'];
                $pinjaman_lalu = $val['alokasi'];
            @endphp

            <tr>
                <td align="center">{{ ++$no }}</td>
                <td>{{ $val['nama'] }}</td>
                <td align="right">{{ number_format($pinjaman_lalu) }}</td>
                <td align="right">{{ number_format(0) }}</td>
                <td align="right">
                    {!! $statusDokumen != 'P' || $pinkel->status == 'V' ? number_format(0) : '&nbsp;' !!}
                </td>
                <td align="right">
                    {!! $statusDokumen == 'W' || $statusDokumen == 'A' ? number_format(0) : '&nbsp;' !!}
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        @endforeach

        <tr>
            <td align="center" colspan="2">
                <b>JUMLAH</b>
            </td>
            <td align="right">{{ number_format($proposal_lalu) }}</td>
            <td align="right">{{ number_format($proposal) }}</td>
            <td align="right">
                {!! $statusDokumen != 'P' || $pinkel->status == 'V' ? number_format($verifikasi) : '&nbsp;' !!}
            </td>
            <td align="right">
                {!! $statusDokumen == 'W' || $statusDokumen == 'A' ? number_format($alokasi) : '&nbsp;' !!}
            </td>
            <td align="right">&nbsp;</td>
        </tr>
    </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="50%" align="justify" style="vertical-align: text-top;">
                <div>Verified Sign:</div>
                <div>
                    Tim Verifikasi {{ $kec->nama_lembaga_sort }} Kecamatan {{ $kec->nama_kec }} menyatakan dengan
                    sebenar-benarnya sesuai
                    dengan hasil survey lapangan bahwa kelompok dengan identitas tersebut di atas <b>ADA/TIDAK ADA</b>
                    keberadaannya dan dapat dipertanggungjawabkan sesuai dengan peraturan yang berlaku. Serta <b>LAYAK/TIDAK
                        LAYAK</b> untuk diberikan pinjaman sesuai dengan hasil rekomendasi Verifikasi di atas. Form ini
                    digunakan sebagai dasar Verified pada SI DBM.
                </div>
            </td>
            <td width="50%" align="justify" style="vertical-align: top;">
                <div>Diverifikasi oleh, Tim Verifikasi {{ $kec->nama_lembaga_sort }} Kecamatan {{ $kec->nama_kec }}</div>
                <div style="margin-top: 12px;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
                        @foreach ($user as $u)
                            <tr>
                                <td width="70" height="20">
                                    <div>{{ $u->namadepan }} {{ $u->namabelakang }}</div>
                                    <div>
                                        <b>{{ $u->j->nama_jabatan }}</b>
                                    </div>
                                </td>
                                <td align="right" style="vertical-align: bottom;">
                                    _____________________________________
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </td>
        </tr>
    </table>
=======
>>>>>>> c8014486a1beef4ddc091f3e97a67c2bc5a0f280
@endsection
