<?php

namespace App\Models\CommentVote;

use Illuminate\Database\Eloquent\Model;

class CommentVote extends Model
{
    protected $fillable = ['comment_id', 'user_id', 'vote'];
    protected $table = "comment_user_table";

    public $timestamps = false;
}
