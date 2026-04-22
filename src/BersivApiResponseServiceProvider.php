<?php

namespace NavidBakhtiary\BersivApiResponse;

use Illuminate\Support\ServiceProvider;

class BersivApiResponseServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any package services.
	 */
	public function boot(): void
	{
		$this->loadTranslationsFrom(__DIR__ . '/../lang', 'bersiv-api-response');
	}

	/**
	 * Register the package services.
	 */
	public function register(): void
	{
		$this->app->singleton('bersiv-api-response', BersivApiResponseManager::class);
	}
}
