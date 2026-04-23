<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Authentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnauthorizedResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionInvalidLoginCredentialsTest extends TestCase
{
	public function testInvalidLoginCredentialsMatchesUnauthorizedResponseBuilder(): void
	{
		$action = new AuthenticationResponseAction();

		$actual_response = $action->invalidLoginCredentials();
		$expected_response = UnauthorizedResponse::invalidLoginCredentials();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testInvalidLoginCredentialsReturnsErrorsKey(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidLoginCredentials();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidLoginCredentialsReturnsFailureResponseShape(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidLoginCredentials();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testInvalidLoginCredentialsReturnsGivenArrayErrors(): void
	{
		$action = new AuthenticationResponseAction();

		$errors = [
			'email' => ['These credentials do not match our records.'],
		];

		$response = $action->invalidLoginCredentials($errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidLoginCredentialsReturnsGivenJsonResourceErrors(): void
	{
		$action = new AuthenticationResponseAction();

		$errors = [
			'email' => ['These credentials do not match our records.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->invalidLoginCredentials($resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidLoginCredentialsReturnsFailureStatusFlag(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidLoginCredentials();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testInvalidLoginCredentialsReturnsUnauthorizedStatusCode(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidLoginCredentials();

		$this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
	}
}
