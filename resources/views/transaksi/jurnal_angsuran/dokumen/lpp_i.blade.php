@php
    use App\Utils\Tanggal;

    $pokok = 0;
    $jasa = 0;
    $target_pokok = 0;
    $target_jasa = 0;

    $t_real_pokok = 0;
    $t_real_jasa = 0;
    $t_saldo = 0;
    $t_tunggakan_pokok = 0;
    $t_tunggakan_jasa = 0;
@endphp

@extends('transaksi.layout.base')

@section('content')
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td colspan="3" align="center">
                <div style="font-size: 18px;">
                    LAPORAN PERKEMBANGAN PINJAMAN PER KELOMPOK
                </div>
                <div style="font-size: 18px; font-weight: bolder; text-transform: uppercase;">
                    KELOMPOK {{ $id_pinj_i->jpp->nama_jpp }} {{ $id_pinj_i->anggota->namadepan }}
                    {{ $id_pinj_i->anggota->d->sebutan_desa->sebutan_desa }} {{ $id_pinj_i->anggota->d->nama_desa }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"></td>
        </tr>
    </table>
    <table border="0" width="90%" align="center" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td width="30">&nbsp;</td>
            <td width="50">Kd. Kelompok</td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->anggota->nik}}</b>
            </td>
            <td width="50">Loan ID</td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->jpp->nama_jpp }}-{{ $id_pinj_i->id }}</b>
            </td>
        </tr>
        <tr>
            <td width="30">&nbsp;</td>
            <td width="50">Nama Kelompok</td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->anggota->namadepan}}</b>
            </td>
            <td width="50">Nomor SPK</td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->spk_no }}</b>
            </td>
        </tr>
        <tr>
            <td width="30">&nbsp;</td>
            <td width="50">Alamat</td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->anggota->alamat}}</b>
            </td>
            <td width="50">Tanggal Cair</td>
            <td width="100">: &nbsp;
                <b>{{ Tanggal::tglLatin($id_pinj_i->tgl_cair) }}</b>
            </td>
        </tr>
        <tr>
            <td width="30">&nbsp;</td>
            <td width="50">{{ $id_pinj_i->anggota->d->sebutan_desa->sebutan_desa }}</td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->anggota->d->nama_desa }}</b>
            </td>
            <td width="50">Alokasi Pinjaman </td>
            <td width="100">: &nbsp;
                <b>{{ number_format($id_pinj_i->alokasi) }}</b>
            </td>
        </tr>
        <tr>
            <td width="30">&nbsp;</td>
            <td width="50">Telpon/SMS </td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->anggota->hp}}</b>
            </td>
            <td width="50">Prosentase, Jenis Jasa</td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->pros_jasa > 0 ? $id_pinj_i->pros_jasa / $id_pinj_i->jangka : '0' }}% / Bulan,
                    {{ $id_pinj_i->jasa->nama_jj }}</b>
            </td>
        </tr>
        <tr>
            <td width="30">&nbsp;</td>
            <td width="50">&nbsp;</td>
            <td width="100">&nbsp;</td>
            <td width="50">Sistem Angsuran</td>
            <td width="100">: &nbsp;
                <b>{{ $id_pinj_i->sis_pokok->nama_sistem }} ({{ $id_pinj_i->jangka }} Bulan)</b>
            </td>
        </tr>
        <tr>
            <td width="30">&nbsp;</td>
            <td width="50">&nbsp;</td>
            <td width="100">&nbsp;</td>
            <td width="50">Jumlah Angsuran </td>
            <td width="100">: &nbsp;
                <b>
                    Rp. {{ number_format($id_pinj_i->target->wajib_pokok) }} x
                    {{ $id_pinj_i->jangka / $id_pinj_i->sis_pokok->sistem }}
                </b>
            </td>
        </tr>
    </table>
    <table border="0" width="98%" align="center" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr style="font-weight: bold;">
            <td class=" l t b" rowspan="2" width="10" align="center">KE</td>
            <td class=" l t b" rowspan="2" width="150" align="center">BULAN</td>
            <td class=" l t b" colspan="2" width="100" align="center">TARGET</td>
            <td class=" l t b" colspan="2" width="100" align="center">REALISASI</td>
            <td class=" l t b" rowspan="2" width="100" align="center">SALDO PINJAMAN</td>
            <td class=" l t r b" colspan="2" width="100" align="center">TUNGGAKAN</td>
        </tr>
        <tr style="font-weight: bold;">
            <td class=" l b" align="center">POKOK</td>
            <td class=" l b" align="center">JASA</td>
            <td class=" l b" align="center">POKOK</td>
            <td class=" l b" align="center">JASA</td>
            <td class=" l b" align="center">POKOK</td>
            <td class=" l r b" align="center">JASA</td>
        </tr>
        @foreach ($rencana as $ra)
            @php
                $warna = '';
                $real_pokok = 0;
                $real_jasa = 0;
                $nunggak_pokok  =0;
                $bulan_ini = date('Y-m-t', strtotime($ra->jatuh_tempo));
                if ($bulan_ini <= $bulan) {
                    $target_pokok = $ra->target_pokok;
                    $target_jasa = $ra->target_jasa;

                    $real_pokok = $ra->sum_pokok - $pokok;
                    $real_jasa = $ra->sum_jasa - $jasa;
                    $saldo = $id_pinj_i->alokasi - $ra->sum_pokok;
                    if ($saldo < 0) {
                        $saldo = 0;
                    }
                    $nunggak_pokok = $ra->target_pokok - $ra->sum_pokok;
                    if ($nunggak_pokok < 0) {
                        $nunggak_pokok = 0;
                    }
                    $nunggak_jasa = $ra->target_jasa - $ra->sum_jasa;
                    if ($nunggak_jasa < 0) {
                        $nunggak_jasa = 0;
                    }

                    $t_real_pokok = $ra->sum_pokok;
                    $t_real_jasa = $ra->sum_jasa;
                    $t_saldo = $saldo;
                    $t_tunggakan_pokok = $nunggak_pokok;
                    $t_tunggakan_jasa = $nunggak_jasa;
                }

                if ($nunggak_pokok > 0 && $nunggak_jasa > 0 && $bulan_ini < $bulan) {
                    $warna = 'red;';
                }
            @endphp
            <tr style="color: {{ $bulan_ini == $bulan ? 'green; font-weight: bold;' : '' }}">
                <td class="l" align="center">{{ $ra->angsuran_ke }}.</td>
                <td class="l" align="left">{{ Tanggal::tglLatin($ra->jatuh_tempo) }}</td>
                <td class="l" align="right">{{ number_format($ra->target_pokok) }}</td>
                <td class="l" align="right">{{ number_format($ra->target_jasa) }}</td>
                <td class="l" align="right">
                    {{ number_format($real_pokok) }}
                </td>
                <td class="l" align="right">
                    {{ number_format($real_jasa) }}
                </td>
                @if ($bulan_ini > $bulan)
                    <td class="l" align="right">
                        0
                    </td>
                    <td class="l" align="right">
                        0
                    </td>
                    <td class="l r" align="right">
                        0
                    </td>
                @else
                    <td class="l" align="right">
                        {{ number_format($saldo) }}
                    </td>
                    <td class="l" align="right" style="color: {{ $warna }};">
                        {{ number_format($nunggak_pokok) }}
                    </td>
                    <td class="l r" align="right" style="color: {{ $warna }};">
                        {{ number_format($nunggak_jasa) }}
                    </td>
                @endif
            </tr>

            @php
                if ($ra->sum_pokok != $pokok) {
                    $pokok = $ra->sum_pokok;
                }

                if ($ra->sum_jasa != $jasa) {
                    $jasa = $ra->sum_jasa;
                }
            @endphp
        @endforeach
        <tr style="font-weight: bold;">
            <td class="l t b" align="center" colspan="2" height="20">
                REKAPITULASI
            </td>
            <td class="t l b" align="right">{{ number_format($target_pokok) }}</td>
            <td class="t l b" align="right">{{ number_format($target_jasa) }}</td>
            <td class="t l b" align="right">{{ number_format($t_real_pokok) }}</td>
            <td class="t l b" align="right">{{ number_format($t_real_jasa) }}</td>
            <td class="t l b" align="right">{{ number_format($t_saldo) }}</td>
            <td class="t l b" align="right">{{ number_format($t_tunggakan_pokok) }}</td>
            <td class="t l b r" align="right">{{ number_format($t_tunggakan_jasa) }}</td>
        </tr>
    </table>
@endsection
