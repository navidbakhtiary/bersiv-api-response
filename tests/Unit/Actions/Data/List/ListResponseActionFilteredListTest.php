<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Helpers\Utilities;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ListResponseActionFilteredListTest extends TestCase
{
	public function testFilteredListReturnsDataKey(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status', [
			['id' => 1],
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testFilteredListReturnsGivenArrayData(): void
	{
		$action = new ListResponseAction();

		$payload = [
			['id' => 1, 'status' => 'active'],
		];

		$response = $action->filteredList('user', 'status', $payload);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testFilteredListReturnsGivenJsonResourceData(): void
	{
		$action = new ListResponseAction();

		$payload = [
			['id' => 1, 'status' => 'active'],
		];

		$resource = JsonResource::make($payload);

		$response = $action->filteredList('user', 'status', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testFilteredListReturnsFilledFilteredListMessageWhenCollectionHasItemsAndAttributeIsString(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status', [
			['id' => 1],
		]);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
				'model' => 'user',
				'attributes' => 'status',
			]),
			$response_data['message']
		);
	}

	public function testFilteredListReturnsEmptyFilteredListMessageWhenCollectionIsEmptyAndAttributeIsString(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status', []);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_filtered_models_list', [
				'model' => 'user',
				'attributes' => 'status',
			]),
			$response_data['message']
		);
	}

	public function testFilteredListReturnsFilledFilteredListMessageWhenCollectionHasItemsAndAttributesAreArray(): void
	{
		$action = new ListResponseAction();

		$attributes = ['status', 'type'];
		$attributes_text = Utilities::createStringFromArray($attributes);

		$response = $action->filteredList('user', $attributes, [
			['id' => 1],
		]);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.filtered_models_list_retrieved', [
				'model' => 'user',
				'attributes' => $attributes_text,
			]),
			$response_data['message']
		);
	}

	public function testFilteredListReturnsEmptyFilteredListMessageWhenCollectionIsEmptyAndAttributesAreArray(): void
	{
		$action = new ListResponseAction();

		$attributes = ['status', 'type'];
		$attributes_text = Utilities::createStringFromArray($attributes);

		$response = $action->filteredList('user', $attributes, []);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_filtered_models_list', [
				'model' => 'user',
				'attributes' => $attributes_text,
			]),
			$response_data['message']
		);
	}

	public function testFilteredListReturnsEmptyDataArrayByDefault(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testFilteredListReturnsEmptyFilteredListMessageWhenDataResourceIsOmitted(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status');

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_filtered_models_list', [
				'model' => 'user',
				'attributes' => 'status',
			]),
			$response_data['message']
		);
	}

	public function testFilteredListReturnsOkStatusCode(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status', []);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testFilteredListReturnsSuccessResponseShape(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status', []);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testFilteredListReturnsSuccessStatusFlag(): void
	{
		$action = new ListResponseAction();

		$response = $action->filteredList('user', 'status', []);

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
