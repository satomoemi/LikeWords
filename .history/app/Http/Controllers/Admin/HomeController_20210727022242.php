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
    public function RegisterView(Request $request)
    {

    }
    
    //admin登録
    public function register(Request $request)
    {
        return redirect(route('admin.login'));
    }
    public function user_index(Request $request)
    {
        $users = User::all();

        return view('admin.home', ['user_indexes' => $users]);
    }

    public function unsubsc_reason_index(Request $request)
    {
        $unsubsc_reasons = Unsubscribe::all();

        return view('admin.unsubsc_reason', ['unsubsc_reason_indexes' => $unsubsc_reasons]);
    }
}
