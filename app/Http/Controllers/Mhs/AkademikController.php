<?php

namespace App\Http\Controllers\Mhs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkademikController extends Controller
{
    private $title = 'Dokumen';
    private $active = 'Dokumen';
    public function index(){
        $data = [
            'title' => $this->title,
            'active' => $this->active
        ];
        return view('mhs.akademik.index', $data);
    }
}
