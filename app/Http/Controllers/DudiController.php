<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dudi;
use App\Models\Pengajuan;

class DudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dudi = Dudi::all();
        return view('dudi.index', compact('dudi'));
    }

    // public function lihat()
    // {
    //     $dudi = Dudi::all();
    //     return view('dudi.lihat', compact('dudi'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dudi.tambah');
    }

    // public function create_dudisiswa()
    // {
    //     return view('dudi.tambah');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dudi' => 'required|unique:dudi,nama_dudi',
            'alamat_dudi' => 'required'
        ]);

        $datadudi = Dudi::create([
            'nama_dudi'=>$request->nama_dudi,
            'alamat_dudi'=>$request->alamat_dudi
        ]);

        return redirect()->route('dudi.index')->with('success','Data DU/DI berhasil disimpan'); 
    }

    // public function store_dudisiswa(Request $request)
    // {
    //     $request->validate([
    //         'nama_dudi' => 'required|unique:dudi,nama_dudi',
    //         'alamat_dudi' => 'required'
    //     ]);

    //     $datadudi = Dudi::create([
    //         'nama_dudi'=>$request->nama_dudi,
    //         'alamat_dudi'=>$request->alamat_dudi
    //     ]);

    //     // return redirect()->route('dudi.index')->with('success','Data DU/DI berhasil disimpan'); 
    //     return redirect()->back()>with('success','Data DU/DI berhasil disimpan');   // edit kalau mau merubah halaman awal yang ingin dituju
    // }

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
        $dudi=Dudi::where('id', $id)->first();
        return view('dudi.ubah', compact('dudi'));
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
            'nama_dudi' => 'unique:dudi,nama_dudi,'. $id
        ]);

        $dudi = Dudi::where('id',$id)->first();

        $dudiupdate = Dudi::where('id',$id)->update([
            'nama_dudi' => $request->nama_dudi,
            'alamat_dudi' => $request->alamat_dudi
        ]);

        return redirect()->route('dudi.index')->with('success','DU/DI berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dudi=Dudi::where('id', $id)->first();
        $cekdata = Pengajuan::where('dudi_id',$id)->first();
        if ($cekdata != null) {
            return redirect()->route('dudi.index')->with('error','Data DU/DI sedang digunakan');
        }
        else {
            $dudi->delete();
            return redirect()->route('dudi.index')->with('success','DU/DI berhasil dihapus');
        }      
    }
}
