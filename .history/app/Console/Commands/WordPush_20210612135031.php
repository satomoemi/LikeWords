<?php
//タイムスケジュールの実行内容を書いていくよ
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\LikeWordsPush;
use App\User;
use App\Word;

class WordPush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //コマンドの名前
    protected $signature = 'WordPush';
    

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
        //ここに書いた処理が実際に定期実行される処理！！！
        $fields = array(
            'app_id' => "8f2d0d35-3d44-4f4d-ab3b-33d3a1f6f6a7",
            // 'include_external_user_ids' => [$user_id],
            'url' => "http://localhost/",
            'headings' => array('en' => 'test'),
            'contents' => array('en' => 'testbody')
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic '.'NmEwYzE5NzQtZGE3Mi00N2M5LTk5YzYtYjgxN2JkZTY3NmM0'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        
        curl_close($ch);

        
        
    }
}
