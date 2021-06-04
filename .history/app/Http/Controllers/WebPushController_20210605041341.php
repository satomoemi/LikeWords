<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebPushController extends Controller
{
    public function push()
    {
        return view('user.push');
    }

    public function __construct() {
        
        // このコントローラーにアクセスする場合、ログインが必須
        //これはstore()の中で特定のユーザーを取得する必要があるため
        $this->middleware('auth');  

    }

   
}
