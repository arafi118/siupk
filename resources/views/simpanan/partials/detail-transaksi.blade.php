@php
$sum = 0;
@endphp

<div class="table-responsive">
    <table class="table table-striped align-items-center mb-0" width="100%">
        <thead>
            <tr class="bg-dark text-white">
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
                    $id_simp = $trx->id_simp; 
                    if (strpos($id_simp, '-') !== false) {
                        list($kd_trx, $cif) = explode("-", $id_simp);
                    } else {
                        $kd_trx = 0;
                        $cif = $id_simp;
                    }

                    $jumlah = floatval($trx->jumlah); // Ensure $trx->jumlah is numeric
                    
                    if (substr($trx->rekening_kredit, 0, 3) == '2.1') {
                        $real_d = $jumlah;
                        $real_k = 0;
                        $sum += $real_d;
                    } elseif (substr($trx->rekening_debit, 0, 3) == '2.1') {
                        $real_d = 0;
                        $real_k = $jumlah;
                        $sum -= $real_k;
                    } else {
                        $real_d = $jumlah;
                        $real_k = $jumlah;
                    }
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tgl_transaksi)->format('d/m/Y') }}</td>
                    <td>{{ $trx->keterangan_transaksi ?? '-' }}</td>
                    <td>{{ $kd_trx ?? '-' }}</td>
                    <td>{{ number_format($real_d, 0, ',', '.') }}</td>
                    <td>{{ number_format($real_k, 0, ',', '.') }}</td>
                    <td>{{ number_format($sum, 0, ',', '.') }}</td>
                    <td>{{ $trx->id_user ?? '-' }}</td>
                    <td>
                        <!-- Tombol Print -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada transaksi di periode ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
