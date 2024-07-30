<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    private $url = 'admin/mahasiswa/';
    private $title = 'Daftar Mahasiswa';
    private $active = 'admin-mahasiswa';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active
        ];

        return view('admin.mahasiswa.index', $data);
    }

    public function getData()
    {
        $data = DB::table('mahasiswa as mhs')
        ->join('ref_sks as sks', 'sks.nim', '=', 'mhs.nim')
        ->join('ref_pembayaran as pembayaran', 'pembayaran.nim', '=', 'mhs.nim')
        ->select(['mhs.nim', 'mhs.nama', 'sks.jumlah', 'pembayaran.status'])
        ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function($data){
                switch($data->status){
                    case 0:
                        return '<span class="badge badge-danger">Belum Lunas</span>';
                    case 1:
                        return '<span class="badge badge-success">Lunas</span>';
                    default:
                        return 'status tidak diketahui';
                }
            })
            ->addColumn('actions', function ($data) {
                return '<div class="btn-group gap-1" merk="group">
                            <button class="btn btn-success btn-sm edit-mhs" data-id="' . $data->nim . '">Ubah</button>                     
                        </div>';
            })
            ->rawColumns(['actions','status'])
            ->make(true);
            
    }

    public function edit($id = NULL){
        $data = DB::table('mahasiswa as mhs')
        ->join('ref_sks as sks', 'sks.nim', '=', 'mhs.nim')
        ->join('ref_pembayaran as pembayaran', 'pembayaran.nim', '=', 'mhs.nim')
        ->select(['mhs.nim', 'mhs.nama', 'sks.jumlah', 'pembayaran.status'])
        ->where('mhs.nim', $id)
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

    public function updateMhs(Request $request)
    {
        // Update ref_pembayaran table
        $savePembayaran = DB::table('ref_pembayaran')
            ->where('nim', $request->nim)
            ->update(['status' => $request->statusPembayaran]);

        // Update ref_sks table
        $saveSks = DB::table('ref_sks')
            ->where('nim', $request->nim)
            ->update(['jumlah' => $request->jumlahSks]);

        if ($savePembayaran || $saveSks) {
            return redirect($this->url)->with('success', 'Berhasil Merubah');
        } else {
            return redirect($this->url)->with('error', 'Gagal Merubah');
        }
    }
}
