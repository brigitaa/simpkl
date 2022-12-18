<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate(); //membuat sesi untuk akun yang login
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $role = Role::where('id',$user->role_id)->first();
            session(['role' => $role->nama_role]);
            // dd($role->nama_role);
            if ($role->nama_role == 'Kaprog') {
                return redirect(route('dashboard.kaprog')); 
            }
            elseif ($role->nama_role == 'Siswa') {
                return redirect(route('dashboard.siswa')); 
            }
            else {
                return redirect(route('dashboard.index')); 
            }
        }
        
        else {
            return redirect('/')->with('fail','Username atau password salah');
        }
    }

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|unique:users,email',
    //         'username' => 'required|unique:users,username',
    //         'password' => 'required|unique:users,password',
    //     ]);

    //     $user = User::create([
    //         'name'=>$request->name,
    //         'username'=>$request->username,
    //         'email'=>$request->email,
    //         'password' => Hash::make($request->password),
    //         'remember_token' => \Str::random(50),
    //         'role_id'=>'1'
    //     ]);

    //     return redirect('/register')->with('success','Akun berhasil dibuat');
    // }

    public function logout(Request $request)
    {
        $request->session()->flush(); //menghapus sesi
        Auth::logout();
        return redirect('/');
    }
}