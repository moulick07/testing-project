<?php

use App\Http\Controllers\variationController;
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
   Route::get('/category-list', [CategoryController::class, 'data'])->name('getData');
   Route::get('/getCategory', [CategoryController::class, 'getCategoryData'])->name('getCategorydata');
   Route::get('/detailCategory/{id}', [CategoryController::class, 'detailCategoryData'])->name('getDetailCategory');
   Route::get('/addVariation/{id}', [CategoryController::class, 'addVariation'])->name('addVariation');
   Route::post('/updateCategory/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
   Route::post('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');


   // variation route
   Route::get('/variation-added/{id}', [variationController::class, 'variationSave'])->name('save-variation');


});
Route::get('/logout', function(){
        Auth::logout();
        return Redirect::to('login');
     })->name('logout.user');