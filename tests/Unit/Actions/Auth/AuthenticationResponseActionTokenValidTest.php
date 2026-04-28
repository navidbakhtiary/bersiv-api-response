<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Auth\AuthenticationResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class AuthenticationResponseActionTokenValidTest extends TestCase
{
	public function testTokenValidReturnsDefaultSuccessContract(): void
	{
		$action = new AuthenticationResponseAction();

		$response = $action->tokenValid();

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(__('bersiv-api-response::auths.successful.valid_token'), $response_data['message']);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testTokenValidReturnsGivenArrayData(): void
	{
		$action = new AuthenticationResponseAction();

		$payload = [
			'user_id' => 1,
			'valid' => true,
		];

		$response = $action->tokenValid($payload);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(__('bersiv-api-response::auths.successful.valid_token'), $response_data['message']);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testTokenValidReturnsGivenJsonResourceData(): void
	{
		$action = new AuthenticationResponseAction();

		$payload = [
			'user_id' => 1,
			'valid' => true,
		];

		$resource = JsonResource::make($payload);

		$response = $action->tokenValid($resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(__('bersiv-api-response::auths.successful.valid_token'), $response_data['message']);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}
}
