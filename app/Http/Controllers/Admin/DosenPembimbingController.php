<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dosen;
use App\Models\RefKuota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DosenPembimbingController extends Controller
{
    protected $title = 'Pengajuan Dosen Pembimbing';
    protected $active = 'Dosen Pembimbing';
    public function index(){
        $data = [
            'title'=> $this->title,
            'active'=> $this->active,
        ];
        return view('admin.dosen.index', $data);
    }
    public function getData() {
        $data = Dosen::where('status', 2)->get(); // Mengambil data dari model Dosen
        return \DataTables::of($data)
            ->addIndexColumn() // Menambahkan kolom DT_RowIndex
            ->editColumn('kuota', function ($row) {
                $kuota = RefKuota::where('nip', $row->nip)->first();
                return $kuota ? $kuota->sisa_kuota : 'Tidak ada data';
            })
            ->addColumn('button', function ($row) {
                return '<button class="btn btn-warning btn-sm edit-btn text-light" data-id="'.$row->nip.'">Acc</button>';
            })
            ->rawColumns(['button','kuota'])
            ->make(true);
    }
    
    

}

