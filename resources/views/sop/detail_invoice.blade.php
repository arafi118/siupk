@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <embed src="/pelaporan/invoice/{{ $inv->idv }}" type="application/pdf" width="100%" height="600px" />
                    
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="/pengaturan/invoice" class="btn btn-sm btn-info mb-0">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <br><br><br>
@endsection
