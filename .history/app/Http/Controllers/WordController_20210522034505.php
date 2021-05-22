<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;

class WordController extends Controller
{
    //Word作成画面
    public function CreateWordForm()
    {
        return view('user.CreateWord');
    }

    //Word作成post
    public function CreateWord(int $idRequest $request)
    {
        $this->validate($request, Word::$rules);
        $word = new Word();
        $form = $request->all();

        unset($form['_token']);
        unset($form['$folders_id']);
        
        $word->fill($form);
        $word->save();

        return redirect('/home');
    }
}