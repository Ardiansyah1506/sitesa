<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dosen;
use App\Models\RefKuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DosenPembimbingController extends Controller
{
    protected $title = 'Pengajuan Dosen Pembimbing';
    protected $active = 'admin-pengajuan-pembimbing';
    public function index(){
        $data = [
            'title'=> $this->title,
            'active'=> $this->active,
        ];
        return view('admin.dosen.index', $data);
    }
    public function listDosen(){
        $data = [
            'title'=> $this->title,
            'active'=> 'list-dosen',
        ];
        return view('admin.dosen.list', $data);
    }


    public function getListDosen(){
        $data = Dosen::where('status', 1)->get(); // Mengambil data dari model Dosen
        return \DataTables::of($data)
            ->addIndexColumn() // Menambahkan kolom DT_RowIndex
            ->editColumn('kuota', function ($row) {
                $kuota = RefKuota::where('nip', $row->nip)->first();
                return $kuota? $kuota->sisa_kuota : 'Tidak ada data';
            })
            ->addColumn('button', function ($row) {
                return '<button class="btn btn-primary btn-sm edit-btn text-light" data-id="'.$row->nip.'">Edit</button>';
            })
            ->rawColumns(['button','kuota'])
            ->make(true);
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
    
    public function accDosen(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);
    
        $nip = $request->input('username');
        $password = $request->input('password');
    
        try {
            // Simpan data ke model User
            $user = new User();
            $user->username = $nip;
            $user->password = bcrypt($password); // Enkripsi password
            $user->role = 3; // Role untuk dosen
            $user->save();
    
            // Perbarui status pada model Dosen
            $dosen = Dosen::where('nip', $nip)->first();
            if ($dosen) {
                $dosen->status = 1; // Set status menjadi 1
                $dosen->save();
    
                // Log aksi sukses
                Log::info('Akun berhasil dibuat dan status dosen diperbarui.', [
                    'nip' => $nip,
                    'user_id' => $user->id
                ]);
    
                return response()->json(['succes' => 'Akun berhasil dibuat dan status dosen diperbarui.']);
            } else {
                // Log jika dosen tidak ditemukan
                Log::warning('Dosen tidak ditemukan.', ['nip' => $nip]);
    
                return response()->json(['message' => 'Dosen tidak ditemukan.'], 404);
            }
        } catch (\Exception $e) {
            // Log jika terjadi kesalahan
            Log::error('Terjadi kesalahan saat membuat akun atau memperbarui status dosen.', [
                'nip' => $nip,
                'error' => $e->getMessage()
            ]);
    
            return response()->json(['message' => 'Terjadi kesalahan, silakan coba lagi.'], 500);
        }
    }
    public function edit($nip)
    {
        $dosen = Dosen::where('nip', $nip)->firstOrFail();
        $kuota = RefKuota::where('nip', $nip)->first();
    
        return response()->json([
            'nip' => $dosen->nip,
            'kuota' => $kuota ? $kuota->sisa_kuota : 0
        ]);
    }
    
    public function updateKuota(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:255',
            'kuota' => 'required|integer|min:0'
        ]);
    
        $nip = $request->input('nip');
        $kuotaValue = $request->input('kuota');
    
        try {
            // Update kuota in RefKuota model
            $kuota = RefKuota::where('nip', $nip)->first();
            if ($kuota) {
                $kuota->sisa_kuota = $kuotaValue;
                $kuota->save();
            } else {
                // Create new kuota record if not exists
                RefKuota::create([
                    'nip' => $nip,
                    'sisa_kuota' => $kuotaValue
                ]);
            }
    
            return response()->json(['success' => 'Kuota berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan, silakan coba lagi.'], 500);
        }
    }
    

}

