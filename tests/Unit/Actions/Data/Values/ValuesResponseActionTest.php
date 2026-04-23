<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ValuesResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ValuesResponseActionTest extends TestCase
{
	public function testHandleReturnsDataKey(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status', ['active', 'inactive']);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testHandleReturnsGivenArrayData(): void
	{
		$action = new ValuesResponseAction();

		$values = ['active', 'inactive'];

		$response = $action->handle('user', 'status', $values);

		$response_data = $response->getData(true);

		$this->assertSame($values, $response_data['data']);
	}

	public function testHandleReturnsGivenJsonResourceData(): void
	{
		$action = new ValuesResponseAction();

		$values = ['active', 'inactive'];

		$resource = JsonResource::make($values);

		$response = $action->handle('user', 'status', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($values, $response_data['data']);
	}

	public function testHandleReturnsEmptyDataArrayByDefault(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testHandleReturnsEmptyMessageWhenValuesAreOmitted(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status');

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_values_list', [
				'model' => 'user',
				'attribute' => 'status',
			]),
			$response_data['message']
		);
	}

	public function testHandleReturnsRetrievedMessageWhenValuesExist(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status', ['active', 'inactive']);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.values_list_retrieved', [
				'model' => 'user',
				'attribute' => 'status',
			]),
			$response_data['message']
		);
	}

	public function testHandleReturnsEmptyMessageWhenValuesDoNotExist(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status', []);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_values_list', [
				'model' => 'user',
				'attribute' => 'status',
			]),
			$response_data['message']
		);
	}

	public function testHandleReturnsOkStatusCode(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status', []);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testHandleReturnsSuccessResponseShape(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status', []);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testHandleReturnsSuccessStatusFlag(): void
	{
		$action = new ValuesResponseAction();

		$response = $action->handle('user', 'status', []);

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
