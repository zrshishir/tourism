<?php

namespace App\Http\Controllers\StatusPosting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Models\Like\Like;
use App\Models\Comment\Comment;
use Log, Session, DB;

class StatusPostingController extends Controller
{
    public function postData(Post $post){
        $datas = $post->with(['comments', 'likes'])->orderBy('created_at', 'desc')->get();
        return response()->json($datas);
       
    }

    public function postComment(Request $request){
        $postId = $request->statusId;
        $userId = 1;
        $comment = $request->comment;
        // if(! Auth::check()){
        //     return response()->json('please login to comment this status');
        // }
        $id = Comment::insertGetId([
            'comment' => $comment,
            'post_id' => $postId,
            'users_id' => $userId
        ]);

        if($id){
             $recentComment = Comment::find($id);
            return response()->json($recentComment);
        }else{
            return response()->json($id);
        }
       
    }

    public function allposts(Post $post){//getting all posts
        $posts = $post->with(['comments', 'likes'])->orderBy('created_at', 'desc')->get();
        return response()->json($posts);
    }


    public function posting(Request $request){ //posting a status
        $status = $request->input('postingV');
        
        $user_id = 1;
        $id = Post::insertGetId([
            "post" => $status,
            "like" => 0,
            "users_id" => $user_id
        ]);
        $recentPost = Post::find($id);
        return  response()->json($recentPost);
        if ($in) {
            return response()->json(true);
        }else{
            return $request->session()->flash('error_msg', $in);
        }
        
    }
    public function likeStatus(Request $request){//like on a status
        Log::info($request);
        $postId =  $request->statusId;
        $user_id = 1;
        $likeExistOrNot = Like::where('post_id', $postId)
                                ->where('user_id', $user_id)->exists();

        if(! $likeExistOrNot){
            $insertingData = Like::insert([
                'post_id' => $postId,
                'user_id' => $user_id,
                'likes' => true
            ]);

            if($insertingData){
                 $in = Post::where('id', $request->statusId)->increment('like');
                $likes = Post::where('id', $request->statusId)->pluck('like');
                return response()->json($likes);
            }
        }else if($likeExistOrNot){
            $likeUpdate = Like::where('post_id', $postId)
                                ->where('user_id', $user_id)
                                ->pluck('likes');
                                // Log::info($likeUpdate[0]);
                                // return response()->json($likeUpdate);
                if($likeUpdate[0]){
                    $in = Post::where('id', $request->statusId)->decrement('like');
                    $updateLike = Like::where('post_id', $postId)
                                        ->where('user_id', $user_id)
                                        ->update([
                                            'likes' => false
                                        ]);
                    $likes = Post::where('id', $request->statusId)->pluck('like');
                    return response()->json($likes);
                }else{
                     $in = Post::where('id', $request->statusId)->increment('like');
                    $updateLike = Like::where('post_id', $postId)
                                        ->where('user_id', $user_id)
                                        ->update([
                                            'likes' => true
                                        ]);
                    $likes = Post::where('id', $request->statusId)->pluck('like');
                    return response()->json($likes);
                }
           
        }
       
    }
}
