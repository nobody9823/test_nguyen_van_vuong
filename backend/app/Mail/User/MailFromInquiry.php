<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailFromInquiry extends Mailable
{
    use Queueable, SerializesModels;

    protected $contents;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inquiry, $file_names)
    {
        $this->inquiry = $inquiry;
        $this->file_names = $file_names;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->view('user.mail.template.inquiry')
                    ->from($this->inquiry->email)
                    ->subject('お問い合わせ種類:'.($this->inquiry->inquiry_category === '選択してください' ? '無選択':$this->inquiry->inquiry_category))
                    ->with([
                             'inquiry' => $this->inquiry,
                           ]);

        if ($this->file_names) {
            foreach ($this->file_names as $file_name) {
                $mail->attach(storage_path('app/public/image/' . $file_name));
            }
        }

        return $mail;
    }
}
