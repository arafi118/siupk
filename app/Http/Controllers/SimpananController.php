<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DataPemanfaat;
use App\Models\JenisJasa;
use App\Models\JenisProdukPinjaman;
use App\Models\JenisSimpanan;
use App\Models\Simpanan;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Keluarga;
use App\Models\PinjamanIndividu;
use App\Models\RealAngsuranI;
use App\Models\RealSimpanan;
use App\Models\Rekening;
use App\Models\RencanaAngsuranI;
use App\Models\StatusPinjaman;
use App\Models\SistemAngsuran;
use App\Models\Transaksi;
use App\Models\User;
use App\Utils\Keuangan;
use App\Utils\Pinjaman;
use App\Utils\Tanggal;
use DB;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use DNS1D;
use Session;

class SimpananController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $simpanan = Simpanan::with(['anggota', 'js', 'realSimpananTerbesar'])
                ->orderBy('id', 'DESC');

            return DataTables::of($simpanan)
                ->addColumn('nama_anggota', function ($row) {
                    return $row->anggota->namadepan ?? '-';
                })
                ->addColumn('jenis_simpanan', function ($row) {
                    return $row->js->nama_js ?? '-';
                })
                ->addColumn('status', function ($row) {
                    $status = '<span class="badge badge-secondary">-</span>';
                    if ($row->status) {
                        $badge = $row->status == 'A' ? 'success' : 'danger';
                        $status = '<span class="badge badge-' . $badge . '">' . ($row->status == 'A' ? 'Aktif' : 'Non-Aktif') . '</span>';
                    }
                    return $status;
                })
                ->editColumn('jumlah', function ($row) {
                    $jumlah = $row->realSimpananTerbesar->sum ?? 0;
                    return 'Rp ' . number_format($jumlah, 0, ',', '.');
                })
                ->editColumn('tgl_buka', function ($row) {
                    return date('d/m/Y', strtotime($row->tgl_buka));
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        $title = 'Daftar Simpanan';
        return view('simpanan.index')->with(compact('title'));
    }

    public function getTransaksi() {
        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');
        $cif = request()->input('cif');

        // Query transaksi dengan filter berdasarkan input bulan, tahun, dan cif
        $transaksiQuery = Transaksi::where('id_simp', 'LIKE', "%-$cif");

        // Filter tahun jika diberikan
        if ($tahun != 0) {
            $transaksiQuery->whereYear('tgl_transaksi', $tahun);
        }

        // Filter bulan jika diberikan
        if ($bulan != 0) {
            $transaksiQuery->whereMonth('tgl_transaksi', $bulan);
        }

        // Ambil data transaksi yang sudah difilter dan diurutkan
        $transaksi = $transaksiQuery->orderBy('tgl_transaksi', 'asc')->get();

        // Ambil data 'ins' berdasarkan id_user dari setiap transaksi
        $transaksi->each(function ($item) {
            $item->ins = User::where('id', $item->id_user)->value('ins');
        });

        $bulankop = $bulan;
        $tahunkop = $tahun;

        // Return view dengan semua variabel yang dibutuhkan
        return view('simpanan.partials.detail-transaksi', compact('transaksi', 'bulankop', 'tahunkop', 'cif'));
    }



    public function detailAnggota($id)
    {
        $nia = Simpanan::where('id', $id)->with(['anggota'])->first();
        $title = 'Simpanan $nia->anggota->namadepan';
        return view('simpanan.partials.detail')->with(compact('title', 'nia'));
    }


    public function create()
    {
        $id_angg = request()->get('id_angg');
        $title = 'Registrasi Simpanan Individu';
        return view('simpanan.create')->with(compact('title', 'id_angg'));
    }

    public function register($id_angg)
    {
        $anggota = Anggota::where('id', $id_angg)->with([
            'pinjaman' => function ($query) {
                $query->orderBy('tgl_proposal', 'DESC');
            },
            'pinjaman.sts'
        ])->first();
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $jenis_jasa = JenisJasa::all();
        $sistem_angsuran = SistemAngsuran::all();
        $js = JenisSimpanan::where(function ($query) use ($kec) {
            $query->where('lokasi', '0')
                ->orWhere(function ($query) use ($kec) {
                    $query->where('kecuali', 'NOT LIKE', "%-{$kec['id']}-%")
                        ->where('lokasi', 'LIKE', "%-{$kec['id']}-%");
                });
        })->get();

        $js_dipilih = $anggota->jenis_produk_pinjaman;

        return view('simpanan.partials.register')->with(compact('anggota', 'kec', 'jenis_jasa', 'sistem_angsuran', 'js', 'js_dipilih'));
    }

    public function jenis_simpanan($id, Request $request)
    {
        $nia = $request->input('nia');
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $urutan = Simpanan::where('nia', $nia)->count();
        $anggota = Anggota::where('id', $nia)->first();

        if ($kec && $anggota) {
            $kec_id = str_pad($kec->id, 3, '0', STR_PAD_LEFT);
            $anggota_id = str_pad($anggota->id, 3, '0', STR_PAD_LEFT);
            $urutan = 1 + $urutan;
            $urutan_formatted = str_pad($urutan, 2, '0', STR_PAD_LEFT);
            $nomor_rekening = "{$id}-{$kec_id}.{$anggota_id}-{$urutan_formatted}";
        } else {
            $nomor_rekening = 'Data tidak valid';
        }

        return response()->json([
            'success' => true,
            'view' => view('simpanan.partials.simpanan', compact('id', 'kec', 'anggota', 'nomor_rekening'))->render()
        ]);
    }

    public function Kuasa($id)
    {
        return response()->json([
            'success' => true,
            'view' => view('simpanan.partials.lembaga')->with(compact('id'))->render()
        ]);
    }

    public function show(Simpanan $simpanan)
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $desa = Desa::where('kd_kec', $kec->kd_kec)->with('sebutan_desa')->get();
        $hubungan = Keluarga::orderBy('kekeluargaan', 'ASC')->get();

        $nia = $simpanan->where('id', $simpanan->id)->with(['anggota', 'js'])->first();
        $title = ucwords($simpanan->anggota->namadepan);
        return view('simpanan.partials.detail')->with(compact('nia', 'title'));
    }


    public function kop(Simpanan $simpanan)
    {
        $simpanan = $simpanan->where('id', $simpanan->id)->with(['anggota', 'js'])->first();
        $title = 'Cetak KOP buku ' . $simpanan->anggota->namadepan;
        return view('simpanan.partials.cetak_kop')->with(compact('title', 'simpanan'));
    }

    public function info(Simpanan $simpanan)
    {
        $simpanan = $simpanan->where('id', $simpanan->id)->with(['anggota','anggotas', 'js'])->first();
        $title = 'Cetak KOP buku ' . $simpanan->anggota->namadepan;
        return view('simpanan.partials.cetak_kop')->with(compact('title', 'simpanan'));
    }
     
    public function koran($cif, $bulankop, $tahunkop)
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $simpanan = Simpanan::where('id', $cif)->with(['anggota', 'js'])->first();
        
    $transaksiQuery = Transaksi::where('id_simp', 'LIKE', "%-$cif");

        // Jika tahun tidak 0, tambahkan filter tahun
        if ($tahunkop != 0) {
            $transaksiQuery->whereYear('tgl_transaksi', $tahunkop);
        }

        // Jika bulan tidak 0, tambahkan filter bulan
        if ($bulankop != 0) {
            $transaksiQuery->whereMonth('tgl_transaksi', $bulankop);
        }

        $transaksi  = $transaksiQuery->orderBy('tgl_transaksi', 'asc')->get();

        $title = 'Cetak Rekening Koran ' . $simpanan->anggota->namadepan;

        return view('simpanan.partials.cetak_koran')->with(compact('title', 'transaksi', 'simpanan', 'kec','cif', 'bulankop', 'tahunkop'));
    }
    
     
    public function formulir0()
    {
        $anggota = '';
        $title = 'Cetak Rekening formulir ';

        return view('simpanan.partials.cetak_formulir')->with(compact('title','anggota'));
    }

     
    public function formulir($nia)
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $anggota = Anggota::where('id', $nia)->with(['anggotas'])->first();

        $title = 'Cetak Rekening formulir ';

        return view('simpanan.partials.cetak_formulir')->with(compact('title', 'kec', 'anggota'));
    }

    public function cetakKwitansi($idt)
{
    $transaksi = Transaksi::where('idt', $idt)->first();
    $user = auth()->user();
    $userTransaksi = User::find($transaksi->id_user);
    
    // Logika untuk menentukan user yang ditampilkan
    $userDisplay = ($user->id == $userTransaksi->id) 
        ? $user->ins 
        : $user->ins . ' / ' . $userTransaksi->ins;

    $user = $userDisplay;
    // Menentukan kode berdasarkan jenis rekening
    
    $kode=substr($transaksi->id_simp, 0, 1);

        $title = 'Cetak Pada Kwitansi '.$transaksi->id_simp;

    return view('simpanan.partials.cetak_pada_kwitansi', compact(
        'transaksi',
        'user',
        'title',
        'kode'
    ));
}

