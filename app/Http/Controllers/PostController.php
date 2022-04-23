<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
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
        $values = array(
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_content
        );
        Post::create($values);
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
        $values = array(
            'user_id' => Auth::id(),
            'post_id'=> $post_id,
            'comment_post' => $request->comment
        );
        Comment::create($values);
        return redirect()->back();
    }
    public function user_site($user_id) {
        $user = User::find($user_id);
        return view('user', ['id' => $user]);
    }
}
