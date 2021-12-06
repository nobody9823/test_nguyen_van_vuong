<?php

namespace App\Notifications;

use App\Models\Project;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Project $project, Payment $payment)
    {
        $this->project = $project->getLoadIncludedPaymentsCountAndSumPrice();

        $this->payment = $payment;
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
        return (new MailMessage)
            ->subject('【FanReturn】リターンの購入が完了しました。')
            ->view(
                'user.mail.template.payment_finished',
                [
                    'billing_users_count' => $this->project->payments_count,
                    'payments_sum_price' => $this->project->payments_sum_price,
                    'project_title' => $this->project->title,
                    'payment_id' => $this->payment->paymentToken->order_id,
                ]
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
