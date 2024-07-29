<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dosen;
use App\Models\Bimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    private $url = 'admin/pengajuan/';
    private $title = 'Pengajuan';
    private $active = 'admin-pengajuan';

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
        $data = Dosen::all();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $url = route('admin.detail-bimbingan', $data->nip);
                return '<div class="btn-group gap-1" merk="group">
                            <a class="btn btn-success btn-sm" href="'. $url .'">Detail</a>                     
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
            
    }

    public function detailDosenBimbingan($nip = NULL){
        $dosen = Dosen::where('nip', $nip)
        ->first();
        $data = [
            'namaDosen' => $dosen->nama,
            'nip' => $nip,
            'url' => $this->url,
            'active' => $this->active,
            'title' => $this->title,
        ];
        return view('admin.pengajuan.detail', $data);
    }

    public function getDataDetail($nip = NULL) {
        $data = DB::table('mhs_bimbingan_ta as bimbingan')
        ->where('bimbingan.nip', $nip)
        ->where('bimbingan.status', 0)
        ->join('tesis', 'tesis.nim', '=', 'bimbingan.nim')
        ->select([
            'bimbingan.nim',
            'bimbingan.nama',
            'bimbingan.nip',
            'bimbingan.no_hp',
            'tesis.judul',
            'tesis.abstrak',
        ])
        ->get();
            
    
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $csrfField = csrf_field();
                $updateMethod = method_field('PUT');
                $accUrl = route('admin.acc', $data->nim);
                return '<div class="btn-group gap-1" merk="group">
                            <form id="accBimbingan" action="' . $accUrl . '" method="POST" style="display:inline;">
                                ' . $updateMethod . '
                                ' . $csrfField . '
                                <input type="text" name="nim" value="'. $data->nim .'" style="display:none">
                                <input type="text" name="nip" value="'. $data->nip .'" style="display:none">
                                <button type="submit" class="btn btn-sm btn-success rounded">Acc</button>
                            </form>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    
    public function acc(Request $request){
        $bimbingan = Bimbingan::where('nip', $request->nip)
        ->where('nim', $request->nim)
        ->first();

        $bimbingan->update(['status' => 1]);

        return redirect($this->url)->with('success', 'Berhasil Acc Mahasiswa');
    }
}
