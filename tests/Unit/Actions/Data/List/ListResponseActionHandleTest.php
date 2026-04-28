<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data\List;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ListResponseActionHandleTest extends TestCase
{
	public function testHandleReturnsEmptySuccessContractWhenCollectionIsEmpty(): void
	{
		$action = new ListResponseAction();

		$response = $action->handle('user', []);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_models_list', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsEmptySuccessContractWhenDataResourceIsOmitted(): void
	{
		$action = new ListResponseAction();

		$response = $action->handle('user');

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_models_list', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsSuccessContractWhenCollectionHasItems(): void
	{
		$action = new ListResponseAction();

		$payload = [
			['id' => 1, 'name' => 'Navid'],
			['id' => 2, 'name' => 'Sara'],
		];

		$response = $action->handle('user', $payload);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.models_list_retrieved', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsSuccessContractWithJsonResourceData(): void
	{
		$action = new ListResponseAction();

		$payload = [
			['id' => 1, 'name' => 'Navid'],
			['id' => 2, 'name' => 'Sara'],
		];

		$resource = JsonResource::make($payload);

		$response = $action->handle('user', $resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.models_list_retrieved', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}
}
