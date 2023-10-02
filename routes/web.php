<?php

use App\Http\Controllers\variationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

 
 Route::get('/', function () {
    return view('welcome');
});



Route::get('home', [HomeController::class, 'index'])->name('home'); 

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

   //product route
   Route::get('/addproduct', [ProductController::class, 'index'])->name('addproduct');
   Route::post('/save-product', [ProductController::class, 'saveProduct'])->name('saveproduct');
   Route::post('/fetch-subcategory', [ProductController::class, 'subCategory'])->name('subCategory');
   Route::post('/fetch-variant', [ProductController::class, 'Variant'])->name('Variant');
   Route::get('/product-list', [ProductController::class, 'productView'])->name('productList');
   Route::get('/detailProduct/{id}', [ProductController::class, 'detailProductData'])->name('getProductDetail');
   Route::get('/editProduct/{id}', [ProductController::class, 'editProduct'])->name('editProduct');
   Route::post('/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
   Route::post('/updateProduct/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');  