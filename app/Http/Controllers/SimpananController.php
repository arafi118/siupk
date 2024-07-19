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
                    $status = '<span class="badge badge-secondary">-</span>';
                    if ($row->status) {
                        $badge = $row->status == 'A' ? 'success' : 'danger';
                        $status = '<span class="badge badge-' . $badge . '">' . ($row->status == 'A' ? 'Aktif' : 'Non-Aktif') . '</span>';
                    }
                    return $status;
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
        $anggota = Anggota::where('id', $nia)->first();
    
        if ($kec && $anggota) {
            $kec_id = str_pad($kec->id, 3, '0', STR_PAD_LEFT);
            $anggota_id = str_pad($anggota->id, 3, '0', STR_PAD_LEFT);
            $urutan = 1 + \App\Models\Simpanan::where('id', $nia)->count();
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
    public function koran(Simpanan $simpanan)
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $simpanan = $simpanan->where('id', $simpanan->id)->with(['anggota', 'js'])->first();
        $title = 'Cetak Rekening Koran' . $simpanan->anggota->namadepan;
        return view('simpanan.partials.cetak_koran')->with(compact('title', 'simpanan', 'kec'));
    }









    public function store(Request $request)
{    $rules = [
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
    $simpanan->save();

    return response()->json([
        'success' => true,
        'message' => 'Data simpanan berhasil disimpan',
        'id' => $simpanan->id
    ]);
}

}
