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
            <div class="form-group">
                <label for="jenis_produk_pinjaman">Jenis Produk Pinjaman</label>
                <select class="form-control" id="jenis_produk_pinjaman" name="jenis_produk_pinjaman" required>
                    @foreach($jenisProdukPinjaman as $jpp)
                        <option value="{{ $jpp->kode }}">{{ $jpp->id }} | {{ $jpp->kode }} {{ $jpp->nama_jpp }} {{ $jpp->deskripsi_jpp }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="from_kas">From Kas</label>
                <select class="form-control" id="from_kas" name="from_kas" required>
                    @for($i = 1; $i <= 10; $i++)
                        <option value="1.1.01.0{{ $i }}">1.1.01.0{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="to_kas">To Kas</label>
                <input type="text" class="form-control" id="to_kas" name="to_kas" readonly>
            </div>
            <div class="form-group">
                <label for="from_pinjaman">From Pinjaman</label>
                <select class="form-control" id="from_pinjaman" name="from_pinjaman" required>
                    @for($i = 1; $i <= 10; $i++)
                        <option value="1.1.03.0{{ $i }}">1.1.03.0{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="to_pinjaman">To Pinjaman</label>
                <input type="text" class="form-control" id="to_pinjaman" name="to_pinjaman" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#jenis_produk_pinjaman').change(function() {
                let kode = parseInt($(this).val());
                $('#to_kas').val(`1.1.01.0${kode + 1}`);
                $('#to_pinjaman').val(`1.1.03.0${kode}`);
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
