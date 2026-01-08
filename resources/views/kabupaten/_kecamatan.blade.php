@extends('kabupaten.layout.base')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="alert alert-danger text-center">
                <h3 class="text-light">{{ $kec->nama }} Belum Menggunakan Aplikasi yang terhubung dengan sistem PT Asta Brata Teknologi.</h3>
            </div>
        </div>
    </div>
@endsection
