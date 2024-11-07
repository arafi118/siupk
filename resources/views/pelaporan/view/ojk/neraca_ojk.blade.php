@extends('pelaporan.layout.base')

@section('content')
    @php
        $data_total = [];
        $data_total_saldo = [];
        $data_rek_beban_ops = [];
    @endphp

    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size: 11px;">
        <tr>
            <td align="center" height="30" colspan="4" class="style3 bottom" style="font-size: 15px;">
                <br><b>{{ $kec->nama_lembaga_long }}</b>
                <br><b>SANDI LKM {{ $kec->sandi_lkm }}</b>
                <br><b>LAPORAN POSISI KEUANGAN</b>
                <br><b>{{ strtoupper($sub_judul) }}</b>
            </td>
        </tr>
    </table>

    <table border="0" width="96%" cellspacing="0" cellpadding="0" 
           style="font-size: 11px; border-color: black; table-layout: fixed;">
        <thead>
            <tr style="background: rgb(232, 232, 232); font-weight: bold; font-size: 12px;">
                <th height="20" width="5%">No</th>
                <th width="50%">Nama Akun</th>
                <th width="20%">Kode Akun</th>
                <th width="20%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $core_number = 1;
                
                // Mendefinisikan kategori dengan nomor urut
                $kategori = [
                    'A' => [
                        'nama' => 'Aset',
                        'id' => 1
                    ],
                    'B' => [
                        'nama' => 'Liabilitas',
                        'id' => 2
                    ],
                    'C' => [
                        'nama' => 'Ekuitas',
                        'id' => 3
                    ]
                ];
            @endphp

            @foreach (['A', 'B', 'C'] as $no)
                <tr style="background: rgb(232, 232, 232); font-weight: bold; font-size: 12px;">
                    <th height="20" width="5%">{{ $no }}</th>
                    <th width="50%">{{ $kategori[$no]['nama'] }}</th>
                    <th width="20%"></th>
                    <th width="20%"></th>
                </tr>
                
                @php
                    // Filter $rekening_ojk berdasarkan super_sub
                    $filteredRekening = $rekening_ojk->where('super_sub', $kategori[$no]['id']);
                @endphp

                @foreach ($filteredRekening as $rek_ojk)
                    <tr style="background: rgb(170, 170, 170); font-weight: bold;">
                        <td align='right'>{{ $rek_ojk->id }}</td>
                        <td>{{ $rek_ojk->nama_akun }}</td>
                        <td align='center'>{{ $rek_ojk->kode }}</td>
                        <td align='right'></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection
