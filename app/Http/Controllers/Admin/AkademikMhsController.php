<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tesis;
use App\Models\SidangTa;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AkademikMhsController extends Controller
{
    private $title = 'Akademik Mahasiswa';
    private $url = 'admin/akademik-mhs/';
    private $active = 'admin-dokumen-mhs';
    public function index(){
        $data = [
            'title' => $this->title,
            'active' => $this->active,
            'url' => $this->url,
        ];

        return view('admin.akademik.index', $data);
    }
    public function getData(){
        $data = Mahasiswa::all();
    
        return \DataTables::of($data)
            ->addIndexColumn() // Menambahkan index kolom
            ->addColumn('actions', function ($data) {
                return '<div class="btn-group gap-1" merk="group">
                            <a class="btn btn-success btn-sm" href="akademik-mhs/detail/'.$data->nim.'">Detail</a>                     
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function detailAkademikMhs($nim = NULL){

        $mhs = Mahasiswa::where('nim', $nim)->first();
        $data = [
            'nim' => $nim,
            'title' => $this->title,
            'active' => $this->active,
            'nama' => $mhs->nama
        ];
        return view('admin.akademik.detail', $data);
    }
    
    public function ujianProposal($nim = NULL)
{
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

    return view('admin.akademik.ujian-proposal-tesis', $data);
}


public function notaPembimbing($nim = NULL)
{
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

    return view('admin.akademik.nota-pembimbing', $data);
}

public function lembarPengesahan($nim = NULL)
{
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
        'direkturPascaSarjana' => null,
        'nipDirekturPascaSarjana' => null,
    ];

    return view('admin.akademik.lembar-pengesahan-proposal', $data);
}


}
