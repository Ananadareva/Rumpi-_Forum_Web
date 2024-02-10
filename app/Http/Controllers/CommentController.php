<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function showComment($id)

    {
        $post = Post::find($id);
        $postComments = $post->comments()->with('user')->orderBy('created_at', 'desc')->paginate(5);
        //   dd($postComments);


     
    $userId = Auth::check() ? Auth::user()->id : 0;

      
        return view('commentView', compact('postComments', 'post', 'userId'));
    }
}
