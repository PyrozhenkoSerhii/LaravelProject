<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{

    protected $fillable = [
        'text', 'created_by', 'post_id', 'parent_id'
    ];

    public function getComments($id)
    {
        //используются рамки
        $comments = Comment::latest('created_at')->where('post_id','=',$id)->get();
        return $comments;
    }
    public function getMyComments(){
        $created_by = Auth::user()->id;
        $comments = Comment::latest('created_at')->Where('created_by','=',$created_by)->get();
        return $comments;
    }


}
