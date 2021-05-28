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
    //フォルダ,Word一覧画面
    public function home(Request $request)
    {
        $folders = Folder::all();
        // dd($folder);
        $current_folder = NULL;
        if($request->id != ''){
            //$request->idと一致するfolderテーブルのレコード全てを取得
            $current_folder = Folder::find($request->id);

            //Folderテーブルのwords()を取得 $current_folderで一致するFolderのレコードを出してる、そのFolderのidと一致するwordのレコードを＄wordsに代入
            $words = $current_folder->words; 
        }else{
            $words = NULL;
        }

        return view('user.home',['folders' => $folders,'current_folder'=>$current_folder,'words'=>$words]);
        
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
        $folder = Folder::find($request->$id);

        return view('user.EditFolder',['folder' => $folder]);
    }

    public function UpdateFolder( Request $request)
    {
        $this->validate($request, Folder::$rules);
        $folder = Folder::find($request->id);
        $folder_form = $request->all();
        unset($form['_token])

        $folder_form->save();

        return redirect(route('home',['id' => ]));
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
