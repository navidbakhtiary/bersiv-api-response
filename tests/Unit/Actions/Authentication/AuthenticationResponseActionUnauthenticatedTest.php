<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Authentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnauthorizedResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionUnauthenticatedTest extends TestCase
{
	public function testUnauthenticatedMatchesUnauthorizedResponseBuilder(): void
	{
		$action = new AuthenticationResponseAction();

		$actual_response = $action->unauthenticated();
		$expected_response = UnauthorizedResponse::unauthenticated();

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testUnauthenticatedReturnsErrorsKey(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->unauthenticated();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testUnauthenticatedReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->unauthenticated();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testUnauthenticatedReturnsFailureResponseShape(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->unauthenticated();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testUnauthenticatedReturnsGivenArrayErrors(): void
	{
		$action = new AuthenticationResponseAction();

		$errors = [
			'token' => ['The provided token is invalid.'],
		];

		$response = $action->unauthenticated($errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testUnauthenticatedReturnsGivenJsonResourceErrors(): void
	{
		$action = new AuthenticationResponseAction();

		$errors = [
			'token' => ['The provided token is invalid.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->unauthenticated($resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testUnauthenticatedReturnsFailureStatusFlag(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->unauthenticated();

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testUnauthenticatedReturnsUnauthorizedStatusCode(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->unauthenticated();

		$this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
	}
}
