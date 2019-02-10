<?php

namespace App\Notifications;

use App\Message;
use App\Repositories\MessageRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


/**
 * Class NewMessageNotification
 * @package App\Notifications
 */
class NewMessageNotification extends Notification
{
    use Queueable;
    /**
     * @var Message
     */
    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message=$message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * @param $notifiable
     * @return array
     */
    public function todatabase($notifiable)
    {
        return [
            'name' => $this->message->fromUser->name,
            'dialog' => $this->message->dialog_id,
        ];
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
