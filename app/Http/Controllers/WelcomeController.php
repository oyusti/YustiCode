<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::where('published', true)
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('welcome', compact('posts'));
    }
}
