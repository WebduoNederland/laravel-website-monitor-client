<?php

namespace WebduoNederland\LaravelWebsiteMonitorClient\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use WebduoNederland\LaravelWebsiteMonitorClient\Actions\MonitorDataAction;

class SendMonitorDataJob implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;

    public function handle(MonitorDataAction $monitorData): void
    {
        $monitorData->monitor();
    }
}
