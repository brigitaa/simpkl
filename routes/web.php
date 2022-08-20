<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\KepalasekolahController;
use App\Http\Controllers\ThnAjaranController;
use App\Http\Controllers\KeahlianController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KaprogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\KonfirmasiDUDIController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruMonitoringController;
use App\Http\Controllers\StatusPKLController;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\ProfilController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/register', function () {
    return view('register');

});

Route::get('/', function () {
    return view('login');
});



Route::post('/post-register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/post-login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('dashboard', DashboardController::class);
    Route::resource('profil', ProfilController::class);
    Route::resource('statusPKL', StatusPKLController::class);
    Route::resource('penempatanPKL', PenempatanController::class);
});

// Route::group(["prefix" => "dashboard", "middleware" => ['auth']], function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
// });

// Route::group(["middleware" => ['auth']], function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
//     Route::resource('profil', ProfilController::class);
// });

Route::group(['middleware' => ['auth','checkrole:Admin']], function(){
    
    Route::resource('datasiswaPKL', DataSiswaController::class);
    Route::get('/datasiswaPKL-impor', [DataSiswaController::class, 'impor'])->name('datasiswaPKL.impor');
    Route::get('/datasiswaPKL-downloadfile', [DataSiswaController::class, 'downloadfile'])->name('datasiswaPKL.downloadfile');
    Route::post('/datasiswaPKL-import', [DataSiswaController::class, 'import'])->name('datasiswaPKL.import');
    Route::resource('tahunajaran', ThnAjaranController::class);
    Route::resource('kompetensikeahlian', KeahlianController::class);
    Route::get('/kompetensikeahlian-getdata', [KeahlianController::class, 'get_data_keahlian'])->name('kompetensikeahlian.get_data_keahlian');
    Route::resource('kelas', KelasController::class);
    Route::resource('kaprog', KaprogController::class);
    Route::resource('manajemenuser', UserController::class);
    Route::resource('kepalasekolah', KepalasekolahController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('gurumonitoring', GuruMonitoringController::class);
});

Route::group(['middleware' => ['auth','checkrole:Admin,Ketua Pokja PKL']], function(){
    Route::resource('periode', PeriodeController::class);
    Route::resource('dudi', DudiController::class);
}); 

Route::group(['middleware' => ['auth','checkrole:Ketua Pokja PKL,Kaprog,Tata Usaha']], function(){
    Route::get('/datasiswaPKL-index', [DataSiswaController::class, 'lihat'])->name('datasiswaPKL.lihat');
}); 

Route::group(['middleware' => ['auth','checkrole:Admin,Ketua Pokja PKL,Kaprog,Tata Usaha']], function(){
    Route::get('/pengajuanPKL-index', [PengajuanController::class, 'lihat'])->name('pengajuanPKL.lihat');
    Route::get('/pengajuanPKL-lihatdetail/{id}', [PengajuanController::class, 'showdetail'])->name('pengajuanPKL.showdetail');
    Route::get('/pengajuanPKL-ekspor', [PengajuanController::class, 'ekspor'])->name('pengajuanPKL.ekspor');
    Route::get('/pengajuanPKL-filter', [PengajuanController::class, 'filter_data'])->name('pengajuanPKL.filter_data');
    Route::get('/konfirmasidudi-index', [KonfirmasiDUDIController::class, 'lihat'])->name('konfirmasidudi.lihat');
    Route::get('/konfirmasidudi/{id}/edit', [KonfirmasiDUDIController::class, 'edit'])->name('konfirmasidudi.edit');
    Route::put('/konfirmasidudi/{id}/update', [KonfirmasiDUDIController::class, 'update'])->name('konfirmasidudi.update');
    
}); 

Route::group(['middleware' => ['auth','checkrole:Siswa']], function(){
    // Route::get('/dudi-index', [DudiController::class, 'lihat'])->name('dudi.lihat');
    // Route::get('/dudi-create', [DudiController::class, 'create'])->name('dudi.create_dudisiswa');
    // Route::post('/dudi-store', [DudiController::class, 'store'])->name('dudi.store_dudisiswa');
    Route::resource('pengajuanPKL', PengajuanController::class);
    Route::get('get/periode/{id}', [PengajuanController::class, 'getPeriode'])->name('getPeriode');
    Route::get('get/dudi/{id}', [PengajuanController::class, 'getDudi'])->name('getDudi');
    Route::get('/pengajuanPKL-pernyataanortu', [PengajuanController::class, 'pernyataanortu'])->name('pengajuanPKL.pernyataanortu');
    Route::get('/pengajuanPKL-pernyataansiswa', [PengajuanController::class, 'pernyataansiswa'])->name('pengajuanPKL.pernyataansiswa');
    Route::get('/pengajuanPKL-filepernyataanortu/{id}', [PengajuanController::class, 'file_pernyataanortu'])->name('pengajuanPKL.file_pernyataanortu');
    Route::get('/pengajuanPKL-filepernyataansiswa/{id}', [PengajuanController::class, 'file_pernyataansiswa'])->name('pengajuanPKL.file_pernyataansiswa');
    // Route::resource('konfirmasidudi', KonfirmasiDUDIController::class);
    Route::get('/konfirmasidudi', [KonfirmasiDUDIController::class, 'index'])->name('konfirmasidudi.index');
    Route::get('/konfirmasidudi/create', [KonfirmasiDUDIController::class, 'create'])->name('konfirmasidudi.create');
    Route::post('/konfirmasidudi/store', [KonfirmasiDUDIController::class, 'store'])->name('konfirmasidudi.store');
    Route::get('get/pengajuan/{id}', [KonfirmasiDUDIController::class, 'getPengajuan'])->name('getPengajuan');
    Route::get('/konfirmasidudi-filebalasandudi/{id}', [KonfirmasiDUDIController::class, 'file_balasandudi'])->name('konfirmasidudi.file_balasandudi');
}); 

Route::group(['middleware' => ['auth','checkrole:Ketua Pokja PKL']], function(){
    Route::post('/pengajuanPKL-approvepokja/{id}', [PengajuanController::class, 'terima_pengajuan_pokja'])->name('pengajuanPKL.terima_pengajuan_pokja');
    Route::post('/pengajuanPKL-rejectpokja/{id}', [PengajuanController::class, 'tolak_pengajuan_pokja'])->name('pengajuanPKL.tolak_pengajuan_pokja');
    Route::post('/pengajuanPKL-cancelpokja/{id}', [PengajuanController::class, 'batal_pengajuan_pokja'])->name('pengajuanPKL.batal_pengajuan_pokja');
}); 

Route::group(['middleware' => ['auth','checkrole:Kaprog']], function(){
    Route::post('/pengajuanPKL-approvekaprog/{id}', [PengajuanController::class, 'terima_pengajuan_kaprog'])->name('pengajuanPKL.terima_pengajuan_kaprog');
    Route::post('/pengajuanPKL-rejectkaprog/{id}', [PengajuanController::class, 'tolak_pengajuan_kaprog'])->name('pengajuanPKL.tolak_pengajuan_kaprog');
    Route::post('/pengajuanPKL-cancelkaprog/{id}', [PengajuanController::class, 'batal_pengajuan_kaprog'])->name('pengajuanPKL.batal_pengajuan_kaprog');
}); 

Route::group(['middleware' => ['auth','checkrole:Tata Usaha']], function(){
    Route::get('/pengajuanPKL-cetak/{id}', [PengajuanController::class, 'create_file_pengajuan'])->name('pengajuanPKL.create_file_pengajuan');
    Route::get('/pengajuanPKL-cetakPDF/{id}', [PengajuanController::class, 'create_surat_pengantar'])->name('pengajuanPKL.create_surat_pengantar');
    Route::get('/contohsurat', function () {
        return view('pengajuanPKL.contohsurat');
    
    });
}); 

// Route::get('/datasiswaPKL', function () {
//     return view('datasiswaPKL.index');

// });

// Route::get('/tambahsiswaPKL', function () {
//     return view('datasiswaPKL.tambah');

// });