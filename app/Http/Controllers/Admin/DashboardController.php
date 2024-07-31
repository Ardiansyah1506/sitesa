<?php

namespace App\Http\Controllers\Admin;

use App\Models\TA;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Tesis;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SidangTa;

class DashboardController extends Controller
{
    protected $title = 'Dashboard Admin';
    protected $active = 'admin-dashboard';

    public function index() {
        $title = $this->title;
        $active = $this->active;
        $mhs = Mahasiswa::count();
        $dosen = Dosen::count();
        $dosbim = Dosen::where('status', '1')->count();
        $progdi = User::where('role', '2')->count();
        $ta = SidangTa::count();
        $judul = Tesis::count();
        return view('admin.index', compact('mhs', 'dosen', 'dosbim', 'ta', 'judul','progdi', 'active', 'title'));
    }
}
