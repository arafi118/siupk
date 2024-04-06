@php
    use App\Utils\Tanggal;
@endphp

@extends('perguliran_i.dokumen.layout.base')

@section('content')
    @foreach ($pinkel->pinjaman_anggota as $pa)
        @if ($loop->iteration > 1)
            <div class="break"></div>
        @endif

        @php
            $identitas_peminjam = [
                [
                    'label' => 'Nama Anggota',
                    'value' => $pa->anggota->namadepan,
                ],
                [
                    'label' => 'NIK',
                    'value' => $pa->anggota->nik,
                ],
                [
                    'label' => 'Tempat, Tanggal Lahir',
                    'value' => $pa->anggota->tempat_lahir . ', ' . Tanggal::tglLatin($pa->anggota->tgl_lahir),
                ],
                [
                    'label' => 'Alamat',
                    'value' => $pa->anggota->alamat,
                ],
                [
                    'label' => 'Jenis Kelamin',
                    'value' => $pa->anggota->jk,
                ],
                [
                    'label' => 'Lama Menjadi Anggota',
                    'value' => '',
                ],
                [
                    'label' => 'Pekerjaan Pokok Suami',
                    'value' => '',
                ],
                [
                    'label' => 'Pekerjaan Pokok Istri',
                    'value' => '',
                ],
                [
                    'label' => 'Jumlah Kredit yang Diminta',
                    'value' => 'Rp. ' . number_format($pa->proposal),
                ],
                [
                    'label' => 'Jenis Usaha yang Akan Didanai',
                    'value' => is_numeric($pa->anggota->usaha) ? $pa->anggota->u->nama_usaha : $pa->anggota->usaha,
                ],
                [
                    'label' => 'Alokasi Lalu',
                    'value' => '',
                ],
            ];
            $informasi_dalam_kelompok = ['Apakah anggota ini aktif dalam pertemuan kelompok', 'Apakah anggota ini aktif memberikan usul, pendapat, sadan dan sebagainya', 'Apakah anggota ini menunjukkan sikap tenang dan terbuka', 'Apakah anggota ini jujur, disiplin dan berusaha menepati janji', 'Apakah anggota ini bersedia membayar iuran-iuran di kelompok', 'Apakah anggota ini disiplin dalam membayar pinjamannya', 'Apakah anggota ini rajin menabung di kelompok', 'Apakah bersedia menjaminkan harta/tabungan sebagai jaminan kredit yang diminta', 'Apakah bersedia menandatangani perjanjian kredit berdua (suami/istri/orang tua)'];
            $pendapatan_pengeluaran = [['Pendapatan keluarga 1 (satu) bulan', 'Pendapatan dan usaha suami', 'Pendapatan dan usaha istri', 'Pendapatan dari hasil kebun, sawah, ladang', 'Pendapatan lain-lain'], ['Pengeluaran keluarga', 'Pembelian alat/barang dagangan', 'Pengeluaran kebutuhan makan/minum', 'Pengeluaran sabun-cuci-mandi', 'Pengeluaran untuk sekolah', 'Pengeluaran untuk sosial', 'Pengeluaran listrik, telpon, dll', 'Angsuran pinjaman di bank/koperasi/perorangan', 'Pengeluaran lain-lain']];
            $jaminan = ['Tabungan di kelompok atas nama pribadi', 'Nilai harta lain berupa ....................................'];
            $penilaian = ['Ratio pendapatan keluarga (bersih) per bulan dibagi angsuran per bulan', 'Ratio tabungan di kelompok dibagi kredit yang diajukan'];
        @endphp

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
            <tr>
                <td class="b" colspan="3" align="center">
                    <div style="font-size: 16px;">
                        PENILAIAN PERMOHONAN PINJAMAN ANGGOTA KELOMPOK
                    </div>
                </td>
            </tr>
        </table>

        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px; table-layout: fixed;">
            <tbody>
                <tr style="font-weight: bold;">
                    <td width="3%" height="15" align="center">A.</td>
                    <td colspan="6">IDENTITAS PEMINJAM (ANGGOTA)</td>
                </tr>

                @foreach ($identitas_peminjam as $dt => $val)
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center" width="3%">{{ $loop->iteration }}.</td>
                        <td width="45%">{{ $val['label'] }}</td>
                        <td colspan="4">: {{ $val['value'] }}</td>
                    </tr>
                @endforeach

                <tr style="font-weight: bold;">
                    <td class="t l b" align="center" height="15">B.</td>
                    <td class="t b" colspan="4">INFORMASI DALAM KELOMPOK</td>
                    <td class="t l b" width="7%" align="center">YA</td>
                    <td class="t l b r" width="7%" align="center">TIDAK</td>
                </tr>

                @foreach ($informasi_dalam_kelompok as $idk => $val)
                    <tr>
                        <td class="t l b">&nbsp;</td>
                        <td class="t b" align="center" width="3%">{{ $loop->iteration }}.</td>
                        <td class="t b" colspan="3">{{ $val }}</td>
                        <td class="t l b" align="center">&nbsp;</td>
                        <td class="t l b r" align="center">&nbsp;</td>
                    </tr>
                @endforeach

                <tr style="font-weight: bold;">
                    <td height="15" align="center">C.</td>
                    <td colspan="6">INFORMASI PENDAPATAN & PENGELUARAN</td>
                </tr>

                @foreach ($pendapatan_pengeluaran as $pp => $p)
                    @php
                        $no = $loop->iteration;
                        $nomor = 0;
                    @endphp
                    @foreach ($p as $pen => $val)
                        @php
                            $number = '';
                            if ($no != $nomor) {
                                $nomor = $no;
                                $number = $no . '.';
                            }

                            $title = 'Pengeluaran';
                            if ($no == 1) {
                                $title = 'Pendapatan';
                            }
                        @endphp

                        <tr>
                            <td>&nbsp;</td>
                            <td align="center" width="3%">{{ $number }}</td>
                            <td colspan="2">{{ $val }}</td>
                            <td width="7%">Rp.</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    @endforeach

                    <tr style="font-weight: bold;">
                        <td>&nbsp;</td>
                        <td align="center" width="3%">&nbsp;</td>
                        <td align="center" colspan="2">Jumlah {{ $title }}</td>
                        <td width="7%">Rp.</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                @endforeach

                <tr style="font-weight: bold;">
                    <td height="15" align="center">D.</td>
                    <td colspan="6">IDENTITAS JAMINAN</td>
                </tr>

                @foreach ($jaminan as $jam => $val)
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center" width="3%">{{ $loop->iteration }}.</td>
                        <td colspan="2">{{ $val }}</td>
                        <td width="7%">Rp.</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                @endforeach

                <tr style="font-weight: bold;" class="break">
                    <td>&nbsp;</td>
                    <td align="center" width="3%">&nbsp;</td>
                    <td align="center" colspan="2">Total Nilai Jaminan</td>
                    <td width="7%">Rp.</td>
                    <td colspan="2">&nbsp;</td>
                </tr>

                <tr style="font-weight: bold;">
                    <td height="15" align="center">E.</td>
                    <td colspan="6">PENILAIAN</td>
                </tr>

                @foreach ($penilaian as $pn => $val)
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center" width="3%">{{ $loop->iteration }}.</td>
                        <td colspan="2">{{ $val }}</td>
                        <td width="7%">.....%</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                @endforeach

                <tr style="font-weight: bold;">
                    <td height="15" align="center">E.</td>
                    <td colspan="6">KESIMPULAN</td>
                </tr>

                <tr class="vt">
                    <td>&nbsp;</td>
                    <td colspan="2">
                        <div>
                            Anggota/pemanfaat ini LAYAK / TIDAK LAYAK untuk diberikan pinjaman sebesar:
                        </div>
                        <div>
                            ........................................................................
                        </div>
                        <div>
                            Catatan:
                            <br>
                            <br>
                        </div>
                        <div>
                            Coret yang tidak perlu
                        </div>
                    </td>
                    <td colspan="4">
                        <div>Diverifikasi pada : .....................................</div>
                        <div>Oleh: Tim Verifikasi Kecamatan</div>
                        <table border="0" width="100%" cellspacing="0" cellpadding="0"
                            style="font-size: 11px; table-layout: fixed;">
                            @foreach ($verifikator as $verif)
                                <tr>
                                    <td width="60%">
                                        <div>
                                            <b>{{ $verif->namadepan . ' ' . $verif->namabelakang }}</b>
                                        </div>
                                        <div>
                                            <b>(Verifikator)</b>
                                        </div>
                                    </td>
                                    <td width="40%" align="right">
                                        <b>__________________</b>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    @endforeach
@endsection
