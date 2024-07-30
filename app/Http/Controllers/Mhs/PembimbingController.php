<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Dosen;
use App\Models\RefKuota;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

class PembimbingController extends Controller
{
    private $title = 'Pengajuan Bimbingan';
    private $active = 'pembimbing-mhs';

    public function index(){
        $data = [
            'title' => $this->title,
            'active' => $this->active
        ];
        return view('mhs.pembimbing.index', $data);
    }

    public function getDataPembimbing()
    {
        $nim = Auth::user()->username;
        // Mengambil data pembimbing dengan join
        $data = Dosen::join('ref_kuota', 'dosen.nip', '=', 'ref_kuota.nip')
                     ->select('dosen.nama', 'dosen.nip', 'ref_kuota.sisa_kuota', 'dosen.id')
                     ->get();
    
        // Hitung jumlah pengajuan bimbingan oleh mahasiswa
        $jumlahPengajuan = Bimbingan::where('nim', $nim)->count();
    
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) use ($jumlahPengajuan) {
                // Cek apakah mahasiswa sudah mengajukan bimbingan dengan dosen tersebut
                $cekData = Bimbingan::where('nip', $row->nip)
                                     ->where('nim', Auth::user()->username)
                                     ->exists();
    
                if ($jumlahPengajuan >= 2) {
                    return '<button class="btn btn-success acc-button" data-nip="' . $row->nip . '" disabled>Ajukan</button>';
                } elseif ($cekData) {
                    return '<span>Dalam Pengajuan</span>';
                } elseif ($row->sisa_kuota > 0) {
                    return '<button class="btn btn-success acc-button" data-nip="' . $row->nip . '">Ajukan</button>';
                } else {
                    return '<span>Kuota Sudah Penuh</span>';
                }
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    

    public function PengajuanBimbingan(Request $request)
    {
        Log::info('PengajuanBimbingan request received', ['request' => $request->all()]);
    
        $nip = $request->nip;
        Log::info('NIP received', ['nip' => $nip]);  // Debugging: Log the NIP
        $nim = Auth::user()->username;
    
        // Mengambil data mahasiswa
        $mahasiswa = Mahasiswa::where('nim', $nim)->select('nama', 'nim', 'email', 'no_hp')->first();
        if (!$mahasiswa) {
            Log::error('Mahasiswa not found', ['nim' => $nim]);
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }
    
        // Mengambil data dosen
        $dosen = Dosen::where('nip', $nip)->select('nama', 'nip')->first();
        if (!$dosen) {
            Log::error('Dosen not found', ['nip' => $nip]);
            return response()->json(['error' => 'Dosen tidak ditemukan'], 404);
        }
    
        // Mengambil sisa kuota
        $kuota = RefKuota::where('nip', $nip)->value('sisa_kuota');
        if ($kuota <= 0) {
            Log::warning('Kuota penuh', ['nip' => $nip, 'sisa_kuota' => $kuota]);
            return response()->json(['error' => 'Kuota dosen sudah penuh'], 400);
        }
    
        // Cek apakah mahasiswa sudah mengajukan bimbingan dengan dosen tersebut
        $cekData = Bimbingan::where('nip', $nip)
            ->where('nim', $nim)
            ->exists();
        if ($cekData) {
            Log::warning('Pengajuan sudah ada', ['nim' => $nim, 'nip' => $nip]);
            return response()->json(['error' => 'Anda sudah mengajukan bimbingan dengan dosen ini'], 400);
        }
    
        // Data pengajuan
        $data = [
            'nama' => $mahasiswa->nama,
            'nim' => $mahasiswa->nim,
            'status' => '0',
            'ta_1' => '0',
            'ta_2' => '0',
            'email' => $mahasiswa->email,
            'no_hp' => $mahasiswa->no_hp,
            'nip' => $dosen->nip,
            'nama_pembimbing' => $dosen->nama,
        ];
    
        // Simpan data pengajuan
        Bimbingan::create($data);
    
        // Kurangi kuota dosen
        RefKuota::where('nip', $nip)->decrement('sisa_kuota');
    
        Log::info('Pengajuan bimbingan berhasil', ['nim' => $nim, 'nip' => $nip]);
        return response()->json(['success' => 'Pengajuan bimbingan berhasil'], 200);
    }

    public function cekPengajuan(){
        $nim = Auth::user()->username;
        $data = Bimbingan::where('nim', $nim)->count();
        return response()->json($data);
    }
}
