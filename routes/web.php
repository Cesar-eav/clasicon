<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Form29Controller;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;

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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('company')->group(function(){
        Route::get('/company',[CompanyController::class,'index'])->name('company.index');
        Route::get('/create',[CompanyController::class,'create'])->name('company.create');
        Route::get('/edit',[CompanyController::class,'edit'])->name('company.edit');
        Route::put('/update/{id}',[CompanyController::class,'update'])->name('company.update');
        Route::post('/store',[CompanyController::class,'store'])->name('company.store');
        Route::delete('/delete/{id}',[CompanyController::class,'delete'])->name('company.delete');
        Route::get('/list',[CompanyController::class,'list'])->name('company.list');
    });

    Route::prefix('form29')->group(function(){
        Route::post('/store',[Form29Controller::class,'store'])->name('form29.store');
        Route::get('/create',[Form29Controller::class,'create'])->name('form29.create');
        Route::get('/list',[Form29Controller::class,'listForm29'])->name('form29.list');
        Route::get('/show',[Form29Controller::class,'show'])->name('form29.show');
    });

});

require __DIR__ . '/auth.php';
