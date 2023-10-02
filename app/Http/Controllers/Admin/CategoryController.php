<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate form data
        $request->validate([
            'name' => 'required|unique:categories|max:255'
        ]);

        //Process form data
        $category = Category::create($request->all());

        //Store a message in session
        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'La categoria ha sido creada correctamente'
        ]);

        //Return redirect
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /* public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    } */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //Validate form data
        $request->validate([
            'name' => 'required|unique:categories|max:255'
        ]);
        
        //Process form data
        $category->update($request->all());

        //Store a message in session
        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'La categoria ha sido actualizada correctamente'
        ]);

        //Return redirect
        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        //Validate if the posts has any category
        $post = Post::where('category_id', $category->id)->exists();

        if ($post) {
            //Store a message in session
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Error',
                'text'  => 'La categoria no puede ser eliminada porque tiene posts asociados'
            ]);

            //Return redirect
            return redirect()->route('admin.categories.index');
        }

        

        $category->delete();

        //Store a message in session
        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'La categoria ha sido eliminada correctamente'
        ]);

        //Return redirect
        return redirect()->route('admin.categories.index');
    }
}
