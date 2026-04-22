<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Authentication;

use Illuminate\Http\Response;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionTokenValidTest extends TestCase
{
	public function testTokenValidReturnsDataKey(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->tokenValid();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testTokenValidReturnsEmptyDataArrayByDefault(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->tokenValid();

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testTokenValidReturnsOkStatusCode(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->tokenValid();

		$this->assertSame(Response::HTTP_OK, $response->getStatusCode());
	}

	public function testTokenValidReturnsSuccessResponseShape(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->tokenValid();

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testTokenValidReturnsSuccessStatusFlag(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->tokenValid();

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}

	public function testTokenValidReturnsValidTokenMessage(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->tokenValid();

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::auths.successful.valid_token'),
			$response_data['message']
		);
	}
}
