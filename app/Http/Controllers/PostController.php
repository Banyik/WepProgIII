<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function post_validate(Request $request) {
        $request->validate([
            'post_title'=>'required'
        ]);
        $post = new Post();
        $post->user_id = Auth::id();
        $post->post_title = $request->post_title;
        $post->post = $request->post_content;
        $post->save();
        return redirect()->route('home');
    }
    public function post_site(){
        return view('create_post');
    }
    public function post($post_id) {
        $post = Post::find($post_id);
        return view('post', ['id' => $post]);
    }
    public function post_comment($post_id, Request $request) {
        $request->validate([
            'comment'=>'required'
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post_id;
        $comment->comment_post = $request->comment;
        $comment->save();
        $post = Post::find($post_id);
        return view('post', ['id' => $post]);
    }
}
