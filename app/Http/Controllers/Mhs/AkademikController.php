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
    }
    public function ujianProposal($nim = NULL)
    {
        $mhs = Mahasiswa::where('nim', $nim)->first();
        $sidang = SidangTa::where('nim', $nim)->first();
        $tesis = Tesis::where('nim', $nim)->first();
        $bimbingan = Bimbingan::where('nim', $nim)->get();
        $penguji1 = Dosen::where('nip', $sidang->nip_penguji_1)->first();
        $penguji2 = Dosen::where('nip', $sidang->nip_penguji_2)->first();
    
        
        $pembimbing = [];
    
        if ($bimbingan->isNotEmpty()) {
            foreach ($bimbingan as $index => $item) {
                $pembimbing["pembimbing" . ($index + 1)] = $item->nama_pembimbing;
            }
        }
    
        $pemb1 = $pembimbing['pembimbing1'] ?? '';
        $pemb2 = $pembimbing['pembimbing2'] ?? '';
    
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
    
        public function notaPembimbing($nim = NULL)
    {
        $mhs = Mahasiswa::where('nim', $nim)->first();
        $sidang = SidangTa::where('nim', $nim)->first();
        $tesis = Tesis::where('nim', $nim)->first();
        $bimbingan = Bimbingan::where('nim', $nim)->get();
        $penguji1 = Dosen::where('nip', $sidang->nip_penguji_1)->first();
        $penguji2 = Dosen::where('nip', $sidang->nip_penguji_2)->first();
    
        
        $pembimbing = [];
        $pembimbingNip = [];
    
        if ($bimbingan->isNotEmpty()) {
            foreach ($bimbingan as $index => $item) {
                $pembimbing["pembimbing" . ($index + 1)] = $item->nama_pembimbing;
                $pembimbingNip["pembimbingNip" . ($index + 1)] = $item->nip;
            }
        }
    
        $pemb1 = $pembimbing['pembimbing1'] ?? '';
        $pemb2 = $pembimbing['pembimbing2'] ?? '';
        $nipPembimbing1 = $pembimbingNip['pembimbingNip1'] ?? '';
        $nipPembimbing2 = $pembimbingNip['pembimbingNip2'] ?? '';
    
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
        public function lembarPengesahan($nim = NULL)
    {
        $mhs = Mahasiswa::where('nim', $nim)->first();
        $sidang = SidangTa::where('nim', $nim)->first();
        $tesis = Tesis::where('nim', $nim)->first();
        $bimbingan = Bimbingan::where('nim', $nim)->get();
        $penguji1 = Dosen::where('nip', $sidang->nip_penguji_1)->first();
        $penguji2 = Dosen::where('nip', $sidang->nip_penguji_2)->first();
    
        
        $pembimbing = [];
        $pembimbingNip = [];
    
        if ($bimbingan->isNotEmpty()) {
            foreach ($bimbingan as $index => $item) {
                $pembimbing["pembimbing" . ($index + 1)] = $item->nama_pembimbing;
                $pembimbingNip["pembimbingNip" . ($index + 1)] = $item->nip;
            }
        }
    
        $pemb1 = $pembimbing['pembimbing1'] ?? '';
        $pemb2 = $pembimbing['pembimbing2'] ?? '';
    
    
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
            'judul' => $tesis->judul,
            'direkturPascaSarjana' => null,
            'nipDirekturPascaSarjana' => null,
        ];
     // Menggenerate PDF menggunakan view 'dokumen.lembarproposal.index'
     $pdf = PDF::loadView('admin.akademik.lembar-pengesahan-proposal', $data);
        
     // Mengunduh PDF dengan nama file 'proposal_tesis.pdf'
     return $pdf->download('lembar-pengesahan-proposal.pdf');
    }
    
}
