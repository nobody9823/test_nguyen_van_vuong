<?php

namespace App\Mail\Talent;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
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
    public function __construct($email_verification)
    {
        $this->pre_user = $email_verification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config('mail.from.address'))
            ->subject('【ガーディアン】仮登録が完了しました')
            ->view('talent.mail.template.pre_register')
            ->with([
                'token' => $this->pre_user->token,
            ]);
    }
}
