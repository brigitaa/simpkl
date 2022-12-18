<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kaprog;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        $user = User::leftjoin('role', 'role.id', 'users.role_id')
                        ->select('users.*','role.nama_role')
                        ->orderBy('role.id')
                        ->get();
        return view('manajemenuser.index', compact('user', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('manajemenuser.tambah', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|unique:users,password',
        ]);

        $role = Role::where('id', $request->role_id)->first();

        $user = User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password' => Hash::make($request->password),
            'remember_token' => \Str::random(50),
            'role_id'=>$role->id,
        ]);

        return redirect()->route('manajemenuser.index')->with('success','Data user berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        // $role = Role::where('id', $user->role_id)->first();
        $role = Role::all();
        return view('manajemenuser.ubah', compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $role = Role::where('id', $user->role_id)->first();

        $request->validate([
            'email' => 'unique:users,email,'. $id,
            'username' => 'unique:users,username,'. $id,
        ]);

        if ($request->password == NULL) {
            $userupdate = User::where('id',$id)->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'remember_token' => \Str::random(50),
                'role_id'=>$request->role_id,
            ]);
        }

        else {
            $userupdate = User::where('id',$id)->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'remember_token' => \Str::random(50),
                'role_id'=>$request->role_id,
            ]);
        }
        
        return redirect()->route('manajemenuser.index')->with('success','Data user berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        $cekdatasiswa = Siswa::where('users_id',$id)->first();
        $cekdatakaprog = Kaprog::where('users_id',$id)->first();

        if ($cekdatasiswa != null) {
            return redirect()->route('manajemenuser.index')->with('error','Data user sedang digunakan');
        }
        elseif ($cekdatakaprog != null) {
            return redirect()->route('manajemenuser.index')->with('error','Data user sedang digunakan');
        }
        else {
            $user->delete();
            return redirect()->route('manajemenuser.index')->with('success','Data user berhasil dihapus');
        }   
    }
}

