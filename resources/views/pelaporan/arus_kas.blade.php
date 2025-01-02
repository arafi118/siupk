@php
    use App\Utils\Keuangan;

    $no = 1;
@endphp
@foreach ($arus_kas as $ak)
    INSERT INTO master_arus_kas VALUES('{{ $no }}', '{{ $ak->nama_akun }}',NULL,NULL, '0');<br>

    @php
        $rekening = [];
        $kode_debit = [];
        $kode_kredit = [];
    @endphp
    @foreach ($ak->child as $child)
        @php
            $kode_akun = explode('#', $child->rekening);
            foreach ($kode_akun as $val => $ka) {
                $kode_rek = explode('~', $ka);
                $debit = $kode_rek[0];
                $kredit = $kode_rek[1];

                if (!(Keuangan::startWith($debit, '1.1.01') || Keuangan::startWith($debit, '1.1.02'))) {
                    $rek_debit = explode('.', $debit);
                    $debit = $rek_debit[0] . '.' . $rek_debit[1] . '.' . $rek_debit[2];
                    $debit = str_replace('%', '', $debit);

                    if (!isset($rekening[$debit])) {
                        $rekening[$debit] = $debit;
                        $kode_debit[] = $debit;
                    }
                }

                if (!(Keuangan::startWith($kredit, '1.1.01') || Keuangan::startWith($kredit, '1.1.02'))) {
                    $rek_kredit = explode('.', $kredit);
                    $kredit = $rek_kredit[0] . '.' . $rek_kredit[1] . '.' . $rek_kredit[2];
                    $kredit = str_replace('%', '', $kredit);

                    if (!isset($rekening[$kredit])) {
                        $rekening[$kredit] = $kredit;
                        $kode_kredit[] = $kredit;
                    }
                }
            }
        @endphp
    @endforeach

    @php
        $child = $no;
    @endphp
    @php
        $no++;

        $index = 0;
    @endphp
    @foreach ($rekening as $rk)
        @php
            $debit = null;
            if (count($kode_debit) > 0) {
                $debit = $kode_debit[$index] . '.00';
            }

            $kredit = null;
            if (count($kode_kredit) > 0) {
                $kredit = $kode_kredit[$index] . '.00';
            }
        @endphp

        INSERT INTO master_arus_kas VALUES('{{ $no }}',
        NULL,'{{ $debit }}','{{ $kredit }}','{{ $child }}');<br>
        @php
            $no++;
            $index++;
        @endphp
    @endforeach
@endforeach
