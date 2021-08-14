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

    public function top()
    {
        return redirect('/home');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //フォルダ,Word一覧画面 検索
    public function home(Request $request)
    {
        //通知時間表示のため
        $user = Auth::id();
        $push = Push::where('user_id',$user)->first();
        //doesntExist()やexists()がnullだとあるないか判断できない
        if (Push::where('user_id',$user)->doesntExist()) {
            $pushtime = NULL;
        }else {
            $pushtime = $push->push_time;
        }

        //ユーザーごとにフォルダー表示
        $folders = $request->user()->folders;
    
        //検索
        $cond_word = $request->cond_word;
        
        
        $current_folder = NULL;
        if($request->id != ''){
            //$request->idと一致するfolderテーブルのレコード全てを取得
            $current_folder = Folder::find($request->id);
            
            //Folderテーブルのwords()を取得 $current_folderで一致するFolderのレコードを出してる、そのFolderのidと一致するwordのレコードを＄wordsに代入
            $words = $current_folder->words; 

        }elseif($cond_word != ''){
            //Wordテーブルの中のwordカラムで$cond_wordと部分一致したレコードを取得する
            $words = Word::where('word','like','%'.$cond_word.'%')->get();
        }else{
            //Laravelのcollectionとは配列のラッパー(配列の仲介業者？)
            //collectの中は空
            $words = collect();
        }

        return view('user.home',['folders' => $folders, 'current_folder' => $current_folder, 'words' => $words, 'cond_word' => $cond_word, 'pushtime' => $pushtime,'user' => $user]);
        
    }



    //フォルダ作成画面
    public function CreateFolderForm()
    {
        $user = Auth::id();

        return view('user.CreateFolder',['user' => $user]);
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
        $user = Auth::id();

        return view('user.EditFolder',['folder' => $folder, 'user' => $user]);
    }

    //フォルダ編集post
    public function UpdateFolder(Request $request)
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
