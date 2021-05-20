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
    //フォルダ一覧画面
    public function home()
    {
        $folder = Folder::all();
        // 選ばれたフォルダを取得する
        $current_folder = Folder::find();
        // 選ばれたフォルダに紐づくタスクを取得する
        $word = Word::where('folders_id','=', $current_folder->id)->get();

        return view('user.home',['folders' => $folder,'current_folder_id' => $current_folder->id,
        'words' => $word,]);
    }

    //フォルダ作成画面
    public function CreateFolderForm()
    {
        return view('user.CreateFolder');
    }

    //フォルダ作成post
    public function CreateFolder(Request $request)
    {
        $this->validate($request, Folder::$rules);
        $folders = new Folder();
        $form = $request->
        $folders->name = $request->name;
        $folders->save();

        return redirect('/home');
    }


   


}
