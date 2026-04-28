<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\RangesResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class RangesResponseActionAttributeRangesTest extends TestCase
{
	public function testAttributeRangesReturnsEmptySuccessContractWhenRangesAreEmpty(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user', []);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_attributes_ranges', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testAttributeRangesReturnsEmptySuccessContractWhenRangesAreOmitted(): void
	{
		$action = new RangesResponseAction();

		$response = $action->attributeRanges('user');

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_attributes_ranges', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame([], $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testAttributeRangesReturnsSuccessContractWhenRangesExist(): void
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

		$response = $action->attributeRanges('user', $payload);

		$response_data = $response->getData(true);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.attributes_ranges_retrieved', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testAttributeRangesReturnsSuccessContractWithJsonResourceData(): void
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

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
		$this->assertTrue($response_data['success']);
		$this->assertSame(
			__('bersiv-api-response::messages.successful.attributes_ranges_retrieved', ['model' => 'user']),
			$response_data['message']
		);
		$this->assertSame($payload, $response_data['data']);
		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}
}
