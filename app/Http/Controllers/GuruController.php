<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Guru_monitoring;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::all();
        return view('guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guru.tambah');
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
            'nip' => 'required|numeric|unique:guru,nip',
            'nama_guru' => 'required',
            'no_telp_guru' => 'required|max:13',
            'alamat' => 'required'
        ]);

        $dataguru = Guru::create([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'no_telp_guru' => $request->no_telp_guru,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('guru.index')->with('success','Data guru berhasil disimpan');
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
        $guru = Guru::where('id', $id)->first();
        return view('guru.ubah', compact('guru'));
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
            'nip' => 'unique:guru,nip,'. $id,
            'no_telp_guru' => 'max:13'
        ]);
        
        $guru = Guru::where('id',$id)->first();

        $guruupdate = Guru::where('id',$id)->update([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'no_telp_guru' => $request->no_telp_guru,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('guru.index')->with('success','Guru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru=Guru::where('id', $id)->first();
        $cekdata = Guru_monitoring::where('guru_id',$id)->first();

        if ($cekdata != null) {
            return redirect()->route('guru.index')->with('error','Data guru sedang digunakan');
        }
        else {
            $guru->delete();
            return redirect()->route('guru.index')->with('success','Guru berhasil dihapus');
        }  
    }
}
