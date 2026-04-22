<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Authentication;

use Illuminate\Http\Response;
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

	public function testLogoutReturnsEmptyArrayDataByDefault(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testLogoutReturnsOkStatusCode(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$this->assertSame(Response::HTTP_OK, $response->getStatusCode());
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
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayHasKey('message', $response_data);
	}

	public function testLogoutReturnsSuccessStatusFlag(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->logout();

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
