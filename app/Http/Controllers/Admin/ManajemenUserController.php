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
    public function index(){
        return view('admin.user.index');
        
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
            ->rawColumns(['button'])
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
        $mahasiswas = Mahasiswa::select('id', 'nama', 'nim')->get();
        return response()->json($mahasiswas);
    }

    public function getNip(){
        $dosens = Dosen::select('id', 'nama', 'nip')->get();
        return response()->json($dosens);
    }
}