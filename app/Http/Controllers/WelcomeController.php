<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class WelcomeController extends Controller
{
    public function __invoke()
    {

        $posts = Post::where('published', true)
            ->when(request('category'), function($query){
                $query->whereIn('category_id', request('category'));
            })->when(request('order' ?? 'new'), function($query){
                if(request('order') == 'old'){
                    $query->orderBy('published_at', 'asc');
                }else{
                    $query->orderBy('published_at', 'desc');
                }
            })->when(request('tag'), function($query){
                $query->whereHas('tags', function($query){
                    $query->where('tags.name', request('tag'));
                });
            })/* ->when(request('search'), function($query){
                $query->where('title', 'like', '%' . request('search') . '%');
            }) */
            /* })->when(request('tag'), function($query){
                $query->whereHas('tags', function($query){
                    $query->whereIn('id', request('tag'));
                });
            })->when(request('search'), function($query){
                $query->where('title', 'like', '%' . request('search') . '%');
            }) */
            /* ->when(request('search'), function($query) {
                $query->where('title', 'like', '%' . request('search') . '%');
            }) */
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $categories = Category::all();
        
        $tags = Tag::all();

        return view('welcome', compact('posts', 'categories', 'tags'));
    }
}
