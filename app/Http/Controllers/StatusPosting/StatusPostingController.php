<?php

namespace App\Http\Controllers\StatusPosting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use Log, Session, DB;

class StatusPostingController extends Controller
{
    public function postData(Post $post){
        $datas = $post->load('comments');
        dd($datas);
        $posts['post'] = Post::get();
        $posts['post'][] = Post::get()->posts;
        dd($posts);
    }
    public function allposts(){
        $posts = Post::all();
        return response()->json($posts);
    }
    public function posting(Request $request){
        $status = $request->input('postingStatus');
        $user_id = 1;
        $in = Post::insert([
            "post" => $status,
            "like" => 0,
            "users_id" => $user_id
        ]);
        if ($in) {
            return Session::flash('success_msg', 'thaks  for posting');
        }else{
            return $request->session()->flash('error_msg', $in);
        }
        
    }
    public function likeStatus(Request $request){
        $in = Post::where('id', $request->statusId)->increment('like');
        $likes = Post::where('id', $request->statusId)->pluck('like');
        return response()->json($likes);
    }
}
