<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PushController extends Controller
{
    public function push()
    {
        return view('user.push');
    }

    public function PushID(Request $request)
    {
        logger()
        $user = Auth::user();
        $user->player_id = $request->all()['player_id']
        
        $user->save();

    }


   
}
