@php
    $status = '0';
    if ($data_anggota->status == '0') {
        $status = '1';
    }
@endphp
<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
        font-size: 14px; /* Default font size */
    }
</style>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fa fa-user-secret"></i>
            </div>
            <div><b>Edit data Pelanggan</b>
                <div class="page-title-subheading">
                     {{ Session::get('nama_lembaga') }} 
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="card-body">
        <form action="/database/penduduk/{{ $data_anggota->nik }}" method="post" id="Penduduk">
            @csrf
            @method('PUT')

            <input type="hidden" name="_nik" id="_nik" value="{{ $data_anggota->nik }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="nik">NIK</label>
                        <input autocomplete="off" maxlength="16" type="text" name="nik" id="nik" class="form-control"
                            value="{{ $data_anggota->nik }}">
                        <small class="text-danger" id="msg_nik"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="nama_lengkap">Nama lengkap</label>
                        <input autocomplete="off" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" 
                        value="{{ $data_anggota->nama_lengkap}}">
                        <small class="text-danger" id="msg_nama_lengkap"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="nama_pangilan">Nama Pangilan</label>
                        <input autocomplete="off" type="text" name="nama_pangilan" id="nama_pangilan" class="form-control"
                        value="{{ $data_anggota->nama_pangilan }}">
                        <small class="text-danger" id="msg_nama_pangilan"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input autocomplete="off" type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                        value="{{ $data_anggota->tempat_lahir }}">
                        <small class="text-danger" id="msg_tempat_lahir"></small>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="tgl_lahir">Tgl Lahir</label>
                        <input autocomplete="off" type="text" name="tgl_lahir" id="tgl_lahir"
                                class="form-control date" value="{{ $data_anggota->tgl_lahir }}">
                                <small class="text-danger" id="msg_tgl_lahir"></small>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="js-select-2 form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option>Pilih Jenis Kelamin</option>
                            <option {{ $jk_dipilih == 'L' ? 'selected' : '' }} value="L">Laki Laki</option>
                            <option {{ $jk_dipilih == 'P' ? 'selected' : '' }} value="P">Perempuan</option>
                        </select>
                        <small class="text-danger" id="msg_jenis_kelamin"></small>
                    </div>
                </div>        
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="no_kk">No. KK</label>
                        <input autocomplete="off" type="text" name="no_kk" id="no_kk" class="form-control"
                        value="{{ $data_anggota->kk }}">
                        <small class="text-danger" id="msg_no_kk"></small>
                    </div>
                </div>      
            </div> 
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="alamat">Alamat KTP</label>
                        <input autocomplete="off" maxlength="16" type="text" name="alamat" id="alamat" class="form-control"
                        value="{{ $data_anggota->alamat}}">
                        <small class="text-danger" id="msg_alamat"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="domisi">Domisi saat ini</label>
                        <input autocomplete="off" type="text" name="domisi" id="domisi" class="form-control"
                        value="{{ $data_anggota->domisi}}">
                        <small class="text-danger" id="msg_domisi"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="desa">Desa/Kelurahan</label>
                        <select class="js-select-2 form-control" name="desa" id="desa">
                            <option>Pilih Desa/Kelurahan</option>
                            @foreach ($desa as $ds)
                                <option {{ $desa_dipilih == $ds->kd_desa ? 'selected' : '' }} value="{{ $ds->kd_desa }}">
                                    {{ $ds->sebutan_desa->sebutan_desa }} {{ $ds->nama_desa }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="msg_desa"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="agama">Agama</label>
                        <select class="js-select-2 form-control" name="agama" id="agama" class="form-control">
                            <option value="">{{ $data_anggota->agama}}</option>
                            <option value="islam">Islam</option>
                            <option value="kristen_protestan">Kristen Protestan</option>
                            <option value="kristen_katolik">Kristen Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                        <small class="text-danger" id="msg_agama"></small>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="pendidikan">Pendidikan</label>
                        <select class="js-select-2 form-control" name="pendidikan" id="pendidikan" class="form-control">
                            <option value="">{{ $data_anggota->pendidikan}}</option>
                            <option value="sd_mi">SD/MI</option>
                            <option value="smp_mts">SMP/MTs</option>
                            <option value="sma_smk_ma">SMA/SMK/MA</option>
                            <option value="diploma_1">Diploma 1 (D1)</option>
                            <option value="diploma_2">Diploma 2 (D2)</option>
                            <option value="diploma_3">Diploma 3 (D3)</option>
                            <option value="sarjana">Sarjana (S1)</option>
                            <option value="magister">Magister (S2)</option>
                            <option value="doktor">Doktor (S3)</option>
                        </select>
                        <small class="text-danger" id="msg_pendidikan"></small>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="position-relative mb-3">
                        <label for="status_pernikahan">Status Pernikahan</label>
                        <select class="js-select-2 form-control" name="status_pernikahan" id="status_pernikahan" class="form-control">
                            <option value="">{{ $data_anggota->status_pernikahan}}</option>
                            <option value="lajang">Lajang</option>
                            <option value="menikah">Menikah</option>
                            <option value="cerai hidup">Cerai Hidup</option>
                            <option value="cerai mati">Cerai Mati</option>
                        </select>
                        <small class="text-danger" id="msg_status_pernikahan"></small>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="no_telp">No. Telp</label>
                        <input autocomplete="off" type="text" name="no_telp" id="no_telp" class="form-control"
                        value="{{ $data_anggota->no_telp}}">
                        <small class="text-danger" id="msg_no_telp"></small>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="nama_ibu">Nama Ibu Kandung</label>
                        <input autocomplete="off" type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                        value="{{ $data_anggota->nama_ibu}}">
                        <small class="text-danger" id="msg_nama_ibu"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="tempat_kerja">Alamat Tempat Kerja</label>
                        <input autocomplete="off" type="text" name="tempat_kerja" id="tempat_kerja" class="form-control"
                        value="{{ $data_anggota->tempat_kerja}}">
                        <small class="text-danger" id="msg_tempat_kerja"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="jenis_usaha">Jenis Usaha</label>
                        <input autocomplete="off" type="text" name="jenis_usaha" id="jenis_usaha" class="form-control"
                        value="{{ $data_anggota->jenis_usaha}}">
                        <small class="text-danger" id="msg_jenis_usaha"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="nik_penjamin">NIK Penjamin</label>
                        <input autocomplete="off" type="text" name="nik_penjamin" id="nik_penjamin" class="form-control"
                        value="{{ $data_anggota->nik_penjamin}}" maxlength="16" minlength="16">
                        <small class="text-danger" id="msg_nik_penjamin"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="penjamin">Penjamin</label>
                        <input autocomplete="off" type="text" name="penjamin" id="penjamin" class="form-control"
                        value="{{ $data_anggota->penjamin}}">
                        <small class="text-danger" id="msg_penjamin"></small>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="hubungan">Hubungan</label>
                        <select class="js-select-2 form-control" name="hubungan" id="hubungan">
                            @foreach ($hubungan as $hb)
                                <option {{ $hubungan_dipilih == $hb->id ? 'selected' : '' }} value="{{ $hb->id }}">
                                    {{ $hb->kekeluargaan }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="msg_hubungan"></small>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-dark btn-sm float-end" id="SimpanPenduduk">Simpan Penduduk</button>
            <button type="button" class="btn btn-danger btn-sm me-3 float-end" id="BlokirPenduduk">
                @if ($status == '0')
                    Blokir Penduduk
                @else
                    Lepaskan Blokiran
                @endif
            </button>
        </form>
    </div>
<form action="/database/penduduk/{{ $data_anggota->nik }}/blokir" method="post" id="Blokir">
    @csrf

    <input type="hidden" name="status" id="status" value="{{ $status }}">
</form>

<script>
    $('.js-select-2').select2({
            theme: 'bootstrap-5'
        });

        // Function to set font size
        function setFontSize(size) {
            $('.select2-container .select2-selection--single .select2-selection__rendered').css('font-size', size + 'px');
        }

        $('.date').datepicker({
            dateFormat: 'dd/mm/yy'
        });
</script>
