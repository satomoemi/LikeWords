<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WPushController extends Controller
{
    public function push()
    {
        return view('user.push');
    }
}
