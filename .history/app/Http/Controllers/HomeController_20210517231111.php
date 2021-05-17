<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WithdrawalRequest;
use Illuminate\Support\Facades\Validator;
use App\Unsubscribe;
use App\Folder;
use Hash;
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
    public function home()
    {
        return view('user.home');
    }

    

    public function push()
    {
        return view('user.push');
    }

    public function UnsubscForm(Request $request)
    {
        $auth = auth::user();
        return view('user.unsubsc',['auth'=>$auth]);
    }

    public function delete(Request $request)
    {
        $this->validate($request, Unsubscribe::$rules);
        //現在のパスワードと新しいパスワードが合わなければエラーを出力
        $validate = $request->validate([
            'CurrentPassword'    => ['required',
                function($attribute, $value, $fail){
                    if(!Hash::check($value, Auth::user()->password)){
                        $fail('Password does not match');
                    }
                }
            ],
        ]);

        //退会理由を保存
        $reason = new Unsubscribe;
        $form = $request->all();

        unset($form['_token']);
        unset($form['CurrentPassword']);
        unset($form['UserId']);

        $reason->fill($form);
        $reason->save();

        
        //退会処理を追加するメソッド
        //UserEdit_Operation_DBっていうのがvenderディレクトリーにあるuseしてるから繋がってる
        $id = Auth::id();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->Withdrawal($request,$id);
    }


}
