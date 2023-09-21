<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
 
 Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [HomeController::class, 'index'])->name('home'); 
Route::group(['middleware' => ['admin']], function () {
   Route::get('admin-home', [HomeController::class, 'adminHome'])->name('admin.home');
   Route::get('category',[CategoryController::class,'index'])->name('category');
   Route::get('save',[CategoryController::class,'save'])->name('save-category');
});
Route::get('/logout', function(){
        Auth::logout();
        return Redirect::to('login');
     })->name('logout.user');