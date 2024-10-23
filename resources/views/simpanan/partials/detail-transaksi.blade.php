@php
$sum =0;
@endphp
<div class="table-responsive">
    <table class="table table-striped align-items-center mb-0" width="100%">
        <thead>
            <tr  style="background-color: #404040;color: #ffffff;">
                <th>#</th>
                <th>Tgl transaksi</th>
                <th>Keterangan</th>
                <th>KD.TRX</th>
                <th>Debit (Tarik)</th>
                <th>Kredit (Setor)</th>
                <th>Saldo</th>
                <th>P</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $index => $trx)

            @php
                $id_simp = $trx->id_simp; //ini nanti di ganti ambil dari real_simpanan_$lokasi
                    if (strpos($id_simp, '-') !== false) {
                        // Jika ada tanda "-", pisahkan menjadi dua bagian
                        list($kd_trx, $cif) = explode("-", $id_simp);
                    } else {
                        // Jika tidak ada tanda "-", atur kd_trx = 0 dan cif = id_simp
                        $kd_trx = 0;
                        $cif = $id_simp;
                    }
                    $idt=$trx->idt;

                
                    $jumlah = floatval($trx->jumlah); // Ensure $trx->jumlah is numeric
                    
                    if(in_array(substr($trx->id_simp, 0, 1), ['1', '2', '5'])) {
                        $real_d = 0;
                        $real_k = $jumlah;
                        $sum += $jumlah;
                    } elseif(in_array(substr($trx->id_simp, 0, 1), ['3', '4', '6', '7'])) {
                        $real_d = $jumlah;
                        $real_k = 0;
                        $sum -= $jumlah;
                    } else {
                        $real_d = 0;
                        $real_k = 0;
                    }
                        
            @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tgl_transaksi)->format('d/m/Y') }}</td>
                    <td>{{$kd_trx}} | {{ $trx->keterangan_transaksi ?? '-' }}</td>
                    <td>{{ $idt ?? '-' }}</td>
                    <td>{{ number_format($real_d, 0, ',', '.') }}</td>
                    <td>{{ number_format($real_k, 0, ',', '.') }}</td>
                    <td>{{ number_format($sum, 0, ',', '.') }}</td>
                    <td>{{ $trx->id_user ?? '-' }}</td>
                    <td>
                        <a class="btn btn-secondary btn-sm  float-end ms-2" data-toggle='tooltip' onclick="window.open('/cetak_koran/{{ $cif }}/{{$bulankop}}/{{$tahunkop}}')" data-placement='top' title='Kwitansi'>
                            <i class="fa fa-print"></i> 
                        </a>
                        <a class="btn btn-secondary btn-sm  float-end ms-2" data-toggle='tooltip' onclick="window.open('/cetak_koran/{{ $cif }}/{{$bulankop}}/{{$tahunkop}}')" data-placement='top' title='Kwitansi'>
                            <i class="fa fa-file-text"></i> 
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada transaksi di periode ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <button class="btn btn-secondary btn-sm float-end ms-2" onclick="window.open('/cetak_koran/{{ $cif }}/{{$bulankop}}/{{$tahunkop}}')" type="button">
        <i class="fa fa-print"></i> Cetak Rekening Koran
    </button>
</div>
