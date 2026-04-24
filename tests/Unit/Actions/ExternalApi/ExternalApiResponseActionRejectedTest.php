<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\ExternalApi;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\ExternalApi\ExternalApiResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\BadGatewayResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ExternalApiResponseActionRejectedTest extends TestCase
{
	public function testRejectedMatchesBadGatewayResponseBuilderWithDefaultMessage(): void
	{
		$action = new ExternalApiResponseAction();

		$actual_response = $action->rejected();
		$expected_response = BadGatewayResponse::externalApiRejected();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testRejectedMatchesBadGatewayResponseBuilderWithCustomMessage(): void
	{
		$action = new ExternalApiResponseAction();

		$actual_response = $action->rejected('External API rejected the payload.');
		$expected_response = BadGatewayResponse::externalApiRejected('External API rejected the payload.');

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testRejectedReturnsErrorsKey(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->rejected();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testRejectedReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->rejected();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testRejectedReturnsGivenArrayErrors(): void
	{
		$action = new ExternalApiResponseAction();

		$errors = [
			'upstream' => ['Validation failed in external API.'],
		];

		$response = $action->rejected(null, $errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testRejectedReturnsGivenJsonResourceErrors(): void
	{
		$action = new ExternalApiResponseAction();

		$errors = [
			'upstream' => ['Validation failed in external API.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->rejected(null, $resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testRejectedReturnsDefaultFailureMessageWhenMessageIsNotProvided(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->rejected();

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.failures.external_api_rejected'),
			$response_data['message']
		);
	}

	public function testRejectedReturnsCustomFailureMessageWhenMessageIsProvided(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->rejected('External API rejected the payload.');

		$response_data = $response->getData(true);

		$this->assertSame('External API rejected the payload.', $response_data['message']);
	}

	public function testRejectedReturnsBadGatewayStatusCode(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->rejected();

		$this->assertSame(JsonResponse::HTTP_BAD_GATEWAY, $response->getStatusCode());
	}

	public function testRejectedReturnsFailureResponseShape(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->rejected();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testRejectedReturnsFailureStatusFlag(): void
	{
		$action = new ExternalApiResponseAction();

		$response = $action->rejected();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}
}
