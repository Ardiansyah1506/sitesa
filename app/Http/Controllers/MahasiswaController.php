<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
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
        set_time_limit(800);
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');

        // Load file Excel
        // $spreadsheet = IOFactory::load($file->getRealPath());
        // $sheet = $spreadsheet->getActiveSheet();
        // $rows = $sheet->toArray();

        $errors = [];
        foreach ($rows as $key => $row) {
            // Pastikan data diabaikan jika header
            if ($key == 0) {
                continue;
            }

            // Ambil 3 digit pertama dari NIM untuk kode prodi
            $kode_prodi = substr($row[1], 0, 3);

            // Buat email dummy
            $email_dummy = strtolower(str_replace(' ', '', $row[3])) . '@example.com';

            // Buat alamat dummy
            $alamat_dummy = 'Jalan Contoh No. ' . ($key + 1);

            // Buat nomor HP dummy
            $no_hp_dummy = '081234567' . str_pad($key, 3, '0', STR_PAD_LEFT);

            // Buat array data untuk validasi dan pengisian otomatis
            $data = [
                'nim' => $row[1],
                'nama' => $row[2],
                'prodi' => $kode_prodi,
                'jk' => 'L', // Mengisi jenis kelamin dengan nilai default 'L'
                'alamat' => $alamat_dummy,
                'email' => $email_dummy,
                'no_hp' => $no_hp_dummy,
                'tanggal_lahir' => $row[7],
                'tempat_lahir' => 'Semarang', // Mengisi tempat lahir dengan 'Semarang'
                'status' => 0, // Mengisi status dengan nilai default 0
            ];

            // Buat validator untuk data
            $validator = Validator::make($data, [
                'nim' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'prodi' => 'required|string|max:255',
                'jk' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:Mahasiswa,email',
                'no_hp' => 'required|numeric',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|string|max:255',
                'status' => 'required|integer',
            ]);
            // Buat data mahasiswa baru jika validasi berhasil
            Mahasiswa::create($data);
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diimpor');
    }
}
