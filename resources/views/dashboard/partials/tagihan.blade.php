@php
    use App\Utils\Tanggal;
@endphp

<form action="" id="FormPemberitahuan">
    <div class="table-responsive">
        <table class="table table-striped midle" width="100%">
            <thead>
                <tr>
                    <td align="center" width="5%">
                        <div class="form-check text-center">
                            <input class="form-check-input" type="checkbox" value="true" id="checked" name="checked">
                        </div>
                    </td>
                    <td align="center">Nama Nasabah</td>
                    <td align="center">Tgl Cair</td>
                    <td align="center">Alokasi</td>
                    <td align="center">Tagihan Pokok</td>
                    <td align="center">Tagihan Jasa</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($pinjaman as $pinj)
                    @if ($pinj->target)
                        @php
                            $nomor = $pinj->anggota->telpon;
                            $desa = $pinj->anggota->d->sebutan_desa->sebutan_desa;
                            $desa .= ' ' . $pinj->anggota->d->nama_desa;

                            $value = $pesan;
                            $value = str_replace('{Nama Nasabah}', $pinj->anggota->namadepan, $value);
                            $value = str_replace('{Nama Desa}', $desa, $value);
                            $value = str_replace('{Angsuran Pokok}', number_format($pinj->target->wajib_pokok), $value);
                            $value = str_replace('{Angsuran Jasa}', number_format($pinj->target->wajib_jasa), $value);
                        @endphp
                        <tr>
                            <td>
                                <div class="form-check text-center">
                                    <input class="form-check-input" type="checkbox"
                                        value="{{ $nomor }}||{{ $pinj->anggota->nama_anggota }}||{{ $value }}"
                                        id="{{ $pinj->id }}" name="pinjaman[]" {!! strlen($nomor) >= 11 ? 'data-input="checked"' : 'disabled' !!}>
                                </div>
                            </td>
                            <td>{{ $pinj->anggota->namadepan }} - {{ $pinj->id }}</td>
                            <td align="center">{{ Tanggal::tglIndo($pinj->tgl_cair) }}</td>
                            <td align="right">{{ number_format($pinj->alokasi, 2) }}</td>
                            <td align="right">{{ number_format($pinj->target->wajib_pokok, 2) }}</td>
                            <td align="right">{{ number_format($pinj->target->wajib_jasa, 2) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</form>

<script>
    $(document).on('click', '#checked', function() {
        if ($(this)[0].checked == true) {
            $('[data-input=checked]').prop('checked', true)
        } else {
            $('[data-input=checked]').prop('checked', false)
        }
    })
</script>
