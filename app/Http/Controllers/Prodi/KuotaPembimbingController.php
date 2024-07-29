<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\Prodi\Kuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $data = DB::table('users')
            ->join('ref_kuota as kuota', 'users.username', '=', 'kuota.nip')
            ->join('dosen', 'users.username', '=', 'dosen.nip')
            ->where('users.role', 3)
            ->select(['users.username', 'kuota.nip' , 'kuota.sisa_kuota', 'dosen.nama'])
            ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                return '<div class="btn-group gap-1" merk="group">
                            <button type="button" class="btn btn-sm btn-primary rounded edit-mhs" data-id="' . $data->nip . '">Ubah</button>
                        </div>';
            })
            ->rawColumns(['actions'])
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

        $data = DB::table('users')
            ->join('ref_kuota as kuota', 'users.username', '=', 'kuota.nip')
            ->join('dosen', 'users.username', '=', 'dosen.nip')
            ->where('users.role', 3)
            ->where('users.username', '=', $id)
            ->select(['users.username', 'kuota.nip' , 'kuota.sisa_kuota', 'dosen.nama'])
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

    public function update(Request $request){
        $data = Kuota::where('nip', $request->nip)->first();
        $updated = [
            'sisa_kuota'=> $request->sisaKuota,
        ];
       $save = $data->update($updated);

       if($save){
            return redirect($this->url)->with('success', 'Berhasil Merubah');
       }else{
            return redirect($this->url)->with('error', 'Gagal Merubah');
       }
    }
}
