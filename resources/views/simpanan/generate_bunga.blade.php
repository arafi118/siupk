@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pilih Bulan Perhitungan Bunga</h3>
        </div>
        <div class="card-body">
            <form action="generate-bunga2" method="post" target="_blank">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group input-group-static my-3">
                            <label for="bulan" >Pilih Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <option value="januari">Januari</option>
                                <option value="februari">Februari</option>
                                <option value="maret">Maret</option>
                                <option value="april">April</option>
                                <option value="mei">Mei</option>
                                <option value="juni">Juni</option>
                                <option value="juli">Juli</option>
                                <option value="agustus">Agustus</option>
                                <option value="september">September</option>
                                <option value="oktober">Oktober</option>
                                <option value="november">November</option>
                                <option value="desember">Desember</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-static my-3">
                            <label for="tahun" >Pilih Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                @for ($year = 2018; $year <= 2025; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-static my-3">
                            <label for="cif">CIF</label>
                            <input type="text" name="cif" id="cif" class="form-control" placeholder="semua CIF" title="semua CIF">
                            <small class="text-muted">*Jika hanya sebagian, ketiklah: CIF, CIF dst</small>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-info btn-sm">Generate</button>
                </div>
            </form>

            <!-- Placeholder to push footer down -->
            <div class="footer-placeholder" style="height: calc(100vh - 95%);"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Script placeholder if needed
    </script>
@endsection

@php
    /*
    <div class="container">
        <h2>Generate Simpanan</h2>
        <p>Total Simpanan yang akan diproses: {{ $total }}</p>
        <form action="{{ route('simpanan.generate') }}" method="get" id="runForm">
            <input type="hidden" name="start" value="{{ $start + $per_page }}">
            <input type="hidden" name="limit" value="{{ $per_page }}">
            <div class="d-flex justify-content-end">
                <button type="submit" id="runButton" class="btn btn-info btn-sm" {{ $start >= $total ? 'disabled' : '' }}>
                    Proses Selanjutnya
                </button>
            </div>
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
    */
@endphp

