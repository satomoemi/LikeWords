<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Http\Requests\WithdrawalRequest;
use UserEdit_Operation_DB;

class UserEditController extends Controller
{
    private function checkLogin(){
        //ログインの有無をチェック
        //ログインしてなかったら404画面が表示される
        if (!Auth::check()) {
            return \App::abort(404);
        }        
    }


    public function UserEditForm(Request $request){
        //ユーザー編集画面を表示させるメソッド
        $auth = auth::user();
        //同じクラス内のメンバ変数を使用する時$thisを使用
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        return view('user.UserEdit',['auth'=>$auth]);
    }
    
    public function NameUpdate(Request $request){
        //登録ユーザー名を更新するメソッド
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        //newはModelからインスタンス（レコード）を生成するメソッド
        $UserEdit_Operation_DB = new UserEdit_Operation_DB(); 
        return $UserEdit_Operation_DB->NameUpdate($request);
    }   

    public function EmailUpdate(Request $request){
        //登録メールアドレスを更新するメソッド
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->EmailUpdate($request);
    }    
    public function BirthdayUpdate(Request $request){
        //登録生年月日を更新するメソッド
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->BirthdayUpdate($request);
    }    
    public function GenderUpdate(Request $request){
        //登録性別を更新するメソッド
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->GenderUpdate($request);
    }    
    
    public function PasswordChange(ChangePasswordRequest $request){
        //パスワードを変更するメソッド
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        $user = Auth::user();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->PasswordChange($request,$user);
    }
}
