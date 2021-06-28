<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class PushController extends Controller
{
    public function push()
    {
        return view('user.push');
    }

    public function PushID(Request $request)
    {
        logger('ajax success');
        $user = Auth::user();
        $user->player_id = $request->all()['player_id'];
        
        $user->save();

    }

    public function DelatePushID(Request $request)
    {
        $user = User::find($request->player_id);

        // 削除する
        $user->delete();
    }



   
}
