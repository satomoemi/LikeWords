<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WithdrawalRequest;
use Illuminate\Support\Facades\Validator;
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

    public function UnsubscForm(Request $request)
    {
        $auth = auth::user();
        return view('user.unsubsc',['auth'=>$auth]);
    }

    public function UnsubscSa(Request $request)

    public function delete(WithdrawalRequest $request){
        //退会処理を追加するメソッド
        $id = auth::id();
        $UserEdit_Operation_DB = new UserEdit_Operation_DB();
        return $UserEdit_Operation_DB->Withdrawal($request,$id);
    }



    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'reason' => ['required', 'string', 'max:255'],
    //     ]);
    // }

    // protected function create(array $data)
    // {
    //     // dd($data);下のデータの状況が見れる
    //     return Unsubscribe::create([
    //         'reason' => $data['reason'],
    //     ]);
    // }


}
