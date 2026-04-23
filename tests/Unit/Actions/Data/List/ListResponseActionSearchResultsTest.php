<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\ListResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ListResponseActionSearchResultsTest extends TestCase
{
	public function testSearchResultsReturnsDataKey(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user', [
			['id' => 1],
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testSearchResultsReturnsGivenArrayData(): void
	{
		$action = new ListResponseAction();

		$payload = [
			['id' => 1, 'name' => 'Navid'],
		];

		$response = $action->searchResults('user', $payload);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testSearchResultsReturnsGivenJsonResourceData(): void
	{
		$action = new ListResponseAction();

		$payload = [
			['id' => 1, 'name' => 'Navid'],
		];

		$resource = JsonResource::make($payload);

		$response = $action->searchResults('user', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testSearchResultsReturnsFilledSearchMessageWhenCollectionHasItems(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user', [
			['id' => 1],
		]);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.searched_query_list_retrieved', ['entity' => 'user']),
			$response_data['message']
		);
	}

	public function testSearchResultsReturnsEmptySearchMessageWhenCollectionIsEmpty(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user', []);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_searched_query_list', ['entity' => 'user']),
			$response_data['message']
		);
	}

	public function testSearchResultsReturnsEmptyDataArrayByDefault(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testSearchResultsReturnsEmptySearchMessageWhenDataResourceIsOmitted(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user');

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_searched_query_list', ['entity' => 'user']),
			$response_data['message']
		);
	}

	public function testSearchResultsReturnsOkStatusCode(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user', []);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testSearchResultsReturnsSuccessResponseShape(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user', []);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testSearchResultsReturnsSuccessStatusFlag(): void
	{
		$action = new ListResponseAction();

		$response = $action->searchResults('user', []);

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
