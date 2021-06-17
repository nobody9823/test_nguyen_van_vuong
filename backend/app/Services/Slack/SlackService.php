<?php
namespace App\Services\Slack;

use Illuminate\Notifications\Notifiable;
use App\Notifications\SlackNotification;

class SlackService
{
    use Notifiable;

    public function send($name = null, $message = null)
    {
        $this->notify(new SlackNotification($name, $message));
    }

    protected function routeNotificationForSlack()
    {
        return config('app.slack_url');
    }
}