<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
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
Route::prefix('login')->group(function() {
    Route::get('/', function(){
        return view('login');
    })->name('loginPage');

    Route::post('/',[DashboardController::class, 'login'] )->name('postLogin');
});
Route::post('/logout',[DashboardController::class, 'logout'] )->name('logout');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('product')->middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/add', [ProductController::class, 'create'])->name('viewAddData');
    Route::post('/add', [ProductController::class, 'store'])->name("addData");
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('viewEditData');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('updateData');
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name("deleteData");
});

