<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionLogoutTest extends TestCase
{
	public function testLogoutReturnsDataKey(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testLogoutReturnsEmptyDataArrayByDefault(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testLogoutReturnsGivenArrayData(): void
	{
		$action = new AuthenticationResponseAction();

		$payload = [
			'revoked_tokens_count' => 2,
		];

		$response = $action->logout($payload);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testLogoutReturnsGivenJsonResourceData(): void
	{
		$action = new AuthenticationResponseAction();

		$payload = [
			'revoked_tokens_count' => 2,
		];

		$resource = JsonResource::make($payload);

		$response = $action->logout($resource);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testLogoutReturnsOkStatusCode(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testLogoutReturnsSuccessfulLogoutMessage(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$response_data = $response->getData(true);

		$this->assertSame(__('bersiv-api-response::auths.successful.logout'), $response_data['message']);
	}

	public function testLogoutReturnsSuccessResponseShape(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testLogoutReturnsSuccessStatusFlag(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
