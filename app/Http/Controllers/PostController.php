<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\PostFile;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Console\Input\Input;

class PostController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public  function uploads($filename) {
        $path = "storage/uploads/". $filename;
        if (!File::exists($path)) {abort(404);}
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function post_validate(Request $request) {
        $request->validate([
            'post_title'=>'required'
        ]);
        $values = array(
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_content
        );
        $post_id = Post::create($values)->id;
        if($request->hasFile('file')){
            $values = array(
                'file' => time().'_'.$request->file('file')->getClientOriginalName(),
                'post_id' => Post::find($post_id)->id
            );
            PostFile::create($values);
            $file = $request->file('file');
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            //dd($file);
            $file->move("storage/uploads/",$fileName);
        }

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
    public function delete_post($post_id){
        $post = Post::find($post_id);
        $comments = $post->comment()->get();
        foreach ($comments as $item){
            $item->delete();
        }
        $post->delete();
        return redirect()->route('home');
    }
    public function delete_comment($comment_id){
        $comment = Comment::find($comment_id);
        $comment->delete();
        return redirect()->back();
    }
    public function user_site($user_id) {
        $user = User::find($user_id);
        return view('user', ['id' => $user]);
    }
    public function post_raw($post_id){
        $post = Post::find($post_id);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('post_raw', ['id' => $post]));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('post.pdf',['Attachment'=>false]);
        return view('post_raw', ['id' => $post]);
    }
    public function post_edit($post_id){
        $post = Post::find($post_id);
        return view ('post_update',['id'=>$post]);
    }
    public function post_edit_validate(Request $request) {
        $request->validate([
            'post_title'=>'required'
        ]);
        $values = array(
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_content
        );
        Post::where('id',$request->id)->update($values);
        if($request->hasFile('file')){
            $values = array(
                'file' => time().'_'.$request->file('file')->getClientOriginalName(),
                'post_id' => $request->id
            );
            PostFile::where('id',Post::find($request->id)->postFile->id)->update($values);
            $file = $request->file('file');
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $file->move("storage/uploads/",$fileName);
        }
        return redirect()->route('home');
    }
}
