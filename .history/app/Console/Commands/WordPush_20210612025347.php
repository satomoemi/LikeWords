<?php
//タイムスケジュールの実行内容を書いていくよ
namespace App\Console\Commands;

use Illuminate\Console\Command;
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
        // $words = Word::get(['word']); //get 特定のカラムの内容を取得
        // logger($words);
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new LikeWordsPush);
        }
        
    }
}
