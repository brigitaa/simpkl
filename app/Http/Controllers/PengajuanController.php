<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use PDF;
use App\Models\Pengajuan;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Thn_ajaran;
use App\Models\Periode;
use App\Models\Dudi;
use App\Models\User;
use App\Models\Role;
use App\Models\Kaprog;
use App\Models\Kompetensi_keahlian;
use App\Models\Konfirmasi_dudi;
use App\Models\Kepalasekolah;
use App\Exports\PengajuanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File; 
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Carbon;

class PengajuanController extends Controller
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

        $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('users_id', Auth::user()->id)
                        ->get();
                        // dd($pengajuan);

        $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                          ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                          ->where('users_id', Auth::user()->id)
                                          ->where('status', '=', 'Disetujui')
                                          ->first();
        // dd($konfirmasidudi);

        return view('pengajuanPKL.index', compact('pengajuan', 'siswa', 'periode', 'dudi', 'konfirmasidudi'));
    }

    public function lihat(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $role = Role::where('id',$user->role_id)->first();
        session(['role' => $role->nama_role]);

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
                $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->get();
            }
    
            else {
                $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->get();    
            }
        }

        elseif ($request->nama_kelas != NULL && $request->nama_thn_ajaran == NULL){
            if ($role->nama_role == 'Kaprog') {
                $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_kelas', '=', $request->nama_kelas)
                            ->get();
            }
    
            else {
                $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('nama_kelas', '=', $request->nama_kelas)
                        ->get();  
            }
            
        }

        elseif ($request->nama_kelas == NULL && $request->nama_thn_ajaran != NULL){
            if ($role->nama_role == 'Kaprog') {
                $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                            ->get();
            }
    
            else {
                $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                        ->get(); 
            }
            
        }

        else {
            if ($role->nama_role == 'Kaprog') {
                $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_kelas', '=', $request->nama_kelas)
                            ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                            ->get();
            }
    
            else {
                $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('nama_kelas', '=', $request->nama_kelas)
                        ->where('nama_thn_ajaran', '=', $request->nama_thn_ajaran)
                        ->get();
            }
            
        }

        return view('pengajuanPKL.lihat', compact('pengajuan', 'siswa', 'periode', 'dudi', 'kelas', 'tahunajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datasiswa = Siswa::where('users_id', Auth::user()->id)->first();
        $datakelas = Kelas::where('kode_kelas', $datasiswa->kode_kelas)->first();
        $tahunajaran = Thn_ajaran::where('kode_thn_ajaran', $datasiswa->kode_thn_ajaran)->first();
        $periode = Periode::all();
        $dudi = Dudi::all();
        // dd($datakelas);
        return view('pengajuanPKL.tambah', compact('datasiswa', 'datakelas', 'tahunajaran', 'periode', 'dudi'));
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
            'pernyataan_ortu' => 'required|mimes:pdf|max:10000',
            'pernyataan_siswa' => 'required|mimes:pdf|max:10000',
        ]);

        $id = IdGenerator::generate(['table' => 'pengajuan', 'length' => 15, 'prefix' =>'P-']);

        $datasiswa = Siswa::where('users_id', Auth::user()->id)->first();
        $periode = Periode::where('id', $request->periode_id)->first();
        
        if ($request->dudi_id != 'Lainnya') {
            $dudi = Dudi::where('id', $request->dudi_id)->first();
        }
        else {
            $dudi = Dudi::create([
                'nama_dudi'=>$request->nama_dudi,
                'alamat_dudi'=>$request->alamat_dudi
            ]);
        }
        
        
        $file_pernyataan_ortu = $request->pernyataan_ortu;
        $fileName_pernyataanOrtu = uniqid(). '_' .$file_pernyataan_ortu->getClientOriginalName();
        $file_pernyataan_ortu->move(public_path('storage/pernyataan_ortu'), $fileName_pernyataanOrtu);

        $file_pernyataan_siswa = $request->pernyataan_siswa;
        $fileName_pernyataanSiswa = uniqid(). '_' .$file_pernyataan_siswa->getClientOriginalName();
        $file_pernyataan_siswa->move(public_path('storage/pernyataan_siswa'), $fileName_pernyataanSiswa);

        $datapengajuan = Pengajuan::create([
            'id'=>$id,
            'siswa_id'=>$datasiswa->id,
            'periode_id'=>$periode->id,
            'dudi_id'=>$dudi->id,
            'pernyataan_ortu'=>$fileName_pernyataanOrtu,
            'pernyataan_siswa'=>$fileName_pernyataanSiswa,
        ]);

        return redirect()->route('pengajuanPKL.index')->with('success','Data pengajuan berhasil disimpan');
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

    public function showdetail($id)
    {
        $pengajuan = Pengajuan::where('id', $id)->first();
        $siswa = Siswa::all()->first();
        $periode = Periode::all();
        $dudi = Dudi::all();
        $dataperiode = Periode::where('id', $pengajuan->periode_id)->first();
        $datadudi = Dudi::where('id', $pengajuan->dudi_id)->first();
        
        return view('pengajuanPKL.show', compact('pengajuan','siswa','periode','dataperiode','dudi','datadudi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengajuan = Pengajuan::where('id', $id)->first();
        $siswa = Siswa::all();
        $periode = Periode::all();
        $dudi = Dudi::all();
        $datasiswa = Siswa::with('pengajuan')
                    ->where('users_id', Auth::user()->id)->first();
        $datakelas = Kelas::where('kode_kelas', $datasiswa->kode_kelas)->first();
        $tahunajaran = Thn_ajaran::where('kode_thn_ajaran', $datasiswa->kode_thn_ajaran)->first();
        $dataperiode = Periode::where('id', $pengajuan->periode_id)->first();
        $datadudi = Dudi::where('id', $pengajuan->dudi_id)->first();
        
        return view('pengajuanPKL.ubah', compact('pengajuan','siswa','periode','dataperiode','dudi','datadudi','datasiswa','datakelas', 'tahunajaran'));
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
            'pernyataan_ortu' => 'mimes:pdf|max:5000',
            'pernyataan_siswa' => 'mimes:pdf|max:5000',
        ]);

        $pengajuan = Pengajuan::where('id', $id)->first();
        $siswa = Siswa::all();
        $periode = Periode::all();
        $dudi = Dudi::all();
        $datasiswa = Siswa::where('users_id', Auth::user()->id)->first();
        $dataperiode = Periode::where('id', $request->periode_id)->first();
        $datadudi = Dudi::where('id', $request->dudi_id)->first();
        
        if($request->hasfile('pernyataan_ortu')) {   
            $file_pernyataan_ortu = $request->file('pernyataan_ortu');
            $fileName_pernyataanOrtu = uniqid(). '_' .$file_pernyataan_ortu->getClientOriginalName();
            $pernyataan_ortu_path = public_path("storage/pernyataan_ortu/{$pengajuan->pernyataan_ortu}");
            if (File::exists($pernyataan_ortu_path)) {
                // File::delete($pernyataan_ortu_path && $pernyataan_siswa_path);
                unlink($pernyataan_ortu_path);
            }
            $file_pernyataan_ortu->move(public_path('storage/pernyataan_ortu'), $fileName_pernyataanOrtu);
            $exist_file_pernyataan_ortu = $pengajuan->update(['pernyataan_ortu'=>$fileName_pernyataanOrtu]);
        }

        if($request->hasfile('pernyataan_siswa')) {   
            $file_pernyataan_siswa = $request->file('pernyataan_siswa');
            $fileName_pernyataanSiswa = uniqid(). '_' .$file_pernyataan_siswa->getClientOriginalName();
            $pernyataan_siswa_path = public_path("storage/pernyataan_siswa/{$pengajuan->pernyataan_siswa}");
            if (File::exists($pernyataan_siswa_path)) {
                unlink($pernyataan_siswa_path);
            }
            $file_pernyataan_siswa->move(public_path('storage/pernyataan_siswa'), $fileName_pernyataanSiswa);
            $pengajuan->update(['pernyataan_siswa'=>$fileName_pernyataanSiswa]);
        }

        $pengajuan->update([
            'siswa_id'=>$datasiswa->id,
            'periode_id'=>$dataperiode->id,
            'dudi_id'=>$datadudi->id,
        ]);

        return redirect()->route('pengajuanPKL.index')->with('success','Pengajuan PKL berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengajuan=Pengajuan::where('id', $id)->first();
        $pernyataan_ortu_path = public_path("storage/pernyataan_ortu/{$pengajuan->pernyataan_ortu}");
        $pernyataan_siswa_path = public_path("storage/pernyataan_siswa/{$pengajuan->pernyataan_siswa}");

        if (File::exists($pernyataan_ortu_path)) {
            // File::delete($pernyataan_ortu_path && $pernyataan_siswa_path);
            unlink($pernyataan_ortu_path);
        }

        if (File::exists($pernyataan_siswa_path)) {
            unlink($pernyataan_siswa_path);
        }

        // dd($pengajuan);
        $pengajuan->delete();
        
        
        return redirect()->route('pengajuanPKL.index')->with('success','Data Pengajuan PKL berhasil dihapus');
    }

    public function getPeriode($idperiode = 0)
    {
        $dataperiode = Periode::find($idperiode);
        echo json_encode($dataperiode);

        exit;
    }

    public function getDudi($iddudi = 0)
    {
        $datadudi = Dudi::find($iddudi);
        echo json_encode($datadudi);

        exit;
    }

    public function pernyataanortu()
    {
        $filepath = public_path('doc/Surat Pernyataan Orang Tua.docx');
        return Response::download($filepath); 
    }

    public function pernyataansiswa()
    {
        $filepath = public_path('doc/Surat Pernyataan Siswa Prakerin.docx');
        return Response::download($filepath); 
    }

    public function file_pernyataanortu($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $filepath = public_path("storage/pernyataan_ortu/{$pengajuan->pernyataan_ortu}");
        return Response::download($filepath); 
    }

    public function file_pernyataansiswa($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $filepath = public_path("storage/pernyataan_ortu/{$pengajuan->pernyataan_siswa}");
        return Response::download($filepath); 
    }

    public function terima_pengajuan_pokja($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->update([
                'status_verif_pokja'=>'2'
            ]);
        return redirect()->route('pengajuanPKL.lihat')->with('success','Status pengajuan PKL telah diterima');  
    }

    public function tolak_pengajuan_pokja($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->update([
                'status_verif_pokja'=>'3'
            ]);
        return redirect()->route('pengajuanPKL.lihat')->with('success','Status pengajuan PKL telah ditolak');  
    }

    public function batal_pengajuan_pokja($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->update([
                'status_verif_pokja'=>'1'
            ]);
        return redirect()->route('pengajuanPKL.lihat')->with('success','Status pengajuan PKL telah dibatalkan');  
    }

    public function terima_pengajuan_kaprog($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->update([
                'status_verif_kaprog'=>'2'
            ]);
        return redirect()->route('pengajuanPKL.lihat')->with('success','Status pengajuan PKL telah diterima');  
    }

    public function tolak_pengajuan_kaprog($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->update([
                'status_verif_kaprog'=>'3'
            ]);
        return redirect()->route('pengajuanPKL.lihat')->with('success','Status pengajuan PKL telah ditolak');  
    }

    public function batal_pengajuan_kaprog($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->update([
                'status_verif_kaprog'=>'1'
            ]);
        return redirect()->route('pengajuanPKL.lihat')->with('success','Status pengajuan PKL telah dibatalkan');  
    }

    public function ekspor(Request $request)
    {
        // $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
        //                         ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
        //                         ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
        //                         ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas') 
        //                         ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
        //                         ->select('pengajuan.id','siswa.nis','siswa.nisn','siswa.nama_siswa','kelas.nama_kelas','thn_ajaran.nama_thn_ajaran','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi');
        //                         // ->when(request()->input('nama_kelas'), function ($query) {
        //                         //     $query->where('kelas.nama_kelas', request()->input('nama_kelas'));
        //                         //   })
        //                         if ($request->has('nama_kelas')) {
        //                             $pengajuan->where('nama_kelas', $request->nama_kelas);
        //                         }
        //                         if ($request->has('nama_thn_ajaran')) {
        //                             $pengajuan->where('nama_thn_ajaran', $request->nama_thn_ajaran);
        //                         }
    
                            
        // if ( request()->has('search') && !empty(request()->get('search')) ) {
        //     $search = request()->query('search');
        //     $pengajuan->where(function ($query) use($search) {
        //         $query->where('nama_kelas', 'LIKE', "%{$search}%")
        //             ->orWhere('nama_thn_ajaran', 'LIKE', "%{$search}%");
                    
        //     });
        // }
        $kelas = $request->get('nama_kelas');
        $tahunajaran = $request->get('nama_thn_ajaran');

        return Excel::download(new PengajuanExport($kelas, $tahunajaran), 'Daftar Pengajuan PKL.xlsx');
    }

    public function create_file_pengajuan($id)
    {
        $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->find($id);

        /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
         
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('doc/template pengajuan PKL.docx'));
        $fileName_pengajuanPKL = $pengajuan['nis'] . '_' . $pengajuan['nama_siswa'] . '_Permohonan Pengajuan PKL.docx';
        $fileName_pengajuanPKLPDF = $pengajuan['nis'] . '_' . $pengajuan['nama_siswa'] . '_Permohonan Pengajuan PKL.pdf';
        // $filepath = public_path('storage/pengajuanPKL' . $fileName_pengajuanPKL);
        
        Carbon::setLocale('id');

        $today = Carbon::now()->isoFormat('D MMMM Y');
        
        $tanggalmulai = Carbon::parse($pengajuan->tanggal_mulai)->translatedFormat('d F Y');
        $tanggalselesai = Carbon::parse($pengajuan->tanggal_selesai)->translatedFormat('d F Y');

        $template->setValue('tanggal_sekarang', $today);
        $template->setValue('nama_dudi', $pengajuan->nama_dudi);
        $template->setValue('tanggal_mulai', $tanggalmulai);
        $template->setValue('tanggal_selesai', $tanggalselesai);
        $template->setValue('nama_siswa', $pengajuan->nama_siswa);
        $template->setValue('nis', $pengajuan->nis);
        $template->setValue('nisn', $pengajuan->nisn);
        $template->setValue('nama_kelas', $pengajuan->nama_kelas);

        $saveDocPath = public_path('storage/cetakpengajuanPKL/' . $fileName_pengajuanPKL);
        $template->saveAs($saveDocPath);

        

        //Load word file
        $Content = \PhpOffice\PhpWord\IOFactory::load($saveDocPath);
        // return $Content->stream();
 
        // //Save it into PDF
        // $savePdfPath = public_path('storage/cetakpengajuanPKL/' . $fileName_pengajuanPKLPDF);

        // /*@ If already PDF exists then delete it */
        // if ( file_exists($savePdfPath) ) {
        //     unlink($savePdfPath);
        // }

        // //Save it into PDF
        // $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
        // $PDFWriter->save($savePdfPath);

        // return response()->file($saveDocPath, [
        //     'Content-Type' => 'application/pdf'
        // ]);

        // return Response::download($savePdfPath);
        
        // /*@ Remove temporarily created word file */
        // if ( file_exists($saveDocPath) ) {
        //     unlink($saveDocPath);
        // }
        return Response::download($saveDocPath); 
        // return Response::download(public_path('storage/pengajuanPKL'), $fileName_pengajuanPKL); 
    }

    public function create_surat_pengantar($id)
    {
        $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->find($id);

        $kepalasekolah = Kepalasekolah::first();    

        $fileName_pengajuanPKLPDF = $pengajuan['nis'] . '_' . $pengajuan['nama_siswa'] . '_Permohonan Pengajuan PKL.pdf';

        $today = Carbon::now()->isoFormat('D MMMM Y');

        $tanggalmulai = Carbon::parse($pengajuan->tanggal_mulai)->translatedFormat('d F Y');
        $tanggalselesai = Carbon::parse($pengajuan->tanggal_selesai)->translatedFormat('d F Y');

        $data = [
            'tanggal_sekarang' => $today,
            'nama_dudi' => $pengajuan->nama_dudi,
            'tanggal_mulai' => $tanggalmulai,
            'tanggal_selesai' => $tanggalselesai,
            'nama_siswa' => $pengajuan->nama_siswa,
            'nis' => $pengajuan->nis,
            'nisn' => $pengajuan->nisn,
            'nama_kelas' => $pengajuan->nama_kelas,
            'jabatan' => $kepalasekolah->jabatan,
            'nama_kepsek' => $kepalasekolah->nama_kepsek,
            'pangkat_gol' => $kepalasekolah->pangkat_gol,
            'nip' => $kepalasekolah->nip
        ];
          
        $pdf = PDF::loadView('pengajuanPKL.suratpengantar', compact('pengajuan', 'kepalasekolah'), $data);
    
        // return $pdf->download($savePdfPath);
        return $pdf->stream($fileName_pengajuanPKLPDF);
    }

}   
