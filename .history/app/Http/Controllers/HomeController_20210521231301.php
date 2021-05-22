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
    public function folder()
    {
        $folders = Folder::all();
        $words = Word::all();

        return view('user.home',['folders' => $folders,'words' => $words]);
    }

    //フォルダ作成画面
    public function CreateFolderForm()
    {
        return view('user.CreateFolder');
    }

    //フォルダ作成post
    public function CreateFolder(Request $request)
    {
        // dd($request);
        $this->validate($request, Folder::$rules);
        $folders = new Folder();
        $form = $request->all();

        unset($form['_token']);
        
        $folders->fill($form);
        $folders->save();

        return redirect('/home');
    }

    public function folderdelete(Request $request)
  {
      // 該当するNews Modelを取得
      $folder = Folder::find($request->id);
      // 削除する
      $folders->delete();
      return redirect('/home');
  }  

   


}