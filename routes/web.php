<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/error-permission', function(){
    return view('errors.permission');
})->name('error.permission');

Route::middleware(['IsLogin'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home.page');
});

Route::middleware(['IsLogin', 'IsAdmin'])->group(function() {
    Route::get('/home', function () {
        return view('home');
    })->name('home.page');
    
    Route::middleware(['IsLogin', 'IsKasir'])->group(function () {
        Route::prefix('/kasir')->name('kasir.')->group(function () {
        });
            
        Route::get('/home', function () {
                return view('welcome');
            })->name('home.page');
        });
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

// Route::get('/', function () {
    //     return view('welcome');
    // });
    
    route::prefix('/medicine')->name('medicine.')->group(function() {
        route::get('/create', [MedicineController::class, 'create'])->name('create');
    route::post('/store', [MedicineController::class, 'store'])->name('store');
    route::get('/', [MedicineController::class, 'index'])->name('home');
    route::get('/{id}', [MedicineController::class, 'edit'])->name('edit');
    route::patch('/{id}', [MedicineController::class, 'update'])->name('update');
    route::delete('/{id}', [MedicineController::class, 'destroy'])->name('delete');
    route::get('/stock', [MedicineController::class, 'stock'])->name('stock');
    route::get('/data/stock/{id}', [MedicineController::class, 'stockEdit'])->name('stock.edit');
    route::patch('/data/stock/{id}', [MedicineController::class, 'stockUpdate'])->name('stock.update');
});

// kelola akun 
Route::prefix('/users')->name('users.')->group(function() {
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
});
});
