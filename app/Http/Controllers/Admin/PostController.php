<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest('id')->paginate(10);
        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the data
        $request->validate([
            'title' => 'required',
            'slug' => 'required | unique:posts',
            'category_id' => 'required | exists:categories,id',
        ]);

        //save the data
        $post = Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            //'user_id' => auth()->user()->id,
        ]);

        //Store a message in session
        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'El post ha sido creado correctamente'
        ]);

        //redirect user
        return redirect()->route('admin.posts.edit', $post);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required | unique:posts,slug,' . $post->id,
            'category_id' => 'required | exists:categories,id',
            'excerpt' => $request->published ? 'required' :'nullable',
            'body' => $request->published ? 'required' :'nullable',
            'published' => 'required|boolean',
            'tags' => 'nullable|array',
            'image' => $request->published ? 'required|image' :'nullable|image',
        ]);

        $data = [];
        $data = $request->all();

        //create tags
        $tags = [];

        //create tags
        foreach ($request->tags ?? [] as $tag) {
            $tags[] = Tag::firstOrCreate([
                'name' => $tag
            ])->id;
        }

        //sync tags
        $post->tags()->sync($tags);

        //upload image
        if ($request->file('image')) {

            if($post->image_path){
                //delete old image
                Storage::delete($post->image_path);
            }
            //upload new image
            $data['image_path'] = Storage::put('posts', $request->image);
        }
        

        $post->update($data);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'El post ha sido actualizado correctamente'
        ]);

        return redirect()->route('admin.posts.index', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'El post ha sido eliminado correctamente'
        ]);

        return redirect()->route('admin.posts.index');
    }
}
