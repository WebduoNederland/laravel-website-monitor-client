<?php

namespace WebduoNederland\LaravelWebsiteMonitorClient;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use WebduoNederland\LaravelWebsiteMonitorClient\Console\Commands\SendMonitorDataCommand;
use WebduoNederland\LaravelWebsiteMonitorClient\Jobs\SendMonitorDataJob;

class LaravelWebsiteMonitorClientServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this
            ->bootConfig()
            ->bootCommands()
            ->bootSchedule();
    }

    protected function bootConfig(): static
    {
        $this->publishes([
            __DIR__.'/../config/laravel-website-monitor-client.php' => config_path('laravel-website-monitor-client.php'),
        ], 'config');

        return $this;
    }

    protected function bootCommands(): static
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SendMonitorDataCommand::class,
            ]);
        }

        return $this;
    }

    protected function bootSchedule(): static
    {
        $this->app->booted(function (): void {
            /** @var Schedule $schedule */
            $schedule = $this->app->make(Schedule::class);

            if (config('laravel-website-monitor-client.enabled', true)) {
                $schedule->job(SendMonitorDataJob::class)->everyThirtySeconds();
            }
        });

        return $this;
    }

    public function register(): void
    {
        $this
            ->registerConfig();
    }

    protected function registerConfig(): static
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-website-monitor-client.php', 'laravel-website-monitor-client');

        return $this;
    }
}
