<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Console\DownCommand;
use Illuminate\Support\Facades\Cookie;

class ExtendedDownCommand extends DownCommand
{
    protected $signature = 'down {--secret= : The secret phrase to bypass maintenance mode}
                                {--time= : The duration (in minutes) to keep the application in maintenance mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $secret = $this->option('secret');
        $time = $this->option('time');
        $timeInMinutes = $time ? intval($time) * 60 : 720;

        if ($time) {
            $this->call('down', [
                '--secret' => $secret,
            ]);
            if ($secret) {
                Cookie::queue('laravel_maintenance', $secret, $timeInMinutes, null, null, false, true);
            }
        } else {
            parent::handle();
        }

        $this->info('Application is now in maintenance mode.');
        return 0;
    }
}
