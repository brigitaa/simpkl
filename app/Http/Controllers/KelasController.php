<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Kompetensi_keahlian;
use App\Models\Siswa;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kompetensi_keahlian = Kompetensi_keahlian::all();
        $kelas = Kelas::leftjoin('kompetensi_keahlian', 'kompetensi_keahlian.id', 'kelas.kompetensi_keahlian_id')
                        ->select('kelas.*','kompetensi_keahlian.nama_keahlian')
                        ->get();
        return view('kelas.index', compact('kelas', 'kompetensi_keahlian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kompetensi_keahlian = Kompetensi_keahlian::all();
        return view('kelas.tambah', compact('kompetensi_keahlian'));
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
            'kode_kelas' => 'required|unique:kelas,kode_kelas',
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
        ]);

        $keahlian = Kompetensi_keahlian::where('id', $request->kompetensi_keahlian_id)->first();

        $kelas = Kelas::create([
            'kode_kelas'=>$request->kode_kelas,
            'nama_kelas'=>$request->nama_kelas,
            'kompetensi_keahlian_id'=>$keahlian->id
        ]);

        return redirect()->route('kelas.index')->with('success','Data kelas berhasil disimpan');
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
        $kelas = Kelas::where('id', $id)->first();
        // $role = Role::where('id', $user->role_id)->first();
        $kompetensi_keahlian = Kompetensi_keahlian::all();
        return view('kelas.ubah', compact('kelas','kompetensi_keahlian'));
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
        $kelas = Kelas::where('id', $id)->first();
        $kompetensi_keahlian = Kompetensi_keahlian::where('id', $kelas->kompetensi_keahlian_id)->first();

        $request->validate([
            'kode_kelas' => 'unique:kelas,kode_kelas,'. $id,
            'nama_kelas' => 'unique:kelas,nama_kelas,'. $id,
        ]);

        $kelasupdate = Kelas::where('id',$id)->update([
            'kode_kelas'=>$request->kode_kelas,
            'nama_kelas'=>$request->nama_kelas,
            'kompetensi_keahlian_id'=>$kompetensi_keahlian->id
        ]);
        
        return redirect()->route('kelas.index')->with('success','Data kelas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas=Kelas::where('id', $id)->first();
        $cekdata = Siswa::where('kode_kelas',$kelas->kode_kelas)->first();
        if ($cekdata != null) {
            return redirect()->route('kelas.index')->with('error','Data kelas sedang digunakan');
        }
        else {
            $kelas->delete();
            return redirect()->route('kelas.index')->with('success','Kelas berhasil dihapus');
        }  
    }
}
