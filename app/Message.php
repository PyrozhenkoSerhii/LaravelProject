<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Message extends Model
{
    protected $fillable = [
        'text', 'user_id', 'viewed'
    ];

    public function getMessages(){
        $user = Auth::user()->id;

        $messages = DB::table('messages')->where('user_id','=',$user)->get();


        return $messages;
    }

    public function getUsersBySubscribedCategory($category){
        $users = DB::table('subscribes')->where('category','=',$category)->get();
        $usersId = [];
        foreach ($users as $user){
            array_push($usersId, $user->user_id);
        }
        return $usersId;
    }

    public function writeMessage($usersId,$category,$title){
        $message = 'There is new article in '.$category.' category:"'.$title.'"';
        foreach ($usersId as $user){
            Message::create([
                'text' => $message,
                'viewed' => 0,
                'category' => $category,
                'user_id' => $user
            ]);
        }
        return true;
    }
}
