@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran.dokumen.layout.base')

@section('content')
@if(empty($kec->nama_asuransi_p))
    <b>Anda tidak mempunyai layanan asuransi, untuk mengatur layanan asurasi, silakan menuju pengaturan > Personalisasi SOP > pengaturan asuransi</b>
@else

@php
    $besar_premi = $kec->besar_premi ?? 1;
@endphp

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>DAFTAR PESERTA ASURANSI {{ $kec->nama_asuransi_p }}</b>
                </div>
                <div style="font-size: 16px;">
                    <b>PLAN ASURANSI CICILAN BULANAN</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="70">Nama Kelompok</td>
            <td width="5" align="right">:</td>
            <td>{{ $pinkel->kelompok->nama_kelompok }} - {{ $pinkel->id }}</td>
            <td width="70">Alokasi Pinjaman</td>
            <td width="5" align="right">:</td>
            <td>Rp. {{ number_format($pinkel->alokasi) }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td align="right">:</td>
            <td>{{ $pinkel->kelompok->alamat_kelompok }}</td>
            <td>Sistem Angsuran</td>
            <td align="right">:</td>
            <td>{{ $pinkel->sis_pokok->nama_sistem }}</td>
        </tr>
        <tr>
            <td>Tanggal Pencairan</td>
            <td align="right">:</td>
            <td>{{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
            <td>Prosentase Jasa</td>
            <td align="right">:</td>
            <td>{{ $pinkel->pros_jasa }}% / {{ $pinkel->jangka }} bulan</td>
        </tr>
        <tr>
            <td>Nomor SPK</td>
            <td align="right">:</td>
            <td>{{ $pinkel->spk_no }}</td>
            <td>Pinjaman Ke-</td>
            <td align="right">:</td>
            <td>0</td>
        </tr>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px; table-layout: fixed;">
        <tr style="background: rgb(232, 232, 232)">
            <th class="t l b" width="3%" rowspan="2" height="15">No</th>
            <th class="t l b" width="10%" rowspan="2">          Nama Anggota</th>
            <th class="t l b" width="11%" rowspan="2">          TTL</th>
            <th class="t l b" width="10%" rowspan="2">          Nama Penjamin</th>
            <th class="t l b" width="6%" rowspan="2">           Masa Pinj.</th>
            <th class="t l b" colspan="2">                      Pinjaman</th>
            <th class="t l b" width="10%" rowspan="2">          Jumlah</th>
            <th class="t l b" width="10%" rowspan="2">          Premi <br> ({{ $besar_premi }} %)</th>
            <th class="t l b" width="10%" rowspan="2">          Keterangan</th>
            <th class="t l b r" width="10%" rowspan="2">        TTD</th>
        </tr>
        <tr style="background: rgb(232, 232, 232)">
            <th class="l b" width="10%">          Pokok</th>
            <th class="l b" width="10%">          Jasa</th>
        </tr>

        @php
            $alokasi = 0;
            $jasa = 0;
            $jumlah = 0;
            $premi = 0;
        @endphp
        @foreach ($pinkel->pinjaman_anggota as $pa)
            @php
                $no = $loop->iteration;
                $alo =  $pa->alokasi ;
                $js = $pa->alokasi*($pa->pros_jasa/$pa->jangka)/100;
                $juml =  $alo+$js ;
                $prm =  $juml*$besar_premi/100 ;

                $usia = \Carbon\Carbon::parse($pa->anggota->tgl_lahir)->age;
                        
                    if ($usia > $kec->usia_mak) {
                        $row_keterangan = "Tidak dapat";
                    } else {
                        $row_keterangan = "Dapat";
                    }
            @endphp
            <tr>
                <td class="t l b" height="15" align="center">{{ $no }}</td>
                <td class="t l b">{{ $pa->anggota->namadepan }}</td>
                <td class="t l b" align="center">{{ $pa->anggota->tempat_lahir }} <br> {{ $pa->anggota->tgl_lahir }}</td>
                <td class="t l b">{{ $pa->anggota->penjamin }}</td>
                <td class="t l b" align="center">{{ $pa->jangka }}</td>
                <td class="t l b" align="right">{{ number_format($alo) }}</td>
                <td class="t l b" align="right">{{ number_format($js) }}</td>
                <td class="t l b" align="right">{{ number_format($juml) }}</td>
                <td class="t l b" align="right">{{ number_format($prm) }}</td>
                <td class="t l b">{{ $row_keterangan }}</td>
                <td class="t l b r">{{ $no }}.</td>
            </tr>
            @php
                $alokasi += $alo;
                $jasa += $js;
                $jumlah += $juml;
                $premi += $prm;
            @endphp
        @endforeach
            <tr>
                <td class="t l b" height="15" align="center"></td>
                <td class="t l b"></td>
                <td class="t l b"></td>
                <td class="t l b"></td>
                <td class="t l b"></td>
                <td class="t l b"></td>
                <td class="t l b"></td>
                <td class="t l b"></td>
                <td class="t l b"></td>
                <td class="t l b"></td>
                <td class="t l b r"></td>
            </tr>

        <tr>
            <td colspan="11" style="padding: 0px !important;">
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px; table-layout: fixed;">
                    <tr style="font-weight: bold;">
                        <td class=" l b" height="15" width="40%" align="center">JUMLAH</td>
                        <td class=" l b" align="right" width="10%">{{ number_format($alokasi) }}</td>
                        <td class=" l b" align="right" width="10%">{{ number_format($jasa) }}</td>
                        <td class=" l b" align="right" width="10%">{{ number_format($jumlah) }}</td>
                        <td class=" l b" align="right" width="10%">{{ number_format($premi) }}</td>
                        <td class=" l b r" width="20%">&nbsp;</td>
                    </tr>
                </table>

                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">
                    <tr>
                        <td width="60%">&nbsp;</td>
                        <td width="60">Diterima Di</td>
                        <td width="2">:</td>
                        <td>{{ substr($pinkel->wt_cair, 6) }}</td>
                    </tr>
                    <tr>
                        <td width="60%">&nbsp;</td>
                        <td width="60">Pada Tanggal</td>
                        <td width="2">:</td>
                        <td>{{ Tanggal::tglLatin($pinkel->tgl_cair) }}</td>
                    </tr>
                </table>
                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">
                    <tr>
                        <td colspan="2" height="10">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" width="50%">Mengetahui,</td>
                        <td align="center" width="50%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center">{{ $kec->sebutan_level_1 }} {{ $kec->nama_lembaga_sort }}</td>
                        <td align="center">Ketua Kelompok</td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2" height="30">&nbsp;</td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td align="center">{{ $dir->namadepan }} {{ $dir->namabelakang }}</td>
                        <td align="center">{{ $pinkel->kelompok->ketua }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endif
@endsection
