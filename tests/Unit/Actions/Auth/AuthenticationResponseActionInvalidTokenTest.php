<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnauthorizedResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionInvalidTokenTest extends TestCase
{
	public function testInvalidTokenMatchesUnauthorizedResponseBuilder(): void
	{
		$action = new AuthenticationResponseAction();

		$actual_response = $action->invalidToken();
		$expected_response = UnauthorizedResponse::invalidToken();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testInvalidTokenReturnsErrorsKey(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidToken();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidTokenReturnsFailureResponseShape(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidToken();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testInvalidTokenReturnsGivenArrayErrors(): void
	{
		$action = new AuthenticationResponseAction();

		$errors = [
			'token' => ['The provided token is invalid.'],
		];

		$response = $action->invalidToken($errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidTokenReturnsGivenJsonResourceErrors(): void
	{
		$action = new AuthenticationResponseAction();

		$errors = [
			'token' => ['The provided token is invalid.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->invalidToken($resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testInvalidTokenReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidToken();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testInvalidTokenReturnsFailureStatusFlag(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidToken();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testInvalidTokenReturnsUnauthorizedStatusCode(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidToken();

		$this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
	}
}
