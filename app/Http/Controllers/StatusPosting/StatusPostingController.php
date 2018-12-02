<?php

namespace App\Http\Controllers\StatusPosting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use Log, Session, DB;

class StatusPostingController extends Controller
{
    public function postData(Post $post){
        $datas = $post->with(['comments', 'likes'])->get();
        // foreach ($datas as $key => $value) {
        //     echo $value->likes;
        //     if(is_array($value->likes)){
        //         dd('shishir');
        //     }; dd('yes');
        //     // echo $value->post. "</br>";
        //     // if($value->comments == 'comments'){
        //     //     dd('exit');
        //     // }
        //     echo 'title = '. $key . '   and value is = '. $value . "</br>";dd('exit');
        // }
        return response()->json($datas);
       
        dd($posts);
    }
    public function allposts(Post $post){
        $posts = $post->with(['comments', 'likes'])->get();
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
