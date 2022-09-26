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
use App\Models\Status_pkl;
use App\Models\User;
use App\Models\Role;
use App\Models\Kaprog;
use Auth;

class PenempatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $role = Role::where('id',$user->role_id)->first();
        session(['role' => $role->nama_role]);

        $konfirmasidudi = Konfirmasi_dudi::all();
        $gurumonitoring = Guru_monitoring::all();
        $guru = Guru::all();
        $pengajuan = Pengajuan::all();
        $siswa = Siswa::all();
        $periode = Periode::all();
        $dudi = Dudi::all();

        if ($role->nama_role == 'Kaprog') {
            $datakaprog = Kaprog::where('users_id', Auth::user()->id)->first();
            $kelas= Kelas::leftjoin('kompetensi_keahlian', 'kompetensi_keahlian.id', 'kelas.kompetensi_keahlian_id')
                                         ->where('kelas.kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                         ->get();
        }
        else {
            $kelas = Kelas::all();
        }

        $tahunajaran = Thn_ajaran::all();

        if (!$request->all() || ($request->nama_kelas == '' && $request->nama_thn_ajaran == '')){
            if ($role->nama_role == 'Kaprog') {
                $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->get();
            }
    
            else {
                $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->get();  
            }
        }

        elseif ($request->nama_kelas != NULL && $request->nama_thn_ajaran == NULL){
            if ($role->nama_role == 'Kaprog') {
                $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('nama_kelas', '=', $request->nama_kelas)
                                ->get();
            }
    
            else {
                $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->where('nama_kelas', '=', $request->nama_kelas)
                                ->get();  
            }
        }

        elseif ($request->nama_kelas == NULL && $request->nama_thn_ajaran != NULL ){
            if ($role->nama_role == 'Kaprog') {
                $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                                ->get();
            }
    
            else {
                $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                                ->get();  
            }    
        }

        else {
            if ($role->nama_role == 'Kaprog') {
                $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('nama_kelas', '=', $request->nama_kelas)
                                ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                                ->get();
            }
    
            else {
                $penempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->where('nama_kelas', '=', $request->nama_kelas)
                                ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                                ->get();
            }
        }

        return view('penempatanPKL.index', compact('penempatan', 'gurumonitoring', 'guru', 'konfirmasidudi', 'pengajuan', 'siswa', 'periode', 'dudi',  'kelas', 'tahunajaran'));
    }

    public function lihat(Request $request)
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
                                ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                ->select('penempatan.*', 'siswa.nama_siswa', 'siswa.no_telp', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi', 'guru.nama_guru', 'status_pkl.nama_status_pkl')
                                ->where('users_id', Auth::user()->id)
                                ->get();  

        return view('penempatanPKL.lihat', compact('penempatan', 'gurumonitoring', 'guru', 'konfirmasidudi', 'pengajuan', 'siswa', 'periode', 'dudi',  'kelas', 'tahunajaran'));
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
        $penempatan = Penempatan::where('id', $id)->first();
        $konfirmasidudi = Konfirmasi_dudi::where('id', $penempatan->konfirmasi_dudi_id)->first();
        $gurumonitoring = Guru_monitoring::where('id', $penempatan->guru_monitoring_id)->first();
        $statuspkl = Status_pkl::all();

        $pengajuan = Pengajuan::where('id', $konfirmasidudi->pengajuan_id)->first();
        $datasiswa = Siswa::where('siswa.id', $pengajuan->siswa_id)->first(); 
        $datakelas = Kelas::where('kode_kelas', $datasiswa->kode_kelas)->first();
        $tahunajaran = Thn_ajaran::where('kode_thn_ajaran', $datasiswa->kode_thn_ajaran)->first();
        $dataperiode = Periode::where('id', $pengajuan->periode_id)->first();
        $datadudi = Dudi::where('id', $pengajuan->dudi_id)->first();
        $dataguru = Guru::where('id', $gurumonitoring->guru_id)->first();
 
        return view('penempatanPKL.ubah', compact('penempatan', 'konfirmasidudi', 'gurumonitoring', 'statuspkl', 'pengajuan', 'datasiswa', 'datakelas', 'tahunajaran', 'dataperiode', 'datadudi', 'dataguru'));
        // return view('penempatanPKL.ubah');
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
        $penempatan = Penempatan::where('id', $id)->first();
        $statuspkl = Status_pkl::where('id', $request->status_pkl_id)->first();

        $penempatanupdate = Penempatan::where('id',$id)->update([
            'status_pkl_id'=>$statuspkl->id
        ]);

        return redirect()->route('penempatanPKL.index')->with('success','Data penempatan  berhasil diubah');
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
