<?php

namespace App\Http\Controllers\Prodi;

use App\Models\Dosen;
use App\Models\Prodi\Kuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\RefKuota;

class KuotaPembimbingController extends Controller
{
    private $url = 'prodi/kuota-pembimbing/';
    private $title = 'Kuota Pembimbing';
    private $active = 'kuota-pembimbing';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active,
        ];
        return view('prodi.kuota.index', $data);
    }

    public function getData()
    {
        $data = Dosen::where('status','!=',0)->join('ref_kuota', 'ref_kuota.nip', 'dosen.nip')
        ->select(['dosen.nama', 'dosen.nip','sisa_kuota'])
        ->get();
    
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('sisa_kuota', function ($data) {
               $kuota = RefKuota::where('nip',$data->nip)->select('sisa_kuota')->first();;
                return $kuota->sisa_kuota;
            })
            ->addColumn('status', function ($data) {
                $statusText = '';
    
                if ($data->status == 0) {
                    $statusText = '<span class="badge bg-warning">Pengajuan</span>';
                } elseif ($data->status == 1) {
                    $statusText = '<span class="badge bg-success">Diterima</span>';
                }
    
                return '<div class="badge-group gap-1">' . $statusText . '</div>';
            })
            ->rawColumns(['status','sisa_kuota'])
            ->make(true);
    }




    
    // public function store(Request $request){
    //     $data = [
    //         'nama' => $request->nama,
    //         'gelombang' => $request->gelombang,
    //         'tanggal_awal' => $request->tanggalMulai,
    //         'tanggal_akhir' => $request->tanggalAkhir,
    //     ];
    //     $save = TanggalTA::create($data);

    //     if($save){
    //         return redirect($this->url)->with('success', 'Berhasil Menambah Data');
    //     }else{
    //         return redirect($this->url)->with('error', 'Gagal Menambah Data');
    //     }
    // }

    public function edit($id = NULL){
        $data = DB::table('dosen')
        ->where('nip',$id)
        ->select(['dosen.nama', 'dosen.nip'])
        ->first();


        if ($data == null) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Data Not Found',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Data Found',
                'data' => $data
            ]);
        }
    }

   

}
