<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\ExternalApi;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\ExternalApi\ExternalApiResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\ServiceUnavailableResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ExternalApiResponseActionUnavailableTest extends TestCase
{
	public function testUnavailableMatchesServiceUnavailableResponseBuilder(): void
	{
		$action = new ExternalApiResponseAction();

		$actual_response = $action->unavailable();
		$expected_response = ServiceUnavailableResponse::externalApiUnavailable();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testUnavailableReturnsErrorsKey(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->unavailable();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testUnavailableReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->unavailable();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testUnavailableReturnsGivenArrayErrors(): void
	{
		$action = new ExternalApiResponseAction();

		$errors = [
			'upstream' => ['Service timeout.'],
		];

		$response = $action->unavailable($errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testUnavailableReturnsGivenJsonResourceErrors(): void
	{
		$action = new ExternalApiResponseAction();

		$errors = [
			'upstream' => ['Service timeout.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->unavailable($resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testUnavailableReturnsDefaultFailureMessage(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->unavailable();

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.failures.unavailable_external_api'),
			$response_data['message']
		);
	}

	public function testUnavailableReturnsServiceUnavailableStatusCode(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->unavailable();

		$this->assertSame(JsonResponse::HTTP_SERVICE_UNAVAILABLE, $response->getStatusCode());
	}

	public function testUnavailableReturnsFailureResponseShape(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->unavailable();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testUnavailableReturnsFailureStatusFlag(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->unavailable();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}
}
