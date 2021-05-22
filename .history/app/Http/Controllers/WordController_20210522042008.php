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
    public function CreateWord(int $id, Request $request)
    {
        $current_folder = Folder::find($id);

        $this->validate($request, Word::$rules);
        $word = new Word();
        $form = $request->all();

        unset($form['_token']);
        
        $word->fill($form);

        //$current_folder に紐づくWordを作成
        $current_folder->folders()->save($word);

        return redirect('/home/{id}',[
            'id' => $current_folder->id,
        ]);
    }
}
