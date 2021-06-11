<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //コマンドの名前
    protected $signature = 'CronTestC';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cron動作確認用のテストコマンドです。';

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
    public function handle()
    {
        //ここに書いた処理が実際に定期実行される処理！！！
        \Log::info('ログ出力テスト - command');
    }
}
