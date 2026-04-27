<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Process;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Process\ProcessResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\OkResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ProcessResponseActionFinishedTest extends TestCase
{
	public function testFinishedMatchesOkResponseBuilder(): void
	{
		$action = new ProcessResponseAction();

		$actual_response = $action->finished('Data import');
		$expected_response = OkResponse::processFinished('Data import');

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testFinishedReturnsDataKey(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->finished('Data import');

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testFinishedReturnsSuccessResponseShape(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->finished('Data import');

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testFinishedReturnsGivenArrayData(): void
	{
		$action = new ProcessResponseAction();

		$data = [
			'imported_rows' => 250,
			'skipped_rows' => 3,
		];

		$response = $action->finished('Data import', $data);

		$response_data = $response->getData(true);

		$this->assertSame($data, $response_data['data']);
	}

	public function testFinishedReturnsGivenJsonResourceData(): void
	{
		$action = new ProcessResponseAction();

		$data = [
			'imported_rows' => 250,
			'skipped_rows' => 3,
		];

		$resource = JsonResource::make($data);

		$response = $action->finished('Data import', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($data, $response_data['data']);
	}

	public function testFinishedReturnsEmptyDataArrayByDefault(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->finished('Data import');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testFinishedReturnsProcessNameInMessage(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->finished('Data import');

		$response_data = $response->getData(true);

		$this->assertStringContainsString('Data import', $response_data['message']);
	}

	public function testFinishedReturnsSuccessStatusFlag(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->finished('Data import');

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}

	public function testFinishedReturnsOkStatusCode(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->finished('Data import');

		$this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
	}
}
