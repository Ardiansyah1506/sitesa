<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
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
                    'kode_prodi' => '-',
                    'nidn' => $row[0]??'-',
                    'nip' =>  $row[1]??'-', // Ganti nilai prodi dengan nama prodi yang sesuai atau fallback ke nilai asli
                    'nama' =>  $row[2]??'-', // Mengisi jenis kelamin dengan nilai default 'L'
                    'jk' =>  $row[3]??'-',
                    'email' => $row[4]?? 'dummy@email.com',
                    'no_hp' =>  $row[5]??000,
                    'alamat' => $row[6]??'-',
                    'tempat_lahir' =>  $row[7]??'-', // Mengisi tempat lahir dengan 'Semarang'
                    'tanggal_lahir' => $row[8]??'1956-12-24',
                    'status' => 0, // Mengisi status dengan nilai default 0
                ];

              
                // Buat data mahasiswa baru jika validasi berhasil
                Dosen::create($data);

                // Buat entri baru di tabel ref_sks
               
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
