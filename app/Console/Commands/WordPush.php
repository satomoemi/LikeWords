<?php
//タイムスケジュールの実行内容を書いていくよ
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Word;
use App\Push;
use App\Folder;

class WordPush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //コマンドの名前
    //特定のユーザーごとに通知したいため、引数を設定する事にした
    //参考 https://qiita.com/shosho/items/af15ef1d94a0a7f34e8e
    protected $signature = 'WordPush {user_id}';//引数を指定する時は {user} のように {} で囲む
    

    /**
     * The console command description.
     *
     * @var string
     */
    //コマンドの説明
    protected $description = 'Wordを出力';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    //処理内容を記述
    public function handle()
    {
        //引数で落ちてくる user_id を$user_idとする。1や2を入力するようにする
        $user_id = $this->argument('user_id');
        logger($user_id);

        //user_idを入力されたら通知登録してる該当user_idレコードを取得する 
        //findではなくてカラムを指定する場合はwhere 
        //getだと配列を取得するからインスタンス取得するfirstを使う
        $push = Push::where('user_id',$user_id)->first();
        logger("###");
        logger($push);
        logger("###");
    
        //ランダムにwordを取得
        //入力されてきた引数の$user_idで該当のUserレコード取得
        //User Model内でリレーションしてるwords使用し、該当のWordレコード取得。さらにそれをランダムに取得
        $word_random = User::find($user_id)->words->random();
        logger($word_random);
        
        //ここに書いた処理が実際に定期実行される処理(app.bladeのscriptとは関連なし)
        $fields = array(
            'app_id' => env('ONESINGAL_APP_ID'),//環境変数にしないとgithubに公開されちゃう
            'include_player_ids' => [$push->player_id],//Push Modelに保存したplayer_idを入れる
            'url' => "https://like-words.com/",//通知を押した時に表示されるURLサイト
            'headings' => array('en' => '👩‍🎓今日のWord👨‍🎓'),//タイトル
            //$word_random連想配列になっているから、wordというカラムがkeyになる。keyを指定したらの値が取得される。ないとカラム名（key）まで出てくる
            'contents' => array('en' => '📝今日のWordは'." ".$word_random["word"])
        );

        //$fieldsの情報をonesignalに送信したいため、この下からonesignalと繋がっている
        //https://qiita.com/iritec/items/47c69c61c3731f63688c 参考

        $fields = json_encode($fields);//json_encodeは連想配列をa=>bをa:bというJSON形式にして返す

        //cURLとは、HTTPリクエストをすることにより、外部サイトの情報を取得することができる関数
        //cURL自体がクライアントになる

        //curl_ini:cURLのセッションを初期化
        $ch = curl_init();

        //curl_setopt:cURLの転送用オプションを設定,返り値にはboolean型の値を返す
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic '.env('ONESINGAL_REST_API_KEY')));//環境変数
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//curl_exec()を実行時、返り値を文字列で返す
        curl_setopt($ch, CURLOPT_HEADER, false);// ヘッダは出力したくない場合
        curl_setopt($ch, CURLOPT_POST, true);//POSTが有効
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);//CURLOPT_POST=true を付与する場合は CURLOPT_POSTFIELDS は必須 CURLOPT_POSTFIELDSにパラメータ（引数）設定するとPOST送信になる
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//falseを設定するとサーバー証明書の検証を行わない.これを設定することでcurl_exec()を実行時、エラーを回避できる

        //curl_exec:cURLのセッションの実行時に使用
        $response = curl_exec($ch);
        logger($response);
        
        //curl_close:cURLのセッションを閉じるときに使用
        curl_close($ch);

        
        
    }
}
