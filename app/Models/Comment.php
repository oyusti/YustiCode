<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //relationships one to many
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relationships one to many polymorphic inverse
    public function commentable()
    {
        return $this->morphTo();
    }

    //relationships one to many polymorphic to table images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
   
}
