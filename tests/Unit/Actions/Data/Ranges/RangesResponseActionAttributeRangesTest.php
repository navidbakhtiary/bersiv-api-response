<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\RangesResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class RangesResponseActionAttributeRangesTest extends TestCase
{
	public function testAttributeRangesReturnsDataKey(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user', [
			'age' => [
				'max' => 65,
				'min' => 18,
			],
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testAttributeRangesReturnsGivenArrayData(): void
	{
		$action = new RangesResponseAction();

		$payload = [
			'age' => [
				'max' => 65,
				'min' => 18,
			],
			'credit' => [
				'max' => 1000,
				'min' => 200,
			]
		];

		$response = $action->attributeRanges('user', $payload);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testAttributeRangesReturnsGivenJsonResourceData(): void
	{
		$action = new RangesResponseAction();

		$payload = [
			'age' => [
				'max' => 65,
				'min' => 18,
			],
			'credit' => [
				'max' => 1000,
				'min' => 200,
			],
		];

		$resource = JsonResource::make($payload);

		$response = $action->attributeRanges('user', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testAttributeRangesReturnsRetrievedMessageWhenRangesExist(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user', [
			'age' => [
				'max' => 65,
				'min' => 18,
			],
		]);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.attributes_ranges_retrieved', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testAttributeRangesReturnsEmptyMessageWhenRangesDoNotExist(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user', []);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_attributes_ranges', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testAttributeRangesReturnsEmptyDataArrayByDefault(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testAttributeRangesReturnsEmptyMessageWhenRangesAreOmitted(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user');

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_attributes_ranges', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testAttributeRangesReturnsOkStatusCode(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user', []);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testAttributeRangesReturnsSuccessResponseShape(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user', []);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testAttributeRangesReturnsSuccessStatusFlag(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user', []);

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
