<?php

use App\Http\Controllers\PegawaiController;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route untuk menampilkan semua karyawan
Route::get('/employees', [PegawaiController::class, 'index']);

// route untuk menambahkan karyawan 
Route::post('/employees', [PegawaiController::class, 'store']);

//route untuk mengedit karyawan 
Route::put('/employees/{id}', [PegawaiController::class, 'update']);

// route show untuk menampilkan data karyawan secara spesifik
Route::get('/employees/{id}', [PegawaiController::class, 'show']);

// route delete untuk menghapus data karyawan
Route::delete('/employees/{id}', [PegawaiController::class, 'destroy']);

// route search untuk mencari nama karyawan 
Route::get('/employees/search/{name}', [PegawaiController::class, 'search']);

//route status untuk melihat karyawan yang masih aktif
Route::get('/employees/status/active', [PegawaiController::class, 'active']);

//route status dibawah melihat karyawan yang sudah tidak aktif
Route::get('/employees/status/inactive', [PegawaiController::class, 'inactive']);

//route status dibawah melihat karyawan yang sudah diberhentikan
Route::get('/employees/status/terminated', [PegawaiController::class, 'terminated']);
