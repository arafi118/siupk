@extends('layouts.base')

@section('content')
<style>
    .tox .tox-promotion {
    background: repeating-linear-gradient(transparent 0 1px, transparent 1px 39px) center top 39px / 100% calc(100% - 39px) no-repeat;
    background-color: #fff;
    grid-column: 2;
    grid-row: 1;
    padding-inline-end: 8px;
    padding-inline-start: 4px;
    padding-top: 5px;
    display: none;
    }
    .tox .tox-statusbar__branding svg {
    fill: rgba(34, 47, 62, .8);
    height: 1.14em;
    vertical-align: -.28em;
    width: 3.6em;
    display: none;
}
</style>
    <div class="app-main__inner">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title">Tanda tangan <b>SPK</b></h5>
                                <form action="/pengaturan/sop/simpanttdpelaporan" method="post" id="formTtdPelaporan" height>
                                    @csrf
                    
                                    <input type="hidden" name="field" id="field" value="tanda_tangan_spk">
                                    <textarea class="tiny-mce-editor" name="tanda_tangan" id="tanda_tangan" rows="20">
                                        @if ($kec->ttd)
                                        {!! json_decode($kec->ttd->tanda_tangan_spk, true) !!}
                                        @else
                                        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
                                            <tr>
                                                <td align="center">Pihak Pertama</td>
                                                <td>&nbsp;</td>
                                                <td align="center">Pihak Kedua</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </table>
                                        @endif
                                        </textarea>
                                </form>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#kataKunci" class="btn btn-info btn-sm">
                                        Kata Kunci
                                    </button>
                                    <button type="button" id="simpanTtdPelaporan" class="btn btn-dark btn-sm ms-2">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <br><br><br><br>
@endsection

@section('modal')
    <div class="modal fade" id="kataKunci" tabindex="-1" aria-labelledby="kataKunciLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="kataKunciLabel">Kata Kunci</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped midle">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th width="10">No</th>
                                <th width="100">Kata Kunci</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keyword as $k)
                                <tr>
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td>{{ $k['key'] }}</td>
                                    <td>{{ $k['des'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('click', '#simpanTtdPelaporan', function(e) {
            e.preventDefault()

            tinymce.triggerSave()
            var form = $('#formTtdPelaporan')
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(result) {
                    if (result.success) {
                        Toastr('success', result.msg)
                    }
                }
            })
        })
    </script>
@endsection
