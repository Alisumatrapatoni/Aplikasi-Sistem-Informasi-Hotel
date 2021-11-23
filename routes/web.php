<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PengunjungController;

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
    $jumlahpegawai = Employee::count();
    $jumlahpegawaicowo = Employee::where('jeniskelamin', 'cowo')->count();
    $jumlahpegawaicewe = Employee::where('jeniskelamin', 'cewe')->count();

    return view('welcome', compact('jumlahpegawai', 'jumlahpegawaicowo', 'jumlahpegawaicewe'));
})->middleware('auth');

Route::get('/pegawai', [EmployeeController::class, 'index']) -> name('pegawai')->middleware('auth');

Route::get('/tambahpegawai', [EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');

Route::post('/insertdatapegawai', [EmployeeController::class, 'insertdatapegawai'])->name('insertdatapegawai');

Route::get('/tampilkandatapegawai/{id}', [EmployeeController::class, 'tampilkandatapegawai'])->name('tampilkandatapegawai');

Route::post('/upadatedatapegawai/{id}', [EmployeeController::class, 'updatedatapegawai'])->name('updatedatapegawai');

Route::get('/deletedatapegawai/{id}', [EmployeeController::class, 'deletedatapegawai'])->name('deletedatapegawai');
//export pdf
Route::get('/exportpdfdatapegawai', [EmployeeController::class, 'exportpdfdatapegawai'])->name('/exportpdfdatapegawai');
//export excel
Route::get('/exportexceldatapegawai', [EmployeeController::class, 'exportexceldatapegawai'])->name('/exportexceldatapegawai');
//import exccel
Route::post('/importexceldatapegawai', [EmployeeController::class, 'importexceldatapegawai'])->name('/importexceldatapegawai');




Route::get('/kamar', [KamarController::class, 'index' ]) -> name('kamar')->middleware('auth');

Route::get('/tambahkamar', [KamarController::class, 'tambahkamar'])->name('tambahkamar');

Route::post('/insertdatakamar', [KamarController::class, 'insertdatakamar'])->name('insertdatakamar');

Route::get('/tampilkandatakamar/{id}', [KamarController::class, 'tampilkandatakamar'])->name('tampilkandatakamar');

Route::post('/upadatedatakamar/{id}', [KamarController::class, 'updatedatakamar'])->name('updatedatakamar');

Route::get('/deletedatakamar/{id}', [KamarController::class, 'deletedatakamar'])->name('deletedatakamar');
//export pdf data kamar
Route::get('/exportpdfdatakamar', [KamarController::class, 'exportpdfdatakamar'])->name('/exportpdfdatakamar');
//export excel
Route::get('/exportexceldatakamar', [KamarController::class, 'exportexceldatakamar'])->name('/exportexceldatakamar');




Route::get('/pengunjung', [PengunjungController::class, 'index']) -> name('pengunjung')->middleware('auth');

Route::get('/tambahpengunjung', [PengunjungController::class, 'tambahpengunjung'])->name('tambahpengunjung');

Route::post('/insertdatapengunjung', [PengunjungController::class, 'insertdatapengunjung'])->name('insertdatapengunjung');

Route::get('/tampilkandatapengunjung/{noktp}', [PengunjungController::class, 'tampilkandatapengunjung'])->name('tampilkandatapengunjung');

Route::post('/updatedatapengunjung/{noktp}', [PengunjungController::class, 'updatedatapengunjung'])->name('updatedatapengunjung');

Route::get('/deletedatapengunjung/{noktp}', [PengunjungController::class, 'deletedatapengunjung'])->name('deletedatapengunjung');
//export pdf data pengunjung
Route::get('/exportpdfdatapengunjung', [PengunjungController::class, 'exportpdfdatapengunjung'])->name('/exportpdfdatapengunjung');
//export excel
Route::get('/exportexceldatapengunjung', [PengunjungController::class, 'exportexceldatapengunjung'])->name('/exportexceldatapengunjung');





Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');




Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');




Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
