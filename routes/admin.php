<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return  view('admin.dashboard');     
})->name('admin.dashboard');

route::resource('/categories', CategoryController::class)
        ->names('admin.categories');
