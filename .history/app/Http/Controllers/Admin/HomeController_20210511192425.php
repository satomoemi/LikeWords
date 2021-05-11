<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function user_index(Request $request)
    {
        $users = User::all();

        return view('admin.home', ['user_' => $users]);
    }

    public function unsubsc_reason_index(Request $request)
    {
        $unsubsc_reasons = Unsubscribe::all();

        return view('admin.unsubsc_reason', ['unsubsc_reason_lists' => $unsubsc_reasons]);
    }
}
