<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemindahan Buku Pinjaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">PEMINDAH BUKUAN PINJAMAN</h1>
        
        <form id="pindahBukuForm" action="{{ route('pindah_buku.pindahBuku') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="jenis_produk_pinjaman">Jenis Produk Pinjaman</label>
                        <select class="form-control" id="jenis_produk_pinjaman" name="jenis_produk_pinjaman" required>
                                <option value="1">Silakan Pilih Jenis Produk Pinjaman</option>
                            @foreach($jenisProdukPinjaman as $jpp)
                                <option value="{{ $jpp->kode }}">
                                    {{ $jpp->id }} | 
                                    {{ $jpp->kode}}
                                    {{ $jpp->nama_jpp }}
                                    {{ $jpp->deskripsi_jpp }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="from_kas">From Kas</label>
                        <select class="form-control" id="from_kas" name="from_kas" required>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="1.1.01.0{{ $i }}">1.1.01.0{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="from_pinjaman">From Pinjaman</label>
                        <select class="form-control" id="from_pinjaman" name="from_pinjaman" required>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="1.1.03.0{{ $i }}">1.1.03.0{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="to_kas">To Kas</label>
                        <input type="text" class="form-control" id="to_kas" name="to_kas" readonly>
                    </div>
                    <div class="form-group">
                        <label for="to_pinjaman">To Pinjaman</label>
                        <input type="text" class="form-control" id="to_pinjaman" name="to_pinjaman" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </div>
        </form>

        <div class="alert alert-danger mt-3" role="alert"><h2>
            <strong>PERINGATAN:</strong>
            Proses ini akan <strong>MENGHAPUS</strong> data yang berkaitan dengan kode akun <strong id="warning_to_kas">1.1.01.02</strong> dan <strong id="warning_to_pinjaman">1.1.03.01</strong> baik di tabel <strong>Rekening</strong> maupun <strong>Transaksi</strong>, silakan pastikan terlebih dahulu di <strong>Database</strong>.
        </h2></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#jenis_produk_pinjaman').change(function() {
                let kode = parseInt($(this).val());
                let toKas = `1.1.01.0${kode + 1}`;
                let toPinjaman = `1.1.03.0${kode}`;
                $('#to_kas').val(toKas);
                $('#to_pinjaman').val(toPinjaman);
                $('#warning_to_kas').text(toKas).css('color', 'red');
                $('#warning_to_pinjaman').text(toPinjaman).css('color', 'red');
            });

            $('#pindahBukuForm').submit(function(e) {
                e.preventDefault();
                let fromKas = $('#from_kas').val();
                let toKas = $('#to_kas').val();
                let fromPinjaman = $('#from_pinjaman').val();
                let toPinjaman = $('#to_pinjaman').val();

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: `Apakah anda yakin ingin memindahkan From kas ${fromKas} To kas ${toKas} dan From pinjaman ${fromPinjaman} To pinjaman ${toPinjaman}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oke',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            @if(session('success'))
                Swal.fire({
                    title: 'Sukses',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'Oke'
                }).then(() => {
                    window.location.href = "{{ route('pindah_buku.index') }}";
                });
            @endif
        });
    </script>
</body>
</html>
