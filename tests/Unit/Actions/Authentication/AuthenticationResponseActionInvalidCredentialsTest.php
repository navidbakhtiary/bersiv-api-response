<?php

namespace NavidBakhtiary\BersivApiResponse\Unit\Actions\Authentication;

use Illuminate\Http\Response;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnauthorizedResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionInvalidCredentialsTest extends TestCase
{
	public function testInvalidCredentialsMatchesUnauthorizedResponseBuilder(): void
	{
		$action = new AuthenticationResponseAction();

		$actual_response = $action->invalidCredentials();
		$expected_response = UnauthorizedResponse::invalidCredentials();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testInvalidCredentialsReturnsErrorsKey(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidCredentials();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidCredentialsReturnsFailureResponseShape(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidCredentials();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayHasKey('message', $response_data);
	}

	public function testInvalidCredentialsReturnsFailureStatusFlag(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidCredentials();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testInvalidCredentialsReturnsUnauthorizedStatusCode(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidCredentials();

		$this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
	}
}
