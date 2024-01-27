<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return  view('admin.dashboard');     
})      ->middleware(['can:Acceso de Dashboard'])
        ->name('dashboard');

route::resource('/categories', CategoryController::class)
        ->middleware(['can:Gestion de Categorias'])
        ->names('categories')
        ->except('show');

route::resource('/posts', PostController::class)
        ->middleware(['can:Gestion de Posts'])
        ->names('posts')
        ->except('show');

route::resource('/roles', RoleController::class)
        ->middleware(['can:Gestion de Roles'])
        ->names('roles')
        ->except('show');

route::resource('/permissions', PermissionController::class)
        ->middleware(['can:Gestion de Permisos'])
        ->names('permissions')
        ->except('show');

route::resource('/users', UserController::class)
        ->middleware(['can:Gestion de Usuarios'])
        ->names('users')
        ->except('show', 'create', 'store');