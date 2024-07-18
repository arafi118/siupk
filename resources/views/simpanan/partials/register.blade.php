<div class="card">
    <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
            <i class="material-icons opacity-10">note_add</i>
        </div>
        <h6 class="mb-0">
            Register Simpanan {{ $anggota->namadepan }}
        </h6>
        <div class="text-xs">
            {{ $anggota->d->sebutan_desa->sebutan_desa }} {{ $anggota->d->nama_desa }},
            {{ $anggota->d->kd_desa }}
        </div>
    </div>
    <div class="card-body pt-0">
        <form action="/simpanan/store" method="post" id="FormRegisterProposal">
            @csrf

            <input type="hidden" name="nia" id="nia" value="{{ $anggota->id }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="my-2">
                        <label class="form-label" for="jenis_simpanan">Jenis Produk Simpanan</label>
                        <select class="form-control" name="jenis_simpanan" id="jenis_simpanan">
                            @foreach ($js as $jps)
                                <option {{ $js_dipilih == $jps->id ? 'selected' : '' }}
                                    value="{{ $jps->id }}">
                                    {{ $jps->nama_js }} ({{ $jps->deskripsi_js }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="msg_jenis_simpanan"></small>
                    </div>
                </div>
            </div>
            <div class="row" id="FormSimpanan">mohon menunggu . . . </div>
        </form>

        <button type="submit" id="SimpanProposal" class="btn btn-github btn-sm float-end">Simpan Proposal</button>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".date").flatpickr({
        dateFormat: "d/m/Y"
    });
    
    // Atur nilai awal jenis_simpanan ke 1
    $('#jenis_simpanan').val('1');

    // Panggil fungsi jenis_simpanan() saat halaman dimuat
    jenis_simpanan();

    $(document).on('change', '#jenis_simpanan', function() {
        jenis_simpanan();
    });

    function jenis_simpanan() {
        let jenis_simpanan = $('#jenis_simpanan').val();
        let nia = $('#nia').val();
        $.get('/register_simpanan/jenis_simpanan/' + jenis_simpanan, { nia: nia }, function(result) {
            if(result.success) {
                $('#FormSimpanan').html(result.view);
            } else {
                console.error('Error saat mengambil jenis_simpanan');
            }
        }).fail(function(xhr, status, error) {
            console.error('Error AJAX:', status, error);
        });
    }
    
     $(document).on('click', '#SimpanProposal', function(e) {
        e.preventDefault();
        $('small.text-danger').html('');
        $('.input-group.input-group-static').removeClass('is-invalid');
        
    var form = $('#FormRegisterProposal');
    
    // Tambahkan debugging log di sini
    var formData = form.serialize();
    console.log('Form Data:', formData);
    
        $.ajax({
            type: 'POST',
            url: '/simpanan/store',
            data: form.serialize(),
            success: function(result) {
                if (result.success) {
                    Swal.fire('Berhasil', result.message, 'success').then(() => {
                        window.location.href = '/simpanan/detail_simpanan/' + result.id;
                    });
                } else {
                    Swal.fire('Error', 'Terjadi kesalahan', 'error');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        $('#' + key).closest('.input-group.input-group-static').addClass('is-invalid');
                        $('#msg_' + key).html(value[0]);
                        errorMessage += key + ': ' + value[0] + '\n';
                    });
                    console.log('Validation Errors:', errorMessage);
                    Swal.fire('Error', 'Cek kembali input yang Anda masukkan:\n' + errorMessage, 'error');
                } else {
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            }
        });
    });
});
</script>
