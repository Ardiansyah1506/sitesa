<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    private $title = 'Informasi Akademik';
    private $active = 'Akademik';
    public function index(){
        $data = [
            'title' => $this->title,
            'active' => $this->active,
        ];
        return view('akademik', $data);
    }
}
