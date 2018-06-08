<?php

namespace App\Http\Controllers;
use App\Favorite;
use App\Subscribe;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Translator;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function admin()
    {
        $users = User::all();
        return view('adminPage.infoPage',['users'=>$users]);
    }

    public function infoPage()
    {
        $users = User::all();
        return view('adminPage.infoPage',['users'=>$users]);
    }

    public function changeAccess($id)
    {
        $user = User::find($id);

        if($user->isAdmin==0){
            $user->isAdmin = 1;
        }else{
            $user->isAdmin = 0;
        }
        $user->save();

        return back();
    }

    public function showProfile(User $userModel){
        $user = User::find(Auth::user()->id);

        return view('profile.mainPageProfile',['user'=>$user]);
    }

    public function editProfile(User $userModel){
        $user = User::find(Auth::user()->id);

        return view('profile.userProfile',['user'=>$user]);
    }

    public function showFavoriteNews(User $userModel, Favorite $favoriteModel){

        /*todo favorite*/
        $favoriteNews = $favoriteModel->showFavorite();

        return view('profile.showFavoriteNews',['favoriteNews'=>$favoriteNews]);
    }

    public function showMyComments(User $userModel,Comment $commentModel, Post $postModel){
        $myComments = $commentModel->getMyComments();
        $posts = $postModel->getNameAndId();
        return view('profile.showMyComments',['comments'=>$myComments,'posts'=>$posts]);
    }

    public function showSuggestedArticles(Post $postModel){
        $suggestedArticles = $postModel->getSuggestedArticles();

        return view('profile.mySuggestedArticles',['suggestedArticles'=>$suggestedArticles]);
    }

    public function changeProfile(){
        $name = $_POST['name'];
        $email = $_POST['email'];

        $user = User::find(Auth::user()->id);

        $user->name = $name;
        $user->email= $email;

        $user->save();


        return response()->json([
            'text' => 'success'
        ]);
    }

    public function showSubscribes(Subscribe $subscribeModel){
        $subscriptions = $subscribeModel->getSubsciption();
        $categories = [];
        foreach ($subscriptions as $subscription){
            array_push($categories, $subscription->category);
        }


        return view('profile.subscribe',['subscriptions'=>$categories]);
    }

    public function changeSubscribe(){
        $category = $_POST['category'];
        $deal = $_POST['deal'];
        $user = Auth::user()->id;

        if($deal=='subscribe'){
            Subscribe::create([
                'category' => $category,
                'user_id' => $user,
            ]);
        }else{
            $subscribe = DB::table('subscribes')->where('user_id','=',$user)->where('category','=',$category)->get();
            $subscribeEntity = Subscribe::find($subscribe[0]->id);
            $subscribeEntity->delete();

        }

        return response()->json([
            'text' => 'success'
        ]);
    }
}
