<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WithdrawalRequest;
use App\Unsubscribe;
use UserEdit_Operation_DB;

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
    public function index()
    {
        return view('user.home');
    }

    public function unsubsc(Request $request)
    {
        // $reason = Unsubscribe::create(['reason' => $data['reason']]);
        $this->validate($request, Unsubsc::$rules);
        $auth = auth::user();
        return view('user.unsubsc',['auth'=>$auth]);
    }

    public function Withdrawal(WithdrawalRequest $request){
        //退会処理を追加するメソッド
        $id = auth::id();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->Withdrawal($request,$id);
    }


}
