<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Push;
use Auth;

class PushController extends Controller
{
    //通知時間画面（通知をOFFにしてるのに時間を設定できてしまってたから、通知ONしてる人つまりplayer_id保存された人が時間を設定できるようにした）
    public function push(Request $request)
    {
        //findではなく、whereね
        //findはidカラムでレコードを取得する user_idカラムではできない
        $push = Push::where('user_id',Auth::id());

        //通知登録してない(player_idが保存されてない->レコードがない)場合
        if ($push->doesntExist()) {
            $pushtime = NULL;
        }else {
            //UserModelのリレーションのpushes使用
            $pushtime = Auth::user()->pushes->push_time;
        }

        return view('user.PushTime',['pushtime' => $pushtime, 'push' => $push]);
    }

    //通知ON player_id保存
    public function PushID(Request $request)
    {
        //app.blade.phpからajaxでplayer_idが送信されてくる
        logger('ajax success');
        $user = Auth::user();
        $push = new Push;
        $push->user_id = $user->id;
        //$form=$request->all()は連想配列としてくるから$push->player_id = $form['player_id']keyを指定する
        //それを一行にしたのが
        $push->player_id = $request->all()['player_id'];
        

        //PushModelに対象のレコードがないかチェック あったら同じレコードが保存されてしまうからなかったら保存実装
        //あるはexists() ないはdoesntExist() '='は省略可
        //Push tableのuser_idにログインしてるユーザーのidがなかったらsave
        if (Push::where('user_id','=',$push->user_id)->doesntExist()) {
            $push->save();
            
        }


    }

    //通知OFF player id削除
    public function DeletePushID(Request $request)
    {
        //app.blade.phpからajaxでplayer_idが送信されてくる
        logger('ajax_delete success');

        //first()の返り値はインスタンス（変数）一番目のものを取得したい時 なければnullを返す
        // get()の返り値はコレクション（配列）
        $push = Push::where('user_id',Auth::id())->first();
        logger($push);
        
        //もしNULLだったら削除する必要がないため
        if ($push != NULL) {
            $push->delete();
        }
    }

    //通知時間保存
    public function PushTime(Request $request)
    {
        //push_timeだけvalidate
        $this->validate($request,['push_time' => 'required',]);
        $user = Auth::id();

        //もし通知登録していたら（ログインしてるIDが存在したら）
        if (Push::where('user_id',$user)->exists()){

            $push = Push::where('user_id',$user)->first();
            $form = $request->all();
            $push->push_time = $form['push_time'];
        
            $push->save();
        }

        return redirect('/home');
    }



   
}
