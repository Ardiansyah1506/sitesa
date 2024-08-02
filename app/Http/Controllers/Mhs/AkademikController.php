<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Dosen;
use App\Models\Tesis;
use App\Models\SidangTa;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AkademikController extends Controller
{
    private $title = 'Dokumen';
    private $active = 'Dokumen';
    public function index(){
        $data = [
            'title' => $this->title,
            'active' => $this->active
        ];
        return view('mhs.akademik.index', $data);
    }   public function ujianProposal()
    {
        $nim = Auth::user()->username;
        // Mengambil data mahasiswa, sidang, tesis, dan bimbingan
        $mhs = Mahasiswa::where('nim', $nim)->first();
        $sidang = SidangTa::where('nim', $nim)->first();
        $tesis = Tesis::where('nim', $nim)->first();
        $bimbingan = Bimbingan::where('nim', $nim)->get();
    
        // Validasi apakah data ditemukan
        if (!$mhs || !$sidang || !$tesis) {
            return view('admin.akademik.kosong');
        }
    
        // Mengambil data dosen penguji
        $penguji1 = Dosen::where('nip', $sidang->nip_penguji_1)->first();
        $penguji2 = Dosen::where('nip', $sidang->nip_penguji_2)->first();
    
        // Validasi apakah data dosen penguji ditemukan
        if (!$penguji1 || !$penguji2) {
            return view('admin.akademik.kosong');
        }
    
        // Mengambil data pembimbing
        $pembimbing = [];
        if ($bimbingan->isNotEmpty()) {
            foreach ($bimbingan as $index => $item) {
                $pembimbing["pembimbing" . ($index + 1)] = $item->nama_pembimbing;
            }
        }
    
        // Set default pembimbing jika tidak ditemukan
        $pemb1 = $pembimbing['pembimbing1'] ?? '';
        $pemb2 = $pembimbing['pembimbing2'] ?? '';
    
        // Data untuk dikirim ke view
        $data = [
            'nim' => $nim,
            'nama' => $mhs->nama,
            'tanggal' => $sidang->tanggal_sidang,
            'judul' => $tesis->judul,
            'penguji1' => $penguji1->nama,
            'penguji2' => $penguji2->nama,
            'pembimbing1' => $pemb1,
            'pembimbing2' => $pemb2,
            'prodi' => '',
        ];
    
    
        // Menggenerate PDF menggunakan view 'dokumen.lembarproposal.index'
     $pdf = PDF::loadView('admin.akademik.ujian-proposal-tesis', $data);
        
     // Mengunduh PDF dengan nama file 'proposal_tesis.pdf'
     return $pdf->download('ujian-proposal-tesis.pdf');
    }
    
    
    public function notaPembimbing()
    {
        $nim = Auth::user()->username;
        // Mengambil data mahasiswa, sidang, tesis, dan bimbingan
        $mhs = Mahasiswa::where('nim', $nim)->first();
        $sidang = SidangTa::where('nim', $nim)->first();
        $tesis = Tesis::where('nim', $nim)->first();
        $bimbingan = Bimbingan::where('nim', $nim)->get();
    
        // Validasi apakah data ditemukan
        if (!$mhs || !$sidang || !$tesis) {
            return view('admin.akademik.kosong');
        }
    
        // Mengambil data dosen penguji
        $penguji1 = Dosen::where('nip', $sidang->nip_penguji_1)->first();
        $penguji2 = Dosen::where('nip', $sidang->nip_penguji_2)->first();
    
        // Validasi apakah data dosen penguji ditemukan
        if (!$penguji1 || !$penguji2) {
            return view('admin.akademik.kosong');
        }
    
        // Mengambil data pembimbing
        $pembimbing = [];
        $pembimbingNip = [];
    
        if ($bimbingan->isNotEmpty()) {
            foreach ($bimbingan as $index => $item) {
                $pembimbing["pembimbing" . ($index + 1)] = $item->nama_pembimbing;
                $pembimbingNip["pembimbingNip" . ($index + 1)] = $item->nip;
            }
        }
    
        // Set default pembimbing dan nip pembimbing jika tidak ditemukan
        $pemb1 = $pembimbing['pembimbing1'] ?? '';
        $pemb2 = $pembimbing['pembimbing2'] ?? '';
        $nipPembimbing1 = $pembimbingNip['pembimbingNip1'] ?? '';
        $nipPembimbing2 = $pembimbingNip['pembimbingNip2'] ?? '';
    
        // Data untuk dikirim ke view
        $data = [
            'nim' => $nim,
            'nama' => $mhs->nama,
            'tanggal' => $sidang->tanggal_sidang,
            'judul' => $tesis->judul,
            'penguji1' => $penguji1->nama,
            'penguji2' => $penguji2->nama,
            'pembimbing1' => $pemb1,
            'pembimbing2' => $pemb2,
            'prodi' => '',
            'program' => '',
            'nipPembimbing1' => $nipPembimbing1,
            'nipPembimbing2' => $nipPembimbing2,
        ];
    
        // Menggenerate PDF menggunakan view 'dokumen.lembarproposal.index'
     $pdf = PDF::loadView('admin.akademik.nota-pembimbing', $data);
        
     // Mengunduh PDF dengan nama file 'proposal_tesis.pdf'
     return $pdf->download('nota-pembimbing.pdf');
    }
    
    public function lembarPengesahan()
    {
        $nim = Auth::user()->username;
        // Mengambil data mahasiswa, sidang, tesis, dan bimbingan
        $mhs = Mahasiswa::where('nim', $nim)->first();
        $sidang = SidangTa::where('nim', $nim)->first();
        $tesis = Tesis::where('nim', $nim)->first();
        $bimbingan = Bimbingan::where('nim', $nim)->get();
    
        // Validasi apakah data ditemukan
        if (!$mhs || !$sidang || !$tesis) {
            return view('admin.akademik.kosong');
        }
    
        // Mengambil data dosen penguji
        $penguji1 = Dosen::where('nip', $sidang->nip_penguji_1)->first();
        $penguji2 = Dosen::where('nip', $sidang->nip_penguji_2)->first();
    
        // Validasi apakah data dosen penguji ditemukan
        if (!$penguji1 || !$penguji2) {
            return view('admin.akademik.kosong');
        }
    
        // Mengambil data pembimbing
        $pembimbing = [];
        $pembimbingNip = [];
    
        if ($bimbingan->isNotEmpty()) {
            foreach ($bimbingan as $index => $item) {
                $pembimbing["pembimbing" . ($index + 1)] = $item->nama_pembimbing;
                $pembimbingNip["pembimbingNip" . ($index + 1)] = $item->nip;
            }
        }
    
        // Set default pembimbing jika tidak ditemukan
        $pemb1 = $pembimbing['pembimbing1'] ?? '';
        $pemb2 = $pembimbing['pembimbing2'] ?? '';
    
        // Data untuk dikirim ke view
        $data = [
            'nim' => $nim,
            'nama' => $mhs->nama,
            'tanggal' => $sidang->tanggal_sidang,
            'judul' => $tesis->judul,
            'penguji1' => $penguji1->nama,
            'penguji2' => $penguji2->nama,
            'pembimbing1' => $pemb1,
            'pembimbing2' => $pemb2,
            'prodi' => null,
            'program' => null,
            'direkturPascaSarjana' => 'Prof. Dr. H. Mahmutarom HR, S.H., M.H.',
            'nipDirekturPascaSarjana' => '01.99.0.0005',
        ];
     // Menggenerate PDF menggunakan view 'dokumen.lembarproposal.index'
 $pdf = PDF::loadView('dokumen.lembarproposal.index', $data);
        
     // Mengunduh PDF dengan nama file 'proposal_tesis.pdf'
     return $pdf->download('lembar-pengesahan-proposal.pdf');
    }
    
}
