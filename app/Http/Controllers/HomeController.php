<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Ta;
use App\Models\Dosen;
use App\Models\TanggalTA;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal sidang
        $jadwalSidang = TanggalTA::all();

        // Hitung jumlah dosen dengan status 1
        $jumlahPembimbing = Dosen::where('status', 1)->count();

        // Hitung jumlah bimbingan berdasarkan nim
        $jumlahBimbingan = Bimbingan::count();

        // Data untuk dikirim ke view
        $data = [
            'title' => 'Home Page',
            'sidangs' => $jadwalSidang,
            'jumlahPembimbing' => $jumlahPembimbing,
            'jumlahBimbingan' => $jumlahBimbingan / 2
        ];

        return view('home', $data);
    }

}
