<?php

use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultController;                                   
use Illuminate\Support\Facades\Route;

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
Route::fallback(function () {
    return view('errors.404');
});
Route::middleware('IsGuest')->group(function(){

    // ketika akses pertama kali yang dimunculkan halaman login
    Route::get('/', function () {
        return view('login');
    })->name('login');
    // menangani proses submit login
    Route::post('/login',[UserController::class, 'authLogin'] )->name('auth-login');
    
    
});
// Route::get('/login', function () {
//     return view('login');
// });


// setelah login
Route::middleware('IsLogin')->group(function(){

    Route::fallback(function () {
        return view('errors.404');
    });
Route::get('/logout',[UserController::class, 'logout'] )->name('auth-logout');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

// prrefix : awalan (mengelompokkan url path sesuai dengan fiturnya)
// name prefix : awalan name route pad akelompok url path
// group : mengelompokkan url path
// ::get -> menampilkan halaman, ::post-> menambah data ke db, ::patch -> mengubah data ke db, ::delete -> menghapus data ke db
// NamaController::class, 'namafunction'
// name() -> nama route yg dipanggil di href/action

Route::middleware('IsStaff')->group(function(){
    Route::prefix('/error')->name('error.')->group(function() {
        Route::get('/permission', [UserController::class, 'permission'])->name('data');
    });
    
    Route::prefix('/user')->name('user.')->group(function() {
        Route::get('/data', [UserController::class, 'index'])->name('data');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/user_data', [UserController::class, 'user_data'])->name('user_data');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}',[UserController::class, 'update'])->name('update');
        Route::delete('delete/{id}',[UserController::class, 'destroy'])->name('delete');
        Route::get('/search',[UserController::class,'search'])->name('search');

        // Route::get('/data/stock',[MedicineController::class, 'stockData'])->name('data.stock');
        // Route::get('/{id}',[MedicineController::class, 'show'])->name('show');
    });
    Route::prefix('/guru')->name('guru.')->group(function() {
        Route::get('/index', [UserController::class, 'indexGuru'])->name('index');
        Route::get('/createGuru', [UserController::class, 'createGuru'])->name('create');
        Route::post('/guru_data', [UserController::class, 'guru_data'])->name('guru_data');
        Route::get('/edit/{id}', [UserController::class, 'editGuru'])->name('edit');
        Route::patch('/update/{id}',[UserController::class, 'updateGuru'])->name('update');
        Route::delete('delete/{id}',[UserController::class, 'destroy'])->name('delete');
        Route::get('/search',[UserController::class,'searchGuru'])->name('search');

        // Route::get('/data/stock',[MedicineController::class, 'stockData'])->name('data.stock');
        // Route::get('/{id}',[MedicineController::class, 'show'])->name('show');
    });
    Route::prefix('/staff/letter_type')->name('staff.letter_type.')->group(function() {
        Route::get('/', [LetterTypeController::class, 'data'])->name('data');
        Route::get('/downloadExcel', [LetterTypeController::class, 'downloadExcel'])->name('downloadExcel');
    });
    Route::prefix('/letter/letters')->name('letter.letters.')->group(function() {
        Route::get('/', [LetterController::class, 'data'])->name('data');
        Route::get('/downloadExcel', [LetterController::class, 'downloadExcel'])->name('downloadExcel');
    });
    Route::prefix('/letter_type')->name('letter_type.')->group(function() {
        Route::get('/', [LetterTypeController::class, 'index'])->name('index');
        // Route::get('/dashboard', [LetterTypeController::class, 'dashboard'])->name('dashboard');
        Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
        Route::post('/letter_type_data', [LetterTypeController::class, 'letter_type_data'])->name('letter_type_data');
        Route::get('/edit/{id}', [LetterTypeController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}',[LetterTypeController::class, 'update'])->name('update');
        Route::delete('delete/{id}',[LetterTypeController::class, 'destroy'])->name('delete');
        Route::get('/detail/{id}',[LetterTypeController::class,'letter_detail'])->name('letter_detail');
        // Route::get('/download-pdf/{id}',[LetterTypeController::class,'downloadPDF'])->name('download-pdf');
        // Route::get('/data/stock',[MedicineController::class, 'stockData'])->name('data.stock');
        // Route::get('/{id}',[MedicineController::class, 'show'])->name('show');

    });
    Route::prefix('/letter')->name('letter.')->group(function() {
        Route::get('/index', [LetterController::class, 'index'])->name('index');
        Route::get('/create', [LetterController::class, 'create'])->name('create');
        Route::post('/letter_data', [LetterController::class, 'letter_data'])->name('letter_data');
        Route::get('/edit/{id}', [LetterController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}',[LetterController::class, 'update'])->name('update');
        Route::delete('delete/{id}',[LetterController::class, 'destroy'])->name('delete');
        Route::get('/data/stock',[LetterController::class, 'stockData'])->name('data.stock');
        Route::get('/{id}',[LetterController::class, 'show'])->name('show');
        Route::get('/detail/{id}',[LetterController::class,'letter_detail'])->name('letter_detail');
        Route::get('/rapat/{id}',[LetterController::class,'rapat'])->name('rapat');
        Route::get('/download-pdf/{id}',[LetterController::class,'downloadPDF'])->name('download-pdf');
        
        Route::get('/downloadExcel', [LetterController::class, 'downloadExcel'])->name('downloadExcel');

        // Route::patch('/stock/update/{id}',[LetterController::class, 'updateStock'])->name('stock.update');
    });
});

Route::middleware('IsGuru')->group(function(){
    Route::prefix('/result')->name('result.')->group(function(){
        Route::get('/',[ResultController::class, 'index'])->name('index');
        Route::get('/create/{id}',[ResultController::class,'create'])->name('create');
        Route::post('/result_data',[ResultController::class,'result_data'])->name('result_data');
        Route::get('/edit/{id}', [ResultController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}',[ResultController::class, 'update'])->name('update');
        Route::get('/detail/{id}',[ResultController::class,'result_detail'])->name('result_detail');

        // Route::get('/struk/{id}',[ResultController::class,'strukPembelian'])->name('struk');
        Route::get('/download-pdf/{id}',[ResultController::class,'downloadPDF'])->name('download-pdf');
        Route::get('/search',[ResultController::class,'search'])->name('search');
    });
});

});






