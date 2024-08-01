@php
    use App\Utils\Inventaris as Inv;
@endphp
<div>
<input type="hidden" name="harsat" id="harsat">
<input type="hidden" name="relasi" id="relasi">
<div class="row">
    <div class="col-md-8">
        <div class="position-relative mb-3">
            <label class="form-label" for="nama_barang">Nama Barang</label>
            <select class="js_select2 form-control" name="nama_barang" id="nama_barang">
                <option value="">-- Pilih Nama Barang --</option>
                @foreach ($inventaris as $inv)
                    @php
                        $nilai_buku = Inv::nilaiBuku($tgl_transaksi, $inv);
                    @endphp
                    <option value="{{ $inv->id }}#{{ $inv->unit }}#{{ $nilai_buku }}">
                        {{ $inv->nama_barang }} ({{ $inv->unit }} unit x
                        {{ number_format($inv->harsat) }}) | NB. {{ number_format($nilai_buku, 2) }}
                    </option>
                @endforeach
            </select>
            <small class="text-danger" id="msg_nama_barang"></small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="position-relative mb-3">
            <label class="form-label" for="alasan">Alasan</label>
            <select class="js_select2 form-control" name="alasan" id="alasan">
                <option value="">-- Alasan Penghapusan --</option>
                <option value="hapus">Hapus</option>
                <option value="hilang">Hilang</option>
                <option value="rusak">Rusak</option>
                <option value="dijual">Dijual</option>
            </select>
            <small class="text-danger" id="msg_alasan"></small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6" id="col_unit">
        <div class="position-relative mb-3">
            <label for="unit">Jumlah (unit)</label>
            <input autocomplete="off" type="number" name="unit" id="unit" class="form-control">
            <small class="text-danger" id="msg_unit"></small>
        </div>
    </div>
    <div class="col-md-6" id="col_nilai_buku">
        <div class="position-relative mb-3">
            <label for="nilai_buku">Nilai Buku</label>
            <input autocomplete="off" readonly disabled type="text" name="nilai_buku" id="nilai_buku"
                class="form-control">
            <small class="text-danger" id="msg_nilai_buku"></small>
        </div>
    </div>
</div>
<div class="row" id="col_harga_jual" style="display: none">
    <div class="col-md-12">
        <div class="position-relative mb-3">
            <label for="harga_jual">Harga Jual</label>
            <input autocomplete="off" type="text" name="harga_jual" id="harga_jual" class="form-control">
            <small class="text-danger" id="msg_harga_jual"></small>
        </div>
    </div>
</div>
</div>
<script>
    $('.js_select2').select2({
     theme: 'bootstrap-5'
    });
    new Choices($('#nama_barang')[0])
    new Choices($('#alasan')[0])

    $("#nilai_buku").maskMoney({
        allowNegative: true
    });

    $("#harga_jual").maskMoney({
        allowNegative: true
    });
</script>
