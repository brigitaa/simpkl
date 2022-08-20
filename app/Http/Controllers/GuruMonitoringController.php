<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru_monitoring;
use App\Models\Penempatan;
use App\Models\Dudi;
use App\Models\Periode;
use App\Models\Guru;


class GuruMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::all();
        $gurumonitoring = Guru_monitoring::leftjoin('dudi', 'dudi.id', 'guru_monitoring.dudi_id')
                        ->leftjoin('periode', 'periode.id', 'guru_monitoring.periode_id')
                        ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                        ->select('guru_monitoring.*', 'dudi.nama_dudi', 'periode.tanggal_mulai', 'periode.tanggal_selesai', 'guru.nama_guru')
                        ->get();
        return view('gurumonitoring.index', compact('gurumonitoring', 'guru'));
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
        $gurumonitoring = Guru_monitoring::where('id', $id)->first();
        $datadudi = Dudi::where('id', $gurumonitoring->dudi_id)->first();
        $dataperiode = Periode::where('id', $gurumonitoring->periode_id)->first();
        $guru = Guru::all();

        return view('gurumonitoring.ubah', compact('gurumonitoring', 'datadudi', 'dataperiode', 'guru'));
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
        $gurumonitoring = Guru_monitoring::where('id', $id)->first();
        $guru = Guru::where('id', $gurumonitoring->guru_id)->first();

        $gurumonitoring->update([
            'guru_id'=>$request->guru_id
        ]);


        // if ($request->guru_id != NULL) {
        //     $penempatan = Penempatan::update([
        //         'guru_monitoring_id'=>$request->guru_id
        //     ]);
        //     // dd($penempatan);
        // }
        
        
        return redirect()->route('gurumonitoring.index')->with('success','Data Guru Monitoring berhasil diubah');
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
