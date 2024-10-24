@php

$startDate = \Carbon\Carbon::createFromDate(
    $tahunkop, 
    $bulankop == 0 ? 1 : $bulankop, 
    1
)->startOfMonth();

// Calculate previous balance
$sum = DB::table('real_simpanan_' . session('lokasi'))
    ->where('cif', $cif)
    ->where('tgl_transaksi', '<', $startDate)
    ->orderBy('tgl_transaksi', 'desc')
    ->orderBy('id', 'desc')
    ->value('sum') ?? 0;
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
        @if ($bulankop != 0 && $tahunkop != 0 ) 
            <tr>
                <td colspan="6" class="text-center">
                    <strong>Saldo Sebelum ({{ \Carbon\Carbon::create(null, $bulankop)->translatedFormat('F') }} {{ $tahunkop }})</strong>
                </td>
                <td>{{ number_format($sum, 0, ',', '.') }}</td>
                <td colspan="2">&nbsp;</td>
            </tr>
        @elseif($bulankop != 0 && $tahunkop == 0 )
            <tr>
                <td colspan="9" class="text-center">
                    <strong>mohon untuk memilih tahun juga</strong>
                </td>
            </tr>
        @elseif($bulankop == 0 && $tahunkop != 0 )
            <tr>
                <td colspan="6" class="text-center">
                    <strong>Saldo Sebelum {{ $tahunkop }})</strong>
                </td>
                <td>{{ number_format($sum, 0, ',', '.') }}</td>
                <td colspan="2">&nbsp;</td>
                </td>
            </tr>
        @endif
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
<a class="btn btn-sm float-end ms-2" data-toggle='tooltip' 
   onclick="window.open('/cetak_buku/{{$idt}}')" 
   data-placement='top' style="background-color: transparent; border: none; padding: 0;"
   title='Cetak Pada Buku'>
    <i class="fa fa-book" style="font-size: 1rem;"></i>
</a>
<a class="btn btn-sm float-end ms-2" data-toggle='tooltip' 
   onclick="window.open('/cetak_kuitansi/{{$idt}}')" 
   data-placement='top' style="background-color: transparent; border: none; padding: 0;"
   title='Cetak Pada Kwitansi'>
    <i class="fa fa-file-text" style="font-size: 1rem;"></i>
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
