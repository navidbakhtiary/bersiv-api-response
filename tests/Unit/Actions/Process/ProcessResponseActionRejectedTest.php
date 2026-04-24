<?php

namespace NavidBakhtiary\BersivApiResponse\Tests\Unit\Actions\Process;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Actions\Process\ProcessResponseAction;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnprocessableEntityResponse;
use NavidBakhtiary\BersivApiResponse\Tests\TestCase;

class ProcessResponseActionRejectedTest extends TestCase
{
	public function testRejectedMatchesUnprocessableEntityResponseBuilder(): void
	{
		$action = new ProcessResponseAction();

		$actual_response = $action->rejected('Data import');
		$expected_response = UnprocessableEntityResponse::processRejected('Data import');

		$this->assertSame($expected_response->getStatusCode(), $actual_response->getStatusCode());
		$this->assertSame($expected_response->getContent(), $actual_response->getContent());
	}

	public function testRejectedReturnsErrorsKey(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->rejected('Data import');

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayNotHasKey('data', $response_data);
	}

	public function testRejectedReturnsFailureResponseShape(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->rejected('Data import');

		$response_data = $response->getData(true);

		$this->assertArrayHasKey('errors', $response_data);
		$this->assertArrayHasKey('message', $response_data);
		$this->assertArrayHasKey('success', $response_data);
	}

	public function testRejectedReturnsGivenArrayErrors(): void
	{
		$action = new ProcessResponseAction();

		$errors = [
			'process' => ['The requested process cannot be started.'],
		];

		$response = $action->rejected('Data import', $errors);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testRejectedReturnsGivenJsonResourceErrors(): void
	{
		$action = new ProcessResponseAction();

		$errors = [
			'process' => ['The requested process cannot be started.'],
		];

		$resource = JsonResource::make($errors);

		$response = $action->rejected('Data import', $resource);

		$response_data = $response->getData(true);

		$this->assertSame($errors, $response_data['errors']);
	}

	public function testRejectedReturnsEmptyErrorsArrayByDefault(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->rejected('Data import');

		$response_data = $response->getData(true);

		$this->assertSame([], $response_data['errors']);
	}

	public function testRejectedReturnsProcessNameInMessage(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->rejected('Data import');

		$response_data = $response->getData(true);

		$this->assertStringContainsString('Data import', $response_data['message']);
	}

	public function testRejectedReturnsFailureStatusFlag(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->rejected('Data import');

		$response_data = $response->getData(true);

		$this->assertFalse($response_data['success']);
	}

	public function testRejectedReturnsUnprocessableEntityStatusCode(): void
	{
		$action = new ProcessResponseAction();

		$response = $action->rejected('Data import');

		$this->assertSame(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
	}
}
