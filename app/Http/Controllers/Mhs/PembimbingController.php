<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Dosen;
use App\Models\RefKuota;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

class PembimbingController extends Controller
{
    public function index(){
        return view('mhs.pembimbing.index');
    }

    public function getDataPembimbing() {
        // Mengambil data pembimbing dengan join
        $data = Dosen::join('ref_kuota', 'dosen.nip', '=', 'ref_kuota.nip')
                     ->select('dosen.nama', 'dosen.nip', 'ref_kuota.sisa_kuota', 'dosen.id')
                     ->get();
    
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                // Cek apakah mahasiswa sudah mengajukan bimbingan dengan dosen tersebut
                $cekData = Bimbingan::where('nip', $row->nip)
                                             ->where('nim', Auth::user()->username)
                                             ->exists();
                if ($cekData) {
                    return '<span>Dalam Pengajuan</span>';
                } else if ($row->sisa_kuota > 0) {
                    return '<button class="btn btn-primary acc-button" data-id="' . $row->id . '">Ajukan</button>';
                } else {
                    return '<span>Kuota Sudah Penuh</span>';
                }
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function PengajuanBimbingan(Request $request){
        $nip = $request->nip;
        $nim = Auth::user()->username;
    
        // Mengambil data mahasiswa
        $mahasiswa = Mahasiswa::where('nim', $nim)->select('nama', 'nim', 'email', 'no_hp')->first();
        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }
    
        // Mengambil data dosen
        $dosen = Dosen::where('nip', $nip)->select('nama', 'nip')->first();
        if (!$dosen) {
            return response()->json(['error' => 'Dosen tidak ditemukan'], 404);
        }
    
      
    
        // Mengambil sisa kuota
        $kuota = RefKuota::where('nip', $nip)->value('sisa_kuota');
        if ($kuota <= 0) {
            return response()->json(['error' => 'Kuota dosen sudah penuh'], 400);
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
    
        return response()->json(['success' => 'Pengajuan bimbingan berhasil'], 200);
    }
    

}
