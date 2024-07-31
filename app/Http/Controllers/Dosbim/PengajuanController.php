<?php

namespace App\Http\Controllers\Dosbim;

use App\Models\Bimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{

    private $url = 'dosen-pembimbing/pengajuan/';
    private $title = 'Pengajuan';
    private $active = 'pengajuan';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active
        ];

        return view('dosbim.pengajuan.index', $data);
    }

    public function getData()
    {
        $user = Auth::user()->username;
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        
        $data = DB::table('mhs_bimbingan_ta as bimbingan')
            ->where('bimbingan.nip', $user)
            ->where('bimbingan.status', 0)
            ->join('tesis', 'bimbingan.nim', '=', 'tesis.nim')
            ->where('tesis.status', 1)
            ->select([
                'bimbingan.id',
                'bimbingan.nim',
                'bimbingan.nama',
                'tesis.judul',
                'tesis.abstrak',
            ])
            ->get();
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $csrfField = csrf_field();
                $updateMethod = method_field('PUT');
                $accUrl = route('dosbim.acc', $data->id);
                return '<div class="btn-group gap-1" merk="group">
                            <form id="accBimbingan" action="' . $accUrl . '" method="POST" style="display:inline;">
                                ' . $updateMethod . '
                                ' . $csrfField . '
                                <input type="text" name="id" value="'. $data->id .'" style="display:none">
                                <button type="submit" class="btn btn-sm btn-success rounded">Acc</button>
                            </form>
                        </div>';
            })
            ->rawColumns(['actions', 'judul'])
            ->make(true);
            
    }

    public function acc(Request $request){
        $bimbingan = Bimbingan::where('id', $request->id);

        $bimbingan->update(['status' => 1]);

        return redirect($this->url)->with('success', 'Berhasil Acc Mahasiswa');
    }
}
