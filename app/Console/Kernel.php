<?php

namespace App\Console;

use App\Jobs\CalculateViewers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Console\Migrations\InstallCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // InstallCommand::class
    ];

    // define your queues here in order of priority
    protected $queues = [
        'default',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // run the queue worker "without overlapping"
        // this will only start a new worker if the previous one has died
        $schedule->command($this->getQueueCommand())
            ->everyMinute()
            ->withoutOverlapping();

        // restart the queue worker periodically to prevent memory issues
        $schedule->command('queue:restart')
            ->hourly();

        $schedule->call(function () {
            option_update('schedule_run', now());
        })->everyMinute();

        $schedule->job(new CalculateViewers)->dailyAt('00:00');
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

    protected function getQueueCommand()
    {
        // build the queue command
        $params = implode(' ', [
            '--daemon',
            '--tries=3',
            '--sleep=3',
            '--queue=' . implode(',', $this->queues),
        ]);

        return sprintf('queue:work %s', $params);
    }
}
