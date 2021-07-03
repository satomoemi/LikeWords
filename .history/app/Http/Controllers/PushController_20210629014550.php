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

    public function DeletePushID(Request $request)
    {
        logger('ajax_delete success');
        // $user = User::find($request->);

        // 削除する
        User::where('player_id', 6af59828-5c5d-4a6d-9ca0-4468985ba249)->delete();
    }



   
}
