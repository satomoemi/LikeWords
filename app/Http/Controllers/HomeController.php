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
        //ユーザーごとにフォルダー表示
        //user()はRequestクラスの中にあるメソッドで、ユーザー情報を取得
        //foldersはUser.phpでリレーションしたfoldersメソッドでuser()で取得したユーザーに合ったフォルダを取得
        $folders = $request->user()->folders;

        //Word作成時のfolder_id保存のため
        //そのまま$foldersを使用したみたが、最後に取得したfolderのidが送られてしまう（folder1のwordを保存して欲しいのに、最後のfolder3にwordが保存されてしまう）
        $word_folder = Folder::find($request->id);

        //通知時間表示のため
        $user = Auth::id();
        $push = Push::where('user_id',$user)->first();
        
        if (Push::where('user_id',$user)->doesntExist()) {
            //doesntExist()やexists()がnullだとあるないか判断できずエラーになるから、なかったらNULLになる
            $pushtime = NULL;
        }else {
            $pushtime = $push->push_time;
        }

        //検索
        $cond_word = $request->cond_word;
        
        //検索とログイン後のTOPページで作成しているfolderを表示
        //folderの名前を押したら該当するword一覧が出るようにする
        $current_folder = NULL;

        //URLの「=1や=3」があったら該当のword表示実装
        if($request->id != ''){
            //$request->idと一致するfolderテーブルのレコード全てを取得
            $current_folder = Folder::find($request->id);
            
            //FolderModelのwords()を使用 
            //$current_folderで一致するFolderのレコードを取得、そのFolderのidと一致するWordModelのレコードを$wordsに代入
            $words = $current_folder->words; 

        //検索ののリクエストがあったら部分検索実装
        }elseif($cond_word != ''){
            //WordModelの中のwordカラムで$cond_wordと部分一致したレコードを取得
            $words = Word::where('word','like','%'.$cond_word.'%')->get();
        
        //$request->id空で、$cond_wordも空ならword一覧を表示しない実装
        }else{
            //Laravelのcollectionとは配列のラッパー(配列の仲介業者？)
            //collectの中は空
            $words = collect();
        }

        return view('user.home',['folders' => $folders, 'current_folder' => $current_folder, 'words' => $words, 'cond_word' => $cond_word, 'pushtime' => $pushtime,'user' => $user,'word_folder' => $word_folder]);
        
    }



    //フォルダ作成画面 Modalに変更したから不要
    // public function CreateFolderForm()
    // {
    //     $user = Auth::id();

    //     return view('user.CreateFolder',['user' => $user]);
    // }

    //フォルダ作成post
    public function CreateFolder( Request $request)
    {

        //FolderModelの全てのカラムにvalidateかけてる
        $this->validate($request, Folder::$rules);
        //新しいレコードが出現される
        $folders = new Folder();
        //ユーザーからきたリクエストを全て$formへ代入
        $form = $request->all();

        //tokenは保存する必要なし
        unset($form['_token']);
        //$foldersで出現したレコードに$formを埋める
        $folders->fill($form);
        //埋めた内容を保存
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
        //一行でもできちゃう
        $folder->fill($folder_form)->save();

        return redirect(route('home',['id' => $folder->id ]));
    }

    //フォルダ削除
    public function DeleteFolder(Request $request)
  {
      // ユーザーからきたリクエストから該当するFolderModelを取得
      $folder = Folder::find($request->id);

      // そのレコードを削除
      $folder->delete();
      
      return redirect('/home');
  }  

   


}
