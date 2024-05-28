@php
    $calk = json_decode($kec->calk, true);
    $peraturan_desa = $calk['peraturan_desa'];
@endphp

<form action="/pengaturan/lembaga/{{ $kec->id }}" method="post" id="FormLembaga">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-3">
            <div class="position-relative mb-3"><label for="id" class="form-label">ID</label>
                <input autocomplete="off" name="id" id="id" type="text"
                    class="form-control"value="{{ $kec->id }}" readonly>
                <small class="text-danger" id="msg_id"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="position-relative mb-3"><label for="kd_kec" class="form-label">Kode
                    Kec.</label>
                <input autocomplete="off" name="kd_kec" id="kd_kec" type="text"
                    class="form-control"value="{{ $kec->kd_kec }}" readonly>
                <small class="text-danger" id="msg_kd_kec"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3"><label for="nama_bumdesma" class="form-label">Nama Lembaga</label>
                <input autocomplete="off" name="nama_bumdesma" id="nama_bumdesma" type="text" class="form-control"
                    value="{{ $kec->nama_lembaga_sort }}">
                <small class="text-danger" id="msg_nama_bumdesma"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="position-relative mb-3"><label for="nomor_badan_hukum" class="form-label">Badan Hukum
                    No.</label>
                <input autocomplete="off" name="nomor_badan_hukum" id="nomor_badan_hukum" type="text"
                    class="form-control"value="{{ $kec->nomor_bh }}">
                <small class="text-danger" id="msg_nomor_badan_hukum"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3"><label for="telpon" class="form-label">Telpon</label>
                <input autocomplete="off" name="telpon" id="telpon" type="text"
                    class="form-control"value="{{ $kec->telpon_kec }}">
                <small class="text-danger" id="msg_telpon"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3"><label for="email" class="form-label">Email </label>
                <input autocomplete="off" name="email" id="email" type="email" class="form-control"
                    value="{{ $kec->email_kec }}">
                <small class="text-danger" id="msg_email"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb-3"><label for="alamat" class="form-label">Alamat</label>
                <input autocomplete="off" name="alamat" id="alamat" type="text"placeholder="Alamat"
                    class="form-control"value="{{ $kec->alamat_kec }}">
                <small class="text-danger" id="msg_alamat"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="position-relative mb-3"><label for="web_utama" class="form-label">Web Utama</label>
                <input autocomplete="off" name="web_utama" id="web_utama" type="text"
                    class="form-control"value="{{ $kec->web_kec }}" readonly>
                <small class="text-danger" id="msg_web_utama"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3"><label for="web_alternatif" class="form-label">Web Alternatif</label>
                <input autocomplete="off" name="web_alternatif" id="web_alternatif" type="text"
                    class="form-control"value="{{ $kec->web_alternatif }}" readonly>
                <small class="text-danger" id="msg_web_alternatif"></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative mb-3"><label for="peraturan_desa" class="form-label">Peraturan Desa Nomor
                </label>
                <input autocomplete="off" name="peraturan_desa" id="peraturan_desa" type="peraturan_desa"
                    class="form-control" value="{{ $kec->peraturan_desa }}">
                <small class="text-danger" id="msg_peraturan_desa"></small>
            </div>
        </div>
    </div>
</form>

<div class="d-flex justify-content-end">
    <button type="button" id="SimpanLembaga" data-target="#FormLembaga" class="btn btn-secondary">
        Simpan Perubahan
    </button>
</div>
