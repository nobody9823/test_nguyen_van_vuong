<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $sender, $url)
    {
        $this->recipient = $recipient->name;
        $this->sender = $sender->name;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.template.notification_message')
            ->from(config('mail.from.address'), config('mail.from.title'))
            ->subject('【ガーディアン】新着メッセージのお知らせ')
            ->with([
                'recipient' => $this->recipient,
                'sender' => $this->sender,
                'url' => $this->url,
            ]);
    }
}
