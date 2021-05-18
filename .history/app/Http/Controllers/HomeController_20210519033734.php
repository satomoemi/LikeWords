<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Folder;

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
    public function home(Request $request)
    {
        $folder = Folder::all();

        return view('user.home',['folders' => $folder]);
    }

    //フォルダ作成画面
    public function ShowCreateFolder()
    {
        return view('user.CreateFolder');
    }

    //フォルダ作成post
    public function CreateFolder(Request $request)
    {
        $this->validate($request, Folder::$rules);
        $folder = new Folder();
        $folder->name = $request->name;
        $folder->save();

        return redirect('/home/createfolder');
    }


   


}
