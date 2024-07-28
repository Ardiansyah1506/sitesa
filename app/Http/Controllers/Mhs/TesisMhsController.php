<?php

namespace App\Http\Controllers\Mhs;

use App\Models\Tesis;
use App\Models\RefSks;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\RefPembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TesisMhsController extends Controller
{
    public function index(){
        return view('mhs.index');
    }

    public function getData(){
        // Mengambil data tesis dengan status '1'
        $data = Tesis::where('status', '1')->get();
    
        // Mengelola data dengan DataTables
        return \DataTables::of($data)
            ->addIndexColumn() // Menambahkan index kolom
            ->make(true);
    }


    public function CekPlagiasi(Request $request){
        $judul = $request->judul;
        $abstrak = $request->abstrak;
    
        $tesis = Tesis::all();
        $max_similarity = 0;
    
        foreach ($tesis as $item) {
            $similarity_judul = 0;
            $similarity_translate = 0;
            $similarity_abstrak = 0;
    
            if (!empty($judul)) {
                $similarity_judul = $this->calculateSimilarity($judul, $item->judul);
                $similarity_translate = $this->calculateSimilarity($judul, $item->translate);
            }
            if (!empty($abstrak)) {
                $similarity_abstrak = $this->calculateSimilarity($abstrak, $item->abstrak);
            }
    
            $max_similarity = max($max_similarity, $similarity_judul, $similarity_translate, $similarity_abstrak);
        }
    
        return response()->json(['similarity' => $max_similarity]);
    }
    

    private function calculateSimilarity($text1, $text2){
        $words1 = explode(' ', $text1);
        $words2 = explode(' ', $text2);

        $intersection = array_intersect($words1, $words2);
        $union = array_unique(array_merge($words1, $words2));

        if(count($union) == 0) return 0;

        $similarity = (count($intersection) / count($union)) * 100;
        return $similarity;
    }

    public function DaftarTesis(Request $request){
        $request->validate([
            'judul' => 'required|string|max:255',
            'abstrak' => 'required|string',
        ]);
    
        $nim = Auth::user()->username;
        $judul = $request->judul;
        $abstrak = $request->abstrak;
        $nama = Mahasiswa::where('nim', $nim)->first();
        $statusPembayaran = RefPembayaran::where('nim', $nim)->value('status');
    
        // Simpan data tesis
        $tesis = new Tesis();
        $tesis->nama = $nama->nama;
        $tesis->nim = $nim;
        $tesis->judul = $judul;
        $tesis->translate = $judul;
        $tesis->abstrak = $abstrak;
        $tesis->status = 0;
        $tesis->save();
    
        return response()->json(['status' => 'success', 'message' => 'Tesis berhasil didaftarkan.']);
    }
    

    public function checkPaymentStatus() {
        $nim = Auth::user()->username;
    
        // Mengambil status pembayaran
        $statusPembayaran = RefPembayaran::where('nim', $nim)->value('status');
    
        // Mengambil jumlah SKS
        $jumlahSks = RefSks::where('nim', $nim)->value('jumlah');
    
        // Menentukan apakah kedua syarat terpenuhi
        $isEligible = $statusPembayaran == 1 && $jumlahSks >= 144;
    
        return response()->json(['status' => $isEligible]);
    }

    public function checkTesis(){
        $nim = Auth::user()->username;
        $tesisExists = Tesis::where('nim', $nim)->exists(); // Periksa tabel tesis
        return response()->json(['status' => $tesisExists]);
    }
    

  

}