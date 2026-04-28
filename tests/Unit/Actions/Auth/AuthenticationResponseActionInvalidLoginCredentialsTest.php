<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionInvalidLoginCredentialsTest extends TestCase
{
	public function testInvalidLoginCredentialsReturnsDefaultFailureContract(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->invalidLoginCredentials();

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(__('bersiv-api-response::auths.failures.incorrect_credentials'), $response_data['message']);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testInvalidLoginCredentialsReturnsGivenArrayErrors(): void
	{
		$action = new AuthenticationResponseAction();

		$errors = [
			'email' => ['These credentials do not match our records.'],
		];

		$response = $action->invalidLoginCredentials($errors);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(__('bersiv-api-response::auths.failures.incorrect_credentials'), $response_data['message']);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
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

		$this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(__('bersiv-api-response::auths.failures.incorrect_credentials'), $response_data['message']);
		$this->assertSame($errors, $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}
}
