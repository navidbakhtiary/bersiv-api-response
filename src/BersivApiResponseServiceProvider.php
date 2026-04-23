<?php

namespace NavidBakhtiary\BersivApiResponse;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for the Bersiv API Response package.
 */
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
