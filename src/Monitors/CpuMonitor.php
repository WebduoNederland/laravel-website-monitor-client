<?php

namespace WebduoNederland\LaravelWebsiteMonitorClient\Monitors;

use Closure;

class CpuMonitor
{
    public function handle(array $data, Closure $next): array|Closure
    {
        $data['cpu']['current'] = match (PHP_OS_FAMILY) {
            'Darwin' => (int) `top -l 1 | grep -E "^CPU" | tail -1 | awk '{ print $3 + $5 }'`,
            'Linux' => (int) `top -bn1 | grep -E '^(%Cpu|CPU)' | awk '{ print $2 + $4 }'`,
            'Windows' => (int) trim(`wmic cpu get loadpercentage | more +1`),
            'BSD' => (int) `top -b -d 2| grep 'CPU: ' | tail -1 | awk '{print$10}' | grep -Eo '[0-9]+\.[0-9]+' | awk '{ print 100 - $1 }'`,
            default => 0,
        };

        [$cpuAvgOneMinute, $cpuAvgFiveMinutes, $cpuAvgFiteenMinutes] = data_get(sys_getloadavg(), null, []);

        $data['cpu']['average'] = [
            '1min' => $cpuAvgOneMinute,
            '5min' => $cpuAvgFiveMinutes,
            '15min' => $cpuAvgFiteenMinutes,
        ];

        return $next($data);
    }
}
