<?php

namespace App\Http\Controllers\Mhs;

use App\Models\TA;
use App\Models\TanggalTA;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MahasiswaBimbingan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaController extends Controller
{
    private $url = 'prodi/pengajuan/';
    private $title = 'Pengajuan TA';
    private $active = 'pengajuan-prodi';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active
        ];

        return view('mhs.waktu-ta.index', $data);
    }
    public function getData()
{
    // Retrieve data for the logged-in user
    $data = MahasiswaBimbingan::where('nim', Auth::user()->username)->get();

    return \DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('kategori_sidang', function($data) {
            // Menghitung kategori sidang berdasarkan urutan atau logika tertentu
            static $kategori_sidang_counter = 0;
            return ++$kategori_sidang_counter;
        })
        ->editColumn('tanggal_sidang', function($data) {
            // Mengambil kategori sidang saat ini untuk setiap row
            static $kategori_sidang_counter = 0;
            $kategori_sidang_counter++;
            
            $sidang = TA::where('nim', $data->nim)->where('kode_ta', $kategori_sidang_counter)->first();
            if ($sidang && $sidang->tanggal != '-') {
                return Carbon::parse($sidang->tanggal)->translatedFormat('d F Y');
            }
            if ($sidang && $sidang->status =='0') {
                return 'Sidang Belum Dimulai ';
            }
            return 'Ajukan Sidang ';
        })
        ->editColumn('nama_file', function($data) {
            static $kategori_sidang_counter = 0;
            $kategori_sidang_counter++;

            $sidang = TA::where('nim', $data->nim)->where('kode_ta', $kategori_sidang_counter)->first();
            if ($sidang && $sidang->nama_file) {
                $fileUrl = url("path/to/files/{$sidang->nama_file}");
                return '<a href="'.$fileUrl.'">"'.$sidang->nama_file.'"</a>';
            }
            return '';
        })
        ->editColumn('status', function($data) {
            static $kategori_sidang_counter = 0;
            $kategori_sidang_counter++;

            $sidang = TA::where('nim', $data->nim)->where('kode_ta', $kategori_sidang_counter)->first();
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
        ->rawColumns(['nama_file', 'status', 'kategori_sidang', 'tanggal_sidang'])
        ->make(true);
}

    public function createPengajuan(Request $request){
        try {
            // Mendapatkan input dari request
            $kategori_sidang = $request->input('kategori');
            $nim = Auth::user()->username;

        // Membuat nama file dengan format nim_kategori.ext
        $file = $request->file('file');
        $fileName = $nim . '_' . $kategori_sidang . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('uploads/ta_' . $kategori_sidang, $fileName, 'public');

        // Menyusun data yang akan disimpan
        $data = [
            'nim' => $nim,
            'kode_ta' => $kategori_sidang,
            'nama_file' => $fileName,
            'tanggal' => '-',
            'nota_pembimbing' => '-',
            'status' => 0,
        ];
            // Membuat pengajuan TA baru
            TA::create($data);
    
            // Logging informasi pengajuan yang berhasil
            Log::info('Pengajuan TA berhasil diajukan.', [
                'nim' => $data['nim'],
                'kategori_sidang' => $data['kode_ta'],
                'file' => $data['nama_file']
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
