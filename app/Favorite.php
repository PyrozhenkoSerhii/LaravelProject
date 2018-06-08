<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    protected $fillable = [
    'user_id', 'post_id'
];

    public function showFavorite(){
        $user = Auth::user()->id;

        $favorite = DB::table('favorites')->where('user_id', '=',$user)->get();



        $favoritePosts = [];
        foreach ($favorite as $item) {
            $tempPost = DB::table('posts')->where('id','=',$item->post_id)->get();

            array_push($favoritePosts, $tempPost[0]);

        }

        return $favoritePosts;
    }
}
