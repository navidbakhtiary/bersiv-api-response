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
		$this->publishes([
			__DIR__ . '/../lang' => lang_path('vendor/bersiv-api-response'),
		], 'bersiv-api-response-translations');

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
