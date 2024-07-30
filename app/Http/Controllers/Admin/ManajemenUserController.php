<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    protected $title = 'Manajemen User';
    protected $active = 'admin-user';
    public function index(){
        $data = [
            'title'=> $this->title,
            'active'=> $this->active,
        ];
        return view('admin.user.index', $data);
    }
    public function getData() {
        $data = User::all();
    
        foreach ($data as $user) {
            if (Mahasiswa::where('nim', $user->username)->exists()) {
                $user->nama = Mahasiswa::where('nim', $user->username)->value('nama');
            } else if (Dosen::where('nip', $user->username)->exists()) {
                $user->nama = Dosen::where('nip', $user->username)->value('nama');
            } else {
                $user->nama = 'Unknown';
            }
        }
    
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('button', function ($row) {
                return '<div><button class="btn btn-warning btn-sm edit-btn text-light" data-id="'.$row->id.'">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="'.$row->id.'">Hapus</button></div>';
            })
            ->editColumn('role', function ($row) {
                switch ($row->role) {
                    case 1:
                        return '<span class="badge rounded-pill bg-success">Admin</span>';
                    case 2:
                        return '<span class="badge rounded-pill bg-info">Porgram Studi</span>';
                    case 3:
                        return '<span class="badge rounded-pill bg-warning">Dosen Pembimbing</span>';
                    case 4:
                        return '<span class="badge rounded-pill bg-black">Mahasiswa</span>';
                    default:
                        return '';
                }
            })
            ->rawColumns(['button', 'role'])
            ->make(true);
    }
    

    public function create(Request $request){
        $username =$request->username;
        $password =$request->password;
        $role = $request->role;
        $hashpassword = Hash::make($password);

        $data = [
            'username' => $username,
            'password' => $hashpassword,
            'role' => $role,
        ];
    
        User::create($data);
    
        return response()->json(['success' => 'User berhasil ditambahkan']);
    

        }
        public function getDataEdit($id){
            $user = User::find($id);
            if (Mahasiswa::where('nim', $user->username)->exists()) {
                $user->nama = Mahasiswa::where('nim', $user->username)->value('nama');
            } else if (Dosen::where('nip', $user->username)->exists()) {
                $user->nama = Dosen::where('nip', $user->username)->value('nama');
            } else {
                $user->nama = 'Unknown';
            }
            return response()->json($user);
        }
        
        public function update(Request $request, $id) {
            $user = User::find($id);
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        
            return response()->json(['success' => 'User berhasil diperbarui']);
        }
        
        public function delete($id) {
            $user = User::find($id);
            $user->delete();
        
            return response()->json(['success' => 'User berhasil dihapus']);
        }
        

    public function getNim(){
        $mahasiswas = Mahasiswa::select('id', 'nama', 'nim')
        ->orderBy('nama', 'asc')
        ->get();
        return response()->json($mahasiswas);
    }

    public function getNip(){
        $dosens = Dosen::select('id', 'nama', 'nip')->get();
        return response()->json($dosens);
    }
}
