<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

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
    public function user_index(Request $request)
    {
        $users = User::all();

        return view('admin.home', ['users' => $users]);
    }

    public function unsubsc_reason_index(Request $request)
    {
        $unsu = Unsubscribe::all();
        return view('admin.unsubsc_reason');
    }
}
