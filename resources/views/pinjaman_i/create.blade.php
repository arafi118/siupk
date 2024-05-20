@extends('layouts.base')

@section('content')
    <div class="card mb-3">
        <div class="card-body p-3" id="SelectIndividu"></div>
    </div>

    <div class="mt-4 pt-1" id="RegisterProposal"></div>
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

        $(document).on('click', '#SimpanProposal', function(e) {
            e.preventDefault()
            $('small').html('')

            var form = $('#FormRegisterProposal')
            $.ajax({
                type: 'post',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    Swal.fire('Berhasil', result.msg, 'success').then(() => {
                        window.location.href = '/detail_i/' + result.id
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
            $.get('/register_proposal_i/' + nia, async (result) => {
                await $('#RegisterProposal').html(result)
            })
        }
    </script>
@endsection
