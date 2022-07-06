<?php

use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\BookFeeController;
use App\Http\Controllers\StudentController;
use App\Models\Student;
use App\Models\Kelas;
use Illuminate\Support\Facades\Route;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PetugasSpp;
use App\Http\Controllers\BookListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagihanController;
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
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function() {
 Route::get("/redirectAuthenticatedUsers", [RedirectAuthenticatedUsersController::class, "home"]);

//Admin
Route::get('admin/', [DashboardController::class,'adminDashboard'])->name('admin.index');
Route::resource('/admin/students', StudentController::class);
Route::post('delete-student', [StudentController::class,'destroy']);
Route::post('/admin/students/import', function () {
    Excel::import(new StudentImport, request()->file('student-excel'));
    return redirect('/admin/students/')->with('success', 'Berhasil mengimpor data!');
})->name('students.import');

//Kelas
Route::resource('/admin/classes', KelasController::class);
Route::post('delete-class', [KelasController::class,'destroy']);

//User
Route::resource('/admin/users', UserController::class);

// Role SPP
Route::prefix('komite')->group(function(){
    Route::get('/', [PetugasSpp\SppController::class,'sppDashboard'])->name('spp.index');

    //Pembayaran SPP
    Route::get('pembayaran/', [PetugasSpp\SppController::class,'index'])->name('spp.pembayaran.index');
    Route::get('pembayaran/tambah-pembayaran/{nisn}', [PetugasSpp\SppController::class,'createBayar'])->name('spp.pembayaran.create');
    Route::post('pembayaran/tambah-pembayaran/', [PetugasSpp\SppController::class,'storeBayar'])->name('spp.pembayaran.store');
    Route::get('pembayaran/get-kelas', [PetugasSpp\SppController::class,'getKelas'])->name('spp.pembayaran.getKelas');
    Route::get('pembayaran/get-nominal', [PetugasSpp\SppController::class,'getNominal'])->name('spp.pembayaran.getNominal');

    //Status Pembayaran
    Route::get('pembayaran/status-pembayaran/', [PetugasSpp\SppController::class,'statusIndex'])->name('spp.status.index');
    Route::get('pembayaran/status-pembayaran/detail/{id}', [PetugasSpp\SppController::class,'statusShow'])->name('spp.status.show');
    Route::delete('pembayaran/status-pembayaran/{id}', [PetugasSpp\SppController::class,'statusDestroy'])->name('spp.status.destroy');

    //Riwayat Pembayaran
    Route::get('riwayat-pembayaran/', [PetugasSpp\SppController::class,'riwayatIndex'])->name('spp.riwayat.index');
    
    //Daftar nominal SPP
    Route::get('daftar-komite/', [PetugasSpp\SppController::class,'daftarSppIndex'])->name('spp.daftar.index');
    Route::get('daftar-komite/tambah-komite', [PetugasSpp\SppController::class,'daftarSppCreate'])->name('spp.daftar.create');
    Route::post('daftar-komite/tambah-komite', [PetugasSpp\SppController::class,'daftarSppStore'])->name('spp.daftar.store');
    Route::get('daftar-komite/edit/{id}', [PetugasSpp\SppController::class,'daftarSppEdit'])->name('spp.daftar.edit');
    Route::put('daftar-komite/edit/{id}', [PetugasSpp\SppController::class,'daftarSppUpdate'])->name('spp.daftar.update');
    Route::post('daftar-komite/delete-spp', [PetugasSpp\SppController::class,'daftarSppDestroy'])->name('spp.daftar.destroy');


    //Export to Excel
    Route::get('riwayat-pembayaran/export-excel/', [PetugasSpp\SppController::class,'createExportExcel'])->name('spp.export.excel.create');
    Route::get('export-excel', [PetugasSpp\SppController::class,'exportExcel'])->name('spp.export.excel');
});

Route::prefix('buku')->group(function() {
    Route::get('/', [DashboardController::class,'bukuDashboard'])->name('buku.index');

    //Daftar Buku
    Route::get('daftar-buku/', [BookListController::class,'index'])->name('buku.daftar.index');
    Route::get('daftar-buku/tambah-buku', [BookListController::class,'create'])->name('buku.daftar.create');
    Route::post('daftar-buku/tambah-buku', [BookListController::class,'store'])->name('buku.daftar.store');
    Route::get('daftar-buku/edit/{id}', [BookListController::class,'edit'])->name('buku.daftar.edit');
    Route::post('daftar-buku/edit/{id}', [BookListController::class,'update'])->name('buku.daftar.update');
    Route::post('daftar-buku/delete-buku', [BookListController::class,'destroy'])->name('buku.daftar.destroy');

    //Tagihan Buku
    Route::get('tagihan-buku/', [TagihanController::class,'index'])->name('tagihan-buku.index');
    Route::get('tagihan-buku/detail/{id}', [TagihanController::class,'show'])->name('tagihan-buku.show');
    Route::get('tagihan-buku/tambah-tagihan/{nisn}', [TagihanController::class,'create'])->name('tagihan-buku.create');
    Route::post('tagihan-buku/tambah-tagihan/', [TagihanController::class,'store'])->name('tagihan-buku.store');

    //Update Tagihan
    Route::post('tagihan-buku/detail/{id}', [TagihanController::class,'update'])->name('tagihan-buku.update');

    //Riwayat Pembayaran
    Route::get('riwayat-pembayaran/', [TagihanController::class,'riwayatIndex'])->name('tagihan-buku.riwayat.index');
});
});