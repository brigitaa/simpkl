<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Siswa;
use App\Models\Dudi;
use App\Models\Pengajuan;
use App\Models\Konfirmasi_dudi;
use App\Models\Penempatan;
use App\Models\Kaprog;
use App\Models\Periode;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periode = Periode::all();

        if (!$request->all() || ($request->tanggal_mulai == '')){
            $siswa = Siswa::all()->count();
            $dudi = Dudi::all()->count();
            $totalpengajuan = Pengajuan::all()->count();
            $ps = Pengajuan::where('status_verif_pokja', '=', 'Disetujui')
                            ->where('status_verif_kaprog', '=','Disetujui')
                            ->count();
            $pspokja = Pengajuan::where('status_verif_pokja', '=', 'Disetujui')->count();

            $konfirmasidudi = Konfirmasi_dudi::all()->count();
            $kds = Konfirmasi_dudi::where('status', '=', 'Disetujui')
                                    ->count();
            $kdt = Konfirmasi_dudi::where('status', '=', 'Ditolak')
                                    ->count();
                                            
            $penempatan = Penempatan::all()->count();
            $pbt = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                             ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                             ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                             ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                             ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                             ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                             ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                             ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                             ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                             ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                             ->where('nama_status_pkl', '=', 'Belum terlaksana')
                             ->count();

            $psb = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                             ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                             ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                             ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                             ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                             ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                             ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                             ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                             ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                             ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                             ->where('nama_status_pkl', '=', 'Sedang berlangsung')
                             ->count();

            $pst = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                             ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                             ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                             ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                             ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                             ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                             ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                             ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                             ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                             ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                             ->where('nama_status_pkl', '=', 'Sudah terlaksana')
                             ->count();
        }
        
        else {
            $siswa = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                ->distinct()
                                ->count('siswa_id');

            $dudi = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                ->distinct()
                                ->count('dudi_id');

            $totalpengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                            ->count();
            
                                                      
            $ps = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                            ->where('status_verif_pokja', '=', 'Disetujui')
                            ->where('status_verif_kaprog', '=','Disetujui')
                            ->count();

            $pspokja = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                            ->where('status_verif_pokja', '=', 'Disetujui')
                            ->count();

            $konfirmasidudi = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                             ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                             ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                             ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                             ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                             ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                             ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                             ->count();

            $kds = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                    ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                    ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                    ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                    ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                    ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                    ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                    ->where('status', '=', 'Disetujui')
                                    ->count();

            $kdt = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                    ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                    ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                    ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                    ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                    ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                    ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                    ->where('status', '=', 'Ditolak')
                                    ->count();
                                            
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
                                    ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                    ->count();
                                    
            $pbt = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                             ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                             ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                             ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                             ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                             ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                             ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                             ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                             ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                             ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                             ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                             ->where('nama_status_pkl', '=', 'Belum terlaksana')
                             ->count();

            $psb = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                             ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                             ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                             ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                             ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                             ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                             ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                             ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                             ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                             ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                             ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                             ->where('nama_status_pkl', '=', 'Sedang berlangsung')
                             ->count();

            $pst = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                             ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                             ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                             ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                             ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                             ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                             ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                             ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                             ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                             ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                             ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                             ->where('nama_status_pkl', '=', 'Sudah terlaksana')
                             ->count();
        }

        return view('dashboard.index', compact('periode','siswa', 'dudi', 'totalpengajuan', 'ps', 'pspokja', 'konfirmasidudi', 'kds', 'kdt', 'penempatan', 'pbt', 'psb', 'pst'));
    }

    public function kaprog(Request $request)
    {
        $datakaprog = Kaprog::where('users_id', Auth::user()->id)->first();
        $periode = Periode::all();

        if (!$request->all() || ($request->tanggal_mulai == '')){
            $siswa = Siswa::leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                        ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                        ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                        ->count();

            $totalpengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->count();

            $pskaprog = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('status_verif_kaprog', '=','Disetujui')
                                ->count();

            $totalkd = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->count();

            $kds = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('status', '=', 'Disetujui')
                                ->count();

            $kdt = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('status', '=', 'Ditolak')
                                ->count();
                                            
            $totalpenempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                    ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                    ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                    ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                    ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                    ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                    ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                    ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                    ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                    ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                    ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                    ->count();

            $pbt = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                            ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                            ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                            ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_status_pkl', '=', 'Belum terlaksana')
                            ->count();

            $psb = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                            ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                            ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                            ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_status_pkl', '=', 'Sedang berlangsung')
                            ->count();

            $pst = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                            ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                            ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                            ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_status_pkl', '=', 'Sudah terlaksana')
                            ->count();
        }

        else {
            $siswa = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->distinct()
                                ->count('siswa_id');

            $totalpengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->count();

            $pskaprog = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('status_verif_kaprog', '=','Disetujui')
                                ->count();

            $totalkd = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->count();

            $kds = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('status', '=', 'Disetujui')
                                ->count();

            $kdt = Konfirmasi_dudi::leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                ->where('status', '=', 'Ditolak')
                                ->count();
                                            
            $totalpenempatan = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                                    ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                                    ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                                    ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                                    ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                                    ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                                    ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                                    ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                                    ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                                    ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                                    ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                                    ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                                    ->count();

            $pbt = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                            ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                            ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                            ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                            ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_status_pkl', '=', 'Belum terlaksana')
                            ->count();

            $psb = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                            ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                            ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                            ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                            ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_status_pkl', '=', 'Sedang berlangsung')
                            ->count();

            $pst = Penempatan::leftjoin('konfirmasi_dudi', 'konfirmasi_dudi.id', 'penempatan.konfirmasi_dudi_id')
                            ->leftjoin('pengajuan', 'pengajuan.id', 'konfirmasi_dudi.pengajuan_id')
                            ->leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                            ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                            ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                            ->leftjoin('kelas', 'kelas.kode_kelas', 'siswa.kode_kelas')
                            ->leftjoin('thn_ajaran', 'thn_ajaran.kode_thn_ajaran', 'siswa.kode_thn_ajaran')
                            ->leftjoin('guru_monitoring', 'guru_monitoring.id', 'penempatan.guru_monitoring_id')
                            ->leftjoin('guru', 'guru.id', 'guru_monitoring.guru_id')
                            ->leftjoin('status_pkl', 'status_pkl.id', 'penempatan.status_pkl_id')
                            ->where('tanggal_mulai', '=', $request->tanggal_mulai)
                            ->where('kompetensi_keahlian_id', $datakaprog->kompetensi_keahlian_id)
                            ->where('nama_status_pkl', '=', 'Sudah terlaksana')
                            ->count();
        }

        return view('dashboard.kaprog', compact('periode', 'siswa', 'totalpengajuan', 'pskaprog', 'totalkd', 'kds', 'kdt', 'totalpenempatan', 'pbt', 'psb', 'pst'));
    }

    public function siswa()
    {
        $pengajuan = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('users_id', Auth::user()->id)
                        ->count();

        $pspokja = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('users_id', Auth::user()->id)
                        ->where('status_verif_pokja', '=','Disetujui')
                        ->count();

        $pskaprog = Pengajuan::leftjoin('siswa', 'siswa.id', 'pengajuan.siswa_id')
                        ->leftjoin('periode', 'periode.id', 'pengajuan.periode_id')
                        ->leftjoin('dudi', 'dudi.id', 'pengajuan.dudi_id')
                        ->select('pengajuan.*','siswa.nis','siswa.nisn','siswa.nama_siswa','periode.tanggal_mulai','periode.tanggal_selesai','dudi.nama_dudi')
                        ->where('users_id', Auth::user()->id)
                        ->where('status_verif_kaprog', '=','Disetujui')
                        ->count();

        return view('dashboard.siswa', compact('pengajuan', 'pspokja', 'pskaprog'));
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
