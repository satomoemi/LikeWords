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
    
        $pushtime = strtotime(Auth::user()->pushes->push_time));
        // dd($pushtime);

        return view('user.PushTime',['pushtime' => $pushtime]);
    }

    //通知ON player_id保存
    public function PushID(Request $request)
    {
        logger('ajax success');
        $user = Auth::user();
        $push = new Push;
        $push->user_id = $user->id;
        $push->player_id = $request->all()['player_id'];
        //$form=$request->all()連想配列としてくる $push->player_id = $form['player_id']

        //DBのテーブルに対象のレコードがないかチェック あるはexists() ないはdoesntExist() '='は省略可
        //Push tableのuser_idにログインしてるユーザーのidがなかったらsave
        if ( Push::where('user_id','=',$push->user_id)->doesntExist()) {
            $push->save();
            
        }


    }

    //通知OFF player id削除
    public function DeletePushID(Request $request)
    {
        logger('ajax_delete success');

        //first()の返り値はインスタンス（変数）一番目のものを取得したい時 なければnullを返す
        // get()の返り値はコレクション（配列）
        $push = Push::where('user_id',Auth::id())->first();
        logger($push);
        

        if ($push != NULL) {
            $push->delete();
        }

        // $user = Auth::user();
        // if ($user->player_id != NULL) {
        //     $user->player_id = NULL;
        //     $user->save();
        // }
    }

    //通知時間保存
    public function PushTime(Request $request)
    {
        //push_timeだけvalidate
        $this->validate($request,['push_time' => 'required',]);
        $user = Auth::id();

        //もしすでに通知登録していたら（ログインしてるIDが存在したら）必要？
        if (Push::where('user_id',$user)->exists()){

            $push = Push::where('user_id',$user)->first();
            $form = $request->all();
            $push->push_time = $form['push_time'];
        
            $push->save();
        }
        

        return redirect('/push/time')->with('status', '時間が更新されました');
    }



   
}
