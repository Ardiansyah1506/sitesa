<?php

namespace App\Http\Controllers\Prodi;

use App\Models\Dosbim\Tesis;
use Illuminate\Http\Request;
use App\Models\Dosbim\Bimbingan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        
        $data = DB::table('mhs_bimbingan_ta as bimbingan')
            ->where('bimbingan.status', 0)
            ->join('tesis', 'bimbingan.nim', '=', 'tesis.nim')
            ->select([
                'bimbingan.id',
                'bimbingan.nim',
                'bimbingan.nama',
                'bimbingan.nama_pembimbing',
                'tesis.judul',
                'tesis.abstrak',
            ])
            ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $csrfField = csrf_field();
                $updateMethod = method_field('PUT');
                $accUrl = route('prodi.delete-waktu-ta', $data->id);
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
