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
    protected $signature = 'CronTestCommand';
    

    /**
     * The console command description.
     *
     * @var string
     */
    //コマンドの説明
    protected $description = 'W';

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
        logger('test');
    }
}
