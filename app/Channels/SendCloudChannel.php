<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/1
 * Time: 13:25
 */

namespace App\Channels;


use http\Message;
use Illuminate\Notifications\Notification;

class SendCloudChannel
{
    public function send($notifiable,Notification $notification)
    {
        $message = $notification->toSendcloud($notifiable);
    }
}