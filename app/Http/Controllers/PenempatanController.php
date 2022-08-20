<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penempatan;
use App\Models\Konfirmasi_dudi;
use App\Models\Pengajuan;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Thn_ajaran;
use App\Models\Periode;
use App\Models\Dudi;
use App\Models\Guru_monitoring;
use App\Models\Guru;

class PenempatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konfirmasidudi = Konfirmasi_dudi::all();
        $gurumonitoring = Guru_monitoring::all();
        $guru = Guru::all();
        $pengajuan = Pengajuan::all();
        $siswa = Siswa::all();
        $periode = Periode::all();
        $dudi = Dudi::all();
        $kelas = Kelas::all();
        $tahunajaran = Thn_ajaran::all();

        $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru')
                                // ->where('pengajuan.periode_id', '=', 'guru_monitoring.periode_id')
                                // ->where('pengajuan.dudi_id', '=', 'guru_monitoring.dudi_id')
                                ->get();
        // dd($penempatan);

        
        return view('penempatanPKL.index', compact('penempatan', 'gurumonitoring', 'guru', 'konfirmasidudi', 'pengajuan', 'siswa', 'periode', 'dudi',  'kelas', 'tahunajaran'));
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
        //
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
        //
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
