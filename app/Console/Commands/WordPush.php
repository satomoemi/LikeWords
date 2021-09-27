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

        //この下からonesignalと繋がっている
        //https://qiita.com/iritec/items/47c69c61c3731f63688c 参考
        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic '.env('ONESINGAL_REST_API_KEY')));//環境変数
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        logger($response);
        curl_close($ch);

        
        
    }
}
