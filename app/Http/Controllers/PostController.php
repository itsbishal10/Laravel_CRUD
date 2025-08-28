<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function delete(Post $post){
       if(Auth::user()->id ===$post['user_id']){
            $post->delete();
        }
            return redirect('/');

    }

    public function actuallyUpdatePost(Post $post, Request $request){
        if(Auth::user()->id !==$post['user_id']){
            return redirect('/');
        }
        $incomingFields= $request->validate([
        'title'=>'required',
        'body'=> 'required'
        ]);

        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['body']=strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Post $post){
        if(Auth::user()->id !==$post['user_id']){
            return redirect('/');
        }
        return view('edit-post', ['post'=> $post]);
    }

    public function createPost(Request $request){
        $incomingFields= $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['body']=strip_tags($incomingFields['body']);
        $incomingFields['user_id']=Auth::id();
        Post::create($incomingFields);
        return redirect('/');
    }
}
