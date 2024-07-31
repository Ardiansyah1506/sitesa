<?php

namespace App\Http\Controllers\Mhs;

use App\Models\TA;
use App\Models\Tesis;
use App\Models\SidangTa;
use App\Models\TanggalTA;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MahasiswaBimbingan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaController extends Controller
{
    private $url = 'mahasiwa/pengajuan/';
    private $title = 'Pengajuan TA';
    private $active = 'ta-mhs';

    public function index(){
        $nim = Auth::user()->username;
        $tesis = Tesis::where('nim', $nim)->first();
    
        $canSubmitTA = true;
        $message = '';
    
        if (!$tesis) {
            // Tidak ada data tesis ditemukan
            $canSubmitTA = false;
            $message = 'Anda belum mengajukan judul';
        } elseif ($tesis->status != 1) {
            // Tesis ada tapi belum di-ACC admin
            $canSubmitTA = false;
            $message = 'Judul belum di-ACC admin';
        }
    
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active,
            'canSubmitTA' => $canSubmitTA,
            'message' => $message,
        ];
    
        return view('mhs.waktu-ta.index', $data);
    }
    
    public function getData()
{
    // Retrieve data for the logged-in user
    $data = SidangTa::where('nim', Auth::user()->username)->get();

    return \DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('nama', function($data) {

            $nama = Tesis::where('nim', Auth::user()->username)->select('nama')->get();
            return $nama;
        })
        ->addColumn('Judul', function($data) {
            $judul = Tesis::where('nim', Auth::user()->username)->select('judul')->get();
            return $judul;
        })
        ->editColumn('status', function($data) {
            $sidang = SidangTa::where('nim', $data->nim)->first();
            if (!$sidang) {
                return '<button class="btn btn-warning btn-modal" data-target="#uploadModal" data-id="'.$kategori_sidang_counter.'">Ajukan</button>';
            } else {
                switch ($sidang->status) {
                    case 0:
                        return '<span class="badge badge-danger">Pengajuan</span>';
                    case 1:
                        return '<span class="badge badge-primary">Selesai</span>';
                    case 2:
                        return '<span class="badge badge-success">Acc</span>';
                    default:
                        return '';
                }
            }
        })
        ->rawColumns(['status','judul','nama'])
        ->make(true);
}

public function createPengajuan(Request $request){
    try {
        // Mendapatkan input dari request
        $kategori_sidang = $request->input('kategori');
        $nim = Auth::user()->username;

        // Menyusun data yang akan disimpan
        $data = [
            'nim' => $nim,
            'kategori_ta' => $kategori_sidang,
            'nama_file' => '-', // Default or placeholder
            'tanggal_daftar' => now()->format('Y-m-d'), // Menyimpan hanya tanggal tanpa jam
            'tanggal_sidang' => null, // Placeholder, diisi nanti
            'penguji_1' => '-', // Placeholder, diisi nanti
            'penguji_2' => '-', // Placeholder, diisi nanti
            'status' => 0,
        ];

        // Membuat pengajuan TA baru
        SidangTa::create($data);

        // Logging informasi pengajuan yang berhasil
        Log::info('Pengajuan TA berhasil diajukan.', [
            'nim' => $data['nim'],
            'kategori_sidang' => $data['kode_ta']
        ]);

        return response()->json(['message' => 'Pengajuan TA berhasil diajukan.'], 200);
    } catch (\Exception $e) {
        // Logging jika terjadi kesalahan
        Log::error('Gagal membuat pengajuan TA.', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString()
        ]);

        return response()->json(['message' => 'Terjadi kesalahan saat mengajukan TA. Silakan coba lagi.'], 500);
    }
}
}
