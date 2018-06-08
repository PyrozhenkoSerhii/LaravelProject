<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'created_by', 'published_at', 'published','description','lecsics','category','img_url'
    ];


    public function getPublishedPosts()
    {
        //используются рамки
        $posts = Post::latest('published_at')->published()->get();
        return $posts;
    }

    public function getUnpublishedPosts()
    {
        $posts = Post::latest('published_at')->unpublished()->get();
        return $posts;
    }

    //рамки: scopeИмя_рамки
    public function scopePublished($query)
    {
        $query->where('published','=',1);
    }

    public function scopeUnpublished($query)
    {
        $query->Where('published','=',0);
    }
    public function getPostsByCategory($category){
        $posts = Post::latest('published_at')->Where('published','=','1')->Where('category','=',$category)->get();
        return $posts;
    }

    public function getSuggestedArticles(){
        $user = Auth::user()->id;
        $posts = Post::latest('published_at')->Where('created_by','=',$user)->get();
        return $posts;
    }

    public function getNameAndId(){
        return $posts = Post::latest('published_at')->get();
    }
}
