<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Helpers\Utilities;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ListResponseActionFilteredListTest extends TestCase
{
	public function testFilteredListReturnsEmptySuccessContractWhenDataResourceIsOmitted(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status');

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_filtered_models_list', [
				'model' => 'user',
				'attributes' => 'status',
			]),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testFilteredListReturnsEmptySuccessContractWhenCollectionIsEmptyAndAttributeIsString(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status', []);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_filtered_models_list', [
				'model' => 'user',
				'attributes' => 'status',
			]),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testFilteredListReturnsSuccessContractWhenCollectionHasItemsAndAttributeIsString(): void
	{
		$action = new ListResponseAction();

		$payload = [
			[
				'id' => 1,
				'status' => 'active',
			],
		];

		$response = $action->filteredList('user', 'status', $payload);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
				'model' => 'user',
				'attributes' => 'status',
			]),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testFilteredListReturnsSuccessContractWhenCollectionHasItemsAndAttributesAreArray(): void
	{
		$action = new ListResponseAction();

		$attributes = ['status', 'type'];
		$attributes_text = Utilities::createStringFromArray($attributes);

		$payload = [
			[
				'id' => 1,
				'status' => 'active',
				'type' => 'admin',
			],
		];

		$response = $action->filteredList('user', $attributes, $payload);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
				'model' => 'user',
				'attributes' => $attributes_text,
			]),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testFilteredListReturnsSuccessContractWithJsonResourceData(): void
	{
		$action = new ListResponseAction();

		$payload = [
			[
				'id' => 1,
				'status' => 'active',
			],
		];

		$resource = JsonResource::make($payload);

		$response = $action->filteredList('user', 'status', $resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
				'model' => 'user',
				'attributes' => 'status',
			]),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testFilteredListReturnsEmptySuccessContractWhenCollectionIsEmptyAndAttributesAreArray(): void
	{
		$action = new ListResponseAction();

		$attributes = ['status', 'type'];
		$attributes_text = Utilities::createStringFromArray($attributes);

		$response = $action->filteredList('user', $attributes, []);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_filtered_models_list', [
				'model' => 'user',
				'attributes' => $attributes_text,
			]),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}
}
