<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Http\Requests\WithdrawalRequest;
use UserEdit_Operation_DB;
use App\User;

class UserEditController extends Controller
{   
    //ログインの有無をチェック
    private function checkLogin(){
        //ログインしてなかったら404画面が表示される
        if (!Auth::check()) {
            return \App::abort(404);
        }        
    }

    //ユーザー編集画面を表示
    public function UserEditForm(Request $request){
        $auth = Auth::user();
        //同じクラス内のメンバ変数を使用する時$thisを使用
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        return view('user.UserEdit',['auth'=>$auth]);
    }
    
    //登録ユーザー名を更新
    public function NameUpdate(Request $request){
        $this->validate($request, User::$rules);
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        //newはModelからインスタンス（レコード）を生成するメソッド
        $UserEdit_Operation_DB = new UserEdit_Operation_DB(); 
        return $UserEdit_Operation_DB->NameUpdate($request);
    }   

    //登録メールアドレスを更新
    public function EmailUpdate(Request $request){
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->EmailUpdate($request);
    }    

    //登録生年月日を更新
    public function BirthdayUpdate(Request $request){
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->BirthdayUpdate($request);
    }    

    //登録性別を更新するメソッド
    public function GenderUpdate(Request $request){
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->GenderUpdate($request);
    }    
    
    //パスワードを変更するメソッド
    public function PasswordChange(ChangePasswordRequest $request){
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        $user = Auth::user();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->PasswordChange($request,$user);
    }
}
