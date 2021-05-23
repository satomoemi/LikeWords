<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Folder;

class WordController extends Controller
{
    //Word作成画面
    public function CreateWordForm(int $id)
    {
        return view('user.CreateWord',[
            'folders_id' => $id
        ]);
    }

    //Word作成post
    public function CreateWord(Request $request)
    {

        $this->validate($request, Word::$rules);
        $words = new Word();
        $form = $request->all();

        unset($form['_token']);
        
        $word->fill($form);

        //$current_folder に紐づくWordを作成
        $wor->folders()->save($word);

        return redirect('/home',[
            'id' => $current_folder->id,
        ]);
    }
}
