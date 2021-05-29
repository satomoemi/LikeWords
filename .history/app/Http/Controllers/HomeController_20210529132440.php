<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Folder;
use App\User;
use App\Push;
use App\Word;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //フォルダ,Word一覧画面 検索
    public function home(Request $request)
    {
        $folders = Folder::all();

        //検索
         $cond_word = $request->cond_word;
        
            
        $current_folder = NULL;
        if($request->id != ''){
            //$request->idと一致するfolderテーブルのレコード全てを取得
            $current_folder = Folder::find($request->id);
            
            //Folderテーブルのwords()を取得 $current_folderで一致するFolderのレコードを出してる、そのFolderのidと一致するwordのレコードを＄wordsに代入
            $words = $current_folder->words; 
        }else{
            $words = NULL;
        }

        i($cond_word != ''){
            //Wordテーブルの中のwordカラムで$cond_wordと一致したレコードを取得する
            $words = Word::where('word','like','%'.$cond_word.'%')->get();
        }
        
    
            
        return view('user.home',['folders' => $folders, 'current_folder' => $current_folder, 'words' => $words, 'cond_word' => $cond_word]);
        
    }

    //検索
    public function SearchWord(Request $request)
    {
         //word検索
         $cond_word = $request->cond_word;
        if($cond_word != ''){
            //Wordテーブルの中のwordカラムで$cond_wordと一致したレコードを取得する
            $posts = Word::where('word','like','%'.$cond_word.'%')->get();
        }else {
            $posts = Word::all();
        }

        return redirect ( route('home',['posts' => $posts->folder_id]));
    }



    //フォルダ作成画面
    public function CreateFolderForm()
    {
        return view('user.CreateFolder');
    }

    //フォルダ作成post
    public function CreateFolder( Request $request)
    {
        
        $this->validate($request, Folder::$rules);
        $folders = new Folder();
        $form = $request->all();

        unset($form['_token']);
        
        $folders->fill($form);
        $folders->save();
        

        return redirect('/home');
    }

    //フォルダ編集画面
    public function EditFolder( Request $request)
    {
        $folder = Folder::find($request->id);

        return view('user.EditFolder',['folder' => $folder]);
    }

    //フォルダ編集post
    public function UpdateFolder( Request $request)
    {
        $this->validate($request, Folder::$rules);
        $folder = Folder::find($request->id);
        $folder_form = $request->all();

        unset($folder_form['_token']);

        $folder->fill($folder_form)->save();

        return redirect(route('home',['id' => $folder->id ]));
    }

    //フォルダ削除
    public function DeleteFolder(Request $request)
  {
      // 該当するFolder Modelを取得
      $folder = Folder::find($request->id);

      // 削除する
      $folder->delete();
      
      return redirect('/home');
  }  

   


}
