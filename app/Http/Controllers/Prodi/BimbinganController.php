<?php

namespace App\Http\Controllers\Prodi;

use Illuminate\Http\Request;
use App\Models\Bimbingan;
use App\Http\Controllers\Controller;

class BimbinganController extends Controller
{
    private $url = 'prodi/bimbingan/';
    private $views = 'prodi/bimbingan/';
    private $active = 'bimbingan-langsung';

    public function index(){
        $data = [
            'url' =>$this -> url,
            'views' =>$this -> views,
            'active' =>$this -> active,
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
            ->rawColumns(['ta_1', 'ta_2'])
            ->make(true);
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
