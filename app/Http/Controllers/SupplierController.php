<?php
namespace App\Http\Controllers;

use App\Models\Supplier;
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
        if (request()->ajax()) {
            $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
            $data = supplier::where('lokasi', $kec->id)->get();
            return DataTables::of($data)
                ->make(true);
        }

        $title = 'Data Supplier';
        $sebutan = SebutanSupplier::all();
        return view('supplier.index')->with(compact('sebutan', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
