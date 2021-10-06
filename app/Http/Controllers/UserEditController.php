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
        $user_edit = Auth::user();
        //同じクラス内のメンバ変数を使用する時$thisを使用
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        return view('user.UserEdit',['user_edit'=>$user_edit]);
    }
    
    //登録ユーザー名を更新
    public function NameUpdate(Request $request){
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
        
        //ユーザー側からリクエストされた、nameというカラムにrequiredというvalidateかける
        //ずっとModelでvalidateかけてるからvalidateされると思ってた。違くて、ここで指定してる
        $this->validate($request,['name' => 'required',]);
        $user = User::find(Auth::id());

        $user->name = $request->all()['name'];

        $user->save();
         
        return redirect('user')->with('flash_message','ユーザー名の変更に成功しました');
    }   

    //登録メールアドレスを更新
    public function EmailUpdate(Request $request){
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
         //ユーザー側からリクエストされた、emailというカラムにrequiredというvalidateかける
        //ずっとModelでvalidateかけてるからvalidateされると思ってた。違くて、ここで指定してる
        $this->validate($request,['email' => 'required',]);
        $user = User::find(Auth::id());

        $user->email = $request->all()['email'];

        $user->save();
        return redirect('user')->with('flash_message', 'メールアドレスの変更に成功しました');
    }    

    //登録生年月日を更新
    public function BirthdayUpdate(Request $request){
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
         //ユーザー側からリクエストされた、birthdayというカラムにrequiredというvalidateかける
        //ずっとModelでvalidateかけてるからvalidateされると思ってた。違くて、ここで指定してる
        $this->validate($request,['birthday' => 'required',]);
        $user = User::find(Auth::id());

        $user->birthday = $request->all()['birthday'];

        $user->save();
        return redirect('user')->with('flash_message','生年月日の変更に成功しました');
    }    

    //登録性別を更新するメソッド
    public function GenderUpdate(Request $request){
        //private function checkLogin()を擬似変数使って呼び出してる
        $this->checkLogin();
         //ユーザー側からリクエストされた、genderというカラムにrequiredというvalidateかける
        //ずっとModelでvalidateかけてるからvalidateされると思ってた。違くて、ここで指定してる
        $this->validate($request,['gender' => 'required',]);
        $user = User::find(Auth::id());

        $user->gender = $request->all()['gender'];

        $user->save();
        return redirect('user')->with('flash_message','性別の変更に成功しました');
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
