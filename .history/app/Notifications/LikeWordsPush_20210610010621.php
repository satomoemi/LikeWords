<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class LikeWordsPush extends Notification
{

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    /**
     * プッシュ通知をする
     *
     * @param [type] $notifiable
     * @param [type] $notification
     * @return void
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('今日のWord')
            ->body('test word incomming!!');
            
    }
}
