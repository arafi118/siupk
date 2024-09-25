<?php
namespace App\Http\Controllers;

use App\Models\Saham;
use App\Models\Usaha;
use App\Models\Desa;
use App\Models\Keluarga;
use App\Models\Kecamatan;
use App\Models\SebutanSaham;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Session;
use Yajra\DataTables\Facades\DataTables;


class SahamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $desa = Desa::where('kd_kec', $kec['kd_kec'])->with('sebutan_desa')->get();
        
        $saham = Saham::where('lokasi', Session::get('lokasi'))->get();
        if (request()->ajax()) {
            $data = Saham::where('lokasi', $kec->id)->with('d')->get();
            return DataTables::of($data)
                ->make(true);
        }

        $desa_dipilih = 0;
        if (request()->get('desa')) {
            $desa_dipilih = request()->get('desa');
        }
        $title = 'Data Saham';
        $sebutan = SebutanSaham::all();
        return view('saham.index')->with(compact('saham', 'sebutan', 'title', 'kec', 'desa', 'desa_dipilih'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $desa = Desa::where('kd_kec', $kec['kd_kec'])->with('sebutan_desa')->get();

        
        $desa_dipilih = 0;
        $saham_dipilih = 0;

        return view('saham.create')->with(compact('desa', 'desa_dipilih'));
    }
    
        public function generateKode()
        {
            $lokasi = Session::get('lokasi');
            $kd_desa = request()->get('kode');

            $jumlah_saham_by_kd_desa = Saham::where('desa', $kd_desa)->orderBy('kd_saham', 'DESC');
            if ($jumlah_saham_by_kd_desa->count() > 0) {
                $data_saham = $jumlah_saham_by_kd_desa->first();
                $kode_saham = explode('-',$data_saham->kd_saham);

                if (count($kode_saham) >= 2) {
                    $kd_saham = $kode_saham[0] . '-' . str_pad(($kode_saham[1] + 1), 3, "0", STR_PAD_LEFT);
                } else {
                    $jumlah_saham = str_pad(Saham::where('desa', $kd_desa)->count() + 1, 3, "0", STR_PAD_LEFT);
                    $kd_saham = $kd_desa . '-' . $jumlah_saham;
                }

                // $kd_saham = $data_saham->kd_saham + 1;

            } else {
                $jumlah_saham = str_pad(Saham::where('desa', $kd_desa)->count() + 1, 3, "0", STR_PAD_LEFT);
                $kd_saham = $kd_desa . '-' . $jumlah_saham;
                // $kd_saham = $kd_desa . $jumlah_saham;

            }

            if (request()->get('kd_saham')) {
                $kd_kel = request()->get('kd_saham');
                $saham = Saham::where('kd_saham', $kd_kel);
                if ($saham->count() > 0) {
                    $data_kel = $saham->first();

                    if ($kd_desa == $data_kel->desa) {
                        $kd_saham = $data_kel->kd_saham;
                    }
                }
            }

            return response()->json([
                'kd_saham' => $kd_saham
            ], Response::HTTP_ACCEPTED);
        }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'nama_saham',
            'rp_saham',
            'pros_saham',
            'nama_direksi',
            'jab_direksi',
            'nama_kom',
            'jab_kom'
        ]);
        $rules = [
            'nama_saham'      => 'required',
        ];

        $validate = Validator::make($data,$rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_MOVED_PERMANENTLY);
        }

        $insert = [ 
            'lokasi'        => Session::get('lokasi'),
            'nama_saham'    => $request->nama_saham,
            'rp_saham'      => $request->rp_saham,
            'pros_saham'    => $request->pros_saham,
            'nama_direksi'  => $request->nama_direksi,
            'jab_direksi'   => $request->jab_direksi,
            'nama_kom'      => $request->nama_kom,
            'jab_kom'       => $request->jab_kom
        ];

        $saham = Saham::create($insert);
        return response()->json([
            'msg' => 'Register Direksi dan Komisaris dengan Nama ' . $insert['nama_saham'] . ' berhasil disimpan'
        ], Response::HTTP_ACCEPTED);
    }
    /**
     * Display the specified resource.
     */
    public function show(Saham $saham)
    {
       return 1;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saham $saham)
    {
        $sebutan = SebutanSaham::all();
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $desa = Desa::where('kd_kec', $kec['kd_kec'])->with('sebutan_desa')->get();

        $desa_dipilih = 0;

        return view('saham.edit')->with(compact('kec', 'saham', 'sebutan', 'desa', 'desa_dipilih'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saham $saham)
    {
        $data = $request->only([
            "nama_saham",
            "rp_saham",
            "pros_saham",
            "nama_direksi",
            "jab_direksi",
            "nama_kom",
            "jab_kom"
            
        ]);

        $validate = Validator::make($data, [
            "nama_saham"      => 'required',
            
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_MOVED_PERMANENTLY);
        }

        saham::where('id', $saham->id)->update($data);
        return response()->json([
            'msg' => 'Edit Direksi dan Komisaris ' . $saham->nama_saham . ' berhasil diperbarui'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    
     public function hapus(Request $request, Saham $saham)
     {
         $id = $request->del_id;
 
             $shm = Saham::where('id', $id)->delete();
 
         return response()->json([
             'success' => true,
             'msg' => 'Data Direksi dan Komisaris Berhasil Dihapus.'
         ]);
     }

    public function destroy(Saham $saham)
    {
        Saham::where('id', $saham->id)->delete();

        return response()->json([
            'success' => true,
            'msg' => 'Data Direksi dan Komisaris Berhasil Dihapus.'
        ]);
    }
}
