<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Tag;

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

Route::get('/tags', function (Request $request) {
    $term = $request->term ?? '';
    $tags = Tag::select('name', 'name as text')
            ->where('name', 'LIKE', '%' . $term . '%')->get()
            ->map(function ($tag) {
                return [
                    'id' => $tag->name,
                    'text' => $tag->name
                ];
            });
    return $tags;
})->name('api.tags.index');
