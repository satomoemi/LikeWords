<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Push;
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
        $push = new Push;
        $push->user_id = $user->id;
        $push->player_id = $request->all()['player_id'];

        if (Push::) {
            $push->save();
            
        }


    }

    public function DeletePushID(Request $request)
    {
        logger('ajax_delete success');
        $push = Push::find($request->id);

        $push->delete();
        // $user = Auth::user();
        // if ($user->player_id != NULL) {
        //     $user->player_id = NULL;
        //     $user->save();
        // }
    }



   
}
