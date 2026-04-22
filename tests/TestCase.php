<?php

namespace NavidBakhtiary\BersivApiResponse\Tests;

use NavidBakhtiary\BersivApiResponse\BersivApiResponseServiceProvider;
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
