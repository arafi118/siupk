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

                
                    if (substr($trx->rekening_kredit, 0, 3) == '2.1') {
                        $real_d         = $trx->jumlah;
                        $real_k         = 0;
                        $sum            = $sum + $real_d;
                    } elseif (substr($trx->rekening_debit, 0, 3) == '2.1') {
                        $real_d         = 0;
                        $real_k         = $trx->jumlah;
                        $sum            = $sum - $real_k;
                    } else {
                        // Jika tidak memenuhi kedua kondisi di atas, gunakan nilai default
                        $real_d         =  $trx->jumlah;
                        $real_k         =  $trx->jumlah;
                        // $sum tidak berubah dalam kasus ini
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
                        <!-- TOMBOL -->
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
