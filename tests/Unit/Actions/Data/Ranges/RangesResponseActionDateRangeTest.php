<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Data;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Data\RangesResponseAction;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class RangesResponseActionDateRangeTest extends TestCase
{
	public function testDateRangeReturnsDataKey(): void
	{
		$action = new RangesResponseAction();

		$response = $action->dateRange('user', [
			'end_date' => '2026-12-31',
			'start_date' => '2026-01-01',
		]);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testDateRangeReturnsGivenArrayData(): void
	{
		$action = new RangesResponseAction();

		$payload = [
			'end_date' => '2026-12-31',
			'start_date' => '2026-01-01',
		];

		$response = $action->dateRange('user', $payload);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testDateRangeReturnsGivenJsonResourceData(): void
	{
		$action = new RangesResponseAction();

		$payload = [
			'end_date' => '2026-12-31',
			'start_date' => '2026-01-01',
		];

		$resource = JsonResource::make($payload);

		$response = $action->dateRange('user', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($payload, $response_data['data']);
	}

	public function testDateRangeReturnsEmptyDataArrayByDefault(): void
	{
		$action = new RangesResponseAction();

		$response = $action->dateRange('user');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testDateRangeReturnsEmptyMessageWhenRangeIsOmitted(): void
	{
		$action = new RangesResponseAction();

		$response = $action->dateRange('user');

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_date_range', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testDateRangeReturnsRetrievedMessageWhenRangeExists(): void
	{
		$action = new RangesResponseAction();

		$response = $action->dateRange('user', [
			'end_date' => '2026-12-31',
			'start_date' => '2026-01-01',
		]);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.date_range_retrieved', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testDateRangeReturnsEmptyMessageWhenRangeDoesNotExist(): void
	{
		$action = new RangesResponseAction();

		$response = $action->dateRange('user', []);

		$response_data = $response->getData(true);

		$this->assertSame(
			__('bersiv-api-response::messages.successful.empty_date_range', ['model' => 'user']),
			$response_data['message']
		);
	}

	public function testDateRangeReturnsOkStatusCode(): void
	{
		$action = new RangesResponseAction();

		$response = $action->dateRange('user', []);

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}

	public function testDateRangeReturnsSuccessResponseShape(): void
	{
		$action = new RangesResponseAction();

		$response = $action->dateRange('user', []);

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testDateRangeReturnsSuccessStatusFlag(): void
	{
		$action = new RangesResponseAction();

		$response = $action->dateRange('user', []);

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}
}
