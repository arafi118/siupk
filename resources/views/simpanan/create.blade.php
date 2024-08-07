@extends('layouts.base')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="main-card mb-3 card">
                <div class="card-body p-3" id="SelectIndividu"></div>
            </div>
        </div>   
        <div class="main-card mb-3 card">
            <div class="mt-4 pt-1" id="RegisterSimpanan"></div>
        </div>
</div>
@endsection

@section('script')
    <script>
        $.get('/daftar_individu?id_angg={{ $id_angg }}', async (result) => {
            await $('#SelectIndividu').html(result)

            var id_angg = $('#individu').val()
            formRegister(id_angg)
        })

        $(document).on('change', '#individu', function(e) {
            e.preventDefault()

            var id_angg = $(this).val()
            formRegister(id_angg)
        })

        $(document).on('click', '#SimpanUtang', function(e) {
            e.preventDefault()
            $('small').html('')

            var form = $('#FormRegisterSimpanan')
            $.ajax({
                type: 'post',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    Swal.fire('Berhasil', result.msg, 'success').then(() => {
                        window.location.href = '/simpanan/' + result.id
                    })
                },
                error: function(result) {
                    const respons = result.responseJSON;

                    Swal.fire('Error', 'Cek kembali input yang anda masukkan', 'error')
                    $.map(respons, function(res, key) {
                        $('#' + key).parent('.input-group.input-group-static').addClass(
                            'is-invalid')
                        $('#msg_' + key).html(res)
                    })
                }
            })
        })

        function formRegister(nia) {
            $.get('/register_simpanan/' + nia, async (result) => {
                await $('#RegisterSimpanan').html(result)
            })
        }
    </script>
@endsection
