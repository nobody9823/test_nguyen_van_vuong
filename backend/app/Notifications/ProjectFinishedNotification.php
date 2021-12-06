<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectFinishedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project)
    {
        $this->project = $project->getLoadIncludedPaymentsCountAndSumPrice();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $address = $notifiable instanceof AnonymousNotifiable
            ? $notifiable->routeNotificationFor('mail')
            : $notifiable->email;

        if ($address === $this->project->user->email) {
            $url = route('user.my_project.project.show', ['project' => $this->project]);
        } else if ($address === config('mail.customer_support.address')) {
            $url = route('admin.project.index', ['project' => $this->project]);
        } else {
            $url = route('user.project.show', ['project' => $this->project]);
        }

        return (new MailMessage)
            ->subject('【FanReturn】プロジェクトの掲載が終了しました。')
            ->view(
                'user.mail.template.project_is_finished',
                ['project' => $this->project, 'url' => $url]
            );
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
