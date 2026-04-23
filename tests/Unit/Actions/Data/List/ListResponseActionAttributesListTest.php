<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ListResponseActionAttributesListTest extends TestCase
{
	public function testAttributesListReturnsDataKey(): void
	{
		$action = new ListResponseAction();

		$response = $action->attributesList('user', ['name', 'email']);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testAttributesListReturnsGivenAttributesAsData(): void
	{
		$action = new ListResponseAction();

		$attributes = ['name', 'email'];

		$response = $action->attributesList('user', $attributes);

		$response_data = $response->getData(true);

		$this->assertSame($attributes, $response_data['data']);
	}

	public function testAttributesListReturnsRetrievedMessageWhenAttributesExist(): void
	{
		$action = new ListResponseAction();

		$response = $action->attributesList('user', ['name', 'email']);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.attributes_list_retrieved', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testAttributesListReturnsGivenJsonResourceData(): void
	{
		$action = new ListResponseAction();

		$attributes = ['name', 'email'];

		$resource = JsonResource::make($attributes);

		$response = $action->attributesList('user', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($attributes, $response_data['data']);
	}

	public function testAttributesListReturnsEmptyDataArrayByDefault(): void
	{
		$action = new ListResponseAction();

		$response = $action->attributesList('user');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testAttributesListReturnsEmptyMessageWhenAttributesDoNotExist(): void
	{
		$action = new ListResponseAction();

		$response = $action->attributesList('user', []);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_attributes_list', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testAttributesListReturnsOkStatusCode(): void
	{
		$action = new ListResponseAction();

		$response = $action->attributesList('user', []);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testAttributesListReturnsSuccessResponseShape(): void
	{
		$action = new ListResponseAction();

		$response = $action->attributesList('user', []);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testAttributesListReturnsSuccessStatusFlag(): void
	{
		$action = new ListResponseAction();

		$response = $action->attributesList('user', []);

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
