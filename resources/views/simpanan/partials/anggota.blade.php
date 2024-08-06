@php
    use App\Models\PinjamanIndividu;

    $selected = false;
@endphp

<div class="row">
    <div class="col-md-9 col-7">
        <select class="form-control mb-0" name="individu" id="individu">
            @foreach ($anggota as $ang)
                @php
                    $pinjaman = 'N';
                    if ($ang->pinjaman) {
                        $status = $ang->pinjaman->status;
                        $pinjaman = $status;
                    }

                    $select = false;
                    if (!($pinjaman == 'P' || $pinjaman == 'V' || $pinjaman == 'W') && !$selected) {
                        $select = true;
                        $selected = true;
                    }

                    if ($nia > 0) {
                        $select = false;
                    }

                    if ($ang->id == $nia) {
                        $select = true;
                    }
                @endphp
                <option {{ $select ? 'selected' : '' }} value="{{ $ang->id }}">
                    @if (isset($ang->d))
                        [{{ $pinjaman }}] {{ $ang->nik }} {{ $ang->namadepan }} [{{ $ang->d->nama_desa }}]
                    @else
                        [{{ $pinjaman }}] {{ $ang->namadepan1 }} []
                    @endif
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 col-5 d-flex align-items-end">
        <div class="d-grid w-100 mb-2">
            <a href="/database/penduduk/register_penduduk" class="btn btn-info btn-sm mb-0">Register Individu</a>
        </div>
    </div>
</div>

<script>
    new Choices($('#individu')[0], {
        shouldSort: false,
        fuseOptions: {
            threshold: 0.1,
            distance: 1000
        }
    })
</script>
