<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailToCheeringUsers extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     protected $contents;
     /**
      * Create a new message instance.
      *
      * @return void
      */
    public function __construct($subject, $description, $user)
    {
         $this->subject = $subject;
         $this->description = $description;
         $this->user = $user;
    }

     /**
      * Build the message.
      *
      * @return $this
      */
    public function build()
    {
         return $this->view('admin.mail.template.cheering_users_mail')
                       ->from(\Auth::user()->email)
                         ->subject($this->subject)
                           ->with([
                             'subject' => $this->subject,
                             'description' => $this->description,
                             'user' => $this->user,
                           ]);
    }
}
