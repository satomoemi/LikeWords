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
        //CommandsファイルのWordPush.phpに毎日設定された時間に実行するとスケジュール実装してる
        //参考 https://qiita.com/nicopinpin/items/29dbdd666433253839ce

        //通知登録かつ時間設定してる人を全て取得
        $pushes = Push::all();

        //おそらく$pushesは連想配列だから、foreachで繰り返してく
        //ユーザーごとに登録してる時間が違うから一つ一つ調べてく感じ
        foreach($pushes as $push) {
            //時間を文字列にしてる
            //dailyAtメソッドの型は文字列でないとだから、time型からstring型に変える必要あり。
            //参考 https://tetechi.com/php-strtotime/
            $pushtime = date('H:i',strtotime($push->push_time));

            //commandメソッドに実行したいコマンド名を入力
            //引数の中に、$pushからuser_idカラムを取得
            //dailyAtメソッドは毎日実行という意味
            $schedule->command("WordPush {$push->user_id}")->dailyAt($pushtime);
        }
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
