<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Comment $postModel, Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'text' => 'required|max:255',
        ]);

            Comment::create([
                'text' => $request->input('text'),
                'parent_id' => null,
                'post_id' => $request->input('post_id'),
                'created_by' => $request->input('created_by'),
            ]);
            return back();

    }

    public function delete($id)
    {
        $post = Comment::find($id);
        $post->delete();
        return back();
        //return redirect()->route('posts');
    }

}
