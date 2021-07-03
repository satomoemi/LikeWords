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

        //DBのテーブルに対象のレコードがないかチェック あるはexist() ないはdoesntExist() '='は省略可
        //Push tableのuser_idにログインしてるユーザーのidがなかったらsave
        if ( Push::where('user_id','=',$push->user_id)->doesntExist()) {
            $push->save();
            
        }


    }

    public function DeletePushID(Request $request)
    {
        logger('ajax_delete success');

        $push = Push::where('user_id',Auth::user())->first();
        logger();

        if ($push != NULL) {
            $push->delete();
            
        }

        // $user = Auth::user();
        // if ($user->player_id != NULL) {
        //     $user->player_id = NULL;
        //     $user->save();
        // }
    }



   
}
