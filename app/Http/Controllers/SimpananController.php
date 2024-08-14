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
use App\Models\Rekening;
use App\Models\RencanaAngsuranI;
use App\Models\StatusPinjaman;
use App\Models\SistemAngsuran;
use App\Models\Transaksi;
use App\Models\User;
use App\Utils\Keuangan;
use App\Utils\Pinjaman;
use App\Utils\Tanggal;
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
            $simpanan = Simpanan::with(['anggota', 'js'])
                ->orderBy('id', 'DESC');
            return DataTables::of($simpanan)
                ->addColumn('nama_anggota', function ($row) {
                    return $row->anggota->namadepan ?? '-';
                })
                ->addColumn('jenis_simpanan', function ($row) {
                    return $row->js->nama_js ?? '-';
                })
                ->addColumn('status', function ($row) {
                    $status = '<span class="badge bg-secondary">-</span>';
                    if ($row->status) {
                        $badge = $row->status == 'A' ? 'success' : 'danger';
                        $status = '<span class="badge bg-' . $badge . '">' . ($row->status == 'A' ? 'Aktif' : 'Non-Aktif') . '</span>';
                    }
                    return $status;
                })
                ->addColumn('status', function ($row) {
                    $status = '<span class="badge bg-secondary">-</span>';
                    if ($row->status) {
                        $badge = $row->status == 'A' ? 'success' : 'danger';
                        $status = '<span class="badge bg-' . $badge . '">' . ($row->status == 'A' ? 'Aktif' : 'Non-Aktif') . '</span>';
                    }
                    return $status;
                })
                ->editColumn('jumlah', function ($row) {
                    return 'Rp ' . number_format($row->jumlah, 0, ',', '.');
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

    public function getTransaksi()
    {
        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');
        $cif = request()->input('cif');

        $transaksi = Transaksi::where('id_simp', 'LIKE', "%-$cif")
            ->whereMonth('tgl_transaksi', $bulan)
            ->whereYear('tgl_transaksi', $tahun)
            ->orderBy('tgl_transaksi', 'asc')
            ->get();
        return view('simpanan.partials.detail-transaksi', compact('transaksi'));
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
        $title = 'Registrasi Pinjaman Individu';
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
        $hubungan = Keluarga::orderBy('kekeluargaan', 'ASC')->get();

        $hubungan_dipilih = 0;

        if ($kec && $anggota) {
            
            $hubungan_dipilih = $kec->hubungan;
            $kec_id = str_pad($kec->id, 3, '0', STR_PAD_LEFT);
            $anggota_id = str_pad($anggota->id, 3, '0', STR_PAD_LEFT);
            $urutan = 1 + $urutan;
            $urutan_formatted = str_pad($urutan, 2, '0', STR_PAD_LEFT);
            $nomor_rekening = "{$id}-{$kec_id}.{$anggota_id}-{$urutan_formatted}";
        } else {
            $nomor_rekening = 'Data tidak valid';
        }
        $fromkuasa = [
            [
                'id' => '1',
                'nama' => 'Pribadi',
            ],
            [
                'id' => '2',
                'nama' => 'Lembaga',
            ],
        ];
        return response()->json([
            'success' => true,
            'view' => view('simpanan.partials.simpanan', compact('id', 'kec', 'anggota', 'nomor_rekening', 'fromkuasa', 'hubungan', 'hubungan_dipilih'))->render()
        ]);
    }

    public function Kuasa($id)
    {
        return response()->json([
            'success' => true,
            'view' => view('simpanan.partials.fromkuasa')->with(compact('id'))->render()
        ]);
    }
    public function show(Simpanan $simpanan)
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $desa = Desa::where('kd_kec', $kec->kd_kec)->with('sebutan_desa')->get();
        $hubungan = Keluarga::orderBy('kekeluargaan', 'ASC')->get();

        $nia = $simpanan->where('id', $simpanan->id)->with(['anggota', 'js'])->first();
        $title = ucwords($simpanan->anggota->namadepan);
        return view('simpanan.partials.detail')->with(compact('nia', 'title', 'hubungan'));
    }


    public function kop(Simpanan $simpanan)
    {
        $simpanan = $simpanan->where('id', $simpanan->id)->with(['anggota', 'js'])->first();
        $title = 'Cetak KOP buku ' . $simpanan->anggota->namadepan;
        return view('simpanan.partials.cetak_kop')->with(compact('title', 'simpanan'));
    }
    public function koran(Simpanan $simpanan)
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $simpanan = $simpanan->where('id', $simpanan->id)->with(['anggota', 'js'])->first();
        $title = 'Cetak Rekening Koran' . $simpanan->anggota->namadepan;
        return view('simpanan.partials.cetak_koran')->with(compact('title', 'simpanan', 'kec'));
    }

    public function simpanTransaksi(Request $request)
    {
        $jenisMutasi = $request->jenis_mutasi;
        $tglTransaksi = $request->tgl_transaksi;
        $jumlah = $request->jumlah;
        $nomorRekening = $request->nomor_rekening;
        $lembaga = $request->lembaga;
        $jabatan = $request->jabatan;
        $catatan_simpanan = $request->catatan_simpanan;
        $namaDebitur = $request->nama_debitur;
        $nia = $request->nia;

        $jenisSimpanan = JenisSimpanan::where('id', substr($nomorRekening, 0, 1))->first();

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_rekening' => 'required', 
            'jenis_simpanan' => 'required',
            'nia' => 'required',
            'setoran_awal' => 'required|numeric',
            'tgl_buka_rekening' => 'required',
            'tgl_minimal_tutup_rekening' => 'required',
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
        $simpanan ->nomor_rekening = $request->nomor_rekening;
        $simpanan ->lembaga = $request->lembaga;
        $simpanan ->jabatan = $request->jabatan;
        $simpanan ->catatan_simpanan = $request->catatan_simpanan;
        $simpanan ->jenis_simpanan = $request->jenis_simpanan;
        $simpanan ->nia = $request->nia;
        $simpanan ->jumlah = $request->setoran_awal;
        $simpanan ->tgl_buka = Tanggal::tglNasional($request->tgl_buka_rekening);
        $simpanan ->tgl_tutup = Tanggal::tglNasional($request->tgl_minimal_tutup_rekening);
        $simpanan ->bunga = $request->bunga;
        $simpanan ->pajak = $request->pajak_bunga;
        $simpanan ->admin = $request->admin;
        $simpanan ->status = 'A';
        $simpanan ->sp = $request->kuasa;
        $simpanan ->pengampu = $request->ahli_waris;
        $simpanan ->hubungan = $request->hubungan;
        $simpanan ->user_id = auth()->id();
        $simpanan ->lu = date('Y-m-d H:i:s');
        $simpanan ->save();

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
            'id_simp' => $maxId,
            'keterangan_transaksi' => 'Setoran Awal ' . $js->nama_js . ' ' . $anggota->namadepan . '',
            'relasi' => $anggota->namadepan . '[' . $request->nia . ']',
            'jumlah' => str_replace(',', '', str_replace('.00', '', $request->setoran_awal)),
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