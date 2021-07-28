<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Unsubscribe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //admin登録画面
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    //admin登録
    public function register(Request $request)
    {
        return redirect(route('admin.login'));
    }
    //ユーザー一覧
    public function user_index(Request $request)
    {
        $users = User::all();

        return view('admin.home', ['user_indexes' => $users]);
    }

    //退会理由一覧
    public function unsubsc_reason_index(Request $request)
    {
        $unsubsc_reasons = Unsubscribe::all();

        return view('admin.unsubsc_reason', ['unsubsc_reason_indexes' => $unsubsc_reasons]);
    }
}
