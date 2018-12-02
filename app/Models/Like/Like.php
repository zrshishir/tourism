<?php

namespace App\Models\Like;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['post_id', 'user_id', 'likes'];

     protected $dates = ['created_at', 'updated_at'];

     protected $hidden = ['id', 'created_at', 'updated_at'];


    public function posts(){
    	return $this->belongsTo('App\Models\Post\Post');
    }
}
