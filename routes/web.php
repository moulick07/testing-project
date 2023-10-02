<?php

use App\Http\Controllers\variationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

 
 Route::get('/', function () {
    return view('welcome');
});



