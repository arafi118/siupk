@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
        <div class="tab-content">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <br>
                    <form action="/transaksi/anggaran" method="post" id="formAnggaran">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative mb-3"><label for="exampleEmail11"
                                        class="form-label">Tahun</label>
                                    <input autocomplete="off" type="number" name="tahun" id="tahun"
                                        class="form-control" value="{{ date('Y') }}">
                                    <small class="text-danger" id="msg_tahun"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative mb-3"><label for="examplePassword11"
                                        class="form-label">Bulan</label>
                                    <input autocomplete="off" type="number" name="bulan" id="bulan"
                                        class="form-control" value="{{ date('m') }}" max="12" min="01">
                                    <small class="text-danger" id="msg_bulan"></small>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="anggaran" class="btn btn-sm btn-dark mb-0"
                            style=" float: right;">TENTUKAN RENCANA ANGGARAN</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <br>
                    <div id="formEbudgeting"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('click', '#anggaran', function(e) {
            e.preventDefault()

            var form = $('#formAnggaran')
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        $('#formEbudgeting').html(result.view)
                    }
                }
            })
        })

        $(document).on('click', '#SimpanAnggaran', function(e) {
            e.preventDefault()


            var form = $('#formRencanaAnggaran')
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        Toastr('success', result.msg)

                        location.reload();
                    }
                }
            })
        })

        $("#nominal").maskMoney({
            allowNegative: true
        });
    </script>
@endsection
