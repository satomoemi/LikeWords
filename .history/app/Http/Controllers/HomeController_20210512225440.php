<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WithdrawalRequest;
use Illuminate\Support\Facades\Validator;
use App\Unsubscribe;
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
    public function index()
    {
        return view('user.home');
    }

    public function UnsubscForm(Request $request)
    {
        $auth = auth::user();
        return view('user.unsubsc',['auth'=>$auth]);
    }

    public function delete(WithdrawalRequest $request)
    {
        //退会理由を保存
        $this->validate($request, Unsubscribe::$rules);
        $reason = new Unsubscribe;
        $form = $request->all();

        unset($form['_token']);
        unset($form['CurrentPassword']);
        unset($form['UserId']);

        $reason->fill($form);
        $reason->save();

        //現在のパスワードと新しいパスワードが合わなければエラーを出力
        $validate = $request->validate([
            'old_password'    => ['required',
                function($attribute, $value, $fail){
                    if(!Hash::check($value, Auth::user()->password)){
                        $fail($attribute.'が違います');
                    }
                }
            ],
        ]);
        
        //退会処理を追加するメソッド
        $id = Auth::id();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->Withdrawal($request,$id);
    }

    // public function withValidator(Validator $validator) {
        // $validator->after(function ($validator) {
        //     $auth = Auth::user();
        //     //現在のパスワードと新しいパスワードが合わなければエラーを出力
        //     if (!(Hash::check($this->input('CurrentPassword'), $auth->password))) {
        //         $validator->errors()->add('CurrentPassword', __('Password does not match'));
        //     }
        // });
    // }


}
