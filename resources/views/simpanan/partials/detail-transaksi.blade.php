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
    <table class="table table-striped align-items-center mb-0" width="97%" style="table-layout: fixed; border-collapse: collapse;">
        <thead>
            <tr  style="background-color: #404040;color: #ffffff;">
                <th width='3%'>#</th>
                <th width='10%'>Tgl transaksi</th>
                <th width='35%'>Keterangan</th>
                <th width='10%'>KD.TRX</th>
                <th width='10%'>Debit (Tarik)</th>
                <th width='10%'>Kredit (Setor)</th>
                <th width='10%'>Saldo</th>
                <th width='5%'>P</th>
                <th width='10%'>#</th>
            </tr>
        </thead>
        @if ($bulankop != 0 && $tahunkop != 0 ) 
            <tr>
                <td colspan="6" class="text-center"><b>
                    Saldo Sebelum {{ \Carbon\Carbon::create(null, $bulankop)->translatedFormat('F') }} {{ $tahunkop }}</b>
                </td>
                <td><b>{{ number_format($sum, 0, ',', '.') }}</b></td>
                <td colspan="2">&nbsp;</td>
            </tr>
        @elseif($bulankop != 0 && $tahunkop == 0 )
            <tr>
                <th colspan="9" class="text-center">
                    <strong>mohon untuk memilih tahun juga</strong>
                </th>
            </tr>
        @elseif($bulankop == 0 && $tahunkop != 0 )
            <tr>
                <th colspan="6" class="text-center">
                    <strong>Saldo Sebelum {{ $tahunkop }}</strong>
                </th>
                <th>{{ number_format($sum, 0, ',', '.') }}</th>
                <th colspan="2">&nbsp;</th>
                </th>
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
                    <td style="word-wrap: break-word; word-break: break-word; white-space: normal;">{{$kd_trx}} | {{ $trx->keterangan_transaksi ?? '-' }}</td>
                    <td>{{ $idt ?? '-' }}</td>
                    <td>{{ number_format($real_d, 0, ',', '.') }}</td>
                    <td>{{ number_format($real_k, 0, ',', '.') }}</td>
                    <td>{{ number_format($sum, 0, ',', '.') }}</td>
                    <td>{{ $trx->ins ?? '-' }}</td>
                    <td>
<a class="btn btn-sm float-end ms-2" data-toggle='tooltip' 
   onclick="window.open('/cetak_buku/{{$idt}}')" 
   data-placement='top' style="background-color: transparent; border: none; padding: 0;"
   title='Cetak Pada Buku'>
    <i class="fa fa-book" style="font-size: 1.2rem;"></i>
</a>
<a class="btn btn-sm float-end ms-2" data-toggle='tooltip' 
   onclick="window.open('/cetak_kuitansi/{{$idt}}')" 
   data-placement='top' style="background-color: transparent; border: none; padding: 0;"
   title='Cetak Pada Kwitansi'>
    <i class="fa fa-file-text" style="font-size: 1.2rem;"></i>
</a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada transaksi di periode ini</td>
                </tr>
            @endforelse
        </tbody>
            <tr>
                <td colspan="6" class="text-center"><b>TOTAL SALDO</b></td>
                <td><b>{{ number_format($sum, 0, ',', '.') }}</b></td>
                <td colspan="2">&nbsp;</td>
            </tr>
    </table><br>
    <button class="btn btn-dark btn-sm float-end ms-2" onclick="window.open('/cetak_koran/{{ $cif }}/{{$bulankop}}/{{$tahunkop}}')" type="button">
        <i class="fa fa-print"></i> Cetak Rekening Koran
    </button>
</div>
