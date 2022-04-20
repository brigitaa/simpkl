<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use Illuminate\Support\Carbon;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::all();
        return view('periode.index', compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periode.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanggal_mulai = Carbon::createFromFormat('d-m-Y', $request->tanggal_mulai);
        $tanggal_selesai = Carbon::createFromFormat('d-m-Y', $request->tanggal_selesai);
        $dataperiode = Periode::create([
            'tanggal_mulai'=>$tanggal_mulai,
            'tanggal_selesai'=>$tanggal_selesai
        ]);
    
        return redirect()->route('periode.index')->with('success','Data periode PKL berhasil disimpan');
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
        $periode = Periode::where('id', $id)->first();
        return view('periode.ubah', compact('periode'));
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
        $periode = Periode::where('id', $id)->first();
        $tanggal_mulai = Carbon::createFromFormat('d-m-Y', $request->tanggal_mulai);
        $tanggal_selesai = Carbon::createFromFormat('d-m-Y', $request->tanggal_selesai);
        $periodeupdate = Periode::where('id',$id)->update([
            'tanggal_mulai'=>$tanggal_mulai,
            'tanggal_selesai'=>$tanggal_selesai
        ]);
        return redirect()->route('periode.index')->with('success','Data periode PKL berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periode=Periode::where('id', $id)->first();
        $periode->delete();

        return redirect()->route('periode.index')->with('success','Periode PKL berhasil dihapus');
    }
}
