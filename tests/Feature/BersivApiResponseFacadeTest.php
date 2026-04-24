<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Feature;

use Illuminate\Http\JsonResponse;
use NavidBakhtiary\BersivApiResponse\Facades\BersivApiResponse;
use Orchestra\Testbench\TestCase;

class BersivApiResponseFacadeTest extends TestCase
{
	protected function getPackageProviders($app): array
	{
		return [
			\NavidBakhtiary\BersivApiResponse\Providers\BersivApiResponseServiceProvider::class,
		];
	}

	public function testCanReturnOkResponseUsingFacade(): void
	{
		$response = BersivApiResponse::login([
			'token' => 'sample-token',
			'user' => [
				'email' => 'navid@example.com',
				'id' => 1,
			],
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}
}
