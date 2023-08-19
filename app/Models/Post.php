<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //fillables
    protected $guarded = [];

    //each post belongs to a user
    public function author(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //each post belongs to a user
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
