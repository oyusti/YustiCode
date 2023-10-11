<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    //Accessors for attributes image if no image is set
    protected function image(): Attribute
    {
        return new Attribute(
            get: fn() => $this->image_path ?? 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg'
        );
    }

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
