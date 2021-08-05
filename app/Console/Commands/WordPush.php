<?php
//タイムスケジュールの実行内容を書いていくよ
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\LikeWordsPush;
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
        $user_id = $this->argument('user_id');//引数で落ちてくる user を取得するには
        logger($user_id);
        $push = Push::where('user_id',$user_id)->first();//Wordの引数を設定して、idを入力したらuserが取得するかどうか調べる findではなくてカラムを指定する場合はwhere getだと配列に取得するからインスタンス取得するfirstを使う
        logger("###");
        logger($push);
        logger("###");
        // logger($user);
        $word_random = User::find($user_id)->words->random();//ランダムにwordを取得
        logger($word_random);
        
        //ここに書いた処理が実際に定期実行される処理(app.bladeのscriptとは関連なし)
        $fields = array(
            'app_id' => env('ONESINGAL_APP_ID'),//環境変数にしないとgithubに公開されちゃう
            'include_player_ids' => [$push->player_id],//保存したplayer_idを入れる
            // 'included_segments' => ['All'],//全員
            'url' => "https://like-words.com/",
            'headings' => array('en' => '👩‍🎓今日のWord👨‍🎓'),
            //wordというカラムがkeyになる。keyの値を取得という意味。ないとカラム名まで出てくる
            'contents' => array('en' => '📝今日のWordは'." ".$word_random["word"])
        );
        //この下からonesignalと繋がっている
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
