@php
    use App\Utils\Tanggal;
    $section = 0;
    $empty = false;
@endphp

@extends('pelaporan.layout.base')

@section('content')
    @foreach ($jenis_pp as $jpp)
        @php
            if ($jpp->pinjaman_anggota->isEmpty()) {
                $empty = true;
                continue;
            }

            $kd_desa = [];
            $t_angg = 0;
            $t_alokasi = 0;
        @endphp

        @if ($jpp->nama_jpp != 'Kendaraan' && !$empty)
            <div class="break"></div>
            @php
                $empty = false;
            @endphp
        @endif

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td colspan="3" align="center">
                    <div style="font-size: 18px;">
                        <b>DAFTAR PERMOHONAN KREDIT {{ strtoupper($jpp->nama_jpp) }}</b>
                    </div>
                    <div style="font-size: 16px;">
                        <b>{{ strtoupper($sub_judul) }}</b>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" height="5"></td>
            </tr>
        </table>

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr style="background: rgb(230, 230, 230); font-weight: bold;">
                <th class="t l b" height="20" width="5%">No</th>
                <th class="t l b" width="5%">Loan ID.</th>
                <th class="t l b" width="20%">Nasabah</th>
                <th class="t l b" width="15%">Tgl Verifikasi</th>
                <th class="t l b" width="10%">Tempo</th>
                <th class="t l b r" width="15%">Rekom Verifikator</th>
            </tr>

            @foreach ($jpp->pinjaman_anggota as $pinj_ang)
                @php
                    $kd_desa[] = $pinj_ang->kd_desa;
                    $desa = $pinj_ang->kd_desa;
                @endphp
                @if (array_count_values($kd_desa)[$pinj_ang->kd_desa] <= '1')
                    @if ($section != $desa && count($kd_desa) > 1)
                        @php
                            $t_angg += $j_angg;
                            $t_alokasi += $j_alokasi;
                        @endphp
                        <tr style="font-weight: bold;">
                            <td class="t l b" colspan="5">Jumlah {{ $nama_desa }}</td>
                            <td class="t l b r" align="right">{{ number_format($j_alokasi) }}</td>
                        </tr>
                    @endif

                    <tr style="font-weight: bold;">
                        <td class="t l b r" colspan="6" align="left">
                            {{ $pinj_ang->kode_desa }}. {{ $pinj_ang->nama_desa }}
                        </td>
                    </tr>

                    @php
                        $nomor = 1;
                        $j_angg = 0;
                        $j_alokasi = 0;
                        $section = $pinj_ang->kd_desa;
                        $nama_desa = $pinj_ang->sebutan_desa . ' ' . $pinj_ang->nama_desa;
                    @endphp
                @endif

                <tr>
                    <td class="t l b" align="center">{{ $nomor++ }}</td>
                    <td class="t l b" align="left"> {{ $pinj_ang->id }}</td>
                    <td class="t l b" align="left">{{ $pinj_ang->namadepan }} </td>
                    <td class="t l b" align="center">{{ Tanggal::tglIndo($pinj_ang->tgl_verifikasi) }}</td>
                    <td class="t l b" align="center">{{ $pinj_ang->jangka }}/{{ $pinj_ang->sis_pokok->sistem }}</td>
                    <td class="t l b r" align="right">{{ number_format($pinj_ang->verifikasi) }}</td>
                </tr>

                @php
                    $j_angg += 0;
                    $j_alokasi += $pinj_ang->verifikasi;
                @endphp
            @endforeach
            @if (count($kd_desa) > 0)
                @php
                    $t_angg += $j_angg;
                    $t_alokasi += $j_alokasi;
                @endphp

                <tr style="font-weight: bold;">
                    <td class="t l b" colspan="5">Jumlah {{ $nama_desa }}</td>
                    <td class="t l b r" align="right">{{ number_format($j_alokasi) }}</td>
                </tr>

                <tr>
                    <td colspan="6" style="padding: 0px !important;">
                        <table class="p" border="0" width="100%" cellspacing="0" cellpadding="0"
                            style="font-size: 11px;">
                            <tr style="background: rgb(74, 74, 74); font-weight: bold; color: #fff;" class="t l b r">
                                <td height="15" colspan="5" align="center">J U M L A H</td>
                                <td align="right" width="9%">{{ number_format($t_alokasi) }}</td>
                            </tr>
                        </table>

                        <div style="margin-top: 16px;"></div>
                        {!! json_decode(str_replace('{tanggal}', $tanggal_kondisi, $kec->ttd->tanda_tangan_pelaporan), true) !!}
                    </td>
                </tr>
            @endif

        </table>
    @endforeach
@endsection
