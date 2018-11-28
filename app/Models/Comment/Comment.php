<?php

namespace App\Models\Comment;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'votes', 'spam', 'reply_id', 'page_id', 'user_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function comments()
    {
        return $this->hasMany('App\Comment', 'id', 'reply_id');
    }
}
