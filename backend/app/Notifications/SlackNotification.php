<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Notification;
use Throwable;

class SlackNotification extends Notification
{
    use Queueable;

    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $message)
    {
        $this->name = $name;

        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $message = $this->message;

        $info = (new SlackMessage)
                    ->from($this->name)
                    ->to('z_guardian_notifications');

        if (!is_null($this->message) && is_string($this->message)){
            $info->attachment(function(SlackAttachment $attachment) use ($message){
                $attachment->content($message);
            });
        } elseif (!is_null($this->message) && ($this->message instanceof Throwable)){
            $info->attachment(function(SlackAttachment $attachment) use ($message){
                $attachment
                    ->title(get_class($message))
                    ->content($message->getMessage());
            });
        }

        return $info;
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
