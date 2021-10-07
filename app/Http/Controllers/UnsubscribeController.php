<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WithdrawalRequest;
use Illuminate\Support\Facades\Auth;
use App\Unsubscribe;
//パスワードを暗号化する
use Hash;
use UserEdit_Operation_DB;


class UnsubscribeController extends Controller
{
    //退会画面
    public function UnsubscForm(Request $request)
    {
        return view('user.unsubsc');
    }

    //退会post
    public function delete(Request $request)
    {
        $this->validate($request, Unsubscribe::$rules);

        $validate = $request->validate([
            'CurrentPassword' => ['required',
            function($attribute, $value, $fail){
                    //現在のパスワードと新しいパスワードが合わなければエラーを出力
                    if(!Hash::check($value, Auth::user()->password)){
                        $fail('パスワードが間違っています');
                    }
                }
            ],
        ]);

        //退会理由を保存
        $reason = new Unsubscribe;
        $form = $request->all();

        unset($form['_token']);
        unset($form['CurrentPassword']);

        $reason->fill($form);
        $reason->save();

        
        //退会処理をするメソッド
        //UserEdit_Operation_DBファイルがvender/useredit/src/にあってそこに問い合わせてる
        $id = Auth::id();
        //UserEdit_Operation_DBファイルにUserEdit_Operation_DBというクラスがある
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        //UserEdit_Operation_DBファイルのWithdrawal($request,$id)というactionにアクセス
        return $UserEdit_Operation_DB->Withdrawal($request,$id);
    }
}
