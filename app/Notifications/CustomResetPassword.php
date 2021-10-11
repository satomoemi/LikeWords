<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class CustomResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // コンストラクタで通知内容を生成する情報源を受け取る
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // via() メソッドで通知方法を選択
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // 通知方法に応じた通知内容を返すメソッドを実装する.slackならtoSlack()
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
                    ->from('LikeWords@example.com', config('app.name'))
                    ->subject('パスワード再設定')
                    ->line('下のボタンをクリックしてパスワードを再設定してください。')
                    ->action('パスワード再設定', url(config('app.url').route('password.reset', $this->token, false)))
                    ->line('もし心当たりがない場合は、本メッセージは破棄してください。');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
