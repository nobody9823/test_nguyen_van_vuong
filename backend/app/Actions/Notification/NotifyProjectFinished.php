<?php

namespace App\Actions\Notification;

use App\Models\Project;
use App\Notifications\ProjectFinishedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class NotifyProjectFinished
{
    public function __construct()
    {
        $this->finished_projects = Project::where('release_status', '掲載中')
            ->whereBetween('end_date', [Carbon::now()->subMinutes(20), Carbon::now()])
            ->with(['user', 'payments.user'])->get();
    }

    public function __invoke()
    {
        foreach ($this->finished_projects as $project) {
            Notification::route('mail', config('mail.customer_support.address'))
                ->notify(new ProjectFinishedNotification($project));
            $project->user->notify(new ProjectFinishedNotification($project));
            foreach ($project->payments as $payment) {
                $payment->user->notify(new ProjectFinishedNotification($project));
            }
        }
    }
}
