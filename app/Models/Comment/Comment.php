<?php

namespace App\Models\Comment;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'votes', 'spam', 'reply_id', 'page_id', 'user_id'];
    protected $dates = ['created_at', 'updated_at'];
    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function posts()
    {
        return $this->belongsTo('App\Models\Post\Post');
    }
}
