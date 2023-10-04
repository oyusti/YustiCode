<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 
        'slug', 
        'category_id', 
        'user_id'
    ];
    
    use HasFactory;

    //Relationships one to many inverse
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relationships one to many inverse
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relationships many to many polymorphic
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    //relationships one to many polymorphic
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
