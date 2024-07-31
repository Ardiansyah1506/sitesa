<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    private $url = 'admin/mahasiswa/';
    private $title = 'Daftar Mahasiswa';
    private $active = 'admin-mahasiswa';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active
        ];

        return view('admin.mahasiswa.index', $data);
    }

    public function getData()
    {
        $data = DB::table('mahasiswa as mhs')
        ->join('ref_sks as sks', 'sks.nim', '=', 'mhs.nim')
        ->join('ref_pembayaran as pembayaran', 'pembayaran.nim', '=', 'mhs.nim')
        ->select(['mhs.nim', 'mhs.nama', 'sks.jumlah', 'pembayaran.status'])
        ->get();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function($data){
                switch($data->status){
                    case 0:
                        return '<span class="badge badge-danger">Belum Lunas</span>';
                    case 1:
                        return '<span class="badge badge-success">Lunas</span>';
                    default:
                        return 'status tidak diketahui';
                }
            })
            ->addColumn('actions', function ($data) {
                return '<div class="btn-group gap-1" merk="group">
                            <button class="btn btn-success btn-sm edit-mhs" data-id="' . $data->nim . '">Ubah</button>                     
                        </div>';
            })
            ->rawColumns(['actions','status'])
            ->make(true);
            
    }

    public function edit($id = NULL){
        $data = DB::table('mahasiswa as mhs')
        ->join('ref_sks as sks', 'sks.nim', '=', 'mhs.nim')
        ->join('ref_pembayaran as pembayaran', 'pembayaran.nim', '=', 'mhs.nim')
        ->select(['mhs.nim', 'mhs.nama', 'sks.jumlah', 'pembayaran.status'])
        ->where('mhs.nim', $id)
        ->first();

        if ($data == null) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Data Not Found',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Data Found',
                'data' => $data
            ]);
        }
    }

    public function updateMhs(Request $request)
    {
        // Update ref_pembayaran table
        $savePembayaran = DB::table('ref_pembayaran')
            ->where('nim', $request->nim)
            ->update(['status' => $request->statusPembayaran]);

        // Update ref_sks table
        $saveSks = DB::table('ref_sks')
            ->where('nim', $request->nim)
            ->update(['jumlah' => $request->jumlahSks]);

        if ($savePembayaran || $saveSks) {
            return redirect($this->url)->with('success', 'Berhasil Merubah');
        } else {
            return redirect($this->url)->with('error', 'Gagal Merubah');
        }
    }

    public function tambahMhs(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nim' => 'required|unique:mahasiswa,nim|max:255',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string|max:255',
        ]);
    
        try {
            // Simpan data mahasiswa baru
            $mahasiswa = new Mahasiswa();
            $mahasiswa->nim = $validated['nim'];
            $mahasiswa->email = $validated['nim'].'@mhs.unwahas.id';
            $mahasiswa->nama = $validated['nama'];
            $mahasiswa->jk = $validated['jk'];
            // Masukkan nilai default atau dummy untuk field yang tidak disertakan dalam form
            $mahasiswa->no_hp = '0000000000'; // Nilai default atau dummy
            $mahasiswa->prodi = 'Tidak diketahui'; // Nilai default atau dummy
            $mahasiswa->tanggal_lahir = '2000-01-01'; // Nilai default atau dummy
            $mahasiswa->alamat = 'Semarang'; // Nilai default atau dummy
            $mahasiswa->tempat_lahir = 'Semarang'; // Nilai default atau dummy
            $mahasiswa->save();
    
            // Log untuk penyimpanan mahasiswa baru
            Log::info('Mahasiswa baru ditambahkan', [
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'jk' => $mahasiswa->jk
            ]);
    
            // Tambahkan entry default di ref_sks dan ref_pembayaran
            DB::table('ref_sks')->insert([
                'nim' => $mahasiswa->nim,
                'jumlah' => 0 // atau nilai default lainnya
            ]);
    
            DB::table('ref_pembayaran')->insert([
                'nim' => $mahasiswa->nim,
                'status' => 0 // atau nilai default lainnya
            ]);
    
            return response()->json(['success' => true, 'message' => 'Mahasiswa berhasil ditambahkan']);
        } catch (\Exception $e) {
            // Log kesalahan
            Log::error('Kesalahan saat menambah mahasiswa', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan, coba lagi nanti']);
        }
    }
}
