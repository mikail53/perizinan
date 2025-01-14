<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SesiController;
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


Route::middleware(['guest'])->group(function(){

    Route::get('/',[SesiController::class, 'index'])->name('login');
Route::post('/',[SesiController::class, 'login']);

});
Route::get('/home',function(){
    return redirect('/home');
});


Route::middleware(['auth'])->group(function(){
    Route::get('/admin',[AdminController::class,'index']);
    Route::get('/admin/operator',[AdminController::class,'operator'])->middleware(('userAkses:operator'));
    Route::get('/admin/koordinator',[AdminController::class,'koordinator'])->middleware(('userAkses:keuangan'));
    Route::get('/logout',[SesiController::class,'logout']);

});

use App\Http\Controllers\IzinController;

Route::resource('izin', IzinController::class);
