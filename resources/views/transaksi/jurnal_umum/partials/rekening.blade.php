<div>
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="sumber_dana">Sumber Dana</label>
                <select class="js-select2 form-control" name="sumber_dana" id="sumber_dana">
                    <option value="">-- {{ $label1 }} --</option>
                    @foreach ($rek1 as $r1)
                        <option value="{{ $r1->kode_akun }}">
                            {{ $r1->kode_akun }}. {{ $r1->nama_akun }}
                        </option>
                    @endforeach
                </select>
                <small class="text-danger" id="msg_sumber_dana"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative mb-3">
                <label for="disimpan_ke">{{ $label2 }}</label>
                <select class="js-select2 form-control" name="disimpan_ke" id="disimpan_ke">
                    <option value="">-- {{ $label2 }} --</option>
                    @foreach ($rek2 as $r2)
                        <option value="{{ $r2->kode_akun }}">
                            {{ $r2->kode_akun }}. {{ $r2->nama_akun }}
                        </option>
                    @endforeach
                </select>
                <small class="text-danger" id="msg_disimpan_ke"></small>
            </div>
        </div>
    </div>
</div>
<script>
        $('.js-select2').select2({
        theme: 'bootstrap-5'
        });
</script>