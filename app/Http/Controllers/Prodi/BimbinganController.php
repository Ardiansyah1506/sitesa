<?php

namespace App\Http\Controllers\Prodi;

use Illuminate\Http\Request;
use App\Models\Dosbim\Bimbingan;
use App\Http\Controllers\Controller;

class BimbinganController extends Controller
{
    private $url = 'prodi/bimbingan/';
    private $views = 'prodi/bimbingan/';
    private $active = 'bimbingan-langsung';

    public function index(){
        $data = [
            'url' =>$this -> url,
            'views' =>$this -> views,
            'active' =>$this -> active,
        ];

        return view('prodi.bimbingan.index', $data);
    }

    public function getData()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        
        $data = Bimbingan::where('status', 2)
            ->select(['nim', 'nama', 'nama_pembimbing', 'ta_1', 'ta_2'])
            ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('ta_1', function($data){
                switch($data->ta_1){
                    case 0:
                        return '<span class="badge badge-info">Pengajuan</span>';
                    case 1:
                        return '<span class="badge badge-success">Selesai</span>';
                    case 2:
                        return '<span class="badge badge-success">Acc</span>';
                    default:
                        return 'Status Tidak Diketahui';
                }
            })
            ->editColumn('ta_2', function($data){
                switch($data->ta_2){
                    case 0:
                        return '<span class="badge badge-info">Pengajuan</span>';
                    case 1:
                        return '<span class="badge badge-success">Selesai</span>';
                    case 2:
                        return '<span class="badge badge-success">Acc</span>';
                    default:
                        return 'Status Tidak Diketahui';
                }
            })
            ->rawColumns(['ta_1', 'ta_2'])
            ->make(true);
    }

}
