<?php
namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Usaha;
use App\Models\Desa;
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
            $data = Supplier::where('lokasi', $kec->id)->with('d')->get();
            return DataTables::of($data)
                ->make(true);
        }

        $title = 'Data Supplier';
        $sebutan = SebutanSupplier::all();
        return view('supplier.index')->with(compact('sebutan', 'title', 'kec'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lokasi = Session::get('lokasi');
        $kec = Kecamatan::where('id', $lokasi)->first();
        $kd_kec = $kec->kd_kec;

        $supplier_dipilih = 0;

        $jumlah_supplier_by_kd_kec = Supplier::where('lokasi', $lokasi)->orderBy('kd_supplier', 'DESC');
        if ($jumlah_supplier_by_kd_kec->count() > 0) {
            $data_supplier = $jumlah_supplier_by_kd_kec->first();
            $kode_supplier = explode('-',$data_supplier->kd_supplier);

            if (count($kode_supplier) >= 3) {
                $kd_supplier =$kode_supplier[0] . '-' . $kode_supplier[1] . '-' . str_pad(($kode_supplier[2] + 1), 3, "0", STR_PAD_LEFT);
            } else {
                $jumlah_supplier = str_pad(Supplier::where('lokasi', $lokasi)->count() + 1, 3, "0", STR_PAD_LEFT);
                $kd_supplier = 'SP-'.str_replace('.','', $kd_kec) . '-' . $jumlah_supplier;
            }
        } else {
            $jumlah_supplier = str_pad(Supplier::where('lokasi', $lokasi)->count() + 1, 3, "0", STR_PAD_LEFT);
            $kd_supplier = 'SP-' .   str_replace('.','', $kd_kec) . '-' . $jumlah_supplier;
        }

        return view('supplier.create')->with(compact('kec', 'kd_supplier'));
    }
    
    public function generateKode()
        {
            //   
        }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'kd_supplier',
            'supplier',
            'alamat',
            'brand',
            'nohp'
        ]);
        $rules = [
            'kd_supplier' => 'required|unique:supplier,kd_supplier',
            'supplier'     => 'required',
            'alamat'        => 'required',
            'brand'          => 'required',
            'nohp'            => 'required'
        ];

        $validate = Validator::make($data,$rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_MOVED_PERMANENTLY);
        }

        $insert = [ 
            'lokasi'        => Session::get('lokasi'),
            'kd_supplier'   => $request->kd_supplier,
            'supplier'      => $request->supplier,
            'alamat'        => $request->alamat,
            'brand'         => $request->brand,
            'nohp'          => $request->nohp
        ];

        $supplier = Supplier::create($insert);
        return response()->json([
            'msg' => 'Register Supplier dengan Kode Supplier ' . $insert['kd_supplier'] . ' berhasil disimpan'
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
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();

        return view('supplier.edit')->with(compact('kec', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->only([
            "supplier",
            "alamat",
            "brand",
            "nohp"
            
        ]);

        $validate = Validator::make($data, [
            "supplier"     => 'required',
            "alamat"        => 'required',
            "brand"          => 'required',
            "nohp"            => 'required'
            
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
