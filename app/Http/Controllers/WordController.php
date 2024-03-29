<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Folder;
use Auth;

class WordController extends Controller
{
    //Word作成画面
    // public function CreateWordForm(Request $request)
    // {
    //     $folder = Folder::find($request->id);//userが指定したidを表示したいから
        
    //     return view('user.CreateWord',['folder' => $folder ]);
    // }

    //Word作成post
    public function CreateWord(Request $request)
    {
        $this->validate($request,['word' => 'required',]);
        
        $word = new Word;//データが入るレコードが作られる
        $word->user_id = Auth::id();
        $form = $request->all();//ユーザーが入力したデータを取得（それは配列になる）
        

        unset($form['_token']);//tokenはデータに保存する必要なし
        
        $word->fill($form);//Wordで作られたレコードに$formを埋める
        $word->save();
        
        
        //home画面に戻って欲しいのだけど（wordを表示した状態で）、redirectではid渡せないからroute使用
        //$word->folder_idはWordModelからfolder_idを取得
        return redirect(route('home',['id' => $word->folder_id]));
    }

    //Word編集画面
    public function EditWord(Request $request)
    {
        $word = Word::find($request->id);
        return view("user.EditWord",['word' => $word]);
    }

    //Word編集post
    public function UpdateWord(Request $request)
    {
        $this->validate($request,['word' => 'required',]);
        $word = Word::find($request->id);
        
        $word->user_id = Auth::id();
        $word_form = $request->all();

        unset($word_form['_token']);

        $word->fill($word_form)->save();

        //home画面に戻って欲しいのだけど（wordを表示した状態で）、redirectではid渡せないからroute使用
        return redirect(route('home',['id' => $word->folder_id])); 
    }


    //Word削除
    public function DeleteWord(Request $request)
  {
    
        // 該当するWord Modelを取得
        $word = Word::find($request->id);
    
        // 削除する
        $word->delete();

        //home画面に戻って欲しいのだけど（wordを表示した状態で）、redirectではid渡せないからroute使用
        return redirect(route('home',['id' => $word->folder_id]));
  }  

}
