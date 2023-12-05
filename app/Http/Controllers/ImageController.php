<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {

        $path = Storage::put('images', $request->upload);

        return [
            'url' => Storage::url($path)
        ];

        /* $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $imageName = time().'.'.$request->image->extension();
        
        $request->image->move(public_path('images'), $imageName);
        
        return back()
                ->with('success', 'You have successfully upload image.')
                ->with('image', $imageName); */
    }
}
