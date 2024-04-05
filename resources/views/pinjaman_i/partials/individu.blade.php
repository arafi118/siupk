@php
    use App\Models\PinjamanIndividu;

    $selected = false;
@endphp

<div class="row">
    <div class="col-md-9 col-7">
        <select class="form-control mb-0" name="individu" id="individu">
            @foreach ($individu as $ind)
                @php
                    $pinjaman = 'N';
                    if ($ind->pinjaman_count > 0) {
                        $status = $ind->pinjaman->status;
                        $pinjaman = $status;
                    }

                    $select = false;
                    if (!($pinjaman == 'P' || $pinjaman == 'V' || $pinjaman == 'W') && !$selected) {
                        $select = true;
                        $selected = true;
                    }

                    if ($id_ind > 0) {
                        $select = false;
                    }

                    if ($ind->id == $id_ind) {
                        $select = true;
                    }
                @endphp
                <option {{ $select ? 'selected' : '' }} value="{{ $ind->id }}">
                    @if (isset($ind->d))
                        [{{ $pinjaman }}] {{ $ind->nama_depan }} [{{ $ind->d->nama_desa }}]
                        [{{ $ind->ketua }}]
                    @else
                        [{{ $pinjaman }}] {{ $ind->nama_depan }} []
                    @endif
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 col-5 d-flex align-items-end">
        <div class="d-grid w-100 mb-2">
            <a href="/database/individu/register_individu" class="btn btn-info btn-sm mb-0">Register Individu</a>
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
