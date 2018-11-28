<?php

namespace App\Http\Controllers\StatusPosting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use Log, Session;

class StatusPostingController extends Controller
{
    public function allposts(){
        $posts = Post::all();
        return response()->json($posts);
    }
    public function posting(Request $request){
        Log::info($request->all());
        $status = $request->input('postingStatus');Log::info($status);
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
        
        Log::info($request->all());
        return response()->json($request->all());
    }
}
