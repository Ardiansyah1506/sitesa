<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Tesis;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\MahasiswaBimbingan;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\SidangTa;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller
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
    public function proposal(){
        $data = [
            'title' => $this->title,
            'active' => $this->active,
        ];

        return view('dokumen.formproposal.index', $data);
    }
    public function lembarproposal(){
        $data = [
            'title' => $this->title,
            'active' => $this->active,
        ];

        return view('dokumen.lembarproposal.index', $data);
    }

    public function lembarProposalPdf()
    {
        $nim = Auth::user()->username;
        // Mengambil data tesis berdasarkan NIM
        $tesis = Tesis::where('nim', $nim)->select('nim', 'nama', 'judul')->first();
    
        // Mengambil data pembimbing
       if($tesis){
        $pembimbing1 = MahasiswaBimbingan::where('nim', $tesis->nim)->select('nip')->first();
        $pembimbing2 = MahasiswaBimbingan::where('nim', $tesis->nim)->select('nip')->orderBy('created_at', 'desc')->first();
     // Mengambil nama dosen pembimbing berdasarkan NIP
     $pembimbing1Name = Dosen::where('nip', $pembimbing1->nip)->select('nama')->first();
     $pembimbing2Name = Dosen::where('nip', $pembimbing2->nip)->select('nama')->first();
 
    }else{
        $pembimbing1Name = null;
        $pembimbing2Name = null;
    }
        // Mengambil data penguji
        $sidangTa = SidangTa::where('nim', 'A11.2022.14711')->select('nip_penguji_1', 'nip_penguji_2')->first();
        if ($sidangTa) {
            $penguji1 = Dosen::where('nip', $sidangTa->nip_penguji_1)->select('nama')->first();
            $penguji2 = Dosen::where('nip', $sidangTa->nip_penguji_2)->select('nama')->first();
        } else {
            $penguji1 = null;
            $penguji2 = null;
        }
    
       
        // Data yang akan dikirim ke view
        $data = [
            'judul' => $tesis->judul??'-',
            'author' => $tesis->nama??'-',
            'nim' => $tesis->nim??'-',
            'date' => 'Selasa, 18 Juni 2024', // Anda dapat mengganti ini dengan tanggal dinamis jika diperlukan
            'supervisors' => [
                $pembimbing1Name ? $pembimbing1Name->nama : 'N/A',
                $pembimbing2Name ? $pembimbing2Name->nama : 'N/A'
            ],
            'examiners' => [
                $penguji1 ? $penguji1->nama : 'N/A',
                $penguji2 ? $penguji2->nama : 'N/A'
            ],
            'director' => 'Prof. Dr. H. Mahmutarom HR, S.H., M.H.'
        ];
    
        // Menggenerate PDF menggunakan view 'dokumen.lembarproposal.index'
        $pdf = PDF::loadView('dokumen.lembarproposal.index', $data);
    
        // Mengunduh PDF dengan nama file 'proposal_tesis.pdf'
        return $pdf->download('proposal_tesis.pdf');
    }
    
}
