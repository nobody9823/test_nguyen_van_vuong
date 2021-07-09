<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Model;
use App\Traits\GetModelName;
use Illuminate\Foundation\Auth\User as ModelType;

class MailForPasswordReset extends Mailable
{
    use Queueable, SerializesModels, GetModelName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, ModelType $model)
    {
        $this->token = $token;
        $this->model = $model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.template.password_reset')
            ->subject('パスワード変更のお願い')
            ->with([
                'url' => url(route($this->getModelName().'.password.reset', ['token' => $this->token])),
                'user' => $this->model,
            ]);
    }
}
