<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pre_user)
    {
        $this->pre_user = $pre_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('【FanReturn】仮登録が完了しました')
            ->view('user.mail.template.pre_register')
            ->with([
                'token' => $this->pre_user->token,
            ]);
    }
}
