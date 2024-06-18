@extends('layouts.base')

@section('content')
    <div class="app-main__inner">
        <div class="tab-content">
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Cart of Account</h5>
                            <form class="">
                                <div class="position-relative mb-3" id="akun">
                                    <label for="exampleText" class="form-label">
                                        @foreach ($akun1 as $lev1)
                                            <li>{{ $lev1->kode_akun }}. {{ $lev1->nama_akun }}
                                                <ul>
                                                    @foreach ($lev1->akun2 as $lev2)
                                                        <li>{{ $lev2->kode_akun }}. {{ $lev2->nama_akun }}
                                                            <ul>
                                                                @foreach ($lev2->akun3 as $lev3)
                                                                    <li>{{ $lev3->kode_akun }}. {{ $lev3->nama_akun }}
                                                                        <ul>
                                                                            @foreach ($lev3->rek as $rek)
                                                                                <li>{{ $rek->kode_akun }}.
                                                                                    {{ $rek->nama_akun }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

