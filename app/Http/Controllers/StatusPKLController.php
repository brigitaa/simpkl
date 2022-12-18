<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status_pkl;
use App\Models\Penempatan;

class StatusPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuspkl = Status_pkl::all();
        return view('statusPKL.index', compact('statuspkl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'nama_status_pkl' => 'required'
        ]);

        $datastatuspkl = Status_pkl::create([
            'nama_status_pkl'=>$request->nama_status_pkl
        ]);

        return redirect()->route('statusPKL.index')->with('success','Data status PKL berhasil disimpan');
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
        $statuspkl = Status_pkl::where('id', $id)->first();
        return view('statusPKL.ubah', compact('statuspkl'));
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
        $statuspkl = Status_pkl::where('id', $id)->first();

        $statuspklupdate = Status_pkl::where('id',$id)->update([
            'nama_status_pkl' => $request->nama_status_pkl
        ]);

        return redirect()->route('statusPKL.index')->with('success','Status PKL berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statuspkl = Status_pkl::where('id', $id)->first();
        $cekdata = Penempatan::where('status_pkl_id',$id)->first();

        if ($cekdata != null) {
            return redirect()->route('statusPKL.index')->with('error','Data status PKL sedang digunakan');
        }
        else {
            $statuspkl->delete();
            return redirect()->route('statusPKL.index')->with('success','Status PKL berhasil dihapus');
        }  
    }
}
