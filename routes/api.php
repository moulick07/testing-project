<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\UploadPhotoController;
use App\Http\Controllers\VariationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/hello', function () {
    return "Hello World!";
  });

Route::apiResource('/product', ProductController::class);
Route::apiResource('/category', CategoryController::class);
Route::apiResource('/category', CategoryController::class);
Route::apiResource('/photo', UploadPhotoController::class);
Route::put('/product/{id}/order',[ProductController::class,'updateOrder']);
Route::put('/product/{id}/order-image',[ProductController::class,'updateImageOrder']);
Route::post('/test', [ProductController::class,'test']);