<?php

namespace App\Http\Controllers;

use App\Dictionary;
class TrainingWordTranslationController extends Controller
{

    public  function main($id){
        $words=[];
        $translations=[];
        $learningPercents=[];
         foreach ($this->getAllWords($id) as $dict){
            array_push($words,$dict->word);
            array_push($translations,$dict->translation);
            array_push($learningPercents,$dict->learningPercent);
         }


        return view('training.trainingWordTranslation',['id'=>$id,'words'=>implode($words,','),'translations'=>implode($translations,','),'learningPercents'=>implode($learningPercents,',')]);
    }


     function getAllWords($id)
    {

//
        $dictionaries = Dictionary::latest('created_at')->where('user_id','=',$id)->get();
        return  $dictionaries;
    }
}