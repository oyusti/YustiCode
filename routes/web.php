<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

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

Route::get('/',WelcomeController::class)->name('home');

Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/blog', function () {
        return view('blog');
    })->name('blog');
});

route::post('image/upload', [ImageController ::class, 'upload'])
        ->name('image.upload');
