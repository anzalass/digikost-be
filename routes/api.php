<?php

use App\Http\Controllers\KategoriesController;
use App\Http\Controllers\PengadaanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Database Pengadaan
Route::get('pengadaan',[PengadaanController::class, 'index']);
Route::get('findPengadaan/{id}',[PengadaanController::class, 'FindPengadaan']);
Route::post('tambahPengadaan',[PengadaanController::class, 'TambahPengadaan']);
Route::put('updatePengadaan/{id}', [PengadaanController::class, 'UpdatePengadaan']);
Route::delete('pengadaanDelete/{id}',[PengadaanController::class, 'DeletePengadaan']);

//Database Kategori
Route::get('getKategori',[KategoriesController::class, 'index']);
Route::get('findKategori/{kodeBarang}/{namaBarang}',[KategoriesController::class, 'FindKategori']);
Route::put('updateKategori/{kodeBarang}', [KategoriesController::class, 'UpdateKategori']);
Route::post('tambahKategori',[KategoriesController::class, 'TambahKategori']);
Route::delete('kategoriDelete/{kodeBarang}',[KategoriesController::class, 'DeleteKategori']);