<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\ThnAjaranController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('login');

});

Route::get('/register', function () {
    return view('register');

});

Route::post('/post-register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/post-login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('dashboard', DashboardController::class);
});

Route::group(['middleware' => ['auth','checkrole:Admin']], function(){
    Route::resource('datasiswaPKL', DataSiswaController::class);
    Route::get('/datasiswaPKL-impor', [DataSiswaController::class, 'impor'])->name('datasiswaPKL.impor');
    Route::get('/datasiswaPKL-downloadfile', [DataSiswaController::class, 'downloadfile'])->name('datasiswaPKL.downloadfile');
    Route::post('/datasiswaPKL-import', [DataSiswaController::class, 'import'])->name('datasiswaPKL.import');
    Route::resource('tahunajaran', ThnAjaranController::class);
    Route::resource('manajemenuser', UserController::class);
});

Route::group(['middleware' => ['auth','checkrole:Ketua Pokja PKL,Kaprog,Tata Usaha']], function(){
    Route::get('/datasiswaPKL-index', [DataSiswaController::class, 'lihat'])->name('datasiswaPKL.lihat');
}); 




// Route::get('/datasiswaPKL', function () {
//     return view('datasiswaPKL.index');

// });

// Route::get('/tambahsiswaPKL', function () {
//     return view('datasiswaPKL.tambah');

// });