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
    public function CreateWord(int $id, Request $request)
    {
        $current_folder = Folder::find($id);

        $this->validate($request, Word::$rules);
        $word = new Word();
        $form = $request->all();

        unset($form['_token']);
        
        $word->fill($form);
        $word->save();

        return redirect('/home',[
            'id' => $current_folder->id,
        ]);
    }
}
