<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Folder;

class WordController extends Controller
{
    //Word作成画面
    public function CreateWordForm(Request $request)
    {
        $
        return view('user.CreateWord');
    }

    //Word作成post
    public function CreateWord(Request $request)
    {
        
        $folders = Folder::find($request->id);

        $this->validate($request, Word::$rules);
        $words = new Word();
        $form = $request->all();

        unset($form['_token']);
        
        $words->fill($form);

        //$words に紐づくWordを作成
        $folders->words->save($words);

        return redirect('/home',['folders' => $folders]);
    }
}
