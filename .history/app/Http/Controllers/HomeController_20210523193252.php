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
        // //選ばれたフォルダを取得する
        $current_folder = NULL;
        if($request->folder_id != ''){
            
            $current_folder = Folder::find($request->folder_id); 
        }
        
        // $word = Word::where('folders_id', $folder->id)->get();
        

        return view('user.home',['folders' => $folders,'current_folder'=>$current_folder,'words'=>Word::all()]);
        
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
        

        return redirect('/home',[
            'id' => $folder->id,
        ]);
    }

    //フォルダ削除
    public function FolderDelete(Request $request)
  {
      // 該当するFolder Modelを取得
      $folder = Folder::find($request->id);
      // 削除する
      $folder->delete();

      return redirect('/home');
  }  

   


}