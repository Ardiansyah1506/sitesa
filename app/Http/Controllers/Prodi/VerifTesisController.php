<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tesis; // Pastikan Anda mengimpor model Tesis

class VerifTesisController extends Controller
{
    private $title = 'Tesis';
    private $active = 'tesis';
    public function index(){
        $data = [
            'title' =>$this->title,
            'active' =>$this->active,
            
        ];
        return view('prodi.tesis.index', $data);
    }


    public function getData()
    {
        $data = Tesis::where('status', '0')->get(); // Mengambil data dengan status 0 (belum diverifikasi)

        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<button class="btn btn-success btn-sm acc-tesis" data-id="'.$row->id.'">Acc</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function accTesis($id)
    {
        $tesis = Tesis::find($id);
        if ($tesis) {
            $tesis->status = 1; // Mengubah status menjadi 1 (disetujui)
            $tesis->save();
        }

        return response()->json(['success' => 'Tesis berhasil di-ACC']);
    }
}
