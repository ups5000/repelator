<?php

namespace App\Console;

use App\Jobs\GetProducts;
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
        //Set every minute for test and more. In production change it to everyDay or everyWeek. how updated do we want the site?
       $schedule->job( new GetProducts('https://www.appliancesdelivered.ie/search/small-appliances?sort=price_desc&page=',1) )->everyMinute();
       $schedule->job( new GetProducts('https://www.appliancesdelivered.ie/search/dishwashers?page=',1) )->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
