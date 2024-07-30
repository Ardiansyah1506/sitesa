<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Tesis;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\MahasiswaBimbingan;
use App\Http\Controllers\Controller;

class DokumenController extends Controller
{
    private $title = 'Nota Pembimbing';
    private $active = 'pengajuan-prodi';

    public function index(){
        // Mengambil data dari database
        $tesis = Tesis::where('nim', auth()->user()->username)->first(['judul']);
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->username)->first(['nim', 'nama', 'prodi']);
        $dosenPembimbing = MahasiswaBimbingan::where('nim', auth()->user()->username)->first(['nama_pembimbing', 'nip']);

        // Menyiapkan data untuk view
        $data = [
            'title' => $this->title,
            'active' => $this->active,
            'tesis' => $tesis,
            'mahasiswa' => $mahasiswa,
            'dosenPembimbing' => $dosenPembimbing
        ];

        return view('dokumen.nota_pembimbing.index', $data);
    }
    public function proposal(){
        $data = [
            'title' => $this->title,
            'active' => $this->active,
        ];

        return view('dokumen.formproposal.index', $data);
    }
}
