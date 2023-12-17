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
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $categories = Category::all();
        
        $tags = Tag::all();

        return view('welcome', compact('posts', 'categories', 'tags'));
    }
}
