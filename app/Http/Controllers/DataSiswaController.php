<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Role;
use App\Models\Kelas;
use App\Models\Thn_ajaran;
use Illuminate\Support\Facades\Hash;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use File;
use Response;
use Auth;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        $tahunajaran = Thn_ajaran::all();
        $siswa = Siswa::leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->select('siswa.*','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran')
                        ->get();

        return view('datasiswaPKL.index', compact('siswa', 'kelas', 'tahunajaran'));
    }

    public function lihat()
    {
        $kelas = Kelas::all();
        $tahunajaran = Thn_ajaran::all();
        $siswa = Siswa::leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->select('siswa.*','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran')
                        ->get();

        return view('datasiswaPKL.lihat', compact('siswa', 'kelas', 'tahunajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $tahunajaran = Thn_ajaran::all();
        return view('datasiswaPKL.tambah', compact('kelas', 'tahunajaran'));
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
            'nis' => 'required|numeric|unique:siswa,nis',
            'nisn' => 'required|numeric|unique:siswa,nisn',
            'name' => 'required',
            'jeniskelamin' => 'required',
            'no_telp' => 'required|numeric',
            'alamat' => 'required',
            'kode_kelas' => 'required',
            'kode_thn_ajaran' => 'required',
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
            'role_id'=>'5'
        ]);

        $datasiswa = Siswa::create([
            'nis'=>$request->nis,
            'nisn'=>$request->nisn,
            'nama_siswa'=>$request->name,
            'jeniskelamin'=>$request->jeniskelamin,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
            'users_id'=>$user->id,
            'kode_kelas'=>$request->kode_kelas,
            'kode_thn_ajaran'=>$request->kode_thn_ajaran
        ]);

        return redirect()->route('datasiswaPKL.index')->with('success','Data siswa PKL berhasil disimpan');
    }

    public function impor()
    {
        return view('datasiswaPKL.impor');
    }

    public function downloadfile()
    {
        $filepath = public_path('doc/templatedatasiswa.xlsx');
        return Response::download($filepath); 
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        //melakukan import file
        Excel::import(new SiswaImport, request()->file('file'));
        //jika berhasil kembali ke halaman sebelumnya
        return redirect()->route('datasiswaPKL.index')->with('success','Data siswa PKL berhasil diimpor');
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
        $siswa=Siswa::where('id', $id)->first();
        $user = User::where('id', $siswa->users_id)->first();
        $kelas = Kelas::all();
        $tahunajaran = Thn_ajaran::all();
        return view('datasiswaPKL.ubah', compact('user','siswa', 'kelas', 'tahunajaran'));
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
        $siswa = Siswa::where('id',$id)->first();
        $user = User::where('id', $siswa->users_id)->first();

        $request->validate([
            'nis' => 'numeric|unique:siswa,nis,'. $id,
            'nisn' => 'numeric|unique:siswa,nisn,'. $id,
            'no_telp' => 'numeric|digits_between:11,13'. $id,
            'email' => 'unique:users,email,'.$siswa->users_id,
            'username' => 'unique:users,username,'.$siswa->users_id,
        ]);

        if ($request->password == NULL) {
            $userupdate = User::where('id', $siswa->users_id)->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'remember_token' => \Str::random(50),
                'role_id'=>'5'
            ]);
        }

        else {
            $userupdate = User::where('id', $siswa->users_id)->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'remember_token' => \Str::random(50),
                'role_id'=>'5'
            ]);
        }

        $siswaupdate = Siswa::where('id',$id)->update([
            'nis'=>$request->nis,
            'nisn'=>$request->nisn,
            'nama_siswa'=>$request->name,
            'jeniskelamin'=>$request->jeniskelamin,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
            'users_id'=>$user->id,
            'kode_kelas'=>$request->kode_kelas,
            'kode_thn_ajaran'=>$request->kode_thn_ajaran
        ]);

        return redirect()->route('datasiswaPKL.index')->with('success','Data siswa PKL berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa=Siswa::where('id', $id)->first();
        $user = User::where('id', $siswa->users_id)->first();
        $siswa->delete();
        $user->delete();

        return redirect()->route('datasiswaPKL.index')->with('success','Data siswa PKL berhasil dihapus');
    }
}
