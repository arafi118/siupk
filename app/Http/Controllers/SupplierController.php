<?php
namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Usaha;
use App\Models\Keluarga;
use App\Models\Kecamatan;
use App\Models\SebutanSupplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Session;
use Yajra\DataTables\Facades\DataTables;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        if (request()->ajax()) {
            $data = supplier::where('lokasi', $kec->id)->get();
            return DataTables::of($data)
                ->make(true);
        }

        $title = 'Data Supplier';
        $sebutan = SebutanSupplier::all();
        return view('supplier.index')->with(compact('sebutan', 'title','kec'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $jenis_usaha = Usaha::orderBy('nama_usaha', 'ASC')->get();
        $hubungan = Keluarga::orderBy('kekeluargaan', 'ASC')->get();

        $supplier_dipilih = 0;
        $jenis_usaha_dipilih = 0;
        $hubungan_dipilih = 0;
        $jk_dipilih = 0;

        $nik = '';
        $value_tanggal = '';
        if (request()->get('nik')) {
            $anggota = Anggota::where('nik', request()->get('nik'));
            if ($anggota->count() > 0) {
                $data_anggota = $anggota->first();

                $supplier_dipilih = $data_anggota->supplier;
                $jenis_usaha_dipilih = $data_anggota->usaha;
                $hubungan_dipilih = $data_anggota->hubungan;
                $jk_dipilih = $data_anggota->jk;

                $data_anggota->tgl_lahir = Tanggal::tglIndo($data_anggota->tgl_lahir);
                return view('supplier.edit')->with(compact( 'jenis_usaha', 'jenis_usaha_dipilih', 'hubungan', 'hubungan_dipilih', 'jk_dipilih', 'data_anggota'));
            }

            $nik = request()->get('nik');
            $kk = substr($nik, 0, 6);
            $tanggal = substr($nik, 6, 2);
            $bulan = substr($nik, 8, 2);
            $tahun = substr($nik, 10, 2);
            if ($tanggal >= 40) {
                $tgl = $tanggal - 40;
                $jk_dipilih = 'P';
            } else {
                $tgl = $tanggal;
                $jk_dipilih = 'L';
            }
            if ($tgl < 10) {
                $tgl = "$tgl";
            }
            if ($tahun < 20) {
                $thn = "20$tahun";
            } else {
                $thn = "19$tahun";
            }

            $value_tanggal = Tanggal::tglIndo("$thn-$bulan-$tgl");
        }

        return view('supplier.create')->with(compact( 'jenis_usaha', 'jenis_usaha_dipilih', 'hubungan', 'hubungan_dipilih', 'nik', 'jk_dipilih', 'value_tanggal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'nomorid',
            'nama',
            'alamat',
            'brand',
            'nohp',
            'ins' 
        ]);
        $rules = [
            'nomorid' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'brand' => 'required',
            'nohp' => 'required',
            'ins' => 'required'
        ];

        $validate = Validator::make($data,$rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_MOVED_PERMANENTLY);
        }

        $insert = [
            'lokasi' => Session::get('lokasi'),
            'nomorid' => $request->nomorid,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'brand' => $request->brand,
            'nohp' => $request->nohp,
            'ins' => $request->ins,
        ];

        $supplier = supplier::create($insert);
        return response()->json([
            'msg' => 'Register Supplier dengan nomor ID ' . $insert['nomorid'] . ' berhasil disimpan'
        ], Response::HTTP_ACCEPTED);
    }
    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $sebutan = SebutanSupplier::all();
        return view('supplier.edit')->with(compact('supplier', 'sebutan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->only([
            "nomorid",
            "nama",
            "alamat",
            "brand",
            "nohp",
            "ins"
            
        ]);

        $validate = Validator::make($data, [
            "nomorid" => 'required',
            "nama" => 'required',
            "alamat" => 'required',
            "brand" => 'required',
            "nohp" => 'required',
            "ins" => 'required'
            
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_MOVED_PERMANENTLY);
        }

        supplier::where('id', $supplier->id)->update($data);
        return response()->json([
            'msg' => 'Supplier ' . $supplier->nama . ' berhasil diperbarui'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
