<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Comment;
use App\Translator;

class FavoriteController extends Controller
{
    public function addToFavorite(){
        $post_id = $_POST['post_id'];

        $user = Auth::user()->id;

        Favorite::create([
            'user_id' => $user,
            'post_id' => $post_id,
        ]);

        return response()->json([
            'text' => 'addSuccessed'
        ]);
    }

    public function deleteFromFavorite(){
        $post_id = $_POST['post_id'];

        $user = Auth::user()->id;

        $favoriteToDelete = DB::table('favorites')->where([
            ['post_id', '=', $post_id],
            ['user_id', '=',$user],
        ])->delete();

        return response()->json([
            'text' => 'deleteSuccessed'
        ]);
    }

    public function getFavorite(){

        $post_id = $_POST['post_id'];
        $user = Auth::user()->id;

        $favoriteToDelete = Favorite::latest('created_at')->Where('post_id','=',$post_id)->Where('user_id','=',$user)->get();

        if($favoriteToDelete=='[]'){
            return response()->json([
                'text' => 'false'
            ]);
        }

        return response()->json([
            'text' => 'true'
        ]);
    }


}
