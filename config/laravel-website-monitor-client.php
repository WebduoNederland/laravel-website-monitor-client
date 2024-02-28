<?php

use WebduoNederland\LaravelWebsiteMonitorClient\Monitors\CpuMonitor;
use WebduoNederland\LaravelWebsiteMonitorClient\Monitors\DiskMonitor;
use WebduoNederland\LaravelWebsiteMonitorClient\Monitors\MemoryMonitor;

return [
    /**
     * When set to false no data will be send to the laravel website monitor dashboard
     */
    'enabled' => true,

    /**
     * Define the base URL (host) of the laravel website monitor dashboard
     */
    'base_url' => env('LARAVEL_WEBSITE_MONITOR_BASE_URL'),

    /**
     * Define the API prefix path which HTTP requests will be sent to
     */
    'api_prefix' => 'api/v1',

    /**
     * Define the API key which is used to send HTTP to the laravel website monitor dashboard
     */
    'api_key' => env('LARAVEL_WEBSITE_MONITOR_API_KEY'),

    /**
     * You can remove or add monitors to this list, feel free to extend it with your own monitors
     */
    'monitors' => [
        CpuMonitor::class,
        MemoryMonitor::class,
        DiskMonitor::class,
    ],
];
