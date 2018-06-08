<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dictionary;
use App\User;
use Auth;

class DictionaryController extends Controller
{
    public function show($id)
    {
        $dictionaries = Dictionary::latest('created_at')->where('user_id','=',$id)->get();
        return view('dictionary',['dictionaries' => $dictionaries]);
    }
    public function delete($id){
        $word=Dictionary::find($id);
        $word->delete();
        return back();
    }

    public function edit($id){
        return view('editWord');
    }

    public function update(Request $request,$id){
        $word=Dictionary::find($id);
        $word->word = $request->input('word');
        $word->translation = $request->input('translation');
        $word->save();
        return back();
    }
    public function store(Request $request){

        Dictionary::create([
            'word' => $request->input('word'),
            'translation' => $request->input('translation'),
            'user_id' =>Auth::user()->id,
            'learningPercent'=>0
        ]);
        return back();
    }

    public function storeFromArticle(){

        $word = $_POST['word'];
        $translation = $_POST['translation'];


        Dictionary::create([
            'word' => $word,
            'translation' => $translation,
            'user_id' =>Auth::user()->id,
            'learningPercent'=>0
        ]);

        $result = 'success';

        return response()->json([
            'result' => $result
        ]);

    }
}
