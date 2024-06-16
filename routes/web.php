<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('index');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('registerPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('admin/detailJadwal/{id}', [AuthController::class, 'detailJadwal'])->name('detailJadwal');
Route::get('admin/jadwalSempro/{id}', [AuthController::class, 'jadwalSempro'])->name('jadwalSempro');
Route::get('/cetakKartu/{id}', [AuthController::class, 'cetakKartu'])->name('cetakKartu');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Routes for admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/admin/dosen', [AdminController::class, 'dosen'])->name('admin.dosen');
    Route::post('/admin/addDosen', [AdminController::class, 'addDosen'])->name('admin.addDosen');
    Route::post('/admin/updateDosen', [AdminController::class, 'updateDosen'])->name('admin.updateDosen');
    Route::get('/admin/deleteDosen/{id}', [AdminController::class, 'deleteDosen'])->name('admin.deleteDosen');
    
    Route::get('/admin/prodi', [AdminController::class, 'prodi'])->name('admin.prodi');
    Route::post('/admin/addProgramStudi', [AdminController::class, 'addProgramStudi'])->name('admin.addProgramStudi');
    Route::post('/admin/updateProgramStudi', [AdminController::class, 'updateProgramStudi'])->name('admin.updateProgramStudi');
    Route::get('/admin/delete-program-studi/{id}', [AdminController::class, 'deleteProgramStudi'])->name('admin.deleteProgramStudi');
    
    Route::get('/admin/kaprodi', [AdminController::class, 'kaprodi'])->name('admin.kaprodi');
    Route::post('/admin/updateKaprodi', [AdminController::class, 'updateKaprodi'])->name('admin.updateKaprodi');
    Route::post('/admin/addkaprodi', [AdminController::class, 'addkaprodi'])->name('admin.addKaprodi');
    Route::get('/admin/deleteKaprodi/{id}', [AdminController::class, 'deleteKaprodi'])->name('admin.deleteKaprodi');
    
    
    Route::get('/admin/mahasiswa', [AdminController::class, 'mahasiswa'])->name('admin.mahasiswa');
    Route::get('/admin/reset-password/{id}', [AdminController::class, 'resetPassword'])->name('admin.resetPassword');

    Route::get('/admin/Pengajuan/', [AdminController::class, 'pengajuan'])->name('admin.pengajuan');
    Route::post('/admin/createJadwal/', [AdminController::class, 'createJadwal'])->name('admin.createJadwal');
    Route::get('/admin/jadwal/', [AdminController::class, 'jadwal'])->name('admin.jadwal');

    // Add more admin routes here
});

Route::group(['middleware' => ['auth', 'role:kaprodi']], function () {
    // Routes for kaprodi
    Route::get('/kaprodi', [KaprodiController::class, 'index'])->name('kaprodi.dashboard');
    Route::get('/kaprodi/pengajuan', [KaprodiController::class, 'pengajuan'])->name('kaprodi.pengajuan');

    Route::post('/kaprodi/updateStatus', [KaprodiController::class, 'updateStatus'])->name('kaprodi.updateStatus');
    // Add more kaprodi routes here
});

Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
    // Routes for mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/pengajuan-judul', [MahasiswaController::class, 'pengajuan'])->name('mahasiswa.pengajuan');
    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile');
    
    Route::post('/mahasiswa/pengajuanPost', [MahasiswaController::class, 'pengajuanPost'])->name('mahasiswa.pengajuanPost');
    Route::post('/mahasiswa/updatePengajuan', [MahasiswaController::class, 'updatePengajuan'])->name('mahasiswa.updatePengajuan');
    // Add more mahasiswa routes here
    Route::get('/mahasiswa/bimbingan', [MahasiswaController::class, 'bimbingan'])->name('mahasiswa.bimbingan');
    Route::post('/mahasiswa/addBimbingan', [MahasiswaController::class, 'addBimbingan'])->name('mahasiswa.addBimbingan');
    Route::post('/mahasiswa/updateBimbingan', [MahasiswaController::class, 'updateBimbingan'])->name('mahasiswa.updateBimbingan');
    Route::get('/mahasiswa/deleteBimbingan/{id}', [MahasiswaController::class, 'deleteBimbingan'])->name('mahasiswa.deleteBimbingan');
    
    Route::post('/mahasiswa/updateMahasiswa', [MahasiswaController::class, 'updateMahasiswa'])->name('mahasiswa.updateMahasiswa');
});
