<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Kaprog;
use App\Models\Siswa;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        // return view('profil.index', compact('user'));
        // contoh1
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        $kaprog = Kaprog::where('users_id', $user_id)->first();
        $siswa = Siswa::where('users_id', $user_id)->first();
        // -------
        // $user = User::where('id', $kaprog->users_id)->first();
        
        // $user_id = Auth::user()->id;
        // $user = User::where('id', $user_id)->first();
        // $role = Role::where('id',$user->role_id)->first();
        // session(['role' => $role->nama_role]);

        // if ($role->nama_role == 'Admin' || $role->nama_role == 'Ketua Pokja PKL') {
        //     $user = Auth::user();
        // }
        // elseif ($role->nama_role == 'Kaprog') {
        //     $kaprog=Kaprog::where('id', $id)->first();
        //     $user = User::where('id', $kaprog->users_id)->first();
        // }
        
        return view('profil.index', compact('user', 'kaprog', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $user_id = Auth::user()->id;

        $user = User::findOrFail($user_id);

        $datauser = User::where('id', $user_id)->first();
        $role = Role::where('id',$datauser->role_id)->first();
        session(['role' => $role->nama_role]);

        if ($request->password == NULL) {
            $user->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'remember_token' => \Str::random(50)
            ]);
        }

        else {
            $request->validate([
                'password' => 'min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ]);
            
            $user->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'password' => Hash::make($request->password),
                'remember_token' => \Str::random(50)
            ]);
        }

        if ($role->nama_role == 'Kaprog') {
            $kaprog = Kaprog::where('users_id', $user_id)->first();
            $kaprog->update([
                'nip'=>$request->nip,
                'nama_kaprog'=>$request->name,
            ]);
        }

        if ($role->nama_role == 'Siswa') {
            $siswa = Siswa::where('users_id', $user_id)->first();
            $siswa->update([
                'nis'=>$request->nis,
                'nisn'=>$request->nisn,
                'nama_siswa'=>$request->name,
                'jeniskelamin'=>$request->jeniskelamin,
                'alamat'=>$request->alamat,
                'no_telp'=>$request->no_telp,
            ]);
        }
        
        return redirect()->route('profil.index')->with('success','Profil berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
