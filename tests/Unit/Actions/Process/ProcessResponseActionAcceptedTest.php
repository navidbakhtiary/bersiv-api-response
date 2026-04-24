<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Process;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Process\ProcessResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Successes\AcceptedResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ProcessResponseActionAcceptedTest extends TestCase
{
	public function testAcceptedMatchesAcceptedResponseBuilder(): void
	{
		$action = new ProcessResponseAction();

		$actual_response = $action->accepted('Data import');
		$expected_response = AcceptedResponse::processingAccepted('Data import');

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testAcceptedReturnsDataKey(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->accepted('Data import');

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayNotHasKey('errors', $response_data);
	}

	public function testAcceptedReturnsSuccessResponseShape(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->accepted('Data import');

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('data', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testAcceptedReturnsGivenArrayData(): void
	{
		$action = new ProcessResponseAction();

		$data = [
			'job_id' => 'job-123',
			'status' => 'processing',
		];

		$response = $action->accepted('Data import', $data);

		$response_data = $response->getData(true);

		$this->assertSame($data, $response_data['data']);
	}

	public function testAcceptedReturnsGivenJsonResourceData(): void
	{
		$action = new ProcessResponseAction();

		$data = [
			'job_id' => 'job-123',
			'status' => 'processing',
		];

		$resource = JsonResource::make($data);

		$response = $action->accepted('Data import', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($data, $response_data['data']);
	}

	public function testAcceptedReturnsEmptyDataArrayByDefault(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->accepted('Data import');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['data']);
	}

	public function testAcceptedReturnsProcessNameInMessage(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->accepted('Data import');

		$response_data = $response->getData(true);

		$this->assertStringContainsString('Data import', $response_data['message']);
	}

	public function testAcceptedReturnsSuccessStatusFlag(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->accepted('Data import');

		$response_data = $response->getData(true);

		$this->assertTrue($response_data['success']);
	}

	public function testAcceptedReturnsAcceptedStatusCode(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->accepted('Data import');

		$this->assertSame(JsonResponse::HTTP_ACCEPTED, $response->getStatusCode());
	}
}
