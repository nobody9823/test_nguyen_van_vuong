<?php

namespace App\Mail\User;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultProject extends Mailable
{
    use Queueable, SerializesModels;

    public $input;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(Auth::user()->email, Auth::user()->name)
            ->subject('【FanReturn】プロジェクト掲載申請')
            ->view('user.mail.template.consult_project');

            if (isset($this->input['files'])) {

                foreach ($this->input['files'] as $file) {
                    $mail->attach($file, [
                        'as' => $file->getClientOriginalName(),
                    ]);
                }
            }

        return $mail;
    }
}
