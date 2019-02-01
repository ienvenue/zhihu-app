<?php

namespace App\Notifications;

use App\Channels\SendCloudChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Naux\Mail\SendCloudTemplate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


    /**
 * Class NewUserFollowNotification
 * @package App\Notifications
 */
class NewUserFollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SendCloudChannel::class,'database',];
    }

    /**
     * @param $notifiable
     */
    public function toSendcloud($notifiable)
    {
        $data = [
            'url' => 'zhihu-local.com',
            'name'=>Auth::guard('api')->user()->name
        ];
        $template = new SendCloudTemplate('zhihu_app_user_follow', $data);

        Mail::raw($template, function ($message) use($notifiable){
           // $message->from('chenyangjieabc@gmail', 'Zhihu-app');
           //this is a bug, SendCloud Use Bug
            $message->to($notifiable->email);
        });
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
//    }
    /**
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
          'name'=>Auth::guard('api')->user()->name,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
