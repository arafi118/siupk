@php
    use App\Utils\Tanggal;
@endphp

<table class="table table-striped">
    <tbody>
        <tr>
            <td>Loan Id.</td>
            <td>:</td>
            <td style="font-weight: bold !important;" colspan="5">
                {{ $nia->jpp->nama_jpp }}-{{ $nia->id }}
            </td>
        </tr>
        <tr>
            <td width="20%">NIK</td>
            <td width="1%">:</td>
            <td width="27" style="font-weight: bold !important;">{{ $nia->anggota->nik }}</td>

            <td width="4%">&nbsp;</td>

            <td width="20%">Nama Peminjam</td>
            <td width="1%">:</td>
            <td width="27" style="font-weight: bold !important;">{{ $nia->anggota->namadepan }}</td>
        </tr>
        <tr>
            <td>Telpon/SMS</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ $nia->anggota->hp }}</td>

            <td>&nbsp;</td>

            <td>Tgl Cair</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ Tanggal::tglIndo($nia->tgl_cair) }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ $nia->anggota->alamat }}</td>

            <td>&nbsp;</td>

            <td>Desa</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ $nia->anggota->d->nama_desa }}</td>
        </tr>
        <tr>
            <td>No. SPK</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ $nia->spk_no }}</td>

            <td>&nbsp;</td>

            <td>Sistem Angsuran</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ $nia->jangka }} bulan @
                {{ $nia->sis_pokok->nama_sistem }}</td>
        </tr>
        <tr>
            <td>Alokasi</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ number_format($nia->alokasi) }}</td>

            <td>&nbsp;</td>

            <td>Jasa</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ $nia->pros_jasa / $nia->jangka }}%</td>
        </tr>
        <tr>
            <td>Angsuran Pokok</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ number_format($nia->target->wajib_pokok) }} x
                {{ $nia->jangka }}
            </td>

            <td>&nbsp;</td>

            <td>Angsuran Jasa</td>
            <td>:</td>
            <td style="font-weight: bold !important;">{{ number_format($nia->target->wajib_jasa) }} x
                {{ $nia->jangka }}
            </td>
        </tr>
    </tbody>
</table>
