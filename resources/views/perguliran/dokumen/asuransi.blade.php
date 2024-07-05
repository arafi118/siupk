@extends('perguliran.dokumen.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr class="b">
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    <b>DAFTAR PESERTA ASURANSI {{ strtoupper($kec->nama_asuransi_p) }}</b>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>

    <table border="0" width="100%" align="center" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="20%">Kelompok</td>
            <td align="center" width="2%">:</td>
            <td width="28%">
                <b>{{ $pinkel->kelompok->nama_kelompok }} / {{ $pinkel->id }}</b>
            </td>
            <td width="20%">Tanggal Cair</td>
            <td align="center" width="2%">:</td>
            <td width="28%">
                <b>{{ Tanggal::tglLatin($pinkel->tgl_cair) }}</b>
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->kelompok->alamat_kelompok }}</b>
            </td>
            <td>Alokasi Pinjaman</td>
            <td align="center">:</td>
            <td>
                <b>Rp. {{ number_format($pinkel->alokasi) }}</b>
            </td>
        </tr>
        <tr>
            <td>{{ $pinkel->kelompok->d->sebutan_desa->sebutan_desa }}</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->kelompok->d->nama_desa }}</b>
            </td>
            <td>Alokasi Pinjaman</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->sis_pokok->nama_sistem }} ({{ $pinkel->jangka }} Bulan)</b>
            </td>
        </tr>
        <tr>
            <td>Ketua</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->kelompok->ketua }}</b>
            </td>
            <td>Sistem Bagi Hasil</td>
            <td align="center">:</td>
            <td>
                <b>{{ $pinkel->pros_jasa / $pinkel->jangka }}%/Bulan, {{ $pinkel->jasa->nama_jj }}</b>
            </td>
        </tr>
    </table>
    
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <th class="t l b" width="3%" rowspan="2">No</th>
            <th class="t l b" width="10%" rowspan="2">Nama Anggota</th>
            <th class="t l b" width="10%" rowspan="2">TTL</th>
            <th class="t l b" width="10%" rowspan="2">Nama Penjamin</th>
            <th class="t l b" colspan="2">Pinjaman</th>
            <th class="t l b" width="10%" rowspan="2">Jumlah</th>
            <th class="t l b" width="10%" rowspan="2">Premi <br> ({{ $kec->besar_premi }}%)</th>
            <th class="t l b" width="10%" rowspan="2">Keterangan</th>
            <th class="t l b r" width="10%" rowspan="2">TTD</th>
        </tr>
        <tr>
            <th class="t l b" width="10%">Pokok</th>
            <th class="t l b" width="10%">Jasa</th>
        </tr>

        @php
            function hitungUsia($tanggal_lahir) {
                $lahir = new DateTime($tanggal_lahir);
                $sekarang = new DateTime('today');
                $usia = $lahir->diff($sekarang)->y + ($lahir->diff($sekarang)->m / 12) + ($lahir->diff($sekarang)->d / 365.25);

                return number_format($usia, 2);
            }
        @endphp

        @php
            $j_pokok = 0;
            $j_jasa = 0;
            $j_jumlah = 0;
            $j_premi = 0;
        @endphp

        @foreach ($pinkel->pinjaman_anggota as $pa)
            @php
                $no = $loop->iteration;

                $j_a = $kec->pengaturan_asuransi;
                $row_pokok = $pa->alokasi;
                
                if($j_a == "2") {
                    $row_jasa = $pa->alokasi * $pa->pros_jasa / 100;
                } else {
                    $row_jasa = "0";
                }

                $row_jumlah = $row_jasa + $row_pokok;
                $u_max = $kec->usia_mak;

                $usia_sekarang = hitungUsia($pa->anggota->tgl_lahir);
                
                if($usia_sekarang > $u_max) {
                    $row_keterangan = "Tidak dapat";
                    $row_premi = "0";
                } else {
                    $row_keterangan = "Dapat";
                    $row_premi = $row_jumlah * $kec->besar_premi / 100;
                }
            @endphp
            <tr>
                <td class="t l b" height="15" align="center">{{ $no }}</td>
                <td class="t l b">{{ $pa->anggota->namadepan }}</td>
                <td class="t l b">{{ $pa->anggota->tempat_lahir }} <br> {{ $pa->anggota->tgl_lahir }}</td>
                <td class="t l b">{{ $pa->anggota->penjamin }}</td>
                <td class="t l b" align="right">{{ number_format($row_pokok) }}</td>
                <td class="t l b" align="right">{{ number_format($row_jasa) }}</td>
                <td class="t l b" align="right">{{ number_format($row_jumlah) }}</td>
                <td class="t l b" align="right">{{ number_format($row_premi) }}</td>
                <td class="t l b">{{ $row_keterangan }}</td>
                <td class="t l b r">{{ $no }}.</td>
            </tr>
            @php
                $j_pokok += $row_pokok;
                $j_jasa += $row_jasa;
                $j_jumlah += $row_jumlah;
                $j_premi += $row_premi;
            @endphp
        @endforeach
            <tr>
                <th class="t l b" height="15" align="center" colspan=4>Jumlah</th>
                <th class="t l b" align="right">{{ number_format($j_pokok) }}</th>
                <th class="t l b" align="right">{{ number_format($j_jasa) }}</th>
                <th class="t l b" align="right">{{ number_format($j_jumlah) }}</th>
                <th class="t l b" align="right">{{ number_format($j_premi) }}</th>
                <th class="t l b r" colspan=2>&nbsp;</th>
            </tr>
    </table>

                <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                    style="font-size: 11px;">
                    <tr>
                        <td width="60%">&nbsp;</td>
                        <td width="60"></td>
                        <td width="2"></td>
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
@endsection
