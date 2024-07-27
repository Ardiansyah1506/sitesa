<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\TanggalTA;
use Illuminate\Http\Request;
use Carbon\Carbon;

Carbon::setLocale('id');


class SetWaktuTAController extends Controller
{
    private $url = 'prodi/waktu-ta/';
    private $title = 'Waktu TA';
    private $active = 'waktu-ta';

    public function index(){
        $data = [
            'url' => $this->url,
            'title' => $this->title,
            'active' => $this->active,
        ];
        return view('prodi.waktu-ta.index', $data);
    }

    public function getData()
    {
        $data = TanggalTA::all();

        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tanggal_awal', function($data){
                return Carbon::parse($data->tanggal_awal)->translatedFormat('d F Y');
            })
            ->editColumn('tanggal_akhir', function($data){
                return Carbon::parse($data->tanggal_akhir)->translatedFormat('d F Y');
            })
            ->addColumn('status', function ($data){
                $currentDate = now();
                if ($data->tanggal_awal <= $currentDate && $data->tanggal_akhir >= $currentDate) {
                    return '<span class="badge badge-info">Sedang Berlangsung</span>';
                } elseif ($data->tanggal_awal > $currentDate) {
                    return '<span class="badge badge-danger">Belum Dimulai</span>';
                } elseif ($data->tanggal_akhir < $currentDate) {
                    return '<span class="badge badge-success">Selesai</span>';
                }
            })
            ->addColumn('actions', function ($data) {
                return '<div class="btn-group gap-1" merk="group">
                            <button type="button" class="btn btn-sm btn-primary rounded edit-ta" data-id="' . $data->id . '">Ubah</button>
                        </div>';
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }


    // public function store(Request $request){
    //     $data = [
    //         'nama' => $request->nama,
    //         'gelombang' => $request->gelombang,
    //         'tanggal_awal' => $request->tanggalMulai,
    //         'tanggal_akhir' => $request->tanggalAkhir,
    //     ];
    //     $save = TanggalTA::create($data);

    //     if($save){
    //         return redirect($this->url)->with('success', 'Berhasil Menambah Data');
    //     }else{
    //         return redirect($this->url)->with('error', 'Gagal Menambah Data');
    //     }
    // }

    public function edit($id = NULL){
        $data = TanggalTA::where('id', $id)->first(['id', 'tanggal_awal','tanggal_akhir']);
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

    public function update(Request $request){
        $data = TanggalTA::where('id', $request->id)->first();
        $updated = [
            'tanggal_awal'=> $request->tanggalMulai,
            'tanggal_akhir'=> $request->tanggalAkhir,
        ];
       $save = $data->update($updated);

       if($save){
            return redirect($this->url)->with('success', 'Berhasil Merubah');
       }else{
            return redirect($this->url)->with('error', 'Gagal Merubah');
       }
    }

    // public function delete($id = NULL){
    //     $waktu = TanggalTA::where('id', $id)->first();

    //     if($waktu->delete()){
    //         return redirect($this->url)->with('success', 'Berhasil Menghapus');
    //     }else{
    //         return redirect($this->url)->with('error', 'Gagal Menghapus');
    //     }
    // }
}
