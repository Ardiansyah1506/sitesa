<?php

namespace App\Http\Controllers\Mhs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $title = 'Dashboard';
    public function index(){
        $data = [
            'title' => $this->title
        ];
        return view('mhs.index', $data);
    }
}
