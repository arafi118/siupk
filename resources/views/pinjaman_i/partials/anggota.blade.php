@php
    use App\Models\PinjamanIndividu;

    $selected = false;
@endphp
<style>
    .custom-button {
    width: 200px; /* Atur panjang tombol sesuai kebutuhan */
    float: right; /* Tempatkan tombol di sebelah kanan */
    text-align: center; /* Pusatkan teks di tombol */
    background-color: #2280de; /* Warna latar belakang */
    color: white; /* Warna teks */
    border: none; /* Hilangkan border */
    border-radius: 5px; /* Atur radius sudut */
    cursor: pointer; /* Ubah kursor saat dihover */
}

.custom-button:hover {
    background-color: #495057; /* Warna latar belakang saat dihover */
}

</style>
<div class="row">
    <div class="col-md-8">
        <div class="position-relative mb-3">
            <select class="js-example-basic-single form-select" name="individu" id="individu" style="width:100%">
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
                            [{{ $pinjaman }}] {{ $ang->namadepan }} []
                        @endif
                    </option>
                @endforeach
            </select>
            <small class="text-danger" id="msg_individu"></small>

        </div>
    </div>
    <div class="col-md-4 position-relative mb-3 resizeable">
        <div class="d-grid w-100 mb-2">
            <a href="/database/penduduk/register_penduduk" class="btn btn-info btn-sm" style="width: 300px; height: 35px;">Reg. Calon Nasabah</a>
        </div>
    </div>
    
</div>

<script>
  $('.js-example-basic-single').select2({
        theme: 'bootstrap-5'
    });
</script>
