<?php

namespace App\Providers;

use App\Http\Controllers\PostController;
use App\Post;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\Favorite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('users')) {


            $admins = User::where('isAdmin', '=', 1)->get();
            $users = User::where('isAdmin','=',0)->get();
            $favorite = Favorite::where('user_id', '=', true)->get();

            $adminsArray = [];
            $usersArray = [];
            $favoriteArray = [];
            foreach ($admins as $value)
            {
                array_push($adminsArray, $value->id);
            }
            foreach ($users as $value)
            {
                array_push($usersArray, $value->id);
            }
            foreach ($favorite as $value)
            {
                array_push($favoriteArray, $value->id);
            }

            view()->share('adminsArray',$adminsArray);
            view()->share('usersArray',$usersArray);
            view()->share('favoriteArray',$favoriteArray);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
