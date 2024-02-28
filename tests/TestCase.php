<?php

namespace WebduoNederland\LaravelWebsiteMonitorClient\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use WebduoNederland\LaravelWebsiteMonitorClient\LaravelWebsiteMonitorClientServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelWebsiteMonitorClientServiceProvider::class,
        ];
    }
}
