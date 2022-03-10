<?php

namespace App\Console;

use App\Actions\GMO\UpdatePaymentIsFinishedByCVS;
use App\Actions\Notification\NotifyProjectFinished;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(new NotifyProjectFinished)->everyFifteenMinutes()->emailOutputOnFailure(config('mail.customer_support.address'));
        $schedule->call(new UpdatePaymentIsFinishedByCVS)->dailyAt('12:00')->emailOutputOnFailure(config('mail.customer_support.address'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
