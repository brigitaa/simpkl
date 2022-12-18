<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
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
use Illuminate\Support\Facades\File;
use Response; 

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        $periode = Periode::all();
        $dudi = Dudi::all();
        $kelas = Kelas::all();
        $tahunajaran = Thn_ajaran::all();

        $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi')
                                ->where('users_id', Auth::user()->id)
                                ->get();  
        // dd($penilaian);

        return view('penilaianPKL.index', compact('penilaian', 'siswa', 'periode', 'dudi',  'kelas', 'tahunajaran'));
    }

    public function lihat(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $role = Role::where('id',$user->role_id)->first();
        session(['role' => $role->nama_role]);

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
                $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi') 
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->get();
            }
    
            else {
                $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi') 
                                ->get();  
            }
        }

        elseif ($request->nama_kelas != NULL && $request->nama_thn_ajaran == NULL){
            if ($role->nama_role == 'Kaprog') {
                $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi') 
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('nama_kelas', '=', $request->nama_kelas)
                                ->get();
            }
    
            else {
                $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi') 
                                ->where('nama_kelas', '=', $request->nama_kelas)
                                ->get();  
            }
        }

        elseif ($request->nama_kelas == NULL && $request->nama_thn_ajaran != NULL ){
            if ($role->nama_role == 'Kaprog') {
                $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi') 
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                                ->get();
            }
    
            else {
                $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi') 
                                ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                                ->get();  
            }    
        }

        else {
            if ($role->nama_role == 'Kaprog') {
                $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi') 
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('nama_kelas', '=', $request->nama_kelas)
                                ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                                ->get();
            }
    
            else {
                $penilaian = Penilaian::leftjoin('penempatan', 'penempatan.id', 'penilaian.penempatan_id')
                                ->leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->select('penilaian.*', 'siswa.nama_siswa', 'kelas.nama_kelas', 'thn_ajaran.nama_thn_ajaran', 'periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi', 'dudi.alamat_dudi') 
                                ->where('nama_kelas', '=', $request->nama_kelas)
                                ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                                ->get();
            }
        }

        return view('penilaianPKL.lihat', compact('penilaian', 'siswa', 'periode', 'dudi',  'kelas', 'tahunajaran'));
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
        $penilaian = Penilaian::where('id', $id)->first();

        $penempatan = Penempatan::where('id', $penilaian->penempatan_id)->first();
        $konfirmasidudi = Konfirmasi_dudi::where('id', $penempatan->konfirmasi_dudi_id)->first();
        $pengajuan = Pengajuan::where('id', $konfirmasidudi->pengajuan_id)->first();
        $datasiswa = Siswa::where('siswa.id', $pengajuan->siswa_id)->first(); 
        $datakelas = Kelas::where('kode_kelas', $datasiswa->kode_kelas)->first();
        $tahunajaran = Thn_ajaran::where('kode_thn_ajaran', $datasiswa->kode_thn_ajaran)->first();
        $dataperiode = Periode::where('id', $pengajuan->periode_id)->first();
        $datadudi = Dudi::where('id', $pengajuan->dudi_id)->first();
 
        return view('penilaianPKL.ubah', compact('penilaian', 'penempatan', 'konfirmasidudi', 'pengajuan', 'datasiswa', 'datakelas', 'tahunajaran', 'dataperiode', 'datadudi'));
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
        $penilaian = Penilaian::where('id', $id)->first();

        if ($penilaian->sertifikat == NULL) {
			$request->validate([
				'sertifikat' => 'required|mimes:pdf|max:1000',
				'nilai' => 'required|numeric',
        	]);
            $file_sertifikat = $request->file('sertifikat');
            $fileName_sertifikat = uniqid(). '_' .$file_sertifikat->getClientOriginalName();
            $file_sertifikat->move(public_path('storage/sertifikat'), $fileName_sertifikat);
            $exist_sertifikat = $penilaian->update(['sertifikat'=>$fileName_sertifikat]);
        }
        else {
			$request->validate([
				'sertifikat' => 'mimes:pdf|max:1000',
				'nilai' => 'numeric',
        	]);
			if($request->hasfile('sertifikat')) {
				$file_sertifikat = $request->file('sertifikat');
				$fileName_sertifikat = uniqid(). '_' .$file_sertifikat->getClientOriginalName();
				$sertifikat_path = public_path("storage/sertifikat/{$penilaian->sertifikat}");
				if (File::exists($sertifikat_path)) {
					unlink($sertifikat_path);
				}
				$file_sertifikat->move(public_path('storage/sertifikat'), $fileName_sertifikat);
				$exist_sertifikat = $penilaian->update(['sertifikat'=>$fileName_sertifikat]);
			}    
        }

        $penilaianupdate = Penilaian::where('id',$id)->update([
            'nilai'=>$request->nilai
        ]);

        return redirect()->route('penilaianPKL.index')->with('success','Data penilaian PKL  berhasil diubah');
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

    public function file_sertifikat($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $filepath = public_path("storage/sertifikat/{$penilaian->sertifikat}");
        return Response::download($filepath); 
    }

    public function verifikasi_nilai($id)
    {
        $penilaian = Penilaian::findOrFail($id);
            $penilaian->update([
                'status_verif_nilai'=>'Sudah diverifikasi'
            ]);
        return redirect()->route('penilaianPKL.lihat')->with('success','Penilaian PKL telah diverifikasi');  
    }

    public function batal_verifikasi_nilai($id)
    {
        $penilaian = Penilaian::findOrFail($id);
            $penilaian->update([
                'status_verif_nilai'=>'Belum diverifikasi'
            ]);
        return redirect()->route('penilaianPKL.lihat')->with('success','Verifikasi penilaian PKL berhasil dibatalkan');  
    }
}
