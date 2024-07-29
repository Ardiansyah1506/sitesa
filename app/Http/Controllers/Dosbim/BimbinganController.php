<?php

namespace App\Http\Controllers\Dosbim;

use App\Models\Bab;
use App\Models\Tesis;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            ->where('status', 1)
            ->select(['nim', 'nama', 'status', 'ta_1', 'ta_2', 'no_hp'])
            ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                switch($row->status){
                    case 0:
                        return 'Pengajuan';
                    case 1:
                        return '<span class="badge rounded-pill bg-success">Bimbingan</span>';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->editColumn('ta_1', function ($row) {
                switch($row->ta_1){
                    case 0:
                        return '<span class="badge badge-warning">Belum</span>';
                    case 1:
                        return 'Lulus';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->editColumn('ta_2', function ($row) {
                switch($row->ta_2){
                    case 0:
                        return '<span class="badge badge-warning">Belum</span>';
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
    
    public function detail($nim = NULL)
    {
        $babList = Bab::where('nim', $nim)
                    ->whereIn('id_kategori', [1, 2, 3, 4, 5, 6])
                    ->get()
                    ->keyBy('id_kategori');

        $mhs = Mahasiswa::where('nim', $nim)
        ->first();

        $tesis = Tesis::where('nim', $nim)
        ->first();

        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active,
            'nim' => $nim,
            'tesis' => $tesis,
            'nama' => $mhs->nama,
            'bab1' => $babList->get(1),
            'bab2' => $babList->get(2),
            'bab3' => $babList->get(3),
            'bab4' => $babList->get(4),
            'bab5' => $babList->get(5),
            'bab6' => $babList->get(6),
        ];


        return view('dosbim.bimbingan.detail', $data);
    }


    public function storeCatatanBab1(Request $request){
        $refBab = Bab::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->where('id_kategori', 1)
        ->where('status', 0)
        ->first();

        $refBab->update(['status' => 2]);

        $catatan = Bimbingan::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->first();

        $catatan->update([
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Berhasil memberi catatan bab 1');
    }   
    public function storeCatatanBab2(Request $request){
        $refBab = Bab::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->where('id_kategori', 2)
        ->where('status', 0)
        ->first();

        $refBab->update(['status' => 2]);

        $catatan = Bimbingan::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->first();

        $catatan->update([
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Berhasil memberi catatan bab 1');
    }   
    public function storeCatatanBab3(Request $request){
        $refBab = Bab::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->where('id_kategori', 3)
        ->where('status', 0)
        ->first();

        $refBab->update(['status' => 2]);

        $catatan = Bimbingan::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->first();

        $catatan->update([
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Berhasil memberi catatan bab 1');
    }   
    public function storeCatatanBab4(Request $request){
        $refBab = Bab::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->where('id_kategori', 4)
        ->where('status', 0)
        ->first();

        $refBab->update(['status' => 2]);

        $catatan = Bimbingan::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->first();

        $catatan->update([
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Berhasil memberi catatan bab 1');
    }   
    public function storeCatatanBab5(Request $request){
        $refBab = Bab::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->where('id_kategori', 5)
        ->where('status', 0)
        ->first();

        $refBab->update(['status' => 2]);

        $catatan = Bimbingan::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->first();

        $catatan->update([
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Berhasil memberi catatan bab 1');
    }   
    public function storeCatatanBab6(Request $request){
        $refBab = Bab::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->where('id_kategori', 1)
        ->where('status', 0)
        ->first();

        $refBab->update(['status' => 2]);

        $catatan = Bimbingan::where('nim', $request->nim)
        ->where('nip', auth()->user()->username)
        ->first();

        $catatan->update([
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Berhasil memberi catatan bab 1');
    }   

    public function accBab(Request $request) {
        $nip = auth()->user()->username;
    
        $refBab = Bab::where('nim', $request->nim)
            ->where('id_kategori', $request->babKe)
            ->first();
    
        $bimbingan = Bimbingan::where('nim', $request->nim)
            ->where('nip', $nip)
            ->first();
        
        if($request->babKe == 3 || $request->babKe == 6)
        {
            // Mengambil semua entri bimbingan dengan status 1
            $statuses = Bimbingan::where('nim', $request->nim)
                ->where('status', 1)
                ->pluck('ta_1');
    
            // Logika yang telah diperbaiki untuk perulangan dengan kondisi bab ke-3 dan ke-6
            foreach($statuses as $status) {
                if ($request->babKe == 3) {
                    Bimbingan::where('nim', $request->nim)
                        ->where('nip', $nip)
                        ->update([
                            'ta_1' => 2
                        ]);
                } elseif ($request->babKe == 6) {
                    Bimbingan::where('nim', $request->nim)
                        ->where('nip', $nip)
                        ->update([
                            'ta_2' => 2
                        ]);
                }
            }
        }
    
        // Memastikan bimbingan dan refBab tidak null sebelum update
        if ($bimbingan) {
            $bimbingan->update(['catatan' => null]);
        }
    
        if ($refBab) {
            $refBab->update(['status' => 1]);
        }
    
        return back()->with('success', 'Acc Bab ke-' . $request->babKe);
    }
    
                
}
