<?php

namespace NBDev\BersivApiResponse\Tests;

use NBDev\BersivApiResponse\Providers\BersivApiResponseServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            BersivApiResponseServiceProvider::class,
        ];
    }
}
