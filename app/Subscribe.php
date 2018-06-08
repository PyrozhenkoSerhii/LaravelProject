<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subscribe extends Model
{

    protected $fillable = [
        'category','user_id'
    ];

    public function getSubsciption(){
        $user = Auth::user()->id;
        return $subscribes = Subscribe::latest('created_at')->Where('user_id','=',$user)->get();
    }
}
