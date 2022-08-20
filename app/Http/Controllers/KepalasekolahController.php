<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kepalasekolah;

class KepalasekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kepalasekolah = Kepalasekolah::first();
        return view('kepalasekolah.index', compact('kepalasekolah'));
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
        $kepalasekolah = Kepalasekolah::where('id',$id)->first();
        return view('kepalasekolah.ubah', compact('kepalasekolah'));

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
        $kepalasekolah = Kepalasekolah::where('id',$id)->first();

        $kepalasekolahupdate = Kepalasekolah::where('id',$id)->update([
            'nip' => $request->nip,
            'nama_kepsek' => $request->nama_kepsek,
            'jabatan' => $request->jabatan,
            'pangkat_gol' => $request->pangkat_gol
        ]);

        return redirect()->route('kepalasekolah.index')->with('success','Data kepala sekolah berhasil diubah');
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
