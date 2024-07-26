
@php
dd($transaksi);
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
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tgl_transaksi)->format('d/m/Y') }}</td>
                    <td>{{ $trx->keterangan ?? '-' }}</td>
                    <td>{{ $trx->kd_trx ?? '-' }}</td>
                    <td>{{ $trx->jenis_transaksi == 'tarik' ? number_format($trx->jumlah, 0, ',', '.') : '-' }}</td>
                    <td>{{ $trx->jenis_transaksi == 'setor' ? number_format($trx->jumlah, 0, ',', '.') : '-' }}</td>
                    <td>{{ number_format($trx->saldo, 0, ',', '.') }}</td>
                    <td>{{ $trx->petugas ?? '-' }}</td>
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
