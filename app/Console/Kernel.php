<?php

namespace App\Console;

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
        Commands\AllCheckersCommand::class,
        Commands\BrowserConsoleCommand::class,
        Commands\CertificateCheckCommand::class,
        Commands\CrawlSiteCommand::class,
        Commands\DnsCheckCommand::class,
        Commands\OpenGraphCheckCommand::class,
        Commands\ResetQueueStatus::class,
        Commands\RobotCheckCommand::class,
        Commands\ScanCertificateCommand::class,
        Commands\ScanConsoleCommand::class,
        Commands\ScanCrawlerCommand::class,
        Commands\ScanDnsCommand::class,
        Commands\ScanEverythingCommand::class,
        Commands\ScanOpenGraphCommand::class,
        Commands\ScanRobotsCommand::class,
        Commands\ScanUptimeCommand::class,
        Commands\ScanVisualDiffsCommand::class,
        Commands\UptimeCheckCommand::class,
        Commands\VisualDiffCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('scan:uptime')->everyMinute()->withoutOverlapping()->runInBackground();
        $schedule->command('scan:robots')->hourly()->withoutOverlapping()->runInBackground();
        $schedule->command('scan:dns')->hourly()->withoutOverlapping()->runInBackground();
        $schedule->command('scan:certificates')->dailyAt('08:00:00')->withoutOverlapping()->runInBackground();
        $schedule->command('scan:opengraph')->dailyAt('08:00:00')->withoutOverlapping()->runInBackground();
        $schedule->command('scan:consoles')->daily()->withoutOverlapping()->runInBackground();
        $schedule->command('scan:visual-diffs')->daily()->withoutOverlapping()->runInBackground();
        $schedule->command('scan:crawler')->weekly()->withoutOverlapping()->runInBackground();
        $schedule->command('horizon:snapshot')->everyFiveMinutes()->withoutOverlapping()->runInBackground();
    }
}
