<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kompetensi_keahlian;

class KeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kompetensi_keahlian = Kompetensi_keahlian::all();
        return view('kompetensikeahlian.index', compact('kompetensi_keahlian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kompetensikeahlian.tambah');
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
            'kode_keahlian' => 'required|unique:kompetensi_keahlian,kode_keahlian',
            'nama_keahlian' => 'required|unique:kompetensi_keahlian,nama_keahlian'
        ]);

    $datakeahlian = Kompetensi_keahlian::create([
        'kode_keahlian'=>$request->kode_keahlian,
        'nama_keahlian'=>$request->nama_keahlian
    ]);

    return redirect()->route('kompetensikeahlian.index')->with('success','Data kompetensi keahlian berhasil disimpan');
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
        $kompetensi_keahlian=Kompetensi_keahlian::where('id', $id)->first();
        return view('kompetensikeahlian.ubah', compact('kompetensi_keahlian'));
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
            'kode_keahlian' => 'unique:kompetensi_keahlian,kode_keahlian,'. $id,
            'nama_keahlian' => 'unique:kompetensi_keahlian,nama_keahlian,'. $id
        ]);
        
        $kompetensi_keahlian = Kompetensi_keahlian::where('id',$id)->first();

        $keahlianupdate = Kompetensi_keahlian::where('id',$id)->update([
            'kode_keahlian'=>$request->kode_keahlian,
            'nama_keahlian'=>$request->nama_keahlian
        ]);

        return redirect()->route('kompetensikeahlian.index')->with('success','Kompetensi keahlian berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kompetensi_keahlian=Kompetensi_keahlian::where('id', $id)->first();
        $kompetensi_keahlian->delete();

        return redirect()->route('kompetensikeahlian.index')->with('success','Kompetensi keahlian berhasil dihapus');
    }
}
