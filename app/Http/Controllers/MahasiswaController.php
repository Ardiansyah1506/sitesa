<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\RefSks;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\RefPembayaran;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function showImportForm()
    {
        return view('import');
    }
    public function import(Request $request)
    {
        ini_set('memory_limit', '512M'); // Tambahkan ini untuk meningkatkan batas memori
        set_time_limit(800);

        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');

        try {
            // Load file Excel
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $errors = [];
            foreach ($rows as $key => $row) {
                // Pastikan data diabaikan jika header
                if ($key == 0) {
                    continue;
                }

                // Ambil 3 digit pertama dari NIM untuk kode prodi
                $kode_prodi = substr($row[1], 0, 3);
                Log::info("Kode prodi: $kode_prodi");

                // Cari nama prodi berdasarkan kode prodi
                $prodi = Prodi::where('kode_prodi', $kode_prodi)->first();
              

                // Buat email dummy
                $email_dummy = strtolower(str_replace(' ', '', $row[2])) . '@example.com';

                // Buat alamat dummy
                $alamat_dummy = 'Jalan Contoh No. ' . ($key + 1);

                // Buat nomor HP dummy
                $no_hp_dummy = '081234567' . str_pad($key, 3, '0', STR_PAD_LEFT);

                // Buat array data untuk validasi dan pengisian otomatis
                $data = [
                    'nim' => $row[1],
                    'jumlah' => '144', // Mengisi status dengan nilai default 0
                ];

                // Buat validator untuk data
                $validator = Validator::make($data, [
                    'nim' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    // Jika validasi gagal, tambahkan pesan kesalahan
                    $errors[] = $validator->errors()->all();
                    Log::warning("Validasi gagal untuk NIM {$row[1]}", $validator->errors()->all());
                    continue;
                }

                // Buat data mahasiswa baru jika validasi berhasil
                RefSks::create($data);

                // Buat entri baru di tabel ref_sks
                // RefSks::create([
                //     'nim' => $data['nim'],
                //     'jumlah' => 144 // Misalkan jumlah SKS default adalah 144
                // ]);

                // // Buat entri baru di tabel ref_pembayaran
                // RefPembayaran::create([
                //     'nim' => $data['nim'],
                //     'status' => 1 // Misalkan status pembayaran default adalah 1 (terpenuhi)
                // ]);
            }

            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors);
            }

            return redirect()->back()->with('success', 'Data mahasiswa berhasil diimpor');
        } catch (\Exception $e) {
            Log::error('Error during import', ['exception' => $e]);
            return redirect()->back()->with('error', 'Terjadi kesalahan selama proses impor');
        }
    }
}
