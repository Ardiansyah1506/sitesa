<?php

namespace App\Http\Controllers\Prodi;

use App\Models\Dosen;
use App\Models\RefKuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DosenController extends Controller
{
    private $url = 'prodi/dosen/';
    private $title = 'Dosen';
    private $active = 'Dosen';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active,
        ];
        return view('prodi.dosen.index', $data);
    }

    public function getData()
    {
        $data = Dosen::where('status','==','0')
        ->select(['dosen.nama', 'dosen.nip'])
        ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                return '<div class="btn-group gap-1" merk="group">
                            <button type="button" class="btn btn-sm btn-success rounded edit-mhs" data-id="' . $data->nip . '">Set Jadi Pembimbing</button>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    

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

    public function store(Request $request)
{
    $nip = $request->nip;
    $kuota = $request->kuota;
    $kuotaInt = intval($kuota);

    Log::info('Kuota yang diterima:', ['kuota' => $kuotaInt]);

    try {
        $dosen = Dosen::where('nip', $nip)->first();

        if ($dosen) {
            // Menambahkan data baru ke RefKuota
            $data = [
                'nip' => $nip,
                'sisa_kuota' => $kuotaInt
            ];
            $save = RefKuota::create($data);

            // Update status dosen
            $dosen->update(['status' => '2']);

            if ($save) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Mengajukan Dosen Pembimbing'
                ]);
            } else {
                Log::error("Gagal menambah data kuota dosen dengan NIP: $nip");
                return response()->json([
                    'Error' => true,
                    'message' => 'Gagal Mengajukan Dosen Pembimbing'
                ]);
            }
        } else {
            Log::error("Data dosen tidak ditemukan untuk NIP: $nip");
            
            return response()->json([
                'Error' => true,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
    } catch (\Exception $e) {
        Log::error("Terjadi kesalahan saat menambah dosen dengan NIP: $nip, Error: " . $e->getMessage());
        return response()->json([
            'Error' => true,
            'message' => 'Data Tidak Ditemukan'
        ]);    }
}
}
