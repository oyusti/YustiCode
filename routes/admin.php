<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return  view('admin.dashboard');     
})->name('dashboard');

route::resource('/categories', CategoryController::class)
        ->names('categories')
        ->except('show');

route::resource('/posts', PostController::class)
        ->names('posts')
        ->except('show');

route::resource('/roles', RoleController::class)
        ->names('roles');