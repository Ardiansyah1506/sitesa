<?php

namespace App\Http\Controllers\Admin;

use App\Models\TA;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Tesis;
use App\Models\TanggalTA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\SidangTa;

Carbon::setLocale('id');


class TaController extends Controller
{
    protected $title = 'Tugas Akhir';
    protected $active = 'admin-ta';
    public function index(){
        $dosen = Dosen::all();
        $data = [
            'title' => $this->title,
            'active' => $this->active,
            'dosens' => $dosen,
        ];
        return view('admin.ta.index', $data);
    }
    public function getData()
    {
        // Mengambil data TA dengan status selain '1'
        $taData = SidangTa::whereIn('status', [0, 2])->get();

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
                'nama_file' => $ta->nama_file, 
                'kode_ta' => $ta->kategori_ta, 
                'tanggal_daftar' => $ta->tanggal_daftar,
                'tanggal_sidang' => $ta->tanggal_sidang,
                'nip_penguji_1' => $ta->nip_penguji_1,
                'nip_penguji_2' => $ta->nip_penguji_2,
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
            ->editColumn('kode_ta', function ($row) {
                switch ($row['kode_ta']) {
                    case 1:
                        return '<span class="badge rounded-pill bg-info">Sidang Proposal</span>';
                    case 2:
                        return '<span class="badge rounded-pill bg-primary">Sidang Tesis</span>';
                    default:
                        return '';
                }
            })
            ->editColumn('tanggal_daftar', function ($row) {
                if (empty($row['tanggal_daftar'])) {
                    return '<span class="badge rounded-pill bg-warning">belum di set</span>';
                } else {
                    return '<span class="badge rounded-pill bg-primary">' . Carbon::parse($row['tanggal_daftar'])->translatedFormat('d F Y') . '</span>';
                }
            })
            ->editColumn('tanggal_sidang', function ($row) {
                if (empty($row['tanggal_sidang'])) {
                    return '<span class="badge rounded-pill bg-warning">belum di set</span>';
                } else {
                    return '<span class="badge rounded-pill bg-primary">' . Carbon::parse($row['tanggal_sidang'])->translatedFormat('d F Y') . '</span>';
                }
            })
            ->editColumn('nama_file', function ($row) {
                    $url = url('') . '/ta/' . $row['nama_file'];
                    return '<a href="' . $url . '" class="btn btn-sm border shadow-sm">Lihat</a>';
            })
            ->addColumn('aksi', function ($row) {
                if ($row['status'] == 0) {
                    return '<button class="btn btn-success acc-button" data-id="' . $row['tesis_id'] . '" data-another-id="' . $row['nim'] . '" data-third-id="'.$row['tanggal_daftar'].'">Acc</button>';
                } else if ($row['status'] == 2) {
                    return '<button class="btn btn-info selesai-button" data-id="' . $row['tesis_id'] . '" data-another-id="' . $row['nim'] . '">Selesai</button>';
                }
                return '';
            })
            ->rawColumns(['status', 'aksi', 'tanggal_sidang', 'tanggal_daftar', 'nama_file', 'kode_ta'])
            ->make(true);

    }

    public function updateStatus(Request $request)
    {
        // Log the request data to see the id and tanggal_sidang
        Log::info('Request data:', $request->all());

        try {
            // Find the TA by ID
            $sidang = SidangTa::where('nim', $request->mhsNim)
                ->first();
                
            if ($sidang) {
                $dataPenguji = [
                    'tanggal_sidang' => $request->tanggal_sidang,
                    'nip_penguji_1' => $request->penguji1,
                    'nip_penguji_2' => $request->penguji2,
                    // 'nip_penguji_3' => $request->penguji3,
                    // 'nip_penguji_4' => $request->penguji4,
                    'status' => 2
                ];

                $sidang->update($dataPenguji);

                return response()->json(['status' => 'success', 'message' => 'Status TA berhasil diperbarui dan tanggal sidang ditambahkan', 'data' => $sidang]);
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

    public function updateSelesaiTA(Request $request)
    {
        Log::info('Request data:', $request->all());

        try {
            // Find the TA by ID
            $ta = SidangTa::where('nim',$request->nim)
            ->first();
            
            if ($ta) {
                $ta->status = 1;
                $ta->save(); // Gunakan save() untuk menyimpan perubahan pada model

                return response()->json(['status' => 'success', 'message' => 'Berhasil melakukan penyelesaian TA', 'data' => $ta]);
            }
            return response()->json(['status' => 'error', 'message' => 'Data TA Tidak Ditemukan'], 404);
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

    public function getTanggalTa($tanggalDaftar = NULL)
    {

        $tanggalTA = TanggalTA::whereDate('tanggal_awal', '>=', $tanggalDaftar)
                          ->first();

        $tanggalAwal = $tanggalTA->tanggal_awal;
        $tanggalAkhir = $tanggalTA->tanggal_akhir;
        $dates = [];

        $currentDate = $tanggalAwal;
        while (strtotime($currentDate) <= strtotime($tanggalAkhir)) {
            $dates[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        return response()->json($dates);
    }
    
    
}