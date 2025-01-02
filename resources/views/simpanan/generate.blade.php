@extends('layouts.base')

@section('content')
<div class="container">
    <h2>Generate Simpanan</h2>
    <p>Total Simpanan yang akan di proses: {{ $total }}</p>
    <form action="{{ route('simpanan.generate') }}" method="get" id="runForm">
        <input type="hidden" name="start" value="{{ $start + $per_page }}">
        <input type="hidden" name="limit" value="{{ $per_page }}">
        <button type="submit" id="runButton" {{ $start >= $total ? 'disabled' : '' }}>
            Proses Selanjutnya
        </button>
    </form>
</div>

@if($start < $total)
<script>
    window.onload = function() {
        setTimeout(function() {
            document.getElementById('runForm').submit();
        }, 1000);
    }
</script>
@endif
@endsection
