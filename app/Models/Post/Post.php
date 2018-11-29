<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Comment\Comment;

class Post extends Model
{
    protected $fillables = ['post', 'like', 'user_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment\Comment', 'post_id');
    }
}
