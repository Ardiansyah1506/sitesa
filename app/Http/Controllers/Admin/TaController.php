<?php

namespace App\Http\Controllers\Admin;

use App\Models\TA;
use App\Models\Tesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TaController extends Controller
{
    public function index(){
        return view('admin.ta.index');
    }
    public function getData()
    {
        // Mengambil data TA dengan status selain '1'
        $taData = TA::where('status', '!=', '1')->get();

        // Menggabungkan data TA dan Tesis berdasarkan NIM
        $data = $taData->map(function ($ta) {
            $tesis = Tesis::where('nim', $ta->nim)->first();
            return [
                'nim' => $ta->nim,
                'nama' => $tesis ? $tesis->nama : null,
                'judul' => $tesis ? $tesis->judul : null,
                'translate' => $tesis ? $tesis->translate : null,
                'abstrak' => $tesis ? $tesis->abstrak : null,
                'status' => $ta->status,
                'ta_id' => $ta->id, // Menyimpan ID TA untuk keperluan aksi
                'tesis_id' => $tesis ? $tesis->id : null,
            ];
        });

        // Mengelola data dengan DataTables
        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                switch ($row['status']) {
                    case 0:
                        return '<span class="badge rounded-pill bg-danger">Pengajuan</span>';
                    case 2:
                        return '<span class="badge rounded-pill bg-success">Sidang</span>';
                    default:
                        return '';
                }
            })
            ->addColumn('aksi', function ($row) {
                if ($row['status'] == 0) {
                    return '<button class="btn btn-primary acc-button" data-id="' . $row['ta_id'] . '">Acc</button>';
                } else if ($row['status'] == 1) {
                    return '<button class="btn btn-primary selesai-button" data-id="' . $row['ta_id'] . '" data-tesis-id="' . $row['tesis_id'] . '">Selesai</button>';
                }
                return '';
            })
            ->rawColumns(['status', 'aksi'])
            ->make(true);

    }

    public function updateStatus(Request $request)
    {
        // Log the request data to see the id and tanggal_sidang
        Log::info('Request data:', $request->all());

        try {
            // Find the TA by ID
            $ta = TA::find($request->id);
            if ($ta) {
                $ta->status = 2;
                $ta->tanggal = $request->tanggal_sidang;
                $ta->save(); // Gunakan save() untuk menyimpan perubahan pada model

                return response()->json(['status' => 'success', 'message' => 'Status TA berhasil diperbarui dan tanggal sidang ditambahkan', 'data' => $ta]);
            }
            return response()->json(['status' => 'error', 'message' => 'Data Tesis Tidak Ditemukan'], 404);
        } catch (\Exception $e) {
            // Log the exception with more details
            Log::error('Error updating status: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan pada server'], 500);
        }
    }
    
    
}