<?php

use App\Http\Controllers\ImexController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SetbiayaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KenaikanKelasController;
use App\Http\Controllers\SiswaKelasController;

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth', 'checkRole:Admin'])->group(function () {

    Route::resource('siswa', SiswaController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);

    Route::post('spp/set', [SetbiayaController::class, 'set']);
    Route::get('/siswabaru', [SiswaKelasController::class, 'index']);
    Route::post('/siswabaru', [SiswaKelasController::class, 'update']);

    Route::get('/kenaikankelas', [KenaikanKelasController::class, 'index']);
    Route::patch('/update', [KenaikanKelasController::class, 'update']);

    Route::post('/import', [ImexController::class, 'import_data']);
    Route::get('/export', [ImexController::class, 'export_data']);

    Route::resource('user', UserController::class);

    Route::get('/pesan', [TelegramController::class, 'pesan']);
    Route::post('/pesan-kirim', [TelegramController::class, 'kirimPesan']);
    Route::post('/kirim-foto', [TelegramController::class, 'kirimFoto']);
});

Route::middleware(['auth', 'checkRole:Admin,TU'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/pembayaran', [PembayaranController::class, 'index']);
    Route::patch('/pembayaran/{bayar:id}/bayar', [PembayaranController::class, 'update']);
    Route::get('/pembayaran/{bayar:sppid}/{siswa:siswaid}/bulanan', [PembayaranController::class, 'show']);
    Route::put('/pembayaran/{batal:id}/batal', [PembayaranController::class, 'batal']);


    Route::get('/pembayaran/{batal:id}/chat', [PembayaranController::class, 'kirimchat']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/datalaporan', [LaporanController::class, 'cekdata']);
});

Route::middleware(['auth', 'checkRole:Admin,TU,Siswa'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/tentang', [HomeController::class, 'tentang']);
    Route::get('/{sppid}/{siswaid}/show', [HomeController::class, 'show']);
    Route::get('/pembayaran/{batal:id}/print', [PembayaranController::class, 'print']);

    Route::get('/gantipassword', [GantiPasswordController::class, 'index']);
    Route::patch('/gantipassword', [GantiPasswordController::class, 'update']);
});
