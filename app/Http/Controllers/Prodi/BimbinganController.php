<?php

namespace App\Http\Controllers\Prodi;

use Illuminate\Http\Request;
use App\Models\Bimbingan;
use App\Http\Controllers\Controller;
use App\Models\Dosen;

class BimbinganController extends Controller
{
    private $url = 'prodi/bimbingan/';
    private $views = 'prodi/bimbingan/';
    private $active = 'bimbingan-langsung';
    private $title = 'Sedang Bimbingan';

    public function index(){
        $pembimbing = Dosen::where('status', 1)->get();
        $data = [
            'title' => $this->title,
            'url' =>$this -> url,
            'views' =>$this -> views,
            'active' =>$this -> active,
            'pembimbing' => $pembimbing
        ];

        return view('prodi.bimbingan.index', $data);
    }

    public function getData()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Fetch data and group by 'nim'
        $data = Bimbingan::where('status', 1)
            ->select(['nim', 'nama', 'nama_pembimbing', 'ta_1', 'ta_2'])
            ->get()
            ->groupBy('nim');

        // Process grouped data
        $groupedData = $data->map(function($group) {
            $first = $group->first();
            $mergedTa1 = $group->pluck('ta_1')->unique();
            $mergedTa2 = $group->pluck('ta_2')->unique();
            $mergedPembimbing = $group->pluck('nama_pembimbing')->unique()->implode(', ');

            return [
                'nim' => $first->nim,
                'nama' => $first->nama,
                'nama_pembimbing' => $mergedPembimbing,
                'ta_1' => $this->mergeStatuses($mergedTa1),
                'ta_2' => $this->mergeStatuses($mergedTa2)
            ];
        })->values();

        return \DataTables::of($groupedData)
            ->addIndexColumn()
            ->editColumn('ta_1', function($data){
                return $data['ta_1'];
            })
            ->editColumn('ta_2', function($data){
                return $data['ta_2'];
            })
            ->addColumn('actions', function($data){
                return '<div class="btn-group gap-1" merk="group">
                            <btn class="btn btn-success ubah-bimbingan btn-sm" data-id="'. $data['nim'] . '">Ubah</btn>                     
                        </div>';
            })
            ->rawColumns(['ta_1', 'ta_2', 'actions'])
            ->make(true);
    }

    public function edit($nim = NULL){
        $data = Bimbingan::where('nim', $nim)
        ->get();
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

    public function updateBimbingan(Request $request)
    {

        // Ambil data dosen berdasarkan NIP
        $pembimbing1 = Dosen::where('nip', $request->pembimbing1)->first();
        $pembimbing2 = Dosen::where('nip', $request->pembimbing2)->first();

        if (!$pembimbing1 || !$pembimbing2) {
            return back()->with('error', 'Pembimbing tidak ditemukan.');
        }

        // Ambil data bimbingan berdasarkan NIM
        $bimbingan = Bimbingan::where('nim', $request->nim)->get();

        // Update data bimbingan
        foreach ($bimbingan as $index => $bimbing) {
            if ($index == 0) {
                $bimbing->update([
                    'nip' => $request->pembimbing1,
                    'nama_pembimbing' => $pembimbing1->nama,
                ]);
            } elseif ($index == 1) {
                $bimbing->update([
                    'nip' => $request->pembimbing2,
                    'nama_pembimbing' => $pembimbing2->nama,
                ]);
            }
        }

        return back()->with('success', 'Berhasil Mengubah Pembimbing');
    }


    // Helper function to merge statuses into badges
    private function mergeStatuses($statuses)
    {
        $statusBadges = $statuses->map(function($status) {
            switch($status){
                case 0:
                    return '<span class="badge badge-info">Belum</span>';
                case 1:
                    return '<span class="badge badge-success">Selesai</span>';
                case 2:
                    return '<span class="badge badge-success">Acc</span>';
                default:
                    return 'Status Tidak Diketahui';
            }
        });

        return $statusBadges->implode(' ');
    }

}
