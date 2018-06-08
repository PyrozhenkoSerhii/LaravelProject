<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 08.05.2017
 * Time: 20:03
 */

namespace App\Http\Controllers;


use App\Dictionary;

class TrainingController extends Controller
{
    public  function main($id){
        // return view('training',['id'=>$id,'words'=>$this->getAllWords()]);
        return view('training.training',['id'=>$id,'words'=>implode(['one','apple','vodka','life','kalero'],","),
            'translations'=>implode(['один','яблока','вмв','жтзнь','валеро'],",") ]);
    }

    private function getAllWords()
    {
        //используются рамки
//        $posts = Dictionary::latest('published_at')->published()->get();
        //$words = Dictionary::all()->get();
        $words=Dictionary::all()->get('word');
        return $words;
    }

}