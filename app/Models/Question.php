<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    
    public function questionable()
    {
        return $this->morphTo();
    }

    //Relationships one to many inverse with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relationships one to many with answers
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    

}
