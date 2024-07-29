<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tesis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TesisController extends Controller
{
    protected $title = 'Tesis';
    protected $active = 'admin-tesis';
    public function index(){
        $data = [
            'title' => $this->title,
            'active' => $this->active,
        ];
        return view('admin.tesis.index', $data);
    }
    public function getData(){
        // Mengambil data tesis dengan status '1'
        $data = Tesis::where('status', '1')->get();
    
        // Mengelola data dengan DataTables
        return \DataTables::of($data)
            ->addIndexColumn() // Menambahkan index kolom
            ->make(true);
    }
    
}
