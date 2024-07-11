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
@endphp

<form action="/pengaturan/pinjaman/{{ $kec->id }}" method="post" id="FormPinjaman">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="default_jasa" class="form-label">Default Jasa (%)</label>
                <input autocomplete="off" type="number" name="default_jasa" id="default_jasa" class="form-control"
                    value="{{ $kec->def_jasa }}">
                <small class="text-danger" id="msg_default_jasa"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="default_jangka" class="form-label">Default Jangka (%)</label>
                <input autocomplete="off" type="number" name="default_jangka" id="default_jangka" class="form-control"
                    value="{{ $kec->def_jangka }}">
                <small class="text-danger" id="msg_default_jangka"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="pembulatan" class="form-label">Default Pembulatan</label>
                <select class="form-control" name="pembulatan" id="pembulatan">
                    <option {{ $pembulatan == '500' ? 'selected' : '' }} value="500">500</option>
                    <option {{ $pembulatan == '1000' ? 'selected' : '' }} value="1000">1000</option>
                </select>
                <small class="text-danger" id="msg_pembulatan"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label" for="def_fee_supp">Default Fee dari Supplier (%)</label>
                <input autocomplete="off" type="text" name="def_fee_supp" id="def_fee_supp" class="form-control"
                    value="{{ $kec->def_fee_supp }}">
                <small class="text-danger" id="msg_def_fee_supp"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb-3">
                <label for="sistem" class="form-label">Sistem Pembulatan </label>
                <select class="form-control" name="sistem" id="sistem">
                    <option {{ $sistem == 'auto' ? 'selected' : '' }} value="">Auto</option>
                    <option {{ $sistem == 'keatas' ? 'selected' : '' }} value="+">Keatas</option>
                    <option {{ $sistem == 'kebawah' ? 'selected' : '' }} value="-">Kebawah</option>
                </select>
                <small class="text-danger" id="msg_sistem"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label"for="def_fee_agen">Default Fee Agen (%)</label>
                <input autocomplete="off" type="text" name="def_fee_agen" id="def_fee_agen" class="form-control"
                    value="{{ $kec->def_fee_agen }}">
                <small class="text-danger" id="msg_def_fee_agen"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label" for="def_admin">Default Biaya Admin (Rp)</label>
                <input autocomplete="off" type="text" name="def_admin" id="def_admin" class="form-control"
                    value="{{ $kec->def_admin }}">
                <small class="text-danger" id="msg_def_admin"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label"for="hit_fee_agent">Rumus Fee Agen</label><br>
                    <input type="radio" id="hit_fee_agent" name="hit_fee_agent" value="1">
                    <label> Rumus 1 (Pros % Fee x Harga Barang)</label><br>
                    <input type="radio" id="hit_fee_agent" name="hit_fee_agent" value="2">
                    <label> Rumus 2 (Pros % Fee x Total Jasa)</label><br><br>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label class="form-label" for="jdwl_angsuran">Jenis Angsuran</label><br>
                <input type="radio" id="jdwl_angsuran" name="jdwl_angsuran" value="1">
                <label> Angsuran di Awal</label><br>
                <input type="radio" id="jdwl_angsuran" name="jdwl_angsuran" value="2">
                <label> Angsuran di Akhir Periode</label><br><br>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb-3">
                <label class="form-label"for="kabag_keuangan">Rumus Fee Agen</label><br>
                    
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Hanya satu</label><br>
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Lebih dari satu</label><br><br>
            </div>
        </div>
    </div> --}}
</form>

<div class="d-flex justify-content-end">
    <button type="button" id="SimpanPinjaman" data-target="#FormPinjaman" class="btn btn-secondary mb-0 btn-simpan">
        Simpan Perubahan
    </button>
</div>
