<?php
//タスクスケジューラ
//どんなタスクをどれくらいのスケジュールで実行するの？って言うのを定義
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Push;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    //コマンドの登録
    protected $commands = [
        Commands\WordPush::Class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    //タスクをスケジュールする
    protected function schedule(Schedule $schedule)
    {
        //command directryのwordpushは1分ごとの実行するとスケジュールしてる
        //at(Push::where('push_time')')入れるのかな？
        $schedule->command('WordPush')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
