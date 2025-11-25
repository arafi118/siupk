@php
    use App\Utils\Keuangan;
    $pembulatan = (string) $kec->pembulatan;

    $sistem = 'auto';
    if (Keuangan::startWith($pembulatan, '+')) {
        $sistem = 'keatas';
        $pembulatan = intval($pembulatan);
    }

    if (Keuangan::startWith($pembulatan, '-')) {
        $sistem = 'kebawah';
        $pembulatan = intval($pembulatan * -1);
    }
    $kolekDb = $kec->kolek ? json_decode($kec->kolek, true) : [];

    $kolekDefaults = [
        ['nama' => '', 'prosentase' => '', 'durasi' => '', 'satuan' => 'hari'],
        ['nama' => '', 'prosentase' => '', 'durasi' => '', 'satuan' => 'hari'],
        ['nama' => '', 'prosentase' => '', 'durasi' => '', 'satuan' => 'hari'],
        ['nama' => '', 'prosentase' => '', 'durasi' => '', 'satuan' => 'hari'],
        ['nama' => '', 'prosentase' => '', 'durasi' => '', 'satuan' => 'hari'],
    ];

    $kolekValues = array_replace_recursive($kolekDefaults, $kolekDb);
@endphp

    <!-- Note -->
    <div class="alert alert-info mt-3" role="alert">
        Durasi adalah kurang dari (<).
    </div>
    <!-- Note -->
    <div class="alert alert-warning mt-3" role="alert">
        Catatan: Apabila sistem hanya menggunakan tiga tingkat kolektibilitas, maka isian untuk Kolek Tingkat 4 dan Kolek Tingkat 5 dapat dikosongkan.
    </div>

<form action="/pengaturan/kolek/{{ $kec->id }}" method="post" id="Formkolek">
    @csrf
    @method('PUT')

    @for ($i = 0; $i < 5; $i++)
    <div class="row">
        <!-- Nama Kolek -->
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="nama_kolek{{ $i+1 }}">Kolek Tingkat {{ $i+1 }}</label>
                <input autocomplete="off" type="text" name="nama_kolek{{ $i+1 }}" id="nama_kolek{{ $i+1 }}"
                    class="form-control"
                    value="{{ old('nama_kolek'.($i+1), $kolekValues[$i]['nama']) }}">
                <small class="text-danger" id="msg_nama_kolek{{ $i+1 }}"></small>
            </div>
        </div>

        <!-- Prosentase -->
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="pros_kolek{{ $i+1 }}">Prosentase (%)</label>
                <input autocomplete="off" type="number" name="pros_kolek{{ $i+1 }}" id="pros_kolek{{ $i+1 }}"
                    class="form-control"
                    value="{{ old('pros_kolek'.($i+1), $kolekValues[$i]['prosentase']) }}">
                <small class="text-danger" id="msg_pros_kolek{{ $i+1 }}"></small>
            </div>
        </div>

        <!-- Durasi -->
        <div class="col-md-3">
            <div class="input-group input-group-static my-3">
                <label for="durasi{{ $i+1 }}">Durasi</label>
                <input autocomplete="off" type="number" name="durasi{{ $i+1 }}" id="durasi{{ $i+1 }}"
                    class="form-control"
                    value="{{ old('durasi'.($i+1), $kolekValues[$i]['durasi']) }}">
                <small class="text-danger" id="msg_durasi{{ $i+1 }}"></small>
            </div>
        </div>

        <!-- Satuan -->
        <div class="col-md-3">
            <div class="my-2">
                <label class="form-label" for="satuan{{ $i+1 }}">Satuan Durasi</label>
                <select class="form-control" name="satuan{{ $i+1 }}" id="satuan{{ $i+1 }}">
                    <option value="hari" {{ old('satuan'.($i+1), $kolekValues[$i]['satuan']) == 'hari' ? 'selected' : '' }}>Hari</option>
                    <option value="bulan" {{ old('satuan'.($i+1), $kolekValues[$i]['satuan']) == 'bulan' ? 'selected' : '' }}>Bulan</option>
                </select>
                <small class="text-danger" id="msg_satuan{{ $i+1 }}"></small>
            </div>
        </div>
    </div>
    @endfor

</form>

<div class="d-flex justify-content-end">
    <button type="button" id="Simpankolek" data-target="#Formkolek"
        class="btn btn-sm btn-github mb-0 btn-simpan">
        Simpan Perubahan
    </button>
</div>
