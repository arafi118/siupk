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

        $transaksiQuery = Transaksi::where('id_simp', 'LIKE', "%-$cif");

        if ($tahun != 0) {
            $transaksiQuery->whereYear('tgl_transaksi', $tahun);
        }

        if ($bulan != 0) {
            $transaksiQuery->whereMonth('tgl_transaksi', $bulan);
        }

        $transaksi = $transaksiQuery->with('realSimpanan')->orderBy('tgl_transaksi', 'asc')->get();

        $transaksi->each(function ($item) {
            $item->ins = User::where('id', $item->id_user)->value('ins');
        });

        $bulankop = $bulan;
        $tahunkop = $tahun;
        
    $startDate = \Carbon\Carbon::createFromDate(
        $tahunkop, 
        $bulankop == 0 ? 1 : $bulankop, 
        1
    )->startOfMonth();

    $last_sum = RealSimpanan::where('cif', $cif)
        ->where('tgl_transaksi', '<', $startDate)
        ->orderBy('tgl_transaksi', 'desc')
        ->orderBy('id', 'desc')
        ->value('sum') ?? 0;

        return view('simpanan.partials.detail-transaksi', compact('transaksi', 'bulankop', 'tahunkop', 'cif', 'last_sum'));
    }

    public function infoBunga() {
        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');

        $tahun_now = $tahun;

        // Hitung bulan lalu
        $tahun_lalu = $tahun_now;
        $bulan_lalu = $bulan - 1;
        if ($bulan_lalu == 0) {
            $bulan_lalu = 12;
            $tahun_lalu--;
        }

        // Ambil tanggal bunga dari pengaturan kecamatan
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $tgl_bunga = $kec->tgl_bunga ?? 0;

        // Hitung jumlah hari dalam bulan sekarang dan bulan sekitar
        $last_day_bulan_lalu = cal_days_in_month(CAL_GREGORIAN, $bulan_lalu, $tahun_lalu);
        $last_day_bulan_ini  = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun_now);

        if ($tgl_bunga < 0) {
            // Hitung dari akhir bulan
            $day_bunga_lalu = $last_day_bulan_lalu + $tgl_bunga + 1;
            $day_bunga_ini  = $last_day_bulan_ini + $tgl_bunga + 1;

            // Amankan tanggal agar tidak di luar batas
            $day_bunga_lalu = max(1, min($day_bunga_lalu, $last_day_bulan_lalu));
            $day_bunga_ini  = max(1, min($day_bunga_ini, $last_day_bulan_ini));

            $tgl_awal  = sprintf("%04d-%02d-%02d", $tahun_lalu, $bulan_lalu, $day_bunga_lalu);
            $tgl_trans = sprintf("%04d-%02d-%02d", $tahun_now, $bulan, $day_bunga_ini);
            $tgl_akhir = date("Y-m-d", strtotime($tgl_trans . " -1 day"));
        } else {
            // Gunakan langsung tgl bunga sebagai awal bulan ini
            $day_bunga_ini = $tgl_bunga;
            $day_bunga_ini = max(1, min($day_bunga_ini, $last_day_bulan_ini));

            // Hitung bulan depan
            $bulan_depan = $bulan + 1;
            $tahun_depan = $tahun_now;
            if ($bulan_depan == 13) {
                $bulan_depan = 1;
                $tahun_depan++;
            }

            $last_day_bulan_depan = cal_days_in_month(CAL_GREGORIAN, $bulan_depan, $tahun_depan);
            $day_bunga_depan = max(1, min($tgl_bunga, $last_day_bulan_depan));

            $tgl_awal  = sprintf("%04d-%02d-%02d", $tahun_now, $bulan, $day_bunga_ini);
            $tgl_trans = sprintf("%04d-%02d-%02d", $tahun_depan, $bulan_depan, $day_bunga_depan);
            $tgl_akhir = date("Y-m-d", strtotime($tgl_trans . " -1 day"));
        }

        // Hitung jumlah hari inklusif
        $datetime_awal  = new \DateTime($tgl_awal);
        $datetime_akhir = new \DateTime($tgl_akhir);
        $selisih = $datetime_awal->diff($datetime_akhir);
        $jumlah_hari = $selisih->days + 1;

        return view('simpanan.partials.info_hitung_bunga', compact('jumlah_hari', 'tgl_awal', 'tgl_akhir'));
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
    $transaksi = Transaksi::where('idt', $idt)->with('realSimpanan')->orderBy('tgl_transaksi', 'asc')->first();
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
        $tgl=Tanggal::tglNasional($tglTransaksi);

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

        // Mengambil real_simpanan terbaru berdasarkan tgl_transaksi dan cif
        $realSimpanan = RealSimpanan::where('cif', $simpanan->id)
            ->where('tgl_transaksi', '<=', $tgl)
            ->orderBy('id', 'desc')
            ->first();

        $sum_baru = $realSimpanan ? ($realSimpanan->sum - ($jenisMutasi == '1' ? 0 : $jumlah) + ($jenisMutasi == '1' ? $jumlah : 0)) : $jumlah;

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
            RealSimpanan::create([
                'cif' => $simpanan->id,
                'idt' => $transaksi->idt,
                'tgl_transaksi' => $tgl,
                'real_d' => $jenisMutasi == '1' ? 0 : $jumlah,
                'real_k' => $jenisMutasi == '1' ? $jumlah : 0,
                'sum' => $sum_baru,
                'lu' => now(),
                'id_user' => $transaksi->id_user,
            ]);

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

    public function bunga_simpanan()
    {
        $title = 'generate Bunga';
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        return view('simpanan.bunga', compact('title', 'kec'));
    }
    
    public function simpanBunga()
    {
        $tahun = request()->get('tahun');
        $bulan = request()->get('bulan');
        $start = request()->get('start');
        $id = request()->get('id');
        $limit = 30;

        if ($id == NULL || $id == ""|| $id == 0) {
            $count = Simpanan::where('status', 'A')->count();
            $nia = Simpanan::where('status', 'A')
                           ->orderBy('id', 'asc')
                           ->skip($start)
                           ->take($limit)
                           ->get();
        } else {
            $id_array = explode(',', $id);
            $id_array = array_map('trim', $id_array);
            $id_array = array_filter($id_array, 'is_numeric');
            
            $count = Simpanan::whereIn('id', $id_array)
                             ->where('status', 'A')
                             ->count();
            $nia = Simpanan::whereIn('id', $id_array)
                           ->where('status', 'A')
                           ->orderBy('id', 'asc')
                           ->skip($start)
                           ->take($limit)
                           ->get();
        }

        $tahun_now = $tahun;
        // Hitung bulan lalu
        $tahun_lalu = $tahun_now;
        $bulan_lalu = $bulan - 1;
        if ($bulan_lalu == 0) {
            $bulan_lalu = 12;
            $tahun_lalu--;
        }

        // Ambil tanggal bunga dari pengaturan kecamatan
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $tgl_bunga = $kec->tgl_bunga ?? 0;

        // Hitung jumlah hari dalam bulan sekarang dan bulan sekitar
        $last_day_bulan_lalu = cal_days_in_month(CAL_GREGORIAN, $bulan_lalu, $tahun_lalu);
        $last_day_bulan_ini  = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun_now);

        if ($tgl_bunga < 0) {
            // Hitung dari akhir bulan
            $day_bunga_lalu = $last_day_bulan_lalu + $tgl_bunga + 1;
            $day_bunga_ini  = $last_day_bulan_ini + $tgl_bunga + 1;

            // Amankan tanggal agar tidak di luar batas
            $day_bunga_lalu = max(1, min($day_bunga_lalu, $last_day_bulan_lalu));
            $day_bunga_ini  = max(1, min($day_bunga_ini, $last_day_bulan_ini));

            $tgl_awal  = sprintf("%04d-%02d-%02d", $tahun_lalu, $bulan_lalu, $day_bunga_lalu);
            $tgl_trans = sprintf("%04d-%02d-%02d", $tahun_now, $bulan, $day_bunga_ini);
            $tgl_akhir = date("Y-m-d", strtotime($tgl_trans . " -1 day"));
        } else {
            // Gunakan langsung tgl bunga sebagai awal bulan ini
            $day_bunga_ini = $tgl_bunga;
            $day_bunga_ini = max(1, min($day_bunga_ini, $last_day_bulan_ini));

            // Hitung bulan depan
            $bulan_depan = $bulan + 1;
            $tahun_depan = $tahun_now;
            if ($bulan_depan == 13) {
                $bulan_depan = 1;
                $tahun_depan++;
            }

            $last_day_bulan_depan = cal_days_in_month(CAL_GREGORIAN, $bulan_depan, $tahun_depan);
            $day_bunga_depan = max(1, min($tgl_bunga, $last_day_bulan_depan));

            $tgl_awal  = sprintf("%04d-%02d-%02d", $tahun_now, $bulan, $day_bunga_ini);
            $tgl_trans = sprintf("%04d-%02d-%02d", $tahun_depan, $bulan_depan, $day_bunga_depan);
            $tgl_akhir = date("Y-m-d", strtotime($tgl_trans . " -1 day"));
        }

        // Hitung jumlah hari inklusif
        $datetime_awal  = new \DateTime($tgl_awal);
        $datetime_akhir = new \DateTime($tgl_akhir);
        $selisih = $datetime_awal->diff($datetime_akhir);
        $jumlah_hari = $selisih->days + 1;

        $hitung_bunga = $kec->hitung_bunga;

        foreach ($nia as $simp) {

            if ($hitung_bunga == 1) { // saldo_terakhir
                $real = RealSimpanan::where('cif', $simp->id)
                    ->whereBetween('tgl_transaksi', [$tgl_awal, $tgl_akhir])
                    ->orderByDesc('tgl_transaksi')
                    ->orderByDesc('id')
                    ->first();

                $saldo = $real->sum ?? 0;

            } elseif ($hitung_bunga == 2) { // saldo_terendah
                $real = RealSimpanan::where('cif', $simp->id)
                    ->whereBetween('tgl_transaksi', [$tgl_awal, $tgl_akhir])
                    ->orderBy('sum', 'asc')
                    ->first();

                $saldo = $real->sum ?? 0;

            } else { // saldo_rata-rata
                $saldo_terakhir_data = RealSimpanan::where('cif', $simp->id)
                    ->where('tgl_transaksi', '<', $tgl_awal)
                    ->orderByDesc('tgl_transaksi')
                    ->orderByDesc('id')
                    ->first();

                $saldo_terakhir = $saldo_terakhir_data->sum ?? 0;

                $transaksi = RealSimpanan::where('cif', $simp->id)
                    ->whereBetween('tgl_transaksi', [$tgl_awal, $tgl_akhir])
                    ->get();

                $jumdeb = 0;
                $jumkre = 0;

                foreach ($transaksi as $real) {
                    $hari_ke = (strtotime($real->tgl_transaksi) - strtotime($tgl_awal)) / (60 * 60 * 24) + 1;
                    $jumdeb += ($real->real_d * ($jumlah_hari - ($hari_ke + 1)));
                    $jumkre += ($real->real_k * ($jumlah_hari - ($hari_ke + 1)));
                }

                $saldo = (($saldo_terakhir * ($jumlah_hari - 1)) + ($jumkre - $jumdeb)) / $jumlah_hari;
            }

            // hitung bunga dan pajak
            $bunga = 0;
            $pajak = 0;

            if ($kec->min_bunga <= $saldo) {
                $bunga = number_format($saldo * $kec->pros_bunga, 2, '.', '');
            }
            if ($kec->min_pajak <= $bunga) {
                $pajak = number_format($bunga * $kec->pros_pajak, 2, '.', '');
            }

            //insert ke transaksi dan real
                $realSimpanan = RealSimpanan::where('cif', $simp->id)
                    ->where('tgl_transaksi', '<=', $tgl_trans)
                    ->orderBy('id', 'desc')
                    ->first();
            //bunga
            if($saldo>0){
                $sum_baru = $realSimpanan ? $realSimpanan->sum + $saldo : $saldo;

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
                    RealSimpanan::create([
                        'cif' => $simpanan->id,
                        'idt' => $transaksi->idt,
                        'tgl_transaksi' => $tgl,
                        'real_d' => $jenisMutasi == '1' ? 0 : $jumlah,
                        'real_k' => $jenisMutasi == '1' ? $jumlah : 0,
                        'sum' => $sum_baru,
                        'lu' => now(),
                        'id_user' => $transaksi->id_user,
                    ]);
            }




        }

        $link = request()->url('');
        $query = request()->query();
        
            if($query['id']=="" || $query['id']==NULL){
                $query['id'] = 0;
            }
            $query['start'] = $start + 30;
        $next = $link . '?' . http_build_query($query);

        if ($query['start'] < $count + 30) {
            $persen = round($query['start'] / ($count + 30) * 100);

            echo '<a href="' . $next . '" id="next"></a>';
            echo '
                <style>
                    @keyframes progress {
                        0% { --percentage: 0; }
                        100% { --percentage: var(--value); }
                    }

                    @property --percentage {
                        syntax: "<number>";
                        inherits: true;
                        initial-value: 0;
                    }

                    [role="progressbar"] {
                        --percentage: var(--value);
                        --primary: #369;
                        --secondary: #adf;
                        --size: 200px;
                        animation: progress 1s 0.2s forwards;
                        width: var(--size);
                        aspect-ratio: 1;
                        border-radius: 50%;
                        position: relative;
                        overflow: hidden;
                        display: grid;
                        place-items: center;
                        margin: 100px auto;
                    }

                    [role="progressbar"]::before {
                        content: "";
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: conic-gradient(var(--primary) calc(var(--percentage) * 1%), var(--secondary) 0);
                        mask: radial-gradient(white 55%, transparent 0);
                        mask-mode: alpha;
                        -webkit-mask: radial-gradient(#0000 55%, #000 0);
                        -webkit-mask-mode: alpha;
                    }

                    [role="progressbar"]::after {
                        counter-reset: percentage var(--value);
                        content: counter(percentage) "%";
                        font-family: Helvetica, Arial, sans-serif;
                        font-size: calc(var(--size) / 5);
                        color: var(--primary);
                    }
                </style>

                <div role="progressbar" aria-valuenow="' . $persen . '" aria-valuemin="0" aria-valuemax="100" style="--value: ' . $persen . '"></div>

                <script>document.querySelector("#next").click()</script>
            ';
            exit;
        } else {
            echo '<script>window.opener.postMessage("closed", "*"); window.close();</script>';
            exit;
        }

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
