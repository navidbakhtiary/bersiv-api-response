<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ListResponseActionSearchResultsTest extends TestCase
{
	public function testSearchResultsReturnsEmptySuccessContractWhenCollectionIsEmpty(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user', []);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_searched_query_list', ['entity' => 'user']),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testSearchResultsReturnsEmptySuccessContractWhenDataResourceIsOmitted(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user');

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_searched_query_list', ['entity' => 'user']),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testSearchResultsReturnsSuccessContractWhenCollectionHasItems(): void
	{
		$action = new ListResponseAction();

		$payload = [
			[
				'id' => 1,
				'name' => 'Navid',
			],
		];

		$response = $action->searchResults('user', $payload);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.searched_query_list_retrieved', ['entity' => 'user']),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testSearchResultsReturnsSuccessContractWithJsonResourceData(): void
	{
		$action = new ListResponseAction();

		$payload = [
			[
				'id' => 1,
				'name' => 'Navid',
			],
		];

		$resource = JsonResource::make($payload);

		$response = $action->searchResults('user', $resource);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.searched_query_list_retrieved', ['entity' => 'user']),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}
}
