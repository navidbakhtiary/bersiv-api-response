<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\RateLimit;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\RateLimit\RateLimitResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class RateLimitResponseActionTooManyRequestsTest extends TestCase
{
	public function testTooManyRequestsReturnsDefaultFailureContract(): void
	{
		$action = new RateLimitResponseAction();

		$response = $action->tooManyRequests();

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_TOO_MANY_REQUESTS, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.server_restriction'),
			$response_data['message']
		);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testTooManyRequestsReturnsGivenArrayErrors(): void
	{
		$action = new RateLimitResponseAction();

		$errors = [
			'rate_limit' => ['Too many requests. Please try again later.'],
		];

		$response = $action->tooManyRequests($errors);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_TOO_MANY_REQUESTS, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.server_restriction'),
			$response_data['message']
		);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testTooManyRequestsReturnsGivenJsonResourceErrors(): void
	{
		$action = new RateLimitResponseAction();

		$errors = [
			'rate_limit' => ['Too many requests. Please try again later.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->tooManyRequests($resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_TOO_MANY_REQUESTS, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.server_restriction'),
			$response_data['message']
		);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}
}
