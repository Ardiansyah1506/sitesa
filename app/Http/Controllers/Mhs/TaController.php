<?php

namespace App\Http\Controllers\Mhs;

use App\Models\TA;
use App\Models\Dosen;
use App\Models\Tesis;
use App\Models\SidangTa;
use App\Models\TanggalTA;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MahasiswaBimbingan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            $message = 'Judul belum di-ACC oleh prodi';
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

            $nama = Tesis::where('nim', Auth::user()->username)->select('nama')->first();
            return $nama ? $nama->nama : 'Nama tidak ditemukan';
            
        })
        ->addColumn('judul', function($data) {
            $judul = Tesis::where('nim', Auth::user()->username)->select('judul')->get();
            return $judul;
        })
        ->addColumn('penguji_1', function($data) {
            $penguji = Dosen::where('nip', $data->nip_penguji_1)->select('nama')->first();
            return $penguji ? $penguji->nama : 'Belum ada penguji';
        })
        ->addColumn('penguji_2', function($data) {
            $penguji = Dosen::where('nip', $data->nip_penguji_2)->select('nama')->first();
            return $penguji ? $penguji->nama : 'Belum ada penguji';
        })
        ->editColumn('status', function($data) {
            $sidang = SidangTa::where('nim', $data->nim)->first();
            if (!$sidang) {
                return '<button class="btn btn-warning btn-modal" data-target="#uploadModal" data-id="'.$data->nim.'">Ajukan</button>';
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
        ->rawColumns(['status','judul','nama','penguji_1','penguji_2'])
        ->make(true);
}

public function createPengajuan(Request $request){
    try {
        // Validasi input
        $request->validate([
            'kategori' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // contoh validasi file
        ]);

        // Mendapatkan input dari request
        $kategori_sidang = $request->input('kategori');
        $file = $request->file('file'); // Mendapatkan file yang diunggah
        $nim = Auth::user()->username;

        // Pastikan file ada sebelum mencoba untuk mendapatkan extension
        if ($file) {
            // Menyusun path penyimpanan
            $folder = 'public/ta';
            $filename = $nim . '_ta_' . $kategori_sidang . '.' . $file->getClientOriginalExtension();

            // Memastikan direktori penyimpanan ada
            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder);
            }

            // Simpan file dalam storage/public/ta_kategori/{nim_ta_kategori}
            $file->storeAs($folder, $filename);

            // Menyusun data yang akan disimpan
            $data = [
                'nim' => $nim,
                'kategori_ta' => $kategori_sidang,
                'file' => $filename, // Menyimpan nama file yang diunggah
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
                'kategori_sidang' => $data['kategori_ta']
            ]);

            return response()->json(['message' => 'Pengajuan TA berhasil diajukan.'], 200);
        } else {
            return response()->json(['message' => 'File tidak ditemukan.'], 400);
        }
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
