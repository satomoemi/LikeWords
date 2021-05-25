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
        $folder = Folder::find($request->id);
        
        return view('user.CreateWord',['folder' => $folder ]);
    }

    //Word作成post
    public function CreateWord(Request $request)
    {
        
        $folder = Folder::find($request->folder_id);
        
        $this->validate($request, Word::$rules);
        
        $word = new Word();
        $form = $request->all();

        unset($form['_token']);
        
        $word->fill($form);

        //$words に紐づくWordを作成
        $word->save();

        return redirect('/home',['id' => $folder->id]);
    }
}
