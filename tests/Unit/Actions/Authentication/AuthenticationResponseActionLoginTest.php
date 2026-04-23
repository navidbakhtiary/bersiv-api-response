<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Authentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionLoginTest extends TestCase
{
	public function testLoginReturnsDataKey(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->login([
			'token' => 'sample-token',
			'user' => [
				'email' => 'navid@example.com',
				'id' => 1,
			],
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testLoginReturnsGivenArrayData(): void
	{
		$action = new AuthenticationResponseAction();

		$payload = [
			'token' => 'sample-token',
			'user' => [
				'email' => 'navid@example.com',
				'id' => 1,
			],
		];

		$response = $action->login($payload);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testLoginReturnsGivenJsonResourceData(): void
	{
		$action = new AuthenticationResponseAction();

		$payload = [
			'token' => 'sample-token',
			'user' => [
				'email' => 'navid@example.com',
				'id' => 1,
			],
		];

		$resource = JsonResource::make($payload);

		$response = $action->login($resource);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testLoginReturnsEmptyDataArrayByDefault(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->login();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testLoginReturnsOkStatusCode(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->login();

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testLoginReturnsSuccessfulLoginMessage(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->login();

		$response_data = $response->getData(true);

		$this->assertSame(__('bersiv-api-response::auths.successful.login'), $response_data['message']);
	}

	public function testLoginReturnsSuccessResponseShape(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->login();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testLoginReturnsSuccessStatusFlag(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->login();

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
