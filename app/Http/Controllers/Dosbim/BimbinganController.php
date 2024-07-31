<?php

namespace App\Http\Controllers\Dosbim;

use App\Models\Bab;
use App\Models\Tesis;
use App\Models\SidangTa;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use function PHPUnit\Framework\isEmpty;

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
    
        $data = DB::table('mhs_bimbingan_ta as bimbingan')
            ->join('tesis', 'tesis.nim', '=', 'bimbingan.nim')
            ->where('bimbingan.nip', $user->username)
            ->where('bimbingan.status', 1)
            ->select([
                'bimbingan.nim',
                'bimbingan.nama',
                'bimbingan.ta_1',
                'bimbingan.ta_2',
                'bimbingan.no_hp',
                'bimbingan.email',
                'tesis.judul'
            ])->get();
    
        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('ta_1', function ($row) {
                $simpro = SidangTa::where('nim', '=', $row->nim)
                    ->where('kategori_ta', '1')
                    ->select('status')
                    ->first();
    
                if (!$simpro) {
                    return '<span class="badge badge-warning">Belum</span>';
                }
    
                switch ($simpro->status) {
                    case 0:
                        return '<span class="badge badge-warning">Pengajuan Sidang</span>';
                    case 1:
                        return 'Selesai';
                    case 2:
                        return 'Sidang';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->editColumn('ta_2', function ($row) {
                $simpro = SidangTa::where('nim', '=', $row->nim)
                    ->where('kategori_ta', '2')
                    ->select('status')
                    ->first();
    
                if (!$simpro) {
                    return '<span class="badge badge-warning">Belum</span>';
                }
    
                switch ($simpro->status) {
                    case 0:
                        return '<span class="badge badge-warning">Pengajuan Sidang</span>';
                    case 1:
                        return 'Selesai';
                    case 2:
                        return 'Sidang';
                    default:
                        return '<span class="badge rounded-pill bg-danger">Status Tidak Diketahui</span>';
                }
            })
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group gap-1" role="group">
                            <a type="button" href="' . route('dosbim.detail-bimbingan', $row->nim) . '" class="btn btn-sm btn-success rounded">Detail</a>
                        </div>';
            })
            ->rawColumns(['ta_1', 'ta_2', 'actions'])
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
