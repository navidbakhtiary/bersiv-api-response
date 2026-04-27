<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\RateLimit;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\RateLimit\RateLimitResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\TooManyRequestsResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class RateLimitResponseActionTooManyRequestsTest extends TestCase
{
	public function testTooManyRequestsMatchesTooManyRequestsResponseBuilder(): void
	{
		$action = new RateLimitResponseAction();

		$actual_response = $action->tooManyRequests();
		$expected_response = TooManyRequestsResponse::tooManyRequests();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testTooManyRequestsReturnsErrorsKey(): void
	{
		$action = new RateLimitResponseAction();

		$response = $action->tooManyRequests();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testTooManyRequestsReturnsFailureResponseShape(): void
	{
		$action = new RateLimitResponseAction();

		$response = $action->tooManyRequests();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testTooManyRequestsReturnsGivenArrayErrors(): void
	{
		$action = new RateLimitResponseAction();

		$errors = [
			'rate_limit' => ['Too many requests. Please try again later.'],
		];

		$response = $action->tooManyRequests($errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
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

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testTooManyRequestsReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new RateLimitResponseAction();

		$response = $action->tooManyRequests();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testTooManyRequestsReturnsFailureStatusFlag(): void
	{
		$action = new RateLimitResponseAction();

		$response = $action->tooManyRequests();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testTooManyRequestsReturnsTooManyRequestsStatusCode(): void
	{
		$action = new RateLimitResponseAction();

		$response = $action->tooManyRequests();

		$this->assertSame(JsonResponse::HTTP_TOO_MANY_REQUESTS, $response->getStatusCode());
	}
}
