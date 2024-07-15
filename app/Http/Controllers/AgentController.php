<?php
namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Usaha;
use App\Models\Desa;
use App\Models\Keluarga;
use App\Models\Kecamatan;
use App\Models\SebutanAgent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Session;
use Yajra\DataTables\Facades\DataTables;


class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $desa = Desa::all(); 
        if (request()->ajax()) {
            $data = agent::where('lokasi', $kec->id)->get();
            return DataTables::of($data)
                ->make(true);
        }

        $title = 'Data Agent';
        $sebutan = SebutanAgent::all();
        return view('agent.index')->with(compact('sebutan', 'title', 'kec', 'desa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desa = Desa::all(); 
        $kec = Kecamatan::where('id', Session::get('lokasi'))->first();
        $jenis_usaha = Usaha::orderBy('nama_usaha', 'ASC')->get();
        $hubungan = Keluarga::orderBy('kekeluargaan', 'ASC')->get();

        $agent_dipilih = 0;
        $jenis_usaha_dipilih = 0;
        $hubungan_dipilih = 0;
        $jk_dipilih = 0;

        $nik = '';
        $value_tanggal = '';
        if (request()->get('nik')) {
            $anggota = Anggota::where('nik', request()->get('nik'));
            if ($anggota->count() > 0) {
                $data_anggota = $anggota->first();

                $agent_dipilih = $data_anggota->agent;
                $jenis_usaha_dipilih = $data_anggota->usaha;
                $hubungan_dipilih = $data_anggota->hubungan;
                $jk_dipilih = $data_anggota->jk;

                $data_anggota->tgl_lahir = Tanggal::tglIndo($data_anggota->tgl_lahir);
                return view('agent.edit')->with(compact( 'jenis_usaha', 'jenis_usaha_dipilih', 'hubungan', 'hubungan_dipilih', 'jk_dipilih', 'data_anggota'));
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

        return view('agent.create')->with(compact( 'jenis_usaha', 'jenis_usaha_dipilih', 'hubungan', 'hubungan_dipilih', 'nik', 'jk_dipilih', 'value_tanggal','desa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'nomorid',
            'agent',
            'alamat',
            'desa',
            'nohp'
        ]);
        $rules = [
            'nomorid'   => 'required',
            'agent'     => 'required',
            'alamat'    => 'required',
            'desa'      => 'required',
            'nohp'      => 'required'
        ];

        $validate = Validator::make($data,$rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_MOVED_PERMANENTLY);
        }

        $insert = [
            'lokasi'    => Session::get('lokasi'),
            'nomorid'   => $request->nomorid,
            'agent'     => $request->agent,
            'alamat'    => $request->alamat,
            'desa'      => $request->desa,
            'nohp'      => $request->nohp
        ];

        $agent = agent::create($insert);
        return response()->json([
            'msg' => 'Register Agent dengan nomor ID ' . $insert['nomorid'] . ' berhasil disimpan'
        ], Response::HTTP_ACCEPTED);
    }
    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        $sebutan = SebutanAgent::all();
        return view('agent.edit')->with(compact('agent', 'sebutan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $data = $request->only([
            "nomorid",
            "agent",
            "alamat",
            "desa",
            "nohp"
            
        ]);

        $validate = Validator::make($data, [
            "nomorid"   => 'required',
            "agent"     => 'required',
            "alamat"    => 'required',
            "desa"      => 'required',
            "nohp"      => 'required'
            
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_MOVED_PERMANENTLY);
        }

        agent::where('id', $agent->id)->update($data);
        return response()->json([
            'msg' => 'Agent ' . $agent->nama . ' berhasil diperbarui'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
