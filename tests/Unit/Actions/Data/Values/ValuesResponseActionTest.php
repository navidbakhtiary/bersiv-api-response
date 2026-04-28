<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ValuesResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ValuesResponseActionTest extends TestCase
{
	public function testHandleReturnsEmptySuccessContractWhenValuesAreEmpty(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status', []);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_values_list', [
				'model' => 'user',
				'attribute' => 'status',
			]),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsEmptySuccessContractWhenValuesAreOmitted(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status');

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_values_list', [
				'model' => 'user',
				'attribute' => 'status',
			]),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsSuccessContractWhenValuesExist(): void
	{
		$action = new ValuesResponseAction();

		$values = ['active', 'inactive'];

		$response = $action->handle('user', 'status', $values);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.values_list_retrieved', [
				'model' => 'user',
				'attribute' => 'status',
			]),
			$response_data['message']
		);
		$this->assertSame($values, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsSuccessContractWithJsonResourceData(): void
	{
		$action = new ValuesResponseAction();

		$values = ['active', 'inactive'];

		$resource = JsonResource::make($values);

		$response = $action->handle('user', 'status', $resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.values_list_retrieved', [
				'model' => 'user',
				'attribute' => 'status',
			]),
			$response_data['message']
		);
		$this->assertSame($values, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}
}
