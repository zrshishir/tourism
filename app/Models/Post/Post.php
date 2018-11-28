<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillables = ['post', 'like', 'user_id'];

    
}
