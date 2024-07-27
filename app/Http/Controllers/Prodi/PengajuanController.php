<?php

namespace App\Http\Controllers\Prodi;

use Illuminate\Http\Request;
use App\Models\Dosbim\Bimbingan;
use App\Http\Controllers\Controller;
use App\Models\Dosbim\Tesis;

class PengajuanController extends Controller
{
    private $url = 'prodi/pengajuan/';
    private $title = 'Pengajuan';
    private $active = 'pengajuan-prodi';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active
        ];

        return view('prodi.pengajuan.index', $data);
    }

    public function getData()
    {
        
        $data = Bimbingan::where('status', 0)
            ->select(['id', 'nim', 'nama', 'nama_pembimbing'])
            ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $csrfField = csrf_field();
                $updateMethod = method_field('PUT');
                $accUrl = route('prodi.acc', $data->id);
                return '<div class="btn-group gap-1" merk="group">
                            <form id="accBimbingan" action="' . $accUrl . '" method="POST" style="display:inline;">
                                ' . $updateMethod . '
                                ' . $csrfField . '
                                <input type="text" name="id" value="'. $data->id .'" style="display:none">
                                <button type="submit" class="btn btn-sm btn-success rounded">Acc</button>
                            </form>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
            
    }

    public function acc(Request $request){
        $bimbingan = Bimbingan::where('id', $request->id);

        $bimbingan->update(['status' => 1]);

        return redirect($this->url)->with('success', 'Berhasil Acc Mahasiswa');
    }
}
