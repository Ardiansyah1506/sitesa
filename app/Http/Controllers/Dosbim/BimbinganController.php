<?php

namespace App\Http\Controllers\Dosbim;

use App\Http\Controllers\Controller;
use App\Models\Dosbim\Bimbingan;
use Illuminate\Http\Request;

class BimbinganController extends Controller
{
    private $url = 'dosen-pembimbing/bimbingan/';
    private $title = 'Bimbingan';
    private $active = 'bimbingan';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active
        ];

        return view('dosbim.bimbingan.index', $data);
    }

    public function getData()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        
        $data = Bimbingan::where('nip', $user->username)
            ->where('status', 2)
            ->select(['nim', 'nama', 'status', 'ta_1', 'ta_2', 'no_hp'])
            ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                switch($row->status){
                    case 0:
                        return 'Pengajuan';
                    case 1:
                        return '<span class="badge rounded-pill bg-success">Lulus</span>';
                    case 2:
                        return '<span class="badge rounded-pill bg-info">Bimbingan</span>';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->editColumn('ta_1', function ($row) {
                switch($row->ta_1){
                    case 0:
                        return '<span class="badge badge-warning">Revisi</span>';
                    case 1:
                        return 'Lulus';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->editColumn('ta_2', function ($row) {
                switch($row->ta_2){
                    case 0:
                        return '<span class="badge badge-warning">Revisi</span>';
                    case 1:
                        return 'Lulus';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->addColumn('actions', function ($data) {
                return '<div class="btn-group gap-1" merk="group">
                            <a type="button" href="' . route('dosbim.detail-bimbingan', $data->nim) . '" class="btn btn-sm btn-primary rounded">Detail</a>
                        </div>';
            })
            ->rawColumns(['ta_1', 'ta_2', 'status', 'actions'])
            ->make(true);
    }
    
    public function detail($id = NULL){
        dd($id);
    }

}

