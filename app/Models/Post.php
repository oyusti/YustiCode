<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'title', 
        'slug', 
        'category_id', 
        'excerpt',
        'body',
        'user_id',
        'published',
        'image_path'
    ];
    
    use HasFactory;

    //Accessors for attributes image if no image is set
    protected function image(): Attribute
    {
        return new Attribute(
            //get: fn() => $this->image_path ?? 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg'
            get: function(){
                if($this->image_path){
                    //Verificar si la imagen comienza con https:// o http://
                    if(strpos($this->image_path, 'https://') === false && strpos($this->image_path, 'http://') === false){
                        return Storage::url($this->image_path);
                    }else{
                        return $this->image_path;
                    }
                }else{
                    return 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg';
                }
            }
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

    //relationships many to many
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    //relationships one to many polymorphic
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    //relationships one to many polymorphic
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
