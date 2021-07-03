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
        $user = Auth::user();
        if ($user->player_id != NULL) {
            $user->player_id = NULL;
            $user->save()

        }
    }



   
}
