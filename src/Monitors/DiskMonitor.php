<?php

namespace WebduoNederland\LaravelWebsiteMonitorClient\Monitors;

use Closure;

class DiskMonitor
{
    public function handle(array $data, Closure $next): array|Closure
    {
        $data['disk']['total'] = intval(round(disk_total_space('/') / 1024 / 1024));

        $data['disk']['used'] = intval(round($data['disk']['total'] - (disk_free_space('/') / 1024 / 1024)));

        return $next($data);
    }
}
