<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thn_ajaran;
use App\Models\Siswa;

class ThnAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunajaran = Thn_ajaran::all();
        return view('tahunajaran.index', compact('tahunajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahunajaran.tambah');
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
                'kode_thn_ajaran' => 'required|unique:thn_ajaran,kode_thn_ajaran',
                'nama_thn_ajaran' => 'required|unique:thn_ajaran,nama_thn_ajaran'
        ]);

        $datatahunajaran = Thn_ajaran::create([
            'kode_thn_ajaran'=>$request->kode_thn_ajaran,
            'nama_thn_ajaran'=>$request->nama_thn_ajaran
        ]);

        return redirect()->route('tahunajaran.index')->with('success','Data tahun ajaran berhasil disimpan');
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
        $tahunajaran=Thn_ajaran::where('id', $id)->first();
        return view('tahunajaran.ubah', compact('tahunajaran'));
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
        $request->validate([
            'kode_thn_ajaran' => 'unique:thn_ajaran,kode_thn_ajaran,'. $id,
            'nama_thn_ajaran' => 'unique:thn_ajaran,nama_thn_ajaran,'. $id
        ]);
        
        $tahunajaran = Thn_ajaran::where('id',$id)->first();

        $tahunajaranupdate = Thn_ajaran::where('id',$id)->update([
            'kode_thn_ajaran' => $request->kode_thn_ajaran,
            'nama_thn_ajaran' => $request->nama_thn_ajaran
        ]);

        return redirect()->route('tahunajaran.index')->with('success','Tahun Ajaran berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tahunajaran=Thn_ajaran::where('id', $id)->first();
        $cekdata = Siswa::where('kode_thn_ajaran',$tahunajaran->kode_thn_ajaran)->first();
        if ($cekdata != null) {
            return redirect()->route('tahunajaran.index')->with('error','Data tahun ajaran sedang digunakan');
        }
        else {
            $dudi->delete();
            return redirect()->route('tahunajaran.index')->with('success','Tahun Ajaran berhasil dihapus');
        }  
    }
}
