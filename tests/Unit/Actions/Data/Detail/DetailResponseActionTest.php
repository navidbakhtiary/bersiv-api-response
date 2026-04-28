<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\DetailResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class DetailResponseActionTest extends TestCase
{
	public function testHandleReturnsFailureContractWhenModelResourceIsNull(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user');

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.entity_not_found', ['entity' => 'user']),
			$response_data['message']
		);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testHandleReturnsFailureContractWhenModelResourceIsOmitted(): void
	{
		$action = new DetailResponseAction();

		$response = $action->handle('user');

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
		$this->assertFalse($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.failures.entity_not_found', ['entity' => 'user']),
			$response_data['message']
		);
		$this->assertSame([], $response_data['errors']);
		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testHandleReturnsSuccessContractWithArrayDataWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$payload = [
			'email' => 'navid@example.com',
			'id' => 1,
			'name' => 'Navid',
		];

		$response = $action->handle('user', $payload);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.model_found', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsSuccessContractWithJsonResourceDataWhenModelResourceIsFound(): void
	{
		$action = new DetailResponseAction();

		$payload = [
			'email' => 'navid@example.com',
			'id' => 1,
			'name' => 'Navid',
		];

		$resource = JsonResource::make($payload);

		$response = $action->handle('user', $resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.model_found', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}
}
