<?php
namespace App\Http\Controllers\Mhs;

use App\Models\Bab;
use App\Models\Bimbingan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MahasiswaBimbingan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BimbinganController extends Controller
{
    public function index()
{
    $nim = Auth::user()->username;

    $bab1 = Bab::where('nim', $nim)->where('id_kategori', 1)->get();
    $bab2 = Bab::where('nim', $nim)->where('id_kategori', 2)->get();
    $bab3 = Bab::where('nim', $nim)->where('id_kategori', 3)->get();
    $bab4 = Bab::where('nim', $nim)->where('id_kategori', 4)->get();
    $bab5 = Bab::where('nim', $nim)->where('id_kategori', 5)->get();
    $bab6 = Bab::where('nim', $nim)->where('id_kategori', 6)->get();

    $showBab2 = !$bab1->isEmpty() && $bab1->every(function ($item) {
        return $item->status == 1;
    });

    $showBab3 = $showBab2 && !$bab2->isEmpty() && $bab2->every(function ($item) {
        return $item->status == 1;
    });

    $showBab4 = $showBab3 && !$bab3->isEmpty() && $bab3->every(function ($item) {
        return $item->status == 1;
    });

    $showBab5 = $showBab4 && !$bab4->isEmpty() && $bab4->every(function ($item) {
        return $item->status == 1;
    });

    $showBab6 = $showBab5 && !$bab5->isEmpty() && $bab5->every(function ($item) {
        return $item->status == 1;
    });

    return view('mhs.bimbingan.index', compact('bab1', 'bab2', 'bab3', 'bab4', 'bab5', 'bab6', 'showBab2', 'showBab3', 'showBab4', 'showBab5', 'showBab6'));
}


    public function getData(Request $request, $id_kategori)
    {
        try {
            // Mengambil NIM dari user yang sedang login
            $nim = Auth::user()->username;
    
            // Mengambil data bimbingan dan menggabungkannya dengan data Bab berdasarkan NIM dan ID Kategori
            $data = Bab::where('nim', $nim)
                ->where('id_kategori', $id_kategori)
                ->select('nim', 'nip', 'status', 'id_kategori') // Select appropriate columns
                ->groupBy('nim', 'nip', 'status', 'id_kategori') // Group by these columns to avoid issues
                ->get();
    
            if ($data->isEmpty()) {
                return response()->json([
                    'draw' => intval($request->draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                ]);
            }
    
            return \DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nama_pembimbing', function ($row) {
                    $data = MahasiswaBimbingan::where('nip', $row->nip)->pluck('nama')->first();
                    return $data;
                })
                ->editColumn('catatan', function ($row) {
                    if ($row->status == '2') {
                        $data = MahasiswaBimbingan::where('nip', $row->nip)->pluck('catatan')->first();
                        return $data;
                    } else {
                        return '';
                    }
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == '0') {
                        return '<span class="badge rounded-pill bg-danger">Pengajuan</span>';
                    } else if ($row->status == '1') {
                        return '<span class="badge rounded-pill bg-success">Acc</span>';
                    } else if ($row->status == '2') {
                        return '<span class="badge rounded-pill bg-warning">Revisi</span>';
                    }
                })
                ->rawColumns(['status', 'nama_pembimbing','catatan'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error fetching data for category ' . $id_kategori . ': ' . $e->getMessage());
            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function uploadBab(Request $request, $id_kategori)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        try {
            $nim = Auth::user()->username;
            $fileName = $nim . '_bab' . $id_kategori . '.' . $request->file->getClientOriginalExtension();

            // Cari data yang sudah ada berdasarkan nim dan id_kategori
            $existingRecord = Bab::where('nim', $nim)->where('id_kategori', $id_kategori)->first();

            // Jika data sudah ada, hapus file lama
            if ($existingRecord) {
                Storage::disk('public')->delete('uploads/bab' . $id_kategori . '/' . $existingRecord->nama_file);
            }
            $filePath = $request->file('file')->storeAs('uploads/bab' . $id_kategori, $fileName, 'public');

            $nip = MahasiswaBimbingan::where('nim',$nim)->select('nip');
            // Update atau buat data baru
            $nips = MahasiswaBimbingan::where('nim', $nim)->pluck('nip');

            // Update atau buat data baru
            foreach ($nips as $nip) {
                Bab::updateOrCreate(
                    [
                        'nim' => $nim,
                        'id_kategori' => $id_kategori,
                        'nip' => $nip, // Include NIP in the unique keys to differentiate entries
                    ],
                    [
                        'nama_file' => $fileName,
                        'status' => 0,
                    ]
                );
            }

            return response()->json([
                'status' => 'success',
                'message' => 'File berhasil diunggah',
                'file' => $fileName
            ]);
        } catch (\Exception $e) {
            Log::error('Error uploading file for category ' . $id_kategori . ': ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengunggah file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function checkBab()
    {
        $nim = Auth::user()->username;
        $bab = Bab::where('nim', $nim)->get();
        if ($bab) {
            return response()->json(['status' => 'success', 'data' => $bab]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Bab belum diupload']);
        }
    }
}
