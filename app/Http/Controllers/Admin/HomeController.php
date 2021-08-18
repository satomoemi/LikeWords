<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Unsubscribe;
use App\Push;

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

    public function PlayerID_index(Request $request)
    {
        $push_playerid = Push::all();

        return view('admin.PlayerID', ['push_playerids' => $push_playerid]);
    }
}
