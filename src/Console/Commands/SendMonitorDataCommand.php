<?php

namespace WebduoNederland\LaravelWebsiteMonitorClient\Console\Commands;

use Illuminate\Console\Command;
use WebduoNederland\LaravelWebsiteMonitorClient\Jobs\SendMonitorDataJob;

class SendMonitorDataCommand extends Command
{
    protected $signature = 'website-monitor:send-monitor-data';

    protected $description = 'Dispatch the job to monitor data and send to laravel website monitor dashboard';

    public function handle(): int
    {
        SendMonitorDataJob::dispatch();

        return static::SUCCESS;
    }
}
