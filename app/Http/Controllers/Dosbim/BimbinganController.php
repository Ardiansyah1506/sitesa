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
                        return 'Bimbingan';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->editColumn('ta_1', function ($row) {
                switch($row->ta_1){
                    case 0:
                        return 'Revisi';
                    case 1:
                        return 'Lulus';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->editColumn('ta_2', function ($row) {
                switch($row->ta_2){
                    case 0:
                        return 'Revisi';
                    case 1:
                        return 'Lulus';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->make(true);
    }

}

