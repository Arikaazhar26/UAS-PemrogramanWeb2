<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;



Route::get('/', function () {

    return redirect()->route('login');

});



require __DIR__.'/auth.php';



Route::middleware(['auth'])->group(function () {



    /*
    |--------------------------------------------------------------------------
    | REDIRECT DASHBOARD SESUAI ROLE
    |--------------------------------------------------------------------------
    */


    Route::get('/dashboard', function () {


        if(Auth::user()->role == 'admin'){


            return redirect()
            ->route('admin.dashboard');


        }


        return redirect()
        ->route('petugas.dashboard');


    })->name('dashboard');






    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */


    Route::get('/admin/dashboard',
        [DashboardController::class,'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');






    /*
    |--------------------------------------------------------------------------
    | PETUGAS DASHBOARD
    |--------------------------------------------------------------------------
    */


    Route::get('/petugas/dashboard', function(){


        return view('user.dashboard');


    })
    ->middleware('role:petugas')
    ->name('petugas.dashboard');







    /*
    |--------------------------------------------------------------------------
    | ADMIN ACCESS
    |--------------------------------------------------------------------------
    */


    Route::middleware(['role:admin'])->group(function(){

        Route::resource('categories', CategoryController::class);
        
        Route::resource('authors', AuthorController::class);

        Route::resource('books', BookController::class);


        Route::resource('members', MemberController::class);


        Route::resource('fines', FineController::class);



        Route::get('/members/export/pdf',
        [MemberController::class,'exportPdf'])
        ->name('members.export.pdf');



        Route::get('/fines/export/pdf',
        [FineController::class,'exportPdf'])
        ->name('fines.export.pdf');



        Route::get('/fines/export/excel',
        [FineController::class,'exportExcel'])
        ->name('fines.export.excel');

        Route::get('/books/export/pdf',
    [BookController::class,'exportPdf'])
    ->name('books.export.pdf');

Route::get('/books/export/excel',
    [BookController::class,'exportExcel'])
    ->name('books.export.excel');



    });






    /*
    |--------------------------------------------------------------------------
    | ADMIN + PETUGAS
    |--------------------------------------------------------------------------
    */


    Route::middleware(['role:admin,petugas'])->group(function(){



        Route::resource('borrowings',
        BorrowingController::class);



        Route::resource('returns',
        ReturnController::class);



        Route::post('/borrowings/{borrowing}/return',
        [BorrowingController::class,'returnBook'])
        ->name('borrowings.return');



        Route::get('/borrowings/export/pdf',
        [BorrowingController::class,'exportPdf'])
        ->name('borrowings.export.pdf');



    });







    /*
    |--------------------------------------------------------------------------
    | TEST ROLE (sementara)
    |--------------------------------------------------------------------------
    */


    Route::get('/admin-test', function(){


        return "Halaman Admin";


    })
    ->middleware(['role:admin']);



});