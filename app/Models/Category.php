<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Mass assignment
    protected $fillable = ['name'];

    //Relationships one to many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
