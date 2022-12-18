<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use App\Models\Konfirmasi_dudi;
use App\Models\Pengajuan;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Thn_ajaran;
use App\Models\Periode;
use App\Models\Dudi;
use App\Models\User;
use App\Models\Role;
use App\Models\Kaprog;
use App\Models\Guru_monitoring;
use App\Models\Status_pkl;
use App\Models\Penempatan;
use App\Models\Penilaian;
use Illuminate\Support\Facades\File; 

class KonfirmasiDUDIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuan = Pengajuan::all();
        $siswa = Siswa::all();
        $periode = Periode::all();
        $dudi = Dudi::all();

        $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                        ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('users_id', Auth::user()->id)
                        ->get();        

        
        return view('konfirmasidudi.index', compact('konfirmasidudi','pengajuan', 'siswa', 'periode', 'dudi'));
    }

    public function lihat(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $role = Role::where('id',$user->role_id)->first();
        session(['role' => $role->nama_role]);

        $pengajuan = Pengajuan::all();
        $siswa = Siswa::all();

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
        $periode = Periode::all();
        $dudi = Dudi::all();   
        
        if (!$request->all() || ($request->nama_kelas == '' && $request->nama_thn_ajaran == '')){
            if ($role->nama_role == 'Kaprog') {
                $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->get();
            }
    
            else {
                $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->get();   
            }
        }

        elseif ($request->nama_kelas != NULL && $request->nama_thn_ajaran == NULL){
            if ($role->nama_role == 'Kaprog') {
                $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_kelas', '=', $request->nama_kelas)
                            ->get();
            }
    
            else {
                $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('nama_kelas', '=', $request->nama_kelas)
                            ->get();  
            }
            
        }

        elseif ($request->nama_kelas == NULL && $request->nama_thn_ajaran != NULL){
            if ($role->nama_role == 'Kaprog') {
                $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                            ->get();
            }
    
            else {
                $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                            ->get(); 
            }
            
        }

        else {
            if ($role->nama_role == 'Kaprog') {
                $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_kelas', '=', $request->nama_kelas)
                            ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                            ->get();
            }
    
            else {
                $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('konfirmasi_dudi.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('nama_kelas', '=', $request->nama_kelas)
                            ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                            ->get();
            }
            
        }

        return view('konfirmasidudi.lihat', compact('konfirmasidudi','pengajuan', 'siswa', 'periode', 'dudi',  'kelas', 'tahunajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengajuan = Pengajuan::all();
        $datasiswa = Siswa::with('pengajuan')
                    ->where('users_id', Auth::user()->id)->first();
        $datakelas = Kelas::where('kode_kelas', $datasiswa->kode_kelas)->first();
        $tahunajaran = Thn_ajaran::where('kode_thn_ajaran', $datasiswa->kode_thn_ajaran)->first();
 
        return view('konfirmasidudi.tambah', compact('datasiswa', 'datakelas', 'tahunajaran'));
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
            'pengajuan_id' => 'required',
            'balasan_dudi' => 'required|mimes:pdf|max:1000',
            'status_balasan_dudi' => 'required',
        ]);

        $pengajuan = Pengajuan::where('id', $request->pengajuan_id)->first();

        $file_balasan_dudi = $request->balasan_dudi;
        $fileName_balasanDudi = uniqid(). '_' .$file_balasan_dudi->getClientOriginalName();
        $file_balasan_dudi->move(public_path('storage/balasan_dudi'), $fileName_balasanDudi);

        $datakonfirmasidudi = Konfirmasi_dudi::create([
            'pengajuan_id'=>$pengajuan->id,
            'balasan_dudi'=>$fileName_balasanDudi,
            'status'=>$request->status_balasan_dudi
        ]);


        if ($request->status_balasan_dudi == "Disetujui") {
            $gurumonitoring = Guru_monitoring::firstOrCreate(
                ['dudi_id' => $pengajuan->dudi_id,
                'periode_id' => $pengajuan->periode_id]
            );

            $datagurumonitoring = Guru_monitoring::where('dudi_id', $pengajuan->dudi_id)
                                                 ->where('periode_id', $pengajuan->periode_id)
                                                 ->first();

            $statuspkl = Status_pkl::where('nama_status_pkl', '=', 'Belum terlaksana')->first();

            $penempatan = Penempatan::create([
                'konfirmasi_dudi_id'=>$datakonfirmasidudi->id,
                'guru_monitoring_id'=>$datagurumonitoring->id,
                'status_pkl_id'=>$statuspkl->id,
            ]);

            $penilaian = Penilaian::create([
                'penempatan_id'=>$penempatan->id,
                'status_verif_nilai'=>'Belum diverifikasi'
            ]);
            
        };

        return redirect()->route('konfirmasidudi.index')->with('success','Data konfirmasi balasan dudi berhasil disimpan');
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
        $konfirmasidudi = Konfirmasi_dudi::where('id', $id)->first();
        $pengajuan = Pengajuan::where('id', $konfirmasidudi->pengajuan_id)->first();
        $datasiswa = Siswa::where('siswa.id', $pengajuan->siswa_id)->first(); 
        // $datasiswa = Siswa::with('pengajuan')
        //             // ->where('users_id', Auth::user()->id)
        //             ->where('siswa_id')
        //             ->get();
        $datakelas = Kelas::where('kode_kelas', $datasiswa->kode_kelas)->first();
        $tahunajaran = Thn_ajaran::where('kode_thn_ajaran', $datasiswa->kode_thn_ajaran)->first();
        $dataperiode = Periode::where('id', $pengajuan->periode_id)->first();
        $datadudi = Dudi::where('id', $pengajuan->dudi_id)->first();
 
        return view('konfirmasidudi.ubah', compact('konfirmasidudi', 'pengajuan', 'datasiswa', 'datakelas', 'tahunajaran', 'dataperiode', 'datadudi'));
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
            'balasan_dudi' => 'mimes:pdf|max:1000',
        ]);

        $konfirmasidudi = Konfirmasi_dudi::where('id', $id)->first();
        $pengajuan = Pengajuan::where('id', $request->pengajuan_id)->first();

        if($request->hasfile('balasan_dudi')) {   
            $file_balasan_dudi = $request->file('balasan_dudi');
            $fileName_balasanDudi = uniqid(). '_' .$file_balasan_dudi->getClientOriginalName();
            $balasan_dudi_path = public_path("storage/balasan_dudi/{$konfirmasidudi->balasan_dudi}");
            if (File::exists($balasan_dudi_path)) {
                unlink($balasan_dudi_path);
            }
            $file_balasan_dudi->move(public_path('storage/balasan_dudi'), $fileName_balasanDudi);
            $exist_file_balasan_dudi = $konfirmasidudi->update(['balasan_dudi'=>$fileName_balasanDudi]);
        }

        $konfirmasidudiupdate = Konfirmasi_dudi::where('id',$id)->update([
            'pengajuan_id'=>$pengajuan->id,
            'status'=>$request->status_balasan_dudi
        ]);

        if ($request->status_balasan_dudi == 'Disetujui') {
            $gurumonitoring = Guru_monitoring::firstOrCreate(
                ['dudi_id' => $pengajuan->dudi_id,
                'periode_id' => $pengajuan->periode_id
                // 'guru_id' => $request->guru_id
            ]);

            $datagurumonitoring = Guru_monitoring::where('dudi_id', $pengajuan->dudi_id)
                                                 ->where('periode_id', $pengajuan->periode_id)
                                                 ->first();
            $statuspkl = Status_pkl::where('nama_status_pkl', '=', 'Belum terlaksana')->first();

            $penempatan = Penempatan::firstOrcreate([
                'konfirmasi_dudi_id'=>$konfirmasidudi->id,
                'guru_monitoring_id'=>$datagurumonitoring->id,
                'status_pkl_id'=>$statuspkl->id,
            ]);

            $penilaian = Penilaian::firstOrcreate([
                'penempatan_id'=>$penempatan->id,
                'status_verif_nilai'=>'Belum diverifikasi'
            ]);
            
        }

        else {
            $penempatan = Penempatan::where('konfirmasi_dudi_id', $konfirmasidudi->id)->first();
            $penilaian = Penilaian::where('penempatan_id', $penempatan->id)->first();
            $penilaian->delete();   
            $penempatan->delete();            
        }


        return redirect()->route('konfirmasidudi.lihat')->with('success','Data konfirmasi balasan dudi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $konfirmasidudi=Konfirmasi_dudi::where('id', $id)->first();
        // $balasan_dudi_path = public_path("storage/balasan_dudi/{$konfirmasidudi->balasan_dudi}");

        // if (File::exists($balasan_dudi_path)) {
        //     unlink($balasan_dudi_path);
        // }

        // $konfirmasidudi->delete();
        
        // return redirect()->route('konfirmasidudi.index')->with('success','Data konfirmasi balasan dudi berhasil dihapus');
    }

    public function getPengajuan($idpengajuan = 0)
    {
        $datapengajuan = Pengajuan::leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
        ->find($idpengajuan);

        echo json_encode($datapengajuan);

        exit;
    }

    public function file_balasandudi($id)
    {
        $konfirmasidudi = Konfirmasi_dudi::findOrFail($id);
        $filepath = public_path("storage/balasan_dudi/{$konfirmasidudi->balasan_dudi}");
        return Response::download($filepath); 
    }
}