public function cetakPadaBuku($idt)
{
    $saldo = 0;
    $transaksi = Transaksi::where('idt', $idt)->first();
    $parts = explode('-', $transaksi->id_simp);

    $transaksiCount = Transaksi::where('id_simp', 'like', '%-' . $parts[1])
                               ->where('idt', '<=', $idt)
                               ->count();
    $user = auth()->user();
    $userTransaksi = User::find($transaksi->id_user);
    
    // Logika untuk menentukan user yang ditampilkan
    $userDisplay = ($user->id == $userTransaksi->id) 
        ? $user->ins 
        : $user->ins . ' / ' . $userTransaksi->ins;
    $user = $userDisplay;
    $kode=substr($transaksi->id_simp, 0, 1);
                    if(in_array(substr($transaksi->id_simp, 0, 1), ['1', '2', '5'])) {
                        $debit = 0;
                        $kredit = $transaksi->jumlah;
                        $saldo += $transaksi->jumlah;
                    } elseif(in_array(substr($transaksi->id_simp, 0, 1), ['3', '4', '6', '7'])) {
                        $debit = $transaksi->jumlah;
                        $kredit = 0;
                        $saldo -= $transaksi->jumlah;
                    } else {
                        $debit = 0;
                        $kredit = 0;
                    }

        $title = 'Cetak Pada Buku '.$transaksi->id_simp;

        return view('simpanan.partials.cetak_pada_buku')->with(compact('title','transaksi', 'transaksiCount', 'kode', 'user', 'debit', 'kredit',  'saldo'));
    }

    public function simpanTransaksi(Request $request)
    {
        $jenisMutasi = $request->jenis_mutasi;
        $tglTransaksi = $request->tgl_transaksi;
        $jumlah = $request->jumlah;
        $nomorRekening = $request->nomor_rekening;
        $namaDebitur = $request->nama_debitur;
        $nia = $request->nia;

        // Mengambil jenis_simpanan dari tabel tb_simpanan berdasarkan id ($nia)
        $simpanan = Simpanan::where('id', $nia)->first();
    
        if (!$simpanan) {
            return response()->json(['success' => false, 'message' => 'Data simpanan tidak ditemukan']);
        }

        // Mengambil jenisSimpanan berdasarkan nilai jenis_simpanan dari tabel simpanan
        $jenisSimpanan = JenisSimpanan::where('id', $simpanan->jenis_simpanan)->first();

        if (!$jenisSimpanan) {
            return response()->json(['success' => false, 'message' => 'Jenis simpanan tidak ditemukan']);
        }

        $transaksi = new Transaksi();
        $transaksi->tgl_transaksi = Tanggal::tglNasional($tglTransaksi);
        $transaksi->rekening_debit = $jenisMutasi == '1' ? $jenisSimpanan->rek_kas : $jenisSimpanan->rek_simp;
        $transaksi->rekening_kredit = $jenisMutasi == '1' ? $jenisSimpanan->rek_simp : $jenisSimpanan->rek_kas;
        $transaksi->idtp = 0;
        $transaksi->id_pinj = 0;
        $transaksi->id_pinj_i = 0;
        $transaksi->id_simp = $jenisMutasi == '1' ? "2-{$nia}" : "3-{$nia}";
        $transaksi->keterangan_transaksi = $jenisMutasi == '1' ? "Setor Tunai Rekening {$nomorRekening}" : "Tarik Tunai Rekening {$nomorRekening}";
        $transaksi->relasi = $namaDebitur;
        $transaksi->jumlah = $jumlah;
        $transaksi->urutan = 0;
        $transaksi->id_user = auth()->user()->id;

        if ($transaksi->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
        }
    }


    public function generateSimpanan()
    {
        $lokasi = 1;
        $kd_kab = 1;

        $request = request();
        if ($request->filled('id')) {
            $id = $request->input('id');
            $idArray = explode(',', $id);
            $idArray = array_map('trim', $idArray);
            $idArray = array_filter($idArray, 'is_numeric');
            $where = "id IN (" . implode(',', $idArray) . ")";
        } else {
            $where = 1;
        }

        $simpanan = DB::table("simpanan_anggota_$kd_kab")
            ->whereRaw($where)
            ->orderBy('id', 'ASC')
            ->get();

        $total = $simpanan->count();

        $start = $request->input('start', 0);
        $per_page = 25;

        $simpananChunk = $simpanan->slice($start, $per_page);

        foreach ($simpananChunk as $simp) {
            DB::table("real_simpanan_$lokasi")->where('cif', $simp->id)->delete();

            $transaksi = DB::table("transaksi_$lokasi")
                ->where('id_simp', $simp->id)
                ->orderBy('tgl_transaksi', 'ASC')
                ->orderBy('urutan', 'ASC') 
                ->orderBy('idt', 'ASC')
                ->get();

            $sum = 0;
            foreach ($transaksi as $trx) {
                $cif = $simp->id;
                $tgl_transaksi = $trx->tgl_transaksi;
                
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

                $lu = now();
                $id_user = $trx->id_user;

                DB::table("real_simpanan_$lokasi")->insert([
                    'cif' => $cif,
                    'tgl_transaksi' => $tgl_transaksi,
                    'real_d' => $real_d,
                    'real_k' => $real_k,
                    'sum' => $sum,
                    'lu' => $lu,
                    'id_user' => $id_user
                ]);
            }
        }

        if ($start >= $total) {
            return redirect()->route('simpanan.index')->with('success', 'Proses generate simpanan telah selesai');
        }
        
        $title = 'generate Simpanan';
        return view('simpanan.generate', compact('title', 'total', 'start', 'per_page'));
    }

    
    public function generateBunga()
    {

        $title = 'generate Bunga';
        $total = '123';
        $start = '0';
        $per_page = '25';
        return view('simpanan.generate_bunga', compact('title', 'total', 'start', 'per_page'));
    }



    public function store(Request $request)
    {
        $rules = [
            'nomor_rekening' => 'required|string|max:255',
            'jenis_simpanan' => 'required',
            'nia' => 'required',
            'setoran_awal' => 'required|numeric',
            'tgl_buka_rekening' => 'required|date_format:d/m/Y',
            'tgl_minimal_tutup_rekening' => 'required|date_format:d/m/Y',
            'bunga' => 'required|numeric',
            'pajak_bunga' => 'required|numeric',
            'admin' => 'required|numeric',
            'kuasa' => 'required',
            'ahli_waris' => 'required',
            'hubungan' => 'required',
        ];

        \Log::info('Validation Rules:', $rules);
        \Log::info('Received Data:', $request->all());

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            \Log::info('Validation Errors:', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validator = Validator::make($request->all(), [
            'nomor_rekening' => 'required',
            'jenis_simpanan' => 'required',
            'nia' => 'required',
            'setoran_awal' => 'required|numeric',
            'tgl_buka_rekening' => 'required|date_format:d/m/Y',
            'tgl_minimal_tutup_rekening' => 'required|date_format:d/m/Y',
            'bunga' => 'required|numeric',
            'pajak_bunga' => 'required|numeric',
            'admin' => 'required|numeric',
            'kuasa' => 'required',
            'ahli_waris' => 'required',
            'hubungan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $simpanan = new Simpanan();
        $simpanan->nomor_rekening = $request->nomor_rekening;
        $simpanan->jenis_simpanan = $request->jenis_simpanan;
        $simpanan->nia = $request->nia;
        $simpanan->jumlah = $request->setoran_awal;
        $simpanan->tgl_buka = Tanggal::tglNasional($request->tgl_buka_rekening);
        $simpanan->tgl_tutup = Tanggal::tglNasional($request->tgl_minimal_tutup_rekening);
        $simpanan->bunga = $request->bunga;
        $simpanan->pajak = $request->pajak_bunga;
        $simpanan->admin = $request->admin;
        $simpanan->status = 'A';
        $simpanan->sp = $request->kuasa;
        $simpanan->pengampu = $request->ahli_waris;
        $simpanan->hubungan = $request->hubungan;
        $simpanan->user_id = auth()->id();
        $simpanan->lu = date('Y-m-d H:i:s');
        $simpanan->save();

        $maxId = Simpanan::max('id');

        $js = JenisSimpanan::where('id', $request->jenis_simpanan)->first();
        $anggota = Anggota::where('id', $request->nia)->first();
        Transaksi::create([
            'tgl_transaksi' => Tanggal::tglNasional($request->tgl_buka_rekening),
            'rekening_debit' => $js->rek_kas,
            'rekening_kredit' =>  $js->rek_simp,
            'idtp' => '0',
            'id_pinj' => '0',
            'id_pinj_i' => '0',
            'id_simp' => '1-'.$maxId.'',
            'keterangan_transaksi' => 'Setoran Awal ' . $js->nama_js . ' ',
            'relasi' => $anggota->namadepan . '[' . $request->nia . ']',
            'jumlah' => str_replace(',', '', str_replace('.00', '', $request->setoran_awal)),
            'urutan' => '0',
            'id_user' => auth()->user()->id,
        ]);

        Transaksi::create([
            'tgl_transaksi' => Tanggal::tglNasional($request->tgl_buka_rekening),
            'rekening_debit' => $js->rek_kas,
            'rekening_kredit' =>  $js->rek_adm,
            'idtp' => '0',
            'id_pinj' => '0',
            'id_pinj_i' => '0',
            'id_simp' => '7-'.$maxId.'',
            'keterangan_transaksi' => 'Biaya Buka Buku ' . $js->nama_js . ' ',
            'relasi' => $anggota->namadepan . '[' . $request->nia . ']',
            'jumlah' => str_replace(',', '', str_replace('.00', '', $request->admin)),
            'urutan' => '0',
            'id_user' => auth()->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data simpanan berhasil disimpan',
            'id' => $simpanan->id
        ]);
    }
}
