<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kaprog;
use App\Models\User;
use App\Models\Kompetensi_keahlian;
use Illuminate\Support\Facades\Hash;

class KaprogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kompetensi_keahlian = Kompetensi_keahlian::all();
        $kaprog = Kaprog::leftjoin('kompetensi_keahlian', 'kompetensi_keahlian.kode_keahlian', 'kaprog.kode_keahlian')
                        ->select('kaprog.*','kompetensi_keahlian.nama_keahlian')
                        ->get();
        return view('kaprog.index', compact('kaprog', 'kompetensi_keahlian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kompetensi_keahlian = Kompetensi_keahlian::all();
        return view('kaprog.tambah', compact('kompetensi_keahlian'));
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
            'nip' => 'required|numeric|unique:kaprog,nip',
            'name' => 'required',
            'kode_keahlian' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ]);
        
        $user = User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password' => Hash::make($request->password),
            'remember_token' => \Str::random(50),
            'role_id'=>'3'
        ]);

        $datakaprog = Kaprog::create([
            'nip'=>$request->nip,
            'nama_kaprog'=>$request->name,
            'users_id'=>$user->id,
            'kode_keahlian'=>$request->kode_keahlian
        ]);

        return redirect()->route('kaprog.index')->with('success','Data ketua program keahlian berhasil disimpan');
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
        $kaprog=Kaprog::where('id', $id)->first();
        $user = User::where('id', $kaprog->users_id)->first();
        $kompetensi_keahlian = Kompetensi_keahlian::all();
        return view('kaprog.ubah', compact('user','kaprog', 'kompetensi_keahlian'));
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
        $kaprog = Kaprog::where('id',$id)->first();
        $user = User::where('id', $kaprog->users_id)->first();

        $request->validate([
            'nip' => 'required|numeric|unique:kaprog,nip,'. $id,
            'email' => 'required|unique:users,email,'.$kaprog->users_id,
            'username' => 'required|unique:users,username,'.$kaprog->users_id,
        ]);

        if ($request->password == NULL) {
            $userupdate = User::where('id', $kaprog->users_id)->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'remember_token' => \Str::random(50),
                'role_id'=>'3'
            ]);
        }

        else {
            $userupdate = User::where('id', $kaprog->users_id)->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'remember_token' => \Str::random(50),
                'role_id'=>'3'
            ]);
        }

        $kaprogupdate = Kaprog::where('id',$id)->update([
            'nip'=>$request->nip,
            'nama_kaprog'=>$request->name,
            'users_id'=>$user->id,
            'kode_keahlian'=>$request->kode_keahlian
        ]);

        return redirect()->route('kaprog.index')->with('success','Data ketua program keahlian berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kaprog=Kaprog::where('id', $id)->first();
        $user = User::where('id', $kaprog->users_id)->first();
        $kaprog->delete();
        $user->delete();

        return redirect()->route('kaprog.index')->with('success','Data ketua program keahlian berhasil dihapus');
    }
}
