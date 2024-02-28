<?php

namespace WebduoNederland\LaravelWebsiteMonitorClient\Actions;

use Exception;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Http;

class MonitorDataAction
{
    public function __construct(
        public Pipeline $pipeline
    ) {
        //
    }

    public function monitor(): void
    {
        /** @var array $data */
        $data = $this->pipeline
            ->send([])
            ->through(config('laravel-website-monitor-client.monitors', []))
            ->thenReturn();

        /** @var ?string $apiKey */
        $apiKey = config('laravel-website-monitor-client.api_key');

        if (! $apiKey) {
            throw new Exception('No API key set in the env for the laravel-website-monitor-client!');
        }

        /** @var ?string $baseUrl */
        $baseUrl = config('laravel-website-monitor-client.base_url');

        if (! $baseUrl) {
            throw new Exception('No base URL set in the env for the laravel-website-monitor-client!');
        }

        /** @var ?string $apiPrefix */
        $apiPrefix = config('laravel-website-monitor-client.api_prefix');

        if (! $apiPrefix) {
            throw new Exception('No api prefix set in the env for the laravel-website-monitor-client!');
        }

        $response = Http::baseUrl($baseUrl)
            ->withToken($apiKey)
            ->post($apiPrefix.'/monitor', [
                'data' => $data,
                'timestamp' => now()->getTimestamp(),
            ]);

        if (! $response->successful()) {
            throw new Exception('Could not send monitor data to '.$baseUrl);
        }
    }
}
