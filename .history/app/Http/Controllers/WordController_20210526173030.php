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
        $folder = Folder::find($request->id);//userが指定したidを表示したいから
        
        return view('user.CreateWord',['folder' => $folder ]);
    }

    //Word作成post
    public function CreateWord(Request $request)
    {
        $this->validate($request, Word::$rules);
        
        $word = new Word;//データが入るレコードが作られる
        $form = $request->all();//ユーザーが入力したデータを取得（それは配列になる）
        

        unset($form['_token']);//tokenはデータに保存する必要なし
        
        $word->fill($form);//Wordで作られたレコードに$formを埋める
        $word->save();
        
        
        //redirectではid渡せない
        //$word->folder_idはmodelのwordからfolder_idを取得
        return redirect(route('home',['id' => $word->folder_id]));
    }

    //Word削除
    public function WordDelete(Request $request)
  {
      // 該当するWord Modelを取得
      $word = Word::find($request->folder_id);
      dd($word);
      // 削除する
      $word->delete();

      return redirect(route('home'));
  }  

}
